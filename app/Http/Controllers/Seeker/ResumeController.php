<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResumeController extends Controller
{
    public function index(Request $request): View
    {
        $profile = $request->user()->jobSeekerProfile;

        return view('jobseeker.resume', [
            'profile' => $profile,
        ]);
    }
}
