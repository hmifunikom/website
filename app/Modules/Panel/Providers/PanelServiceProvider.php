<?php namespace HMIF\Modules\Panel\Providers;

use Illuminate\Support\ServiceProvider;
use Lang;
use View;

class PanelServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot()
    {
        Lang::addNamespace('panel', __DIR__.'/../Resources/lang');

        View::addNamespace('panel', __DIR__.'/../Resources/views');
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
		    __DIR__.'/../Config/config.php', 'panel'
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
