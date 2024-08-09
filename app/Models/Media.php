<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Concerns\HasTranslations;
use App\Libraries\Database\Eloquent\Concerns\Filterable;
use App\Libraries\Database\Eloquent\Concerns\HasColumns;
use App\Libraries\Database\Eloquent\Concerns\HasRoutes;
use App\Libraries\Database\Eloquent\Concerns\AdminOrderable;
use App\Libraries\Database\Eloquent\Concerns\AdminSearchable;
use App\Libraries\Database\Eloquent\Contracts\TableContract;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use Spatie\MediaLibrary\Support\UrlGenerator\UrlGeneratorFactory;
use Spatie\MediaLibrary\Helpers\File;

class Media extends BaseMedia implements TableContract
{
    use Filterable,
        HasColumns,
        HasRoutes,
        HasTranslations,
        AdminOrderable,
        AdminSearchable;

    public function getUrl(string $conversionName = ''): string
    {
        $urlGenerator = UrlGeneratorFactory::createForMedia($this, $conversionName);

        $url = $urlGenerator->getUrl();

        if (env('MEDIA_DISK') === 'minio') {
            $components = parse_url($url);
            $port = $components['port'];
            $path = $components['path'];

            $url = env('APP_URL').':'.$port.$path;
        }

        return $url;
    }

    public function getHumanReadableSizeAttribute(): string
    {
        return getHumanReadableSize($this->size);
    }
}
