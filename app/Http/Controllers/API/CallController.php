<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Call;
use Validator;
use App\Http\Resources\Call as CallResource;

class CallController extends BaseController
{

    public function index()
    {
        $calls = Call::all();
        return $this->sendResponse(CallResource::collection($calls), 'Calls retrieved successfully.');
    }
}
