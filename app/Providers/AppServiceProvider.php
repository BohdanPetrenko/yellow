<?php

namespace App\Providers;

use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Mail\Factory;
use Illuminate\Contracts\Mail\MailQueue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->alias('mail.manager', Factory::class);
        $this->app->alias('mailer', MailQueue::class);
    }
}
