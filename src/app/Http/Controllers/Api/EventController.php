<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            ['data' => Event::all()]
        );
    }
}