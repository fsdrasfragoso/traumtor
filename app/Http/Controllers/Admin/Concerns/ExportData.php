<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Jobs\Export\CsvExport;
use App\Models\Export;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait ExportData
{
    /**
     * Creates export job.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function export(Request $request)
    {
        $this->authorize('export', $this->resourceType);

        $export = new Export();
        $export->user_id = user()->getKey();
        $export->model = get_class($this->getRepository()->getInstance());
        $export->repository = get_class($this->getRepository());
        $export->parameters = $request->all();
        $export->save();

        $job = new CsvExport($export);

        dispatch($job);

        return redirect()->back()
            ->with('success', __('Exportação solicitada com sucesso!'));
    }
}
