<?php

namespace App\Http\Controllers\WebService;

use App\Http\Controllers\Controller;
use App\Repositories\AddressRepository;
use App\Libraries\Viacep\AddressRepository as ViacepRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Find address
     *
     * @param Request $request
     * @return Response
     */
    public function find(Request $request, $zip_code)
    {
        $address = (new ViacepRepository())->find($zip_code);

        if ($address) {
            return response()->json($address);
        }

        return abort(404);
    }
}
