@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Mentorship Applications')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-select-bs5/select.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
  'resources/assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
  'resources/assets/vendor/libs/moment/moment.js',
  'resources/assets/vendor/libs/flatpickr/flatpickr.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/mentorship-applications.js'])
@endsection


@section('content')
<div class="nav-align-top nav-tabs-shadow">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <button
        type="button"
        class="nav-link active"
        role="tab"
        data-bs-toggle="tab"
        data-bs-target="#navs-top-align-home"
        aria-controls="navs-top-align-home"
        aria-selected="true">
        Pending
      </button>
    </li>
    <li class="nav-item">
      <button
        type="button"
        class="nav-link"
        role="tab"
        data-bs-toggle="tab"
        data-bs-target="#navs-top-align-profile"
        aria-controls="navs-top-align-profile"
        aria-selected="false">
        Approved
      </button>
    </li>
    <li class="nav-item">
      <button
        type="button"
        class="nav-link"
        role="tab"
        data-bs-toggle="tab"
        data-bs-target="#navs-top-align-messages"
        aria-controls="navs-top-align-messages"
        aria-selected="false">
        Rejected
      </button>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="navs-top-align-home" role="tabpanel">
    <div class="card-datatable dataTable_select">
        <table class="table table-responsive" id="pending-table">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Occupation</th>
                <th>Programme</th>
                <th>Submission Date</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
    </div>
    <div class="tab-pane fade" id="navs-top-align-profile" role="tabpanel">
        <table class="table" id="approved-table">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Occupation</th>
                <th>Programme</th>
                <th>Submission Date</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="tab-pane fade" id="navs-top-align-messages" role="tabpanel">
        <table class="table" id="rejected-table">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Occupation</th>
                <th>Programme</th>
                <th>Submission Date</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
  </div>
</div>



<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Offcanvas End</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-2 mx-0 flex-grow-0">
    <div>
        <span class="text-heading fw-medium">Full Name</span>
        <p class="text-heading" id="full_name"></p>
    </div>
    <div class="pt-2">
        <span class="text-heading fw-medium">Email</span>
        <p class="text-heading" id="email"></p>
    </div>
    <div class="pt-2">
        <span class="text-heading fw-medium">Contact Number</span>
        <p class="text-heading" id="contact_number"></p>
    </div>

    <div class="pt-2">
        <span class="text-heading fw-medium">Occupation</span>
        <p class="text-heading" id="occupation"></p>
    </div>

    <div class="pt-2">
        <span class="text-heading fw-medium">Designation</span>
        <p class="text-heading" id="designation"></p>
    </div>

    <div class="pt-2">
        <span class="text-heading fw-medium">Organization</span>
        <p class="text-heading" id="organization"></p>
    </div>

    <div class="pt-2">
        <span class="text-heading fw-medium">Programme Choice</span>
        <p class="text-heading" id="programme_choice"></p>
    </div>

    <div class="pt-2">
        <span class="text-heading fw-medium">LinkedIn</span>
        <p class="text-heading" id="linkedin"></p>
    </div>

    <div class="pt-2">
        <span class="text-heading fw-medium">Submission Date</span>
        <p class="text-heading" id="submition_date"></p>
    </div>

    <div class="pt-2">
        <span class="text-heading fw-medium">Email Verified</span>
        <p class="text-heading" id="email_verified"></p>
    </div>

    <div class="pt-2">
        <span class="text-heading fw-medium">Status</span>
        <p class="text-heading" id="status"></p>
    </div>
    <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
    <button type="button" class="btn btn-label-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
  </div>
</div>

<script>
    const mentorshipRoute = "{{ route('mentorship-applications') }}";
</script>
@endsection