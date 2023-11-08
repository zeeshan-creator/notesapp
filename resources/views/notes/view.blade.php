@extends('layouts.master')

@section('title', 'View Note')

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
                            <h2>{{ $note->title }}</h2>
                            <p>{{ $note->body }}</p>
                            <hr>
                            <h5>
                                <td>{{ implode(', ', $note->tags->pluck('tag')->toArray()) }}</td>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
