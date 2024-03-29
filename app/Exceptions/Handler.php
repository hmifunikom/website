<?php namespace HMIF\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;
use Exception;
use GrahamCampbell\Exceptions\ExceptionHandler as ExceptionHandler;

class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException'
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        if (app()->environment() === 'production')
        {
            Log::error($e);
        }

        foreach ($this->dontReport as $type)
        {
            if ($e instanceof $type)
                return parent::report($e);
        }

        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($this->isHttpException($e))
        {
            return $this->renderHttpException($e);
        }

        if ($e instanceof ModelNotFoundException)
        {
            return response()->view("errors.404", [], 404);
        }

        return parent::render($request, $e);
    }

}
