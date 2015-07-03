<?php namespace HMIF\Custom\Displayer;

use Exception;
use GrahamCampbell\Exceptions\Displayers\DisplayerInterface;

class HtmlDisplayer implements DisplayerInterface
{
    public function display(Exception $exception, $code, array $headers)
    {
        ob_start();
        include base_path('resources/views/errors/error.blade.php');
        $content = ob_get_clean();

        return Response($content, $code, array_merge($headers, ['Content-Type' => 'text/html']));
    }

    /**
     * Get the supported content type.
     *
     * @return string
     */
    public function contentType()
    {
        return 'text/html';
    }

    /**
     * Can we display the exception?
     *
     * @param \Exception $exception
     *
     * @return bool
     */
    public function canDisplay(Exception $exception)
    {
        return true;
    }

    /**
     * Do we provide verbose information about the exception?
     *
     * @return bool
     */
    public function isVerbose()
    {
        return false;
    }
}
