<?php

namespace App\Exceptions;

use ErrorException;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rareloop\Lumberjack\Exceptions\Handler as LumberjackHandler;
use Rareloop\Lumberjack\Facades\Config;
use Rareloop\Lumberjack\Facades\Log;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;

class Handler extends LumberjackHandler
{
    protected $dontReport = [];

    public function report(Exception $e)
    {
        if ($e instanceof ErrorException) {
            $ignoredSeverities = [
                E_DEPRECATED,
                E_USER_DEPRECATED,
                E_NOTICE,
                E_USER_NOTICE,
            ];

            if (in_array($e->getSeverity(), $ignoredSeverities, true)) {
                return;
            }
        }

        // Lumberjack replaces Sentry's handlers on the front end, so forward to Sentry here.
        if (function_exists('Sentry\\captureException')) {
            \Sentry\captureException($e);
        }

        parent::report($e);
    }

    public function render(ServerRequestInterface $request, Exception $e): ResponseInterface
    {
        // Provide a customisable error rendering when not in debug mode
        try {
            if (Config::get('app.debug') === false) {
                $data = Timber::context();
                $data['exception'] = $e;

                return new TimberResponse('templates/errors/whoops.twig', $data, 500);
            }
        } catch (Exception $customRenderException) {
            // Something went wrong in the custom renderer, log it and show the default rendering
            Log::error($customRenderException);
        }

        return parent::render($request, $e);
    }
}
