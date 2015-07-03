<?php namespace HMIF\Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Lang;
use View;

class UserServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot()
    {
        Lang::addNamespace('user', __DIR__.'/../Resources/lang');

        View::addNamespace('user', __DIR__.'/../Resources/views');
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{		
		$this->registerConfig();
	}

	/**
	 * Register config.
	 * 
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'user'
		);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
