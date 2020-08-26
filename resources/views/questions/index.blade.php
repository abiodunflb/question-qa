@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('All Questions') }}</div>

                <div class="card-body">
                    @forelse($questions as $question)
                    <div class="media">
                        <div class="media-body">
                        <h3 class="mt-0">{{$question->title}}</h3>
                        {{Str::limit($question->body, 250)}}
                        </div>
                    </div>
                    <hr>

                    @empty

                    <h3>No question Available</h3>
                    
                    @endforelse

                    {{$questions->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
