@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Submission Details')

@section('page-script')
<script>
  window.appConfig = {
    moodleEnrollUrl: "{{ route('moodle.enroll', ['id' => $application->id]) }}",
    csrfToken: "{{ csrf_token() }}"
  };
</script>
@vite(['resources/assets/js/mentorship-respond-submission.js'])
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card md-6">
            <div class="card-body">
                <h5>Submission Details</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <span class="text-heading fw-medium">Name</span>
                            <p class="text-heading">{{ $application->first_name }} {{ $application->second_name }}</p>
                        </div>
                        <div class="pt-1">
                            <span class="text-heading fw-medium">Email</span>
                            <p class="text-heading">{{ $application->email }}</p>
                        </div>
                        <div class="pt-1">
                            <span class="text-heading fw-medium">Contact</span>
                            <p class="text-heading">{{ $application->contact_number }}</p>
                        </div>
                        <div class="pt-1">
                            <span class="text-heading fw-medium">Occupation</span>
                            <p class="text-heading">{{ $application->occupation }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="pt-1">
                            <span class="text-heading fw-medium">Designation</span>
                            <p class="text-heading">{{ $application->designation }}</p>
                        </div>
                        <div class="pt-1">
                            <span class="text-heading fw-medium">Organization</span>
                            <p class="text-heading">{{ $application->organization }}</p>
                        </div>
                        <div class="pt-1">
                            <span class="text-heading fw-medium">Programme</span>
                            <p class="text-heading">{{ $application->programme_choice }}</p>
                        </div>
                        <div class="pt-1">
                            <span class="text-heading fw-medium">Linkedin</span>
                            <p class="text-heading">{{ $application->linkedin }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <span class="text-heading fw-medium">Current Status</span>
                    <p class="text-heading pt-1">
                        @if (is_null($application->is_eligible))
                            <span class="badge bg-label-warning">Pending</span>
                        @elseif ($application->is_eligible)
                            <span class="badge bg-label-success">Approved</span>
                        @else
                            <span class="badge bg-label-danger">Rejected</span>
                        @endif
                    </p>
                </div>
                <div class="pt-1">
                    <span class="text-heading fw-medium">Submission Date</span>
                    <p class="text-heading pt-1">{{ $application->submitted_at }}</p>
                </div>
                <div class="pt-1">
                    <span class="text-heading fw-medium">Other Submissions</span>
                    @if($otherSubmissions->count())
                    <ul class="list-group pt-2">
                        @foreach($otherSubmissions as $other)
                        <a href="{{ route('mentorship-view-application', $other->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1"><strong>Programme:</strong> {{ $other->programme_choice }}</p>
                                <small>{{ \Carbon\Carbon::parse($other->submitted_at)->diffForHumans() }}</small>
                            </div>
                            @if (is_null($other->is_eligible))
                                <h6 class="mb-1 badge bg-label-warning">Pending</h6>
                            @elseif ($other->is_eligible)
                                <h6 class="mb-1 badge bg-label-success">Approved</h6>
                            @else
                                <h6 class="mb-1 badge bg-label-danger">Rejected</h6>
                            @endif
                        </a>
                        @endforeach
                    </ul>
                    @else
                    <p class="mt-4 text-muted">No other submissions by this user.</p>
                    @endif
                </div>
                <div class="pt-2">
                    @if (is_null($application->is_eligible))
                        <button class="btn btn-label-success w-100 mb-2" data-id="{{$application->id}}" id="approve-submission">Approve Submission</button>
                        <button class="btn btn-label-danger w-100" id="reject-submission">Reject Submission</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@if($application->is_eligible)
    <div class="col-md-8 pt-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex w-100 justify-content-between">
                    <h5>Account Credentials</h5>
                    <button type="button" class="btn btn-icon me-2 btn-label-primary">
                        <span class="icon-base ri ri-share-line icon-22px"></span>
                    </button>
                </div>
                <div class="pt-1">
                    <span class="text-heading fw-medium">Login URL</span>
                    <p class="text-heading">https://msj.moodlecloud.com/login</p>
                </div>
                <div class="pt-1">
                    <span class="text-heading fw-medium">Username</span>
                    <p class="text-heading">{{ $application->username }}</p>
                </div>
                <div class="pt-1">
                    <span class="text-heading fw-medium">Password</span>
                    <p class="text-heading">{{ $application->password }}</p>
                </div>
                <div class="pt-1">
                    <span class="text-heading fw-medium">Session Date</span>
                    <p class="text-heading">{{ $application->session_date }}</p>
                </div>
            </div>
        </div>
    </div>

@endif
</div>
@endsection
