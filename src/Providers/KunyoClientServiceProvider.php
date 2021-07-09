<?php

namespace Kunyo\RewardSystem\Providers;

use Illuminate\Support\ServiceProvider;

class KunyoClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
	public function boot()
	{
        // use routes from file api.php in package
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        
        // load migration schemas 
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
	}	

	/**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Load configuration and merge
        $this->mergeConfigFrom(__DIR__ . '/../config/kunyo-client.php', 'kunyo-client');

        // publish configuration
        $this->publishes([
            __DIR__ . '/../config/kunyo-client.php' => config_path('kunyo-client.php'),
        ]);

        $this->app->bind(\Kunyo\RewardSystem\Repositories\OrderInterface::class, \Kunyo\RewardSystem\Repositories\OrderRepository::class);
        $this->app->bind(\Kunyo\RewardSystem\Repositories\OrderProductInterface::class, \Kunyo\RewardSystem\Repositories\OrderProductRepository::class);
        $this->app->bind(\Kunyo\RewardSystem\Repositories\CustomerInterface::class, \Kunyo\RewardSystem\Repositories\CustomerRepository::class);
        $this->app->bind(\Kunyo\RewardSystem\Repositories\RewardInterface::class, \Kunyo\RewardSystem\Repositories\RewardRepository::class);
    }
}
