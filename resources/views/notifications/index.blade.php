@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Powiadomienia</div>
                    <div class="panel-body text-center">
                        @if (Auth::user()->notifications->count() === 0)
                            <h4>Brak powiadomień</h4>
                        @else
                            <ul class="list-group">
                                @foreach(Auth::user()->notifications as $notification)
                                <li class="list-group-item">
                                    {{ $notification->data['message'] }}
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
