<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\MentorshipApplication;

    class DashboardController extends Controller
    {
        public function index()
        {
            $totalApplications = MentorshipApplication::count();
            $awaitingApproval = MentorshipApplication::whereNull('is_eligible')->count();
            $newRegistrations = MentorshipApplication::where('is_eligible', 1)->count();
            $newApplications = $totalApplications - $awaitingApproval - $newRegistrations;

            $percentChange = 18;

            return view('dashboard.dashboard', compact(
                'totalApplications',
                'newApplications',
                'awaitingApproval',
                'newRegistrations',
                'percentChange'
            ));
        }
    }
