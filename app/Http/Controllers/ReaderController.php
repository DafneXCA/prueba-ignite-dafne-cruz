<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\JsonResponse;

class ReaderController extends Controller
{
    public function show(Title $title): JsonResponse
    {
        return response()->json([
            'code' => 'READER_ACCESS_GRANTED',
            'data' => [
                'title_id' => (int) $title->id,
                'title_name' => (string) $title->name,
            ],
        ]);
    }
}
