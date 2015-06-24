<?php 
namespace Wiretech\Citrus;

use Illuminate\Support\ServiceProvider;

class CitrusServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('wiretech/citrus');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Citrus', function()
        {
            return new \Wiretech\Citrus\Classes\Citrus;
        });

        $this->app['config']->package('wiretech/citrus', 'Wiretech\Citrus\Config');
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
