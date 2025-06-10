<?php

namespace App\Http\Controllers\pages;

use App\Models\MentorshipApplication;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MentorshipApplications extends Controller
{
  public function index(Request $request)
  {
    if($request->ajax()){
      $query = MentorshipApplication::query();

        // Filter based on status
        if ($request->has('status')) {
            switch ($request->get('status')) {
                case 'Approved':
                    $query->where('is_eligible', 1);
                    break;
                case 'Rejected':
                    $query->where('is_eligible', 0);
                    break;
                case 'Pending':
                    $query->whereNull('is_eligible');
                    break;
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);


      /*$data = MentorshipApplication::select('*');

      return DataTables::of($data)
      ->addIndexColumn()
      ->editColumn('status', function ($row) {
          if (is_null($row->is_eligible)) return '<span class="badge rounded-pill bg-label-warning">Pending</span>';
          return $row->is_eligible ? 
              '<span class="badge rounded-pill bg-label-success">Approved</span>' : 
              '<span class="badge rounded-pill bg-label-danger">Rejected</span>';
      })
      ->rawColumns(['status'])
      ->make(true);*/
    }
    
    return view('content.pages.mentorship.applications');
  }

  public function show($id)
  {
    $application = MentorshipApplication::find($id);

    $otherSubmissions = MentorshipApplication::where('id', '!=', $id)
        ->where(function ($query) use ($application) {
            $query->where('email', $application->email)
                  ->orWhere('linkedin', $application->linkedin);
        })
        ->get();

    return view('content.pages.mentorship.view-application', compact('application', 'otherSubmissions'));
  }
}
