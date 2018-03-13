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
                            <ul class="list-group" >
                                @foreach(Auth::user()->notifications as $notification)
                                <li class="list-group-item{{ !is_null($notification->read_at) ? ' notification' : '' }}">
                                    {!!  $notification->data['message'] !!}

                                    @if (is_null($notification->read_at))
                                        <form method="POST" action="{{ url('notifications/' . $notification->id) }}" class="pull-right">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}

                                            <button type="submit" class="btn btn-primary btn-xs">Przeczytane</button>
                                        </form>
                                    @endif
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
