<?php

namespace App\Jobs\Export;

use App\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Pagination\Paginator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\Csv\Writer;
use App\Repositories\Repository;

class CsvExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 7200;

    /**
     * @var Export
     */
    public $export;

    /**
     * Current page for paginator to enhance queries.
     *
     * @var int
     */
    public $page;

    /**
     * Create a new job instance.
     *
     * @param Export $export
     */
    public function __construct(Export $export) {

        $this->queue = 'exports';

        $this->export = $export;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {

            $export = $this->export;
            $export->status = Export::STATUS_PENDING;
            $export->save();

            $this->overwritePageResolver();

            $storagePath = storage_path('app/exports');
            $fileName = $export->buildFileName().'.csv';
            $fullPath = $storagePath.'/'.$fileName;

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            $writer = Writer::createFromPath($fullPath, 'w+');

            $writer->setDelimiter(';');
            $writer->setNewline("\r\n");
            $writer->setOutputBOM(Writer::BOM_UTF8);

            $this->exportData($export, $writer);

            $export->addMedia($fullPath)
                ->toMediaCollection('csv');

            $export->status = Export::STATUS_SUCCESS;
            $export->save();

        } catch (\Exception $e) {
            $export->status = Export::STATUS_FAILED;
            $export->save();

            throw $e;
        }
    }

    /**
     * Do exportation.
     *
     * @param Export $export
     * @param Writer $writer
     * @throws \League\Csv\CannotInsertRecord
     */
    protected function exportData($export, $writer)
    {
        $repository = $export->getRepository();
        $parameters = $export->parameters;
        data_set($parameters, 'user_id', $export->user_id);
        
        $writer->insertOne($this->convertEncoding($this->getCsvHeader($repository)));
        
        $columns = $repository->getInstance()->getExportColumns();
        
        $columns = array_filter($columns, function ($c) {
            return $c != 'blank';
        });
        
        $this->page = 1;

        while (($result = $repository->export($parameters)) && !$result->isEmpty()) {
            foreach ($result->items() as $item) {
                $rowData = [];

                foreach ($columns as $column) {
                    $rowData[] = $item->getAdminColumn($column, true);
                }

                $writer->insertOne($this->convertEncoding($rowData));
            }

            ++$this->page;
            
            data_set($parameters, 'page', $this->page);
        }
    }

    /**
     * Get csv header.
     *
     * @param Repository $repository
     * @return array
     */
    protected function getCsvHeader($repository)
    {
        $type = get_class($repository->getInstance());

        $columns = $repository->getInstance()->getExportColumns();

        $columns = array_filter($columns, function ($c) {
            return $c != 'blank';
        });

        return collect($columns)
            ->map(function ($column) use ($type) {
                return modelAttribute($type, $column);
            })
            ->toArray();
    }

    /**
     * Updates paginator page resolver.
     */
    protected function overwritePageResolver()
    {
        Paginator::currentPageResolver(function ($pageName) {
            return $this->page;
        });
    }

    /**
     * Converts encoding of strings.
     *
     * @param array $data
     * @return array
     */
    protected function convertEncoding($data)
    {
        foreach ($data as $key => $item) {
            if ($item === 'ID') {
                $item = 'Id';
            }

            $data[$key] = is_string($item)
                ? mb_convert_encoding($item, 'Windows-1252', 'auto')
                : $item;
        }

        return $data;
    }

    /**
     * Job tags
     *
     * @return array
     */
    public function tags()
    {
        return [
            'export:' . $this->export->id
        ];
    }
}
