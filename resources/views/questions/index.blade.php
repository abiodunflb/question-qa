@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                        <a href="{{route('questions.create')}}" class="btn btn-outline-secondary">Create Question</a>
                        </div>
                    </div>

                    
                </div>

                <div class="card-body">
                    {{$questions->links()}}
                    @include('inc._messages')
                    @forelse($questions as $question)
                    <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{$question->votes}}</strong> {{Str::plural('vote', $question->votes)}}
                                </div>

                                <div class="status {{$question->status}} mb-2">
                                    <strong>{{$question->answers_count}}</strong> {{Str::plural('answer', $question->answers_count)}}
                                </div>

                                <div class="view">
                                    {{$question->views . " " . Str::plural('view', $question->votes)}}
                                </div>
                            </div>
                        <div class="media-body">

                            <div class="d-flex align-items-center">
                                <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                                <div class="ml-auto">
                            {{-- @if(Auth::user()->can('update-question', $question)) --}}
                            @if(auth()->user()->id == $question->user_id)
                                <a href="{{route('questions.edit', $question->id)}}" class="btn btn-outline-info btn-sm">Edit</a>
                                    
                                
                            {{-- @endif --}}
                             {{-- @if(Auth::user()->can('delete-question', $question)) --}}
                                <form class="form-delete" action="{{route('questions.destroy', $question->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                
                                </form>
                            @endif
                                
                            {{-- @endif --}}
                                </div>
                            </div>
                            
                            
                            <p class="lead">
                            Asked By <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                            <small class="text-muted">{{$question->created_date}}</small>
                            </p>
                            
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
