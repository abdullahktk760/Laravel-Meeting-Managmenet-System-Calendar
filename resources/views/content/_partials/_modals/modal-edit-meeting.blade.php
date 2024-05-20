<!-- Add Task -->
<div class="modal fade" id="editMeetingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-task">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-2 pb-2">
                <div class="text-center mb-2">
                    <h1 class="task-title ">Update Meeting</h1>

                </div>
                <!-- Add Task Form -->
                <form id="edit_meeting_form" class="row edit_meeting_form"  method="post" action="">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6 form-group">
                        <label class="form-label" for="title">Subject</label> <span class="text-danger">*</span>
                        <input type="text" id="title" name="subject" class="form-control"
                            placeholder="Enter Task Title like 'Create Plugin Page'" tabindex="-1"
                            data-msg="Please enter Task title" />
                    </div>

                    <div class="col-md-6 form-group ">
                        <label class="form-label" for="organizer_email">Oraganizer Email</label> <span
                            class="text-danger">*</span>
                        <input type="email" id="organizer_email" name="organizer_email" class="form-control"
                            placeholder="oraginzer@gmail.com" data-msg="Please enter organizer Email" />
                    </div>
                    <div class="col-md-6 form-group mt-1">
                        <label class="form-label" for="attendee_1">Attendee 1 Email</label> <span
                            class="text-danger">*</span>
                        <input type="email" id="attendee_1" name="attendee_1" class="form-control"
                            placeholder="attendee.first@gmail.com" data-msg="Please enter organizer Email" />
                    </div>
                    <div class="col-md-6 form-group mt-1">
                        <label class="form-label" for="attendee_2">Attendee 2 Email</label> <span
                            class="text-danger">*</span>
                        <input type="email" id="attendee_2" name="attendee_2" class="form-control"
                            placeholder="attendee.second@gmail.com" data-msg="Please enter organizer Email" />
                    </div>

                      <div class="col-md-6 form-group mt-1">
                        <label class="form-label" for="fp-range">Date</label> <span class="text-danger">*</span>
                        <input
                          type="text"
                          id="fp-range"
                          class="form-control flatpickr-basic"
                          placeholder="YYYY-MM-DD to YYYY-MM-DD"
                          name="date"
                        />
                      </div>
                      <div class="col-md-6 form-group mt-1">
                        <label for="meeting_time">Meeting Time<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="meeting_time" name="meeting_time" value="{{ old('meeting_time') }}" required>
                    </div>
                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="btn btn-success me-1">Update</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
                <!--/ Add Task form End -->
            </div>
        </div>
    </div>
</div>

<!--/ Add Task Modal End-->
