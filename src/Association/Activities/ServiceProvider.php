<?php

declare(strict_types=1);

namespace Francken\Association\Activities;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\View\Factory as View;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot() : void
    {
        $view = $this->app->make(View::class);

        $view->composer(
            'association.activities.index',
            ActivitiesSidebarComposer::class
        );

        $view->composer(
            'association.activities.ical',
            ActivitiesSidebarComposer::class
        );

        $this->app->bind(
            ActivitiesRepository::class,
            function ($app) {
                return new ActivitiesRepository(
                    fopen(storage_path('app/calendar.ics'), 'r')
                );
            }
        );
    }
}
