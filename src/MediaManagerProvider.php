<?php

namespace VCComponent\Laravel\MediaManager;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use VCComponent\Laravel\MediaManager\Entities\MediaItem;
use VCComponent\Laravel\MediaManager\Repositories\CollectionRepositoryImpl;
use VCComponent\Laravel\MediaManager\Repositories\Contracts\CollectionRepository;
use VCComponent\Laravel\MediaManager\Repositories\Contracts\MediaRepository;
use VCComponent\Laravel\MediaManager\Repositories\MediaRepositoryImpl;

class MediaManagerProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CollectionRepository::class, CollectionRepositoryImpl::class);
        $this->app->bind(MediaRepository::class, MediaRepositoryImpl::class);
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'media' => MediaItem::class,
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->publishes([
            __DIR__ . '/../config/vc-media-manager.php' => config_path('vc-media-manager.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../database/migrations/create_collections_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_collections_table.php'),
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/../database/migrations/create_media_items_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_media_items_table.php'),
        ], 'migrations');
    }
}
