<?php

declare(strict_types=1);

namespace Francken\Shared\Providers;

use DateTimeImmutable;
use DateTimeZone;
use Francken\Infrastructure\Http\Controllers\DashboardController;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

final class NavigationServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        View::composer('layout._header', function ($view) : void {
            $menu = $this->app->config->get('francken.navigation.menu');
            $menu[1]['icon'] = $this->associationIcon();

            $settings = $this->app->make(\Francken\Shared\Settings\Settings::class);
            if ($settings->isPienterShownInNavigation()) {
                $menu[] = [
                    'url' => 'http://pienterkamp.nl/',
                    'title' => 'Pienterkamp',
                    'subItems' => [],
                    'icon' => 'child'
                ];
            }
            if ($settings->isSymposiumShownInNavigation()) {
                $menu[] = [
                    'url' => 'https://franckensymposium.nl',
                    'title' => 'Symposium',
                    'subItems' => [],
                    'icon' => 'globe-europe',
                ];
            }
            if ($settings->isSlefShownInNavigation()) {
                $menu[] = [
                    'url' => 'https://slef.nl',
                    'title' => 'Slef',
                    'subItems' => [],
                    'icon' => 'globe-europe',
                ];
            }
            if ($settings->isLustrumShownInNavigation()) {
                $menu[] = [
                    'url' => '/lustrum',
                    'title' => 'Lustrum',
                    'subItems' => [
                        [
                            'url' => '/lustrum/blue-beard-pirates',
                            'icon' => 'fa fa-skull-crossbones',
                            'title' => 'Blue beards',
                            'description' => 'Join the blue team and win the Lustrum week',
                        ],
                        [
                            'url' => '/lustrum/red-beard-pirates',
                            'icon' => 'fa fa-skull-crossbones',
                            'title' => 'Red beards',
                            'description' => "Join the red team and don't win the Lustrum week",
                        ],
                        [
                            'url' => '/lustrum/adtchievements',
                            'icon' => 'fa fa-trophy',
                            'title' => 'Adtchievements',
                            'description' => "",
                        ]
                    ],
                    'icon' => 'water',
                ];
            }
            if ($settings->isExpeditionShownInNavigation()) {
                $menu[] = [
                    'url' => 'https://expeditionstrategy.nl/',
                    'title' => 'Expedition Strategy',
                    'subItems' => [],
                    'icon' => 'building',
                ];
            }

            $user = Auth::user();
            if ($user !== null) {
                $menu[] = [
                    'url' => '/profile',
                    'title' => 'Profile',
                    'icon' => 'user',
                    'subItems' => array_filter([
                        // Job prospects
                        ['url' => '/profile/expenses', 'icon' => 'fa fa-chart-bar', 'title' => 'Expenses'],

                        ($user->can('can-access-dashboard')
                         ? ['url' => action([DashboardController::class, 'redirectToDashboard']), 'icon' => 'fa fa-database', 'title' => 'Admin', 'can' => 'can-access-dashboard']
                         : []),
                        ['url' => route('logout'), 'icon' => 'fas fa-sign-out-alt', 'title' => 'Logout']
                    ]),
                ];
            } else {
                if ($settings->isLoginShownInNavigation()) {
                    $menu[] = [
                        'url' => route('login'),
                        'title' => 'Login',
                        'subItems' => [],
                        'icon' => '',
                        'class' => 'login-link',
                    ];
                }
            }

            $gate = $this->app->make(Gate::class);
            $view->with('items', array_filter($menu, function ($item) use ($gate) {
                // If no permission rule is set always allow showing the item
                return ! isset($item['can']) || $gate->allows($item['can']);
            }));
        });

        View::composer('admin.layout', function ($view) : void {
            $menu = $this->app->config->get('francken.navigation.admin-menu');

            $view->with('menu', $menu);
        });

        View::composer('homepage._pillars', function ($view) : void {
            $view->with('associationIcon', $this->associationIcon());
        });
    }

    public function associationIcon()
    {
        $now = (new DateTimeImmutable())
            ->setTimeZone(new DateTimeZone('Europe/Amsterdam'));

        $fourOClock = DateTimeImmutable::createFromFormat('H a', '4 pm')
            ->setTimeZone(new DateTimeZone('Europe/Amsterdam'));

        $fourOClockMorning = DateTimeImmutable::createFromFormat('H a', '4 am')
            ->setTimeZone(new DateTimeZone('Europe/Amsterdam'));

        if ($fourOClockMorning < $now && $now < $fourOClock) {
            return 'coffee';
        }

        return 'beer';
    }
}
