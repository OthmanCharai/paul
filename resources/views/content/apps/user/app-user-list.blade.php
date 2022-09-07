@extends('layouts/contentLayoutMaster')

@section('title', 'User List')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- users list start -->
<section class="app-user-list">
    <div class="row">

    
    @if(session()->has('success'))
    <div class="col">
        <div class="alert alert-success text-center" role="alert">
            <h4 class="alert-heading">Success</h4>
            <div class="alert-body">
              {{ session()->get("success") }}
            </div>
        </div>
        
    </div>
    @elseif(session()->has('error'))
    <div class="col">
    <div class="alert alert-danger text-center" role="alert">
        <h4 class="alert-heading">Error</h4>
        <div class="alert-body">
          {{ session()->get("error") }}
        </div>
    </div>
</div>


    @endif 
</div>
  <div class="row">
      
    <div class="col-lg-6 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">120</h3>
            <span>Total Doctors</span>
          </div>
          <div class="avatar bg-light-primary p-50">
            <span class="avatar-content">
              <i data-feather="user" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-sm-6">
      <div class="card">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h3 class="fw-bolder mb-75">0</h3>
            <span>Active Doctor</span>
          </div>
          <div class="avatar bg-light-success p-50">
            <span class="avatar-content">
              <i data-feather="user-check" class="font-medium-4"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
 
  </div>
  <!-- list and filter start -->
  <div class="card">
    <div class="card-body border-bottom">
      <h4 class="card-title">Search & Filter</h4>
      <div class="row">
        <div class="col-md-4 user_role"></div>
        <div class="col-md-4 user_plan"></div>
        <div class="col-md-4 user_status"></div>
      </div>
      <input type="hidden" @role('admin')  value="admin" @else value='none'@endrole id="admin">
    </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="user-list-table table">
        <thead class="table-light">
          <tr>
            <th></th>
            <th>Name</th>
            <th>address</th>
            <th>phone</th>
            <th>speciality</th>
            
            @role('admin')
            <th>user</th>
            @endrole
            <th>Actions</th>
          </tr>
        </thead>
      </table>
    </div>
    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form method="POST" action="{{ route('doctor.store') }}" class="add-new-user modal-content pt-0">
          @csrf
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-fullname">First Name</label>
              <input
                type="text"
                class="form-control dt-full-name"
                id="basic-icon-default-fullname"
                placeholder="John "
                name="first_name"
              />
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-uname">Last Name</label>
              <input
                type="text"
                id="basic-icon-default-uname"
                class="form-control dt-uname"
                placeholder="Doe"
                name="last_name"
              />
            </div>
         
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-contact">Contact</label>
              <input
                type="text"
                id="basic-icon-default-contact"
                class="form-control dt-contact"
                placeholder="+1 (609) 933-44-22"
                name="phone"
              />
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-company">Speciality</label>
              <input
                type="text"
                id="basic-icon-default-company"
                class="form-control dt-uname"
                placeholder="speciality"
                name="speciality"
              />
            </div>

            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-company">Address</label>
              <input
                type="text"
                id="basic-icon-default-company"
                class="form-control dt-uname"
                placeholder="address"
                name="address"
              />
            </div>

            @role('admin')
                <div class="mb-1 select2-primary">
                    <label for="event-guests" class="form-label">Add User</label>
                    <select class="select2 select-add-guests form-select w-100" id="event-guests"  name='user_id'>
                    @foreach ($users as $user)
                        <option data-avatar="{{ $user->name }}" value="{{ $user->id }}"> <span class="avatart-content"></span>{{ $user->name }}</option>
                    
                    @endforeach
                    
                    </select>
                </div>
            @endrole
            
        
       
            <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->
  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
  <script>
$(function () {
  ("use strict");

  var dtUserTable = $(".user-list-table"),
      newUserSidebar = $(".new-user-modal"),
      newUserForm = $(".add-new-user"),
      select = $(".select2"),
      dtContact = $(".dt-contact"),
      statusObj = {
          1: { title: "Pending", class: "badge-light-warning" },
          2: { title: "Active", class: "badge-light-success" },
          3: { title: "Inactive", class: "badge-light-secondary" },
      };
      let isAdmin=$("#admin").val();
      isAdmin=(isAdmin=='admin')?true:false;
     
  var assetPath = "../../../app-assets/",
      userView = "app-user-view-account.html";

  if ($("body").attr("data-framework") === "laravel") {
      assetPath = $("body").attr("data-asset-path");
      userView = assetPath + "app/user/view/account";
  }

  select.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
          // the following code is used to disable x-scrollbar when click in select input and
          // take 100% width in responsive also
          dropdownAutoWidth: true,
          width: "100%",
          dropdownParent: $this.parent(),
      });
  });

function getConditionalColumn(isAdmin){
    var columns= [];
    columns.push({ data: "" }) 
    columns.push({ data: "fullname" }) 
    columns.push({ data: "address" })
    columns.push({ data: "phone" }) 
    columns.push({ data: "speciality" }) 
  if(isAdmin){
      columns.push({ data: "user" })
      columns.push({ data: "" })
  }
  else{
    columns.push({ data: "" })

  }
  return columns;
} 

function getColumsDef(isAdmin){
    if(isAdmin){
        return [
              {
                  // For Responsive
                  className: "control",
                  orderable: false,
                  responsivePriority: 2,
                  targets: 0,
                  render: function (data, type, full, meta) {
                      return "";
                  },
              },
              {
                  // User full name and username
                  targets: 1,
                  responsivePriority: 4,
                  render: function (data, type, full, meta) {
                      var $name =
                          full["fullname"] ;

                      // For Avatar badge
                      var stateNum = Math.floor(Math.random() * 6) + 1;
                      var states = [
                          "success",
                          "danger",
                          "warning",
                          "info",
                          "dark",
                          "primary",
                          "secondary",
                      ];
                      var $state = states[stateNum];
                      var $name =
                          full["first_name"] + " " + full["last_name"];
                      $initials = $name.match(/\b\w/g) || [];
                      $initials = (
                          ($initials.shift() || "") + ($initials.pop() || "")
                      ).toUpperCase();
                      $output =
                          '<span class="avatar-content">' +
                          $initials +
                          "</span>";

                      var colorClass = true
                          ? " bg-light-" + $state + " "
                          : "";
                      // Creates full output for row
                      var $row_output =
                          '<div class="d-flex justify-content-left align-items-center">' +
                          '<div class="avatar-wrapper">' +
                          '<div class="avatar ' +
                          colorClass +
                          ' me-1">' +
                          $output +
                          "</div>" +
                          "</div>" +
                          '<div class="d-flex flex-column">' +
                          '<a href="' +
                          userView +
                          '" class="user_name text-truncate text-body"><span class="fw-bolder">' +
                          $name +
                          "</span></a>" +
                          '<small class="emp_post text-muted">' +
                          "</small>" +
                          "</div>" +
                          "</div>";
                      return $row_output;
                  },
              },
              {
                  // User Role
                  targets: 2,
                  render: function (data, type, full, meta) {
                      var $role = full["address"];
                      var roleBadgeObj = {
                          Subscriber: feather.icons["user"].toSvg({
                              class: "font-medium-3 text-primary me-50",
                          }),
                          Author: feather.icons["settings"].toSvg({
                              class: "font-medium-3 text-warning me-50",
                          }),
                          Maintainer: feather.icons["database"].toSvg({
                              class: "font-medium-3 text-success me-50",
                          }),
                          Editor: feather.icons["edit-2"].toSvg({
                              class: "font-medium-3 text-info me-50",
                          }),
                          Admin: feather.icons["slack"].toSvg({
                              class: "font-medium-3 text-danger me-50",
                          }),
                      };
                      return (
                          "<span class='text-truncate align-middle'>" +
                          $role +
                          "</span>"
                      );
                  },
              },
              {
                  targets: 3,
                  render: function (data, type, full, meta) {
                      var $billing = full["phone"];

                      return (
                          '<span class="text-nowrap">' + $billing + "</span>"
                      );
                  },
              },
              {
                  // User Status
                  targets: 4,
                  render: function (data, type, full, meta) {
                      var $status = full["speciality"];

                      return (
                          '<span class="text-nowrap">' + $status + "</span>"
                      );
                  },
              },
         
              {
                  // User Status
                  targets: 5,
                  render: function (data, type, full, meta) {
                      if (full['user']['name']) {
                          var $status = full["user"]['name'];
                          return (
                              '<span class="text-nowrap">' + $status + "</span>"
                          );
                        
                      }
                  },
              },
              {
                  // Actions
                  targets: -1,
                  title: "Actions",
                  orderable: false,
                  render: function (data, type, full, meta) {
                      return (
                        
                          '<div class="btn-group">' +
                          '<a class="btn btn-sm dropdown-toggle hide-arrow"  data-bs-toggle="dropdown">' +
                          feather.icons["more-vertical"].toSvg({
                              class: "font-small-4",
                          }) +
                          "</a>" +
                          '<div class="dropdown-menu dropdown-menu-end">' +
                          '<a  data-bs-toggle="modal" data-bs-target="#modals-slide-in-update'+ full['id']+'" href="' +
                          '" class="dropdown-item  ">' +
                          feather.icons["file-text"].toSvg({
                              class: "font-small-4 me-50",
                          }) +
                          "Update</a>" +
                          '<button onclick="deleteRcord('+full["id"]+')" class="dropdown-item delete-record">' +
                          feather.icons["trash-2"].toSvg({
                              class: "font-small-4 me-50",
                          }) +
                          "Delete</button>"+
                          "</div>" +
                          "</div>" +
                          "</div>"+
                        '<div class="modal modal-slide-in update-user-modal fade" id="modals-slide-in-update'+ full['id']+'">'+
                            '<div class="modal-dialog">'+
                              '<form method="post" action="/doctor/'+full['id']+'" class="add-new-user modal-content pt-0">'+
                                '@csrf'+
                                '@method('PUT')'+
                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>'+
                                '<div class="modal-header mb-1">'+
                                  '<h5 class="modal-title" id="exampleModalLabel">Add User</h5>'+
                                '</div>'+
                                '<div class="modal-body flex-grow-1">'+
                                  '<div class="mb-1">'+
                                  ' <label class="form-label" for="basic-icon-default-fullname">First Name</label>'+
                                    '<input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="'+full['first_name']+ '" name="first_name"/>'+
                                ' </div>'+
                                ' <div class="mb-1">'+
                                    '<label class="form-label" for="basic-icon-default-uname">Last Name</label>'+
                                    '<input type="text" id="basic-icon-default-uname" class="form-control dt-uname" value="'+full['last_name']+'" name="last_name"/>'+
                                    '</div>'+         
                                  '<div class="mb-1">'+
                                  '<label class="form-label" for="basic-icon-default-contact">Contact</label>' +             
                                      '<input type="text"'+
                                      'id="basic-icon-default-contact"'+
                                      'class="form-control dt-contact"'+
                                      'name="phone"'+
                                      "value='"+full['phone']+"'"+
                                    '/>'+
                                  '</div>'+
                                  '<div class="mb-1">'+
                                  ' <label class="form-label" for="basic-icon-default-company">Speciality</label>'+
                                  ' <input type="text" id="basic-icon-default-company" class="form-control dt-uname" value='+full['speciality']+' name="speciality"/>'+
                                  '</div>'+
                                  '<div class="mb-1">'+
                                  '<label class="form-label" for="basic-icon-default-company">Address</label>'+
                                    '<input type="text" id="basic-icon-default-company" class="form-control dt-uname" value='+full['address']+'" name="address"/>'+
                                  '</div>'+            
                                  '<button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>'+
                                ' <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>'+
                                '</div></form></div></div>'
                      );
                  },
              },
          ];
    }
    return [
              {
                  // For Responsive
                  className: "control",
                  orderable: false,
                  responsivePriority: 2,
                  targets: 0,
                  render: function (data, type, full, meta) {
                      return "";
                  },
              },
              {
                  // User full name and username
                  targets: 1,
                  responsivePriority: 4,
                  render: function (data, type, full, meta) {
                      var $name =
                          full["fullname"] ;

                      // For Avatar badge
                      var stateNum = Math.floor(Math.random() * 6) + 1;
                      var states = [
                          "success",
                          "danger",
                          "warning",
                          "info",
                          "dark",
                          "primary",
                          "secondary",
                      ];
                      var $state = states[stateNum];
                      var $name =
                          full["first_name"] + " " + full["last_name"];
                      $initials = $name.match(/\b\w/g) || [];
                      $initials = (
                          ($initials.shift() || "") + ($initials.pop() || "")
                      ).toUpperCase();
                      $output =
                          '<span class="avatar-content">' +
                          $initials +
                          "</span>";

                      var colorClass = true
                          ? " bg-light-" + $state + " "
                          : "";
                      // Creates full output for row
                      var $row_output =
                          '<div class="d-flex justify-content-left align-items-center">' +
                          '<div class="avatar-wrapper">' +
                          '<div class="avatar ' +
                          colorClass +
                          ' me-1">' +
                          $output +
                          "</div>" +
                          "</div>" +
                          '<div class="d-flex flex-column">' +
                          '<a href="' +
                          userView +
                          '" class="user_name text-truncate text-body"><span class="fw-bolder">' +
                          $name +
                          "</span></a>" +
                          '<small class="emp_post text-muted">' +
                          "</small>" +
                          "</div>" +
                          "</div>";
                      return $row_output;
                  },
              },
              {
                  // User Role
                  targets: 2,
                  render: function (data, type, full, meta) {
                      var $role = full["address"];
                      var roleBadgeObj = {
                          Subscriber: feather.icons["user"].toSvg({
                              class: "font-medium-3 text-primary me-50",
                          }),
                          Author: feather.icons["settings"].toSvg({
                              class: "font-medium-3 text-warning me-50",
                          }),
                          Maintainer: feather.icons["database"].toSvg({
                              class: "font-medium-3 text-success me-50",
                          }),
                          Editor: feather.icons["edit-2"].toSvg({
                              class: "font-medium-3 text-info me-50",
                          }),
                          Admin: feather.icons["slack"].toSvg({
                              class: "font-medium-3 text-danger me-50",
                          }),
                      };
                      return (
                          "<span class='text-truncate align-middle'>" +
                          $role +
                          "</span>"
                      );
                  },
              },
              {
                  targets: 3,
                  render: function (data, type, full, meta) {
                      var $billing = full["phone"];

                      return (
                          '<span class="text-nowrap">' + $billing + "</span>"
                      );
                  },
              },
              {
                  // User Status
                  targets: 4,
                  render: function (data, type, full, meta) {
                      var $status = full["speciality"];

                      return (
                          '<span class="text-nowrap">' + $status + "</span>"
                      );
                  },
              },
         
             
              {
                  // Actions
                  targets: -1,
                  title: "Actions",
                  orderable: false,
                  render: function (data, type, full, meta) {
                      return (
                        
                          '<div class="btn-group">' +
                          '<a class="btn btn-sm dropdown-toggle hide-arrow"  data-bs-toggle="dropdown">' +
                          feather.icons["more-vertical"].toSvg({
                              class: "font-small-4",
                          }) +
                          "</a>" +
                          '<div class="dropdown-menu dropdown-menu-end">' +
                          '<a  data-bs-toggle="modal" data-bs-target="#modals-slide-in-update'+ full['id']+'" href="' +
                          '" class="dropdown-item  ">' +
                          feather.icons["file-text"].toSvg({
                              class: "font-small-4 me-50",
                          }) +
                          "Update</a>" +
                          '<button onclick="deleteRcord('+full["id"]+')" class="dropdown-item delete-record">' +
                          feather.icons["trash-2"].toSvg({
                              class: "font-small-4 me-50",
                          }) +
                          "Delete</button>"+
                          "</div>" +
                          "</div>" +
                          "</div>"+
                        '<div class="modal modal-slide-in update-user-modal fade" id="modals-slide-in-update'+ full['id']+'">'+
                            '<div class="modal-dialog">'+
                              '<form method="post" action="/doctor/'+full['id']+'" class="add-new-user modal-content pt-0">'+
                                '@csrf'+
                                '@method('PUT')'+
                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>'+
                                '<div class="modal-header mb-1">'+
                                  '<h5 class="modal-title" id="exampleModalLabel">Add User</h5>'+
                                '</div>'+
                                '<div class="modal-body flex-grow-1">'+
                                  '<div class="mb-1">'+
                                  ' <label class="form-label" for="basic-icon-default-fullname">First Name</label>'+
                                    '<input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" value="'+full['first_name']+ '" name="first_name"/>'+
                                ' </div>'+
                                ' <div class="mb-1">'+
                                    '<label class="form-label" for="basic-icon-default-uname">Last Name</label>'+
                                    '<input type="text" id="basic-icon-default-uname" class="form-control dt-uname" value="'+full['last_name']+'" name="last_name"/>'+
                                    '</div>'+         
                                  '<div class="mb-1">'+
                                  '<label class="form-label" for="basic-icon-default-contact">Contact</label>' +             
                                      '<input type="text"'+
                                      'id="basic-icon-default-contact"'+
                                      'class="form-control dt-contact"'+
                                      'name="phone"'+
                                      "value='"+full['phone']+"'"+
                                    '/>'+
                                  '</div>'+
                                  '<div class="mb-1">'+
                                  ' <label class="form-label" for="basic-icon-default-company">Speciality</label>'+
                                  ' <input type="text" id="basic-icon-default-company" class="form-control dt-uname" value='+full['speciality']+' name="speciality"/>'+
                                  '</div>'+
                                  '<div class="mb-1">'+
                                  '<label class="form-label" for="basic-icon-default-company">Address</label>'+
                                    '<input type="text" id="basic-icon-default-company" class="form-control dt-uname" value='+full['address']+'" name="address"/>'+
                                  '</div>'+            
                                  '<button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>'+
                                ' <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>'+
                                '</div></form></div></div>'
                      );
                  },
              },
          ]
}

  // Users List datatable
  if (dtUserTable.length) {
      dtUserTable.DataTable({
          ajax: "{{ route('doctor.index') }}", // JSON file to add data
          
          columns: getConditionalColumn(isAdmin),
          columnDefs:getColumsDef(isAdmin),
          order: [[1, "desc"]],
          dom:
              '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
              '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
              '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
              ">t" +
              '<"d-flex justify-content-between mx-2 row mb-1"' +
              '<"col-sm-12 col-md-6"i>' +
              '<"col-sm-12 col-md-6"p>' +
              ">",
          language: {
              sLengthMenu: "Show _MENU_",
              search: "Search",
              searchPlaceholder: "Search..",
          },
          // Buttons with Dropdown
          buttons: [
              {
                  extend: "collection",
                  className: "btn btn-outline-secondary dropdown-toggle me-2",
                  text:
                      feather.icons["external-link"].toSvg({
                          class: "font-small-4 me-50",
                      }) + "Export",
                  buttons: [
                      {
                          extend: "print",
                          text:
                              feather.icons["printer"].toSvg({
                                  class: "font-small-4 me-50",
                              }) + "Print",
                          className: "dropdown-item",
                          exportOptions: { columns: [1, 2, 3, 4, 5] },
                      },
                      {
                          extend: "csv",
                          text:
                              feather.icons["file-text"].toSvg({
                                  class: "font-small-4 me-50",
                              }) + "Csv",
                          className: "dropdown-item",
                          exportOptions: { columns: [1, 2, 3, 4, 5] },
                      },
                      {
                          extend: "excel",
                          text:
                              feather.icons["file"].toSvg({
                                  class: "font-small-4 me-50",
                              }) + "Excel",
                          className: "dropdown-item",
                          exportOptions: { columns: [1, 2, 3, 4, 5] },
                      },
                      {
                          extend: "pdf",
                          text:
                              feather.icons["clipboard"].toSvg({
                                  class: "font-small-4 me-50",
                              }) + "Pdf",
                          className: "dropdown-item",
                          exportOptions: { columns: [1, 2, 3, 4, 5] },
                      },
                      {
                          extend: "copy",
                          text:
                              feather.icons["copy"].toSvg({
                                  class: "font-small-4 me-50",
                              }) + "Copy",
                          className: "dropdown-item",
                          exportOptions: { columns: [1, 2, 3, 4, 5] },
                      },
                  ],
                  init: function (api, node, config) {
                      $(node).removeClass("btn-secondary");
                      $(node).parent().removeClass("btn-group");
                      setTimeout(function () {
                          $(node)
                              .closest(".dt-buttons")
                              .removeClass("btn-group")
                              .addClass("d-inline-flex mt-50");
                      }, 50);
                  },
              },
              {
                  text: "Add New Doctor",
                  className: "add-new btn btn-primary",
                  attr: {
                      "data-bs-toggle": "modal",
                      "data-bs-target": "#modals-slide-in",
                  },
                  init: function (api, node, config) {
                      $(node).removeClass("btn-secondary");
                  },
              },
          ],
          // For responsive popup
          responsive: {
              details: {
                  display: $.fn.dataTable.Responsive.display.modal({
                      header: function (row) {
                          var data = row.data();
                          return "Details of " + data["first_name"];
                      },
                  }),
                  type: "column",
                  renderer: function (api, rowIdx, columns) {
                      var data = $.map(columns, function (col, i) {
                          return col.columnIndex !== 6 // ? Do not show row in modal popup if title is blank (for check box)
                              ? '<tr data-dt-row="' +
                                    col.rowIdx +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    "<td>" +
                                    col.title +
                                    ":" +
                                    "</td> " +
                                    "<td>" +
                                    col.data +
                                    "</td>" +
                                    "</tr>"
                              : "";
                      }).join("");
                      return data
                          ? $('<table class="table"/>').append(
                                "<tbody>" + data + "</tbody>"
                            )
                          : false;
                  },
              },
          },
          language: {
              paginate: {
                  // remove previous & next text from pagination
                  previous: "&nbsp;",
                  next: "&nbsp;",
              },
          },
          initComplete: function () {
              // Adding role filter once table initialized
              this.api()
                  .columns(1)
                  .every(function () {
                      var column = this;
                      var label = $(
                          '<label class="form-label" for="UserRole">Name</label>'
                      ).appendTo(".user_role");
                      var select = $(
                          '<select id="UserRole" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Name </option></select>'
                      )
                          .appendTo(".user_role")
                          .on("change", function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                  $(this).val()
                              );
                              column
                                  .search(
                                      val,
                                      true,
                                      false
                                  )
                                  .draw();
                          });
                          
                    
                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                              select.append(
                                  '<option value="' +
                                      d +
                                      '" class="text-capitalize">' +
                                      d +
                                      "</option>"
                              );
                          });
                  });
              // Adding plan filter once table initialized
              this.api()
                  .columns(4)
                  .every(function () {
                      var column = this;
                      var label = $(
                          '<label class="form-label" for="UserPlan">Specialty</label>'
                      ).appendTo(".user_plan");
                      var select = $(
                          '<select id="UserPlan" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Specialty </option></select>'
                      )
                          .appendTo(".user_plan")
                          .on("change", function () {
                              var val = $.fn.dataTable.util.escapeRegex(
                                  $(this).val()
                              );
                              column
                                  .search(
                                      val ? "^" + val + "$" : "",
                                      true,
                                      false
                                  )
                                  .draw();
                          });

                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                              select.append(
                                  '<option value="' +
                                      d +
                                      '" class="text-capitalize">' +
                                      d +
                                      "</option>"
                              );
                          });
                  });

              this.api()
                  .columns(2)
                  .every(function () {
                      var column = this;
                      var label = $(
                          '<label class="form-label" for="UserPlan">Address</label>'
                      ).appendTo(".user_status");
                      var select = $(
                          '<select id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2xx"><option value=""> Select Address </option></select>'
                      )
                          .appendTo(".user_status")
                          .on("change", function () {
                              var val = $.fn.dataTable.util.escapeRegex(
                                  $(this).val()
                              );
                              column
                                  .search(
                                      val ,
                                      true,
                                      false
                                  )
                                  .draw();
                          });

                      column
                          .data()
                          .unique()
                          .sort()
                          .each(function (d, j) {
                              select.append(
                                  '<option value="' +
                                      d +
                                      '" class="text-capitalize">' +
                                      d +
                                      "</option>"
                              );
                          });
                  });
          },
      });
  }

  // Form Validation
  if (newUserForm.length) {
      newUserForm.validate({
          errorClass: "error",
          rules: {
              "user-fullname": {
                  required: true,
              },
              "user-name": {
                  required: true,
              },
              "user-email": {
                  required: true,
              },
          },
      });

      newUserForm.on("submit", function (e) {
          var isValid = newUserForm.valid();

          if (isValid) {
              newUserSidebar.modal("hide");
          }
      });
  }

  // Phone Number
  if (dtContact.length) {
      dtContact.each(function () {
          new Cleave($(this), {
              phone: true,
              phoneRegionCode: "US",
          });
      });
  }

});

function deleteRcord(id){
  alert(id)
  Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-outline-danger ms-1",
                },
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                  $.ajax({
                    url:"/doctor/"+id,
                    type:'DELETE',
                    data:{
                      "_token": "{{ csrf_token() }}",
                    },
                    success:function(result){
                      Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        customClass: {
                            confirmButton: "btn btn-success",
                        },
                    }).then(function(result){
                      if (result.value) {
                        window.location.reload();
                      }
                    });
                    
                    }
                  })
                    
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error",
                        customClass: {
                            confirmButton: "btn btn-success",
                        },
                    });
                }
            });
}
</script>

@endsection
