@extends('layouts/contentLayoutMaster')

@section('title', 'Meeting')

@section('vendor-style')
    <!-- Vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection
@section('content')
    <div class="card bg-white p-2">
        <div class="card-header">
            <div class="row">
                <button class="btn btn-primary" data-bs-target="#addMeetingModal" data-bs-toggle="modal">Create Meeting</button>
                <div class="col-12 mt-2 text-center">
                    @if ($errors->any() || session('success') || session('error'))
                    <div id="flash-message"
                         class="alert
                         @if ($errors->any() || session('error')) alert-danger @elseif (session('success')) alert-success @endif">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @elseif (session('error'))
                            {{ session('error') }}
                        @elseif (session('success'))
                            {{ session('success') }}
                        @endif
                    </div>
                @endif
                </div>
            </div>
        </div>
        <table   id="myTable">
            <thead class="bg-secondary text-white">
                <tr>
                    <th>Subject</th>
                    <th>MEETING TIME</th>
                    <th>DATE</th>
                    <th>ORGANIZER EMAIL</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody class="bg-darken-2">
                 @foreach ($meeting as $meeting)
                    <tr>
                        <td>{{ $meeting->short_subject }}</td>
                        <td>{{ $meeting->meeting_time }}</td>
                        <td>{{ $meeting->date->format('Y-m-d') }}</td>
                        <td>{{ $meeting->organizer_email }}</td>
                        <td>
                            <button class="btn btn-success get_data_for_edit_modal" data-meeting-id="{{ $meeting->id }}"
                                data-bs-target="#editMeetingModal" data-bs-toggle="modal">Edit</button>
                            <form id="delete-form-{{ $meeting->id }}" action="{{ route('meeting.destroy', $meeting->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="btn btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $meeting->id }}').submit();">
                                Delete
                            </button>
                            <a class="btn btn-info" href="{{ route('meeting.show', ['meeting' => $meeting->id]) }}">
                                Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
     @include('content/_partials/_modals/modal-add-meeting')
   @include('content/_partials/_modals/modal-edit-meeting')
@endsection

@section('vendor-script')
    <!-- Vendor js files -->
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/modal-edit-meeting.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/meeting-form-validation.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
@endsection
