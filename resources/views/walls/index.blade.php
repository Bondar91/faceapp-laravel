@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-7 col-md-offset-3">
                @if(Auth::check())
                    <div class="panel panel-default">
                        <div class="panel-body text-center">

                            @include('posts.create')

                        </div>
                    </div>
                @endif

                @if ($posts->count() > 0)
                    @foreach($posts as $post)

                        @include('posts.include.single')

                    @endforeach
                @else
                    Brak postów
                @endif

                <div class="text-center">
                    {{ $posts }}
                </div>
            </div>


        </div>
    </div>
@endsection
