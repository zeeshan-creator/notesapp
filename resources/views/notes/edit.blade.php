@extends('layouts.master')

@section('title', 'Edit Note')

@section('content')
    <main>
        <button type="button" class="btn btn-primary m-4" onclick="history.back()">Back</button>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Note <span class="fw-300"><i></i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <form method="POST" action="{{ route('notes.update', $note->id) }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label" for="example-palaceholder">Title</label>
                                        <input type="text" id="example-palaceholder" class="form-control"
                                            placeholder="Title" name="title" value="{{ $note->title }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="example-textarea">Note</label>
                                        <textarea class="form-control" id="example-textarea" rows="5" name="body" required>{{ $note->body }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="example-select">Tags</label>
                                        <select class="select2-placeholder-multiple form-control" multiple
                                            id="example-select" required name="tags[]">
                                            @foreach ($tags as $tag)
                                                @if (in_array($tag->id, $note->tags->pluck('id')->toArray()))
                                                    <option value="{{ $tag->id }}" selected>{{ $tag->tag }}
                                                    </option>
                                                @else
                                                    <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('scripts')
    <script>
        $(".select2-placeholder-multiple").select2({
            placeholder: "Select Tags"
        });
    </script>
@endsection
