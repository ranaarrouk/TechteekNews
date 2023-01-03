@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ $article->title }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @php($content = json_decode(\Illuminate\Support\Str::replace(['[', ']'], "", $article->content)))
                        @if($content->type = 'image')
                            <embed src="{{ $content->data->gifUrl }}" width="300" height="300">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
