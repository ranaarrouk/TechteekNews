@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create your article') }}</div>

                    <div class="card-body">

                        <div id="validation_errors" class="alert alert-danger" role="alert" style="display: none;">

                        </div>
                        <form id="editor-form" method="post" action="{{ route('articles.store') }}">
                            @csrf
                            <div class="col-md-12">
                                <label class="form-label">Title</label>
                                <input id="title" type="text" class="form-control" name="title">
                                @if($errors->has('title'))
                                    <span class="error">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Content</label>
                                <div id="editorjs"></div>
                                <input type="hidden" name="content" id="content">
                            </div>

                            <button id="submit-btn" class="btn btn-success">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/editor.js') }}"></script>
    <script src="{{ asset('js/search_GIFs.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        const editor = new EditorJS({
            holderId: 'editorjs',
            autofocus: true,
            tools: {
                image: GIFImage
            }
        });

        document.querySelector('#submit-btn').addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById('validation_errors').style.display = 'none';
            document.getElementById('validation_errors').innerText = '';
            let form = document.querySelector('#editor-form');
            let title = document.querySelector('#title').value;
            editor.save().then((outputData) => {
                console.log('Article data: ', outputData.blocks);
                axios({
                    method: form.method,
                    url: form.action,
                    data: {
                        title: title,
                        content: outputData.blocks
                    }
                }).then(function (response) {
                    if (response.data.status == 'fail') {
                        document.getElementById('validation_errors').style.display = 'block';
                        document.getElementById('validation_errors').innerText = response.data.message;
                    } else {
                        location.assign(response.data);
                    }

                });

            }).catch((error) => {
                console.log('Saving failed: ', error)
            });

        });
    </script>
@endsection
