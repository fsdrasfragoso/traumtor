<?php

namespace App\Repositories\Concerns;


use App\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;

trait WithFiles
{
    /**
     * Add media attachment.
     *
     * @param HasMedia $resource
     * @param string $collection
     * @param string $file
     */
    protected function addFileToCollection($resource, $collection, $file, $fromDisk = false)
    {
        if ($file)
        {
            $resource->clearMediaCollection($collection);
            if($fromDisk) {
                $resource->addMediaFromDisk($file)->toMediaCollection($collection);
            } else {
                $resource->addMedia($file)->toMediaCollection($collection);
            }
        }
    }

    /**
     * Add media attachment.
     *
     * @param HasMedia $resource
     * @param string $collection
     * @param string $file
     */
    protected function addBase64FileToCollection($resource, $collection, $file)
    {
        $resource->clearMediaCollection($collection);
        if ($file) {
            $resource->addMediaFromBase64($file)
                ->toMediaCollection($collection);
        }
    }

    /**
     * Add multiple media attachments.
     *
     * @param HasMedia $resource
     * @param string $collection
     * @param string $key
     */
    protected function addMultipleFilesToCollection($resource, $collection, $key = null)
    {
        $key = $key ?: $collection;

        $files = request()->file($key);

        if (is_array($files)) {
            foreach ($files as $file) {
                $resource->addMedia($file)
                    ->toMediaCollection($collection);
            }
        }
    }

    /**
     * Save file meta to media.
     *
     * @param HasMedia $resource
     * @param string $collection
     * @param string $key
     */
    protected function saveFileMeta($resource, $collection, $key = null)
    {
        $key = $key ?: $collection . '_meta';

        $input = request()->input($key);

        if (is_array($input)) {
            foreach ($input as $id => $meta) {
                /** @var Media $media */
                if ($media = $resource->media()->find($id)) {
                    $properties = $media->custom_properties ?: [];

                    foreach ($meta as $property => $value) {
                        $properties[$property] = $value;
                    }

                    $media->custom_properties = $properties;
                    $media->save();
                }
            }
        }
    }
}
