@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dane użytkownika</div>

                    <div class="panel-body text-center">
                        <h2><a href="{{ url('/users/' . $user->id) }}">{{ $user->name }}</a></h2>
                        <p>
                            @if ( $user->sex == 'm' )
                                Mężczyzna
                            @else
                                Kobieta
                            @endif
                        </p>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil officia praesentium quas repellendus suscipit? Consequuntur incidunt officiis omnis quisquam unde.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
