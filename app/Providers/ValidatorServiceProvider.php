<?php namespace HMIF\Providers;

use HMIF\Custom\Validator\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any necessary services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->resolver(function($translator, $data, $rules, $messages)
        {
            return new Validator($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }


}
