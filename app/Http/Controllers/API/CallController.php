<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Call as CallResource;
use App\Http\Controllers\API\BaseController as BaseController;



class CallController extends BaseController
{

    public function index()
    {
        $calls = Call::all();
        return $this->sendResponse(CallResource::collection($calls), 'Calls retrieved successfully.');
    }

    public function create(Request $request)
    {
        $call_number = $request->call_number;
        $to_number = $request->to_number;

        $client = new Client($_ENV["TWILLO_SID"], $_ENV["TWILLO_TOKEN"]);

    }
}
