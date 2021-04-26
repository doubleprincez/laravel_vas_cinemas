<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Cinema\Contracts\CinemaInterface;
use Modules\Core\Contracts\CoreInterface;
use Modules\Core\Repository\CoreRepository;
use Modules\Movie\Contracts\MovieInterface;

class BindingServiceProvider extends ServiceProvider
{

    public function register()
    {
        $version = $this->getVersion();

        $cinema_repo = 'Modules\Cinema\Repository\\' . $version . '\\CinemaRepository';
        $movie_repo = 'Modules\Movie\Repository\\' . $version . '\\MovieRepository';
        $this->app->bind(CoreInterface::class, CoreRepository::class);

        $this->app->bind(CinemaInterface::class, $cinema_repo);
        $this->app->bind(MovieInterface::class, $movie_repo);
    }

    /**
     * Setting the current version this app is using
     * @param null
     * @return string
     */
    private function getVersion(): string
    {
        $v = (string)config('current_version');

        // On upgrading to a new version, you include the version name as a string here
        // and use the ps-4 naming convention as indicated in config.app
        if ($v === "1.0") {
            $version = 'v_one_zero';
        } else {
            $version = 'v_one_zero';
        }
        return $version;
    }

    public function boot()
    {

    }

}
