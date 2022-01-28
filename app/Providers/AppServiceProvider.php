<?php

namespace App\Providers;

use App\Repositories\{
    CompanyRepository,
    Contracts\CompanyRepositoryContract,
    Contracts\UserRepositoryContract,
    UserRepository
};
use Illuminate\Contracts\Mail\{
    Factory,
    MailQueue
};
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
        $this->app->bind(CompanyRepositoryContract::class, CompanyRepository::class);
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->alias('mail.manager', Factory::class);
        $this->app->alias('mailer', MailQueue::class);
    }
}
