@extends('layouts.master')

@section('title', 'Shared Notes')

@section('content')
    <main>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            shared <span class="fw-300"><i>Notes</i></span>
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
                                        <th>Created by</th>
                                        {{-- <th>Tags</th> --}}
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sharedNotes as $sharedNote)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sharedNote->note->title }}</td>
                                            <td>{{ $sharedNote->note->body }}</td>
                                            {{-- <td>{{ implode(', ', $note->tags->pluck('tag')->toArray()) }}</td> --}}
                                            <td>
                                                {{ $sharedNote->createdUser->name }}
                                            </td>
                                            <td>{{ $sharedNote->note->created_at }}</td>
                                            <td>
                                                <a class="btn btn-default"
                                                    href="{{ route('notes.show', $sharedNote->note->id) }}">View</a>
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
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Datatables
            $('#dt-basic-example').dataTable({
                responsive: true
            });
        });
    </script>
@endsection
