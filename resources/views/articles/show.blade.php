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
                        @php($content = json_decode($article->content, true))
                        @if(is_array($content))
                            @foreach($content as $item=>$value)
                                @if($value["type"] == "paragraph")
                                    <p>{{ $value["data"]["text"]}}</p><br>
                                @elseif($value["type"] == 'image')
                                    <embed src="{{ $value["data"]["gifUrl"] }}" width="300" height="300"><br>
                                @endif
                            @endforeach
                        @else
                            @if(isset($content->type) == 'image')
                                <embed src="{{ $content->data->gifUrl }}" width="300" height="300">
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
