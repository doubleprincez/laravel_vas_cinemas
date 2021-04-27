<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Cinema\Contracts\CinemaInterface;
use Modules\Core\Contracts\CoreInterface;
use Modules\Core\Repository\CoreRepository;
use Modules\Movie\Contracts\MovieInterface;
use Modules\User\Contracts\UserInterface;

class BindingServiceProvider extends ServiceProvider
{

    public function register()
    {
        $version = $this->getVersion();

        $cinema_repo = 'Modules\Cinema\Repository\\' . $version . '\\CinemaRepository';
        $movie_repo = 'Modules\Movie\Repository\\' . $version . '\\MovieRepository';
        $user_repo = 'Modules\User\Repository\\' . $version . '\\UserRepository';

        // Ensure all interfaces have their corresponding repositories included...
        // both arrays must have equal length

        $interfaces = [CoreInterface::class, CinemaInterface::class, MovieInterface::class, UserInterface::class,];
        $repos = [CoreRepository::class, $cinema_repo, $movie_repo, $user_repo];

        $this->bindRepos($interfaces, $repos);
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

    private function bindRepos(array $interfaces, array $repositories): bool
    {
        foreach ($interfaces as $i => $key) {
            $this->app->bind($interfaces[$i], $repositories[$i]);
        }
        return true;
    }

    public function boot()
    {

    }

}
