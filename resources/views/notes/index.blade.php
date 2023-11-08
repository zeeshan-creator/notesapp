@extends('layouts.master')

@section('title', 'My Notes')

@section('content')
    <main>

        <button type="button" class="btn btn-primary m-4" data-toggle="modal" data-target="#create_note_modal">Add
            Note</button>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Notes <span class="fw-300"><i></i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Tags</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notes as $note)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $note->title }}</td>
                                            <td>{{ $note->body }}</td>
                                            <td>{{ implode(', ', $note->tags->pluck('tag')->toArray()) }}</td>
                                            <td>{{ $note->created_at }}</td>
                                            <td><a class="btn btn-info" href="{{ route('notes.edit', $note->id) }}">Edit</a>
                                                | <a class="btn btn-default"
                                                    href="{{ route('notes.show', $note->id) }}">View</a>
                                                | <button class="btn btn-danger btn-delete"
                                                    data-id="{{ $note->id }}">Delete</button> |
                                                <button class="btn btn-secondary btn-share"
                                                    data-id="{{ $note->id }}">Share</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <!-- datatable end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Note Create Modal -->
        <div class="modal fade" id="create_note_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('notes.create') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="example-palaceholder">Title</label>
                                <input type="text" id="example-palaceholder" class="form-control" placeholder="Title"
                                    name="title" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="example-textarea">Note</label>
                                <textarea class="form-control" id="example-textarea" rows="5" name="body" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="example-select">Tags</label>
                                <select class="select2-placeholder-multiple form-control" multiple id="example-select"
                                    required name="tags[]">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Users Modal -->
        <div class="modal fade" id="share_users_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Share Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="users_dropdown">
                                Users
                            </label>
                            <input type="hidden" name="note_id" id="hidden_note_id">
                            <select class="select2-multiple-users form-control w-100" multiple name="uesrs[]"
                                id="users_dropdown">
                                <option value="">Select an option</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-share-store">Share</button>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Datatables
            $('#dt-basic-example').dataTable({
                responsive: true
            });

            // Select2
            $(".select2").select2({
                dropdownParent: $("#share_users_modal")
            });
            $(".select2-placeholder-multiple").select2({
                placeholder: "Select Tags",
                dropdownParent: $("#create_note_modal")
            });

            $(".select2-multiple-users").select2({
                placeholder: "Select Users",
                dropdownParent: $("#share_users_modal")
            });

            // Delete Button
            $('.btn-delete').click(function() {
                var id = $(this).data('id');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: "{{ route('notes.destroy', '') }}" + "/" + id,
                        type: 'GET',
                        data: {
                            _token: csrfToken,
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                }
            });

            // Share with users
            $('.btn-share').click(function() {
                var id = $(this).data('id');
                $('#hidden_note_id').val(id);

                $('#share_users_modal').modal('show');
            });

            // Send an AJAX request to fetch users
            $.ajax({
                url: "{{ route('getusers') }}",
                type: 'GET',
                success: function(data) {
                    // Loop through the received data and add options to the select dropdown
                    data.forEach(function(user) {
                        $('#users_dropdown').append(
                            $('<option>', {
                                value: user.id,
                                text: user.name
                            })
                        );
                    });

                    // Refresh the Select2 dropdown to apply the changes
                    $('#users_dropdown').trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });

            // store users to shared Notes
            $('.btn-share-store').click(function(e) {
                e.preventDefault(); // Prevent the default form submission if any

                // Check if a user is selected in the dropdown
                var selectedUserId = $('#users_dropdown').val();

                if (selectedUserId) {
                    // Run an AJAX request to store the selected user in the shared notes table
                    $.ajax({
                        url: "{{ route('shared.notes.create') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            note_id: $('#hidden_note_id')
                                .val(), // Assuming you have the hidden_note_id set
                            user_ids: selectedUserId
                        },
                        success: function(response) {
                            // Handle success, e.g., show a success message or perform any other actions
                            alert(response.message);
                            $('#share_users_modal').modal('hide');
                        },
                        error: function(xhr, status, error) {
                            // Handle error, e.g., show an error message or perform any other actions
                            alert('Error: ' + error);
                        }
                    });
                } else {
                    // Handle the case where no user is selected
                    alert('Please select a user before sharing');
                }
            });
        });
    </script>
@endsection
