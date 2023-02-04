@extends('layouts.app')
@section('title','Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if (Auth::check())
            <div class="card">
                <div class="card-header"></div>    
                    @include('partials.banner')

                    @guest
                       @if (Route::has('login'))

                       @endif
                    @else
                       @include('partials.botones_inicio')
                    @endguest
                </div>
        @else
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
