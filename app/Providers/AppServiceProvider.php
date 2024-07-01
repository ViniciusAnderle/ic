<?php



namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Mediators\ReservationMediator;
use App\Mediators\ReservationMediatorInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ReservationMediatorInterface::class, ReservationMediator::class);
    }
}
