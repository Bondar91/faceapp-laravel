<div class="dropdown pull-right">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/posts/' . $post->id . '/edit') }}">Edytuj</a>
        </li>
        <li>
            <form method="POST" action="{{ url('/posts/' . $post->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-delete" onclick="return confirm('Czy na pewno chcesz usunąć post?');">Usuń</button>
            </form>
        </li>
    </ul>
</div>