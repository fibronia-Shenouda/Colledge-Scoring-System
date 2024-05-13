<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;



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
    public function boot()
    {
        Validator::extend('more_than_150_words', function ($attribute, $value, $parameters, $validator) {
            $wordCount = str_word_count($value);
            return $wordCount > 150;
        });

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
    
}
