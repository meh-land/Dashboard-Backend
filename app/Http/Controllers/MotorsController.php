<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MotorsController extends Controller
{
    public function checkVelocities()
    {
        $filePath = storage_path('app/Motors.txt'); 

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'status file does not exist.'], 404);
        }

        $lastLine = $this->getLastLine($filePath);

        // Check if the last line has changed
        $cachedLastLine = Cache::get('last_motors_line', '');

        if ($lastLine !== $cachedLastLine) {
            // Update the cache
            Cache::put('last_motors_line', $lastLine, now()->addMinutes(10));

            return response()->json(['new_line' => $lastLine]);
        }

        return response()->json(['message' => 'No changes detected.']);
    }

    private function getLastLine($filePath)
    {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return array_pop($lines);
    }
}
