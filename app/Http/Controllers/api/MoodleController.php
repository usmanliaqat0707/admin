<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MentorshipApplication;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Services\MoodleService;

class MoodleController extends Controller
{
    public function enroll(Request $request, MoodleService $moodle, $id)
    {
        $applicant = MentorshipApplication::findOrFail($id);

        $user = [
            'username' => $this::generateUsername($applicant->email),
            'password' => $this::generateSecurePassword(),
            'firstname' => $applicant->first_name,
            'lastname' => $applicant->second_name,
            'email' => $applicant->email,
        ];

        $createResponse = $moodle->createUser($user);

        if (!$createResponse['success']) {
            return response()->json(['error' => $createResponse['message']], 400);
        }

        $userId = $createResponse['user_id'];
        $courseId = $applicant->programme_id; 

        $enrollResponse = $moodle->enrollUser($userId, $courseId);

        if (!$enrollResponse['success']) {
            return response()->json(['warning' => 'User created but enrollment failed', 'message' => $enroll['message']], 400);
        }

        $update = MentorshipApplication::updateOrCreate(
            ['id' => $applicant->id],
            [
                'username' => $user['username'],
                'password' => $user ['password'],
                'is_eligible' => 1
            ]
        );

        return response()->json([
            'message' => 'User created and enrolled successfully',
            'user_id' => $userId
        ]); 
    }

    private function generateSecurePassword($length = 12): string
    {
        $uppercase    = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase    = 'abcdefghijklmnopqrstuvwxyz';
        $numbers      = '0123456789';
        $specialChars = '!@#$%^&*()-_=+[]{}<>?';
    
        // Ensure at least one of each required character type
        $password = [
            $uppercase[random_int(0, strlen($uppercase) - 1)],
            $lowercase[random_int(0, strlen($lowercase) - 1)],
            $numbers[random_int(0, strlen($numbers) - 1)],
            $specialChars[random_int(0, strlen($specialChars) - 1)],
        ];
    
        // Fill the rest of the password
        $allChars = $uppercase . $lowercase . $numbers . $specialChars;
        for ($i = 4; $i < $length; $i++) {
            $password[] = $allChars[random_int(0, strlen($allChars) - 1)];
        }
    
        // Shuffle to avoid predictable order
        shuffle($password);
    
        return implode('', $password);
    }

private function generateUsername(string $email): string
{
    // Get the part before @
    $username = Str::before($email, '@');

    // Remove any character that's not a letter or number
    return preg_replace('/[^A-Za-z0-9]/', '', $username);
}
}