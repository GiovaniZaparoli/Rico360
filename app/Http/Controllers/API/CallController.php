<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Call;
use Illuminate\Http\Request;
use App\Services\CallService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Call as CallResource;
use App\Http\Controllers\API\BaseController as BaseController;



class CallController extends BaseController
{

    protected $callService;

    public function __construct(CallService $callService)
    {
        $this->callService = $callService;
    }

    public function index(Request $request)
    {
        $calls = $this->callService->getAllCalls($request->all());
        return $this->sendResponsePaginated(CallResource::collection($calls), $calls, 'Calls retrieved successfully.');
    }
}
