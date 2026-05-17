<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::post('/test-upload', function (Request $request) {
    Log::info('Test upload endpoint hit');
    Log::info('Has file', ['has_file' => $request->hasFile('company_logo')]);
    Log::info('All files', ['files' => array_keys($request->allFiles())]);
    Log::info('All input', ['input' => array_keys($request->all())]);
    
    if ($request->hasFile('company_logo')) {
        $file = $request->file('company_logo');
        Log::info('File details', [
            'name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime' => $file->getMimeType(),
        ]);
        
        $path = $file->store('logos', 'public');
        Log::info('File stored at', ['path' => $path]);
        
        return response()->json(['success' => true, 'path' => $path]);
    }
    
    return response()->json(['success' => false, 'message' => 'No file']);
})->middleware('auth');
