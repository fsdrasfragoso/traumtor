<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\FootballerRepository;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;

class DefaultController extends Controller
{
    /**
     * Redirect user to dashboard.
     *
     * @return RedirectResponse
     */
    public function show()
    {
        $footballers = (new FootballerRepository())->selectOptions();

        $start_date = date('d/m/Y');
        $end_date = date('d/m/Y');
        
        $reportrange = request()->input('reportrange');
        $footballer_id = request()->input('footballer');

        if ($reportrange) {
            $reportrange = explode('-', preg_replace('/\s/', '', $reportrange));
            $start_date = $reportrange[0];
            $end_date = $reportrange[1];
        }

        return view('admin.default.show')
            ->with('footballers', $footballers)
            ->with('footballer_id', $footballer_id)
            ->with('start_date', $start_date)
            ->with('end_date', $end_date);
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        return "Cache is cleared";
    }
}
