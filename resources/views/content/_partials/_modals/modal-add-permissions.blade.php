<!-- Add Role Modal -->
<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background-color:#ff01014d !important;"></button>
            </div>
            <div class="modal-body px-2 pb-2">
                <!-- Add role form -->
                    <div class="col-12">
                        <h4 class=" pt-50">Role Permissions</h4>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing ">
                                <tbody class="" id="permission">
                                    <meta name="csrf-token" id="cs" content="{{csrf_token()}}">
                                   {{--  <tr>
                                        <td class="text-nowrap fw-bolder">
                                            Administrator Access
                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Allows a full access to the system">
                                                <i data-feather="info"></i>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll" />
                                                <label class="form-check-label" for="selectAll"> Select All </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($permission as $index => $per)
                                        <tr>
                                            <td class="text-nowrap fw-bolder" id="module">{{ $index }}</td>
                                            <td>
                                                @foreach ($per as $per)
                                                    <div class="d-flex">
                                                        <div class="form-check me-3 me-lg-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="checkbox_{{ $per->name }}" name="{{$per->name}}"
                                                                 />
                                                            <label class="form-check-label" for="checkbox_{{ $per->name }}">
                                                                {{ $per->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center mt-2">
                        <button type="submit" id="submit" class="btn btn-primary me-1"  data-bs-dismiss="modal"
                        aria-label="Close">Submit</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>

                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>
<!--/ Add Role Modal -->
