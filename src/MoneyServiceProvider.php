<?php

namespace LaravelTech\Money;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class MoneyServiceProvider
 * @package LaravelTech\Money
 */
class MoneyServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/money.php' => config_path('money.php'),
            ], 'money-config');
        }

        Blade::directive('money', function ($expression) {
            return "<?php echo money(${expression}); ?>";
        });
    }
}
