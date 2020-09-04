@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                    <h2>{{$question->title}}</h2>
                        <div class="ml-auto">
                        <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back To All Questions</a>
                        </div>
                    </div>
                    @include('inc._messages')
                    
                </div>
                <div class="media">
                    <div class="d-flex flex-column vote-controls">
                        <a title="This is a useful question" class="vote-up">Vote Up</a>
                        <span class="votes-count">123</span>
                        <a title="This is not a useful question" class="vote-down off">Vote Down</a>
                        <a title="click to mark as favourite (click to undo)" class="favourite">
                            favourite
                            <span class="favourites-count">123</span>
                        </a>
                    </div>
                    <div class="media-body">
                        {{$question->body}}
                    </div>
                </div>
                

                <div class="card-footer">
                    <div class="d-flex align-items-center">
                    By <img class="px-2" src="{{$question->user->avatar}}" alt=""> {{$question->user->name}}  {{$question->created_date}}
                        <div class="ml-auto">
                        <a href="{{route('questions.edit', $question->id)}}" class="btn btn-outline-primary btn-sm">Edit</a>
                            <form class="form-delete" action="{{route('questions.destroy', $question->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{$question->answers_count . " " . Str::plural('Answer', $question->answers_count)}}</h2>
                    </div>
                    <hr>
                    @forelse($question->answers as $answer)
                    <div class="media">

                        <div class="media-body">
                            {{$answer->body}}
                            <div class="d-flex float-right mt-3">
                                <div class="media">
                                    <a href="{{$answer->user->url}}" class="pr-2">
                                    <img src="{{$answer->user->avatar}}" alt="avatar">
                                    </a>
                                </div>
                                Answered {{$answer->created_date}} By {{$answer->user->name}}
                                
                            </div>
                        </div>
                    </div>
                    <hr>

                    @empty
                    <div class="media">
                        <div class="media-body">
                            No answer
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
