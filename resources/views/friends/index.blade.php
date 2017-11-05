@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Lista znajomych <span class="label label-info">{{ $user->friends()->count() }}</span></div>
                    <div class="panel-body text-center">
                        @if ($user->friends()->count() === 0)
                            <h4>Brak wyników wyszukiwania</h4>
                        @else
                            <div class="row">
                                @foreach($user->friends() as $user)
                                    <div class="col-md-4 text-center">
                                        <a href="{{ url('/users/' . $user->id) }}">
                                            <div class="thumbnail">
                                                <img src="{{ url('images/user-avatar/' . $user->id . '/250') }}" alt="User Avatar" class="img-responsive">
                                                <h5>{{ $user->name }}</h5>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
