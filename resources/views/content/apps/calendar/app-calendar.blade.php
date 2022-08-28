@extends('layouts/contentLayoutMaster')

@section('title', 'App Calender')

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/calendars/fullcalendar.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-calendar.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- Full calendar start -->
<section>
  <div class="app-calendar overflow-hidden border">
    <div class="row g-0">
      <div class="col " id='success-alert'  style='display:none'>
       
        
    </div>
      <!-- Sidebar -->
      <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
        <div class="sidebar-wrapper">
          <div class="card-body d-flex justify-content-center">
            <button
              class="btn btn-primary btn-toggle-sidebar w-100"
              data-bs-toggle="modal"
              data-bs-target="#add-new-sidebar"
            >
              <span class="align-middle">Add Meet</span>
            </button>
          </div>
          <div class="card-body pb-0">
            <h5 class="section-label mb-1">
              <span class="align-middle">Filter</span>
            </h5>
            <div class="form-check mb-1">
              <input type="checkbox" class="form-check-input select-all" id="select-all" checked />
              <label class="form-check-label" for="select-all">View All</label>
            </div>
            <div class="calendar-events-filter">
              <div class="form-check form-check-success mb-1">
                <input
                  type="checkbox"
                  class="form-check-input input-filter"
                  id="personal"
                  data-value="Done"
                  checked
                />
                <label class="form-check-label" for="personal">Done</label>
              </div>
              <div class="form-check form-check-danger mb-1">
                <input
                  type="checkbox"
                  class="form-check-input input-filter"
                  id="business"
                  data-value="Cancled"
                  checked
                />
                <label class="form-check-label" for="business">Cancled</label>
              </div>
              <div class="form-check form-check-warning mb-1">
                <input type="checkbox" class="form-check-input input-filter" id="family" data-value="Reported" checked />
                <label class="form-check-label" for="family">Reported</label>
              </div>
              
            </div>
          </div>
        </div>
        <div class="mt-auto">
          <img
            src="{{asset('images/pages/calendar-illustration.png')}}"
            alt="Calendar illustration"
            class="img-fluid"
          />
        </div>
      </div>
      <!-- /Sidebar -->

      <!-- Calendar -->
      <div class="col position-relative">
        <div class="card shadow-none border-0 mb-0 rounded-0">
          <div class="card-body pb-0">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
      <!-- /Calendar -->
      <div class="body-content-overlay"></div>
    </div>
  </div>
  <!-- Calendar Add/Update/Delete event modal-->
  <div class="modal modal-slide-in event-sidebar fade" id="add-new-sidebar">
    <div class="modal-dialog sidebar-lg">
      <div class="modal-content p-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
        <div class="modal-header mb-1">
          <h5 class="modal-title">Add Meet</h5>
        </div>
        <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
          <form class="event-form needs-validation" data-ajax="false" novalidate>
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

            <div class="mb-1">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Meet Title" required />
            </div>
            <div class="mb-1">
              <label for="select-label" class="form-label">Status</label>
              <select class="select2 select-label form-select w-100" id="select-label" name="status">
                <option data-label="warning" value="Reported" selected>Reported</option>
                <option data-label="danger" value="Cancled">Cancled</option>
                <option data-label="success" value="Done">Done</option>
              </select>
            </div>
            <div class="mb-1 position-relative">
              <label for="start-date" class="form-label">Start Date</label>
              <input type="text" class="form-control" id="start-date" name="start" placeholder="Start Date" />
            </div>

            <div class="mb-1 select2-primary">
              <label for="event-guests" class="form-label">Add Doctor</label>
              <select class="select2 select-add-guests form-select w-100" id="event-guests" multiple name='doctor_id'>
                @foreach ($doctors as $doctor)
                  <option data-avatar="{{ $doctor->full_name }}" value="{{ $doctor->id }}">{{ $doctor->full_name }}</option>
              
                @endforeach
              
              </select>
            </div>
            
            <div class="mb-1">
              <label class="form-label">Description</label>
              <textarea name="description" id="event-description-editor" class="form-control"></textarea>
            </div>
            <div class="mb-1 d-flex">
              <button type="submit" class="btn btn-primary add-event-btn me-1">Add</button>
              <button type="button" class="btn btn-outline-secondary btn-cancel" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary update-event-btn d-none me-1">Update</button>
              <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ Calendar Add/Update/Delete event modal-->
</section>
<!-- Full calendar end -->
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/calendar/fullcalendar.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/app-calendar-events.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/app-calendar.js')) }}"></script>
@endsection
