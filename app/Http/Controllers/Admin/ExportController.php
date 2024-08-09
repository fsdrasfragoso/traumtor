<?php

namespace App\Http\Controllers\Admin;

use App\Models\Export;
use App\Repositories\ExportRepository;

class ExportController extends CrudController
{
    /**
     * Type of the resource to manage.
     *
     * @var string
     */
    protected $resourceType = Export::class;

    /**
     * Type of the managing repository.
     *
     * @var string
     */
    protected $repositoryType = ExportRepository::class;

    /**
     * Download exported csv file.
     *
     * @param string $export
     *
     * @return Response File
     */
    public function download(Export $export)
    {
        try {
            $media = $export->getFirstMedia('csv');
             activity()
                ->performedOn($export)
                ->log('download');

            return $media;
        } catch (\Throwable $th) {
            abort(404, 'File not found');
        }
    }
}
