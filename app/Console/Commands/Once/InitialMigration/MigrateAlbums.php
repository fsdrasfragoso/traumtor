<?php

namespace App\Console\Commands\Once\InitialMigration;

use App\Models\Album;

trait MigrateAlbums
{
    public function migrateAlbums()
    {
        $album = Album::query()->where('type', 'default')->first();
        if(!$album) {
            $album = new Album();

            $album->type = 'default';
            $album->title = 'default';
            $album->slug = 'default';
            $album->save();
        }

        $this->migrateMedias(2, 'App\PhotoAlbum', 'default', $album->id, Album::class, 'default');
    }
}
