<?php


namespace App\Facades;


use App\Services\FeatureTagsService;
use Illuminate\Support\Facades\Facade;

class FeatureTag extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FeatureTagsService::class;
    }
}