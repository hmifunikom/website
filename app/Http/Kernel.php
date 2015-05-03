<?php namespace HMIF\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Krucas\Notification\Middleware\NotificationMiddleware',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        'HMIF\Http\Middleware\VerifyCsrfToken',
        'HMIF\Http\Middleware\Secure',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'       => 'HMIF\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest'      => 'HMIF\Http\Middleware\RedirectIfAuthenticated',
    ];

}
