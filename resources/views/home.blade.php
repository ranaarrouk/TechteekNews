@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h1>Teckteek News</h1>
                        <h3> Create your own articles with special GIFs <a href="{{ route('articles.create') }}">
                                here </a></h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
