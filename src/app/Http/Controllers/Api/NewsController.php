<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(
            ['data' => News::all()]
        );
    }
}