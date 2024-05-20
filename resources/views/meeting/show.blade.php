@extends('layouts/contentLayoutMaster')

@section('title', 'Meeting Details')

@section('content')
<!-- Timeline Starts -->

<section class="basic-timeline">
  <div class="row">
    <div class="col-lg-12">
      <div class="card bg-white">
        <div class="card-header">
            <a href="{{ route('meeting.index') }}"  class="btn btn-primary">< Back</a>
        </div>
        <div class="card-body">
          <ul class="timeline">
            <li class="timeline-item">
              <span class="timeline-point timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6>Meeting Subject</h6>
                  <span class="timeline-event-time">{{ $meeting->short_date }}</span>
                </div>
                <p>{{ ucfirst($meeting->subject) }}</p>
                <div class="d-flex flex-row align-items-center">
                </div>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-secondary timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6>Oragnizer Email</h6>
                  <span class="timeline-event-time">{{ $meeting->short_time }}</span>
                </div>
                <p>{{ $meeting->organizer_email }}</p>

              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-success timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6>First Attendee Email</h6>
                  <span class="timeline-event-time">{{ $meeting->short_time }}</span>
                </div>
                <p class="mb-50">{{ $meeting->attendee1_email }}</p>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6 class="mb-50">  Second Attendee Email </h6>
                  <span class="timeline-event-time">{{ $meeting->short_time }}</span>
                </div>
                <p >{{ $meeting->attendee2_email }}</p>
              </div>
            </li>
            <li class="timeline-item">
              <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6>Meeting Date</h6>
                </div>
                <p>
                    {{ $meeting->date->format('Y-m-d') }}
                </p>
                <div class="d-flex justify-content-between flex-wrap flex-sm-row flex-column">
                  <div>
                    <p class="text-muted mb-50">Developers</p>
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-light-primary avatar-sm me-50">
                        <span class="avatar-content">{{ $meeting->organizer_name }}</span>
                      </div>
                      <div class="avatar bg-light-success avatar-sm me-50">
                        <span class="avatar-content">{{ $meeting->first_attendee_name }}</span>
                      </div>
                      <div class="avatar bg-light-danger avatar-sm">
                        <span class="avatar-content">{{ $meeting->second_attendee_name }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="mt-sm-0 mt-1">
                    <p class="text-muted mb-50">Deadline</p>
                    <p class="mb-0">{{ $meeting->date->format('Y-m-d') }}-{{ $meeting->short_time }}</p>
                  </div>
                  <div class="mt-sm-0 mt-1">
                    <p class="text-muted mb-50">Created On</p>
                    <p class="mb-0">{{ $meeting->created_at->format('Y-m-d') }}</p>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Timeline Ends -->
@endsection
