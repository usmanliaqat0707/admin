<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MentorshipApplication;
use Illuminate\Support\Facades\Http;

class MoodleController extends Controller
{
    public function enroll(Request $request, $id)
    {
        $applicant = MentorshipApplication::findOrFail($id);

        // Example MoodleCloud API call
        $applicant = MentorshipApplication::findOrFail($id);

        $domain = 'https://msj.moodlecloud.com';
        $token = 'YOUR_API_TOKEN';
        $courseid = 2;
        $roleid = 5;

        return response()->json([
            'message' => $applicant
        ]);
    }
}