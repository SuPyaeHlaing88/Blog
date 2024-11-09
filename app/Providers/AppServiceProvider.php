<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap(); //for desanding or order management

        Gate::define('delete-articlce', function($user, $article){
            return $user->id == $article->user_id;
        });

        Gate::define('delete-comment', function($user, $comment){
            return $user->id == $comment->user_id
                or  $user->id == $comment->article->user_id;
        });
    }
}
