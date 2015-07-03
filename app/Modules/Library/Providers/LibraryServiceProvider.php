<?php namespace HMIF\Modules\Library\Providers;

use Illuminate\Support\ServiceProvider;
use Lang;
use View;

class LibraryServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot()
    {
        Lang::addNamespace('library', __DIR__.'/../Resources/lang');

        View::addNamespace('library', __DIR__.'/../Resources/views');
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
		    __DIR__.'/../Config/config.php', 'library'
		);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
