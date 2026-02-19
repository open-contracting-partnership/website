<?php

return [
    /**
     * The driver to use to store the session (defaults to `file`)
     */
    'driver' => $_ENV['SESSION_DRIVER'] ?: 'file',

    /**
     * The name of the cookie that is set in a visitors browser
     */
    'cookie' => $_ENV['SESSION_COOKIE'] ?: 'lumberjack_session',

    /**
     * How long the session will persist for
     */
    'lifetime' => $_ENV['SESSION_LIFETIME'] ?: 120,

    /**
     * The URL path that will be considered valid for the cookie. Normally this is the
     * root of the domain but might need to be changed if serving WordPress from a sub-directory.
     */
    'path' => '/',

    /**
     * The domain that the cookie is valid for
     */
    'domain' => $_ENV['SESSION_DOMAIN'] ?: null,

    /**
     * If true, the cookie will only be sent if the connection is done over HTTPS
     */
    'secure' => $_ENV['SESSION_SECURE_COOKIE'] ?: false,

    /**
     * If true, JavaScript will not be able to access the cookie data
     */
    'http_only' => true,

    /**
     * Should the session data be encrypted when stored?
     */
    'encrypt' => false,

    /**
     * When using the `file` driver this is the path to which session data is stored.
     * If none is specified the default PHP location will be used.
     */
    'files' => false,
];
