<?php

namespace App\Exceptions;

use ErrorException;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Rareloop\Lumberjack\Exceptions\Handler as LumberjackHandler;
use Rareloop\Lumberjack\Facades\Config;
use Rareloop\Lumberjack\Facades\Log;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Timber\Timber;
use Psr\Http\Message\ServerRequestInterface;

class Handler extends LumberjackHandler
{
    protected $dontReport = [];

    public function report(Exception $e)
    {
        // Lumberjack replaces Sentry's handlers on the front end, so forward to Sentry here.
        if (function_exists('Sentry\\captureException') && $this->coveredBySentry($e)) {
            \Sentry\captureException($e);
        }

        parent::report($e);
    }

    /**
     * Whether Sentry's configured error types cover the exception. captureException() bypasses the error handler
     * that WP_SENTRY_ERROR_TYPES configures, so the mask is applied here.
     */
    private function coveredBySentry(Exception $e): bool
    {
        if (!$e instanceof ErrorException || !defined('WP_SENTRY_ERROR_TYPES')) {
            return true;
        }

        return (bool) (constant('WP_SENTRY_ERROR_TYPES') & $e->getSeverity());
    }

    public function render(ServerRequestInterface $request, Exception $e): ResponseInterface
    {
        // Provide a customisable error rendering when not in debug mode
        try {
            if (Config::get('app.debug') === false) {
                $data = Timber::get_context();
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
