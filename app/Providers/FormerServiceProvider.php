<?php namespace HMIF\Providers;

use HMIF\Custom\Former\Populator;
use Former\FormerServiceProvider as RealFormerServiceProvider;
use Illuminate\Container\Container;

class FormerServiceProvider extends RealFormerServiceProvider {

    /**
     * Bind Former classes to the container
     *
     * @param  Container $app
     *
     * @return Container
     */
    public function bindFormer(Container $app)
    {
        $app = parent::bindFormer($app);

        $app->singleton('former.populator', function ($app) {
            return new Populator();
        });

        return $app;
    }

}
