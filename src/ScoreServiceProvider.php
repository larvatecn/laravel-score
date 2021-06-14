<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

declare (strict_types=1);

namespace Larva\Score;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class ScoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang'),
            ], 'score-lang');
        }

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'score');

        // Transaction
        Event::listen(\Larva\Transaction\Events\ChargeClosed::class, \Larva\Score\Listeners\ChargeClosedListener::class);//支付关闭
        Event::listen(\Larva\Transaction\Events\ChargeFailure::class, \Larva\Score\Listeners\ChargeFailureListener::class);//支付失败
        Event::listen(\Larva\Transaction\Events\ChargeShipped::class, \Larva\Score\Listeners\ChargeShippedListener::class);//支付成功

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