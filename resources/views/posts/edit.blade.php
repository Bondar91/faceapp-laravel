@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="POST" action="{{ url('posts/' . $post->id) }}">
                            <div class="form-group{{ $errors->has('post_content') ? ' has-error' : '' }}">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}

                                @if ($errors->has('post_content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('post_content') }}</strong>
                                    </span>
                                @endif

                                <textarea name="post_content" class="form-control" cols="30" rows="5" placeholder="O czym myślisz?">{{ $post->content }}</textarea>
                                <button type="submit" class="btn btn-default pull-right" style="margin-top: 10px;">Edytuj post!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
