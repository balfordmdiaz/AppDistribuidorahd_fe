@extends('layouts.app')
@section('title','Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    
                    @include('partials.banner')

                    @guest
                       @if (Route::has('login'))

                       @endif
                    @else
                       @include('partials.botones_inicio')
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
