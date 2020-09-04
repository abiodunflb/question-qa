@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Create Question</h2>
                        <div class="ml-auto">
                        <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back To All Questions</a>
                        </div>
                    </div>

                    @include('inc._messages')
                </div>

                <div class="card-body">
                <form action="{{route('questions.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                    <input type="text" class="form-control {{ $errors->has('title')? 'is-invalid': ''}}" id="title" name="title" value="{{old('title')}}">
                    </div>

                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control {{ $errors->has('body')? 'is-invalid': ''}}" name="body" id="body" rows="10">{{old('body')}}</textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-outline-primary btn-lg" type="submit">Ask</button>
                    </div>
                
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
