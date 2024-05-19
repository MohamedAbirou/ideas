@extends('layout.layout')

@section('title', 'View Idea')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.sidebar')
        </div>
        <div class="col-6">
            @include('shared.success_message')
            <hr>
            <div class="mt-3">
                @include('ideas.shared.idea_card')
            </div>

        </div>
        <div class="col-3">
            @include('shared.search-bar')
            @include('shared.follow-box')
        </div>
    </div>
@endsection
