<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class MoodleService
{
    protected $endpoint;
    protected $token;

    public function __construct()
    {
        $this->endpoint = 'https://cloudonesol.com/webservice/rest/server.php';
        $this->token = '89bba8dcec277010ebd4b2187c2fbe56';
    }

    public function createUser(array $user)
    {
        try {
            $response = Http::asForm()
                ->withOptions(['verify' => false]) // Disable SSL check only for dev
                ->post($this->endpoint, [
                    'wstoken' => $this->token,
                    'wsfunction' => 'core_user_create_users',
                    'moodlewsrestformat' => 'json',
                    'users[0][username]' => $user['username'],
                    'users[0][password]' => $user['password'],
                    'users[0][firstname]' => $user['firstname'],
                    'users[0][lastname]' => $user['lastname'],
                    'users[0][email]' => $user['email'],
                    'users[0][auth]' => 'manual',
                ]);

            $data = $response->json();

            if (isset($data['exception'])) {
                throw new Exception("Moodle Error: {$data['message']}");
            }

            return [
                'success' => true,
                'user_id' => $data[0]['id'],
                'message' => 'User created successfully',
            ];
        } catch (Exception $e) {
            Log::error("Moodle Create User Error: " . $e->getMessage());

            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function enrollUser(int $userId, int $courseId, int $roleId = 5): array
    {
        try {
            $response = Http::asForm()
                ->withOptions(['verify' => false])
                ->post($this->endpoint, [
                    'wstoken' => $this->token,
                    'wsfunction' => 'enrol_manual_enrol_users',
                    'moodlewsrestformat' => 'json',
                    'enrolments[0][roleid]' => $roleId,
                    'enrolments[0][userid]' => $userId,
                    'enrolments[0][courseid]' => $courseId,
                ]);

            $data = $response->json();

            if (isset($data['exception'])) {
                throw new Exception("Moodle Enroll Error: {$data['message']}");
            }

            return [
                'success' => true,
                'message' => 'User enrolled successfully',
            ];
        } catch (Exception $e) {
            Log::error("Moodle Enroll Error: " . $e->getMessage());

            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}