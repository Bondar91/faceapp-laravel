@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Wyniki wyszukiwania</div>
                    <div class="panel-body text-center">
                        @if ($search_results_users->count() === 0)
                            <h4>Brak wyników wyszukiwania</h4>
                        @else
                            <div class="row">
                                @foreach($search_results_users as $user)
                                    <div class="col-md-4 text-center">
                                        <a href="{{ url('/users/' . $user->id) }}">
                                        <div class="thumbnail">
                                            <img src="{{ url('images/user-avatar/' . $user->id . '/250') }}" alt="User Avatar" class="img-responsive">
                                            <h5>{{ $user->name }}</h5>
                                        </div>
                                        </a>
                                    </div>
                                @endforeach
                                {{ $search_results_users->appends(['q' => $search_phrase])->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
