@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Timeline</div>

                <div class="card-body">
                  @if (Auth::user()->token)
                      @if($tweets->count())
                          @foreach ($tweets as $tweet)
                                <div class="media">
                                      <div class="media-left">
                                         
                                      </div>
                                      <div class="media-body" id="app">
                                         <strong>{{ $tweet->user->name }}</strong>
                                         <p>{{ $tweet->body }}</p>
                                         
                                      </div>
                                </div>

                          @endforeach
                      @endif
                  @else 
                      <p>Please <a href="{{ url('/auth/twitter') }}">Authorize with Twitter</a></p>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
