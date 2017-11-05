<div class="col-md-3 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
            Użytkownik
            @if($user->id === Auth::id())
                <a href="{{ url('/users/' . $user->id . '/edit') }}" class="pull-right">Edytuj</a>
            @endif
        </div>

        <div class="panel-body text-center">
            <img src="{{ url('images/user-avatar/' . $user->id . '/250') }}" alt="Avatar image" class="thumbnail img-responsive">
            <h2><a href="{{ url('/users/' . $user->id) }}">{{ $user->name }}</a></h2>
            <p>
                @if ( $user->sex == 'm' )
                    Mężczyzna
                @else
                    Kobieta
                @endif
            </p>
            <p>{{ $user->email }}</p>

            @if (Auth::check() && $user->id !== Auth::id())
                <form method="POST" action="{{ url('/friends/add/' . $user->id ) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">Zaproś do znajomych</button>
                </form>
            @endif
        </div>
    </div>
</div>