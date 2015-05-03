<?php namespace HMIF\Custom\Framework;

use Former\Framework\TwitterBootstrap3 as FormerTwitterBootstrap3;

class TwitterBootstrap3 extends FormerTwitterBootstrap3 {

    /**
     * Get an option for the current framework
     *
     * @param string $option
     *
     * @return string
     */
    protected function getFrameworkOption($option)
    {
        return $this->app['config']->get("TwitterBootstrap3.$option");
    }

}