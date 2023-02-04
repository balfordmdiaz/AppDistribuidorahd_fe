@extends('layouts.app')
@section('title','Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if (Auth::check())
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    
                    @include('partials.banner')

                </div>
            </div>
        
        @else
        </div>
        @endif
    </div>
</div>
@endsection