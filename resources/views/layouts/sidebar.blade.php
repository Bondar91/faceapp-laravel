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
            <p>
                <a href="{{ url('/users/' . $user->id . '/friends') }}">
                    Znajomi <span class="label label-info">{{ $user->friends()->count() }}</span>
                </a>
            </p>

            @if (Auth::check() && $user->id !== Auth::id())

                @if (!friendship($user->id)->exists && !has_friend_invitation($user->id))
                    <form method="POST" action="{{ url('/friends/' . $user->id ) }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">Zaproś do znajomych</button>
                    </form>

                @elseif (has_friend_invitation($user->id))
                    <form method="POST" action="{{ url('/friends/' . $user->id ) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <button type="submit" class="btn btn-primary">Przyjmij zaproszenie</button>
                    </form>

                @elseif (friendship($user->id)->exists && !friendship($user->id)->accepted)
                    <button class="btn btn-success disabled">Zaproszenie wysłane</button>

                @elseif (friendship($user->id)->exists && friendship($user->id)->accepted)
                    <form method="POST" action="{{ url('/friends/' . $user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Usuń ze znajomych</button>
                    </form>

                @endif
            @endif
        </div>
    </div>
</div>