<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StatisticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StatisticController extends Controller
{
    /** @var StatisticsService $statistics */
    private $statistics;

    public function __construct(StatisticsService $statistics)
    {
        $this->statistics = $statistics;
    }

    public function paymentsSumTotal(Request $request)
    {
        $reportrange = $request->input('reportrange');
        $product = $request->input('product');

        $data = $this->statistics
            ->paymentsSumTotal(
                $this->statistics->dateBegin($reportrange),
                $this->statistics->dateEnd($reportrange),
                $product
            );

        return response()->json($data);
    }

    public function paymentsSumRefund(Request $request)
    {
        $reportrange = $request->input('reportrange');
        $book = $request->input('book');

        $data = $this->statistics
            ->paymentsSumRefund(
                $this->statistics->dateBegin($reportrange),
                $this->statistics->dateEnd($reportrange),
                $book
            );

        return response()->json($data);
    }
}
