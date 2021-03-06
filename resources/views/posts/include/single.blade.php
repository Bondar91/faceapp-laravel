<div class="panel panel-default{{ $post->trashed() ? ' trashed' : '' }}">
    <div class="panel-body">

        @if (belongs_to_auth($post->user_id) || is_admin())

            @include('posts.include.dropdown-menu')

        @endif

        <div class="clearfix" >
            <img src="{{ url('images/user-avatar/' . $post->user->id . '/50') }}" alt="Avatar" class="img-responsive pull-left">
            <div class="pull-left" style="margin: 3px 10px;">
                <a href="{{ url('users/' . $post->user->id) }}"><strong>{{ $post->user->name }}</strong></a><br>
                <a href="{{ url('posts/' . $post->id) }}" class="text-muted"><small>{{ $post->created_at }}</small></a>
            </div>
        </div>

        <div id="post{{ $post->id }}" style="margin-top: 5px;">
            <p>{{ $post->content }}</p>
        </div>

        @include('posts.include.likes')

        <hr>

        @if (Auth::check())
            @include('comments.create')
        @endif

        <div class="row">
            <div class="col-md-12">
                @foreach ($post->comments as $comment)
                    @include('comments.include.single')
                @endforeach
            </div>
        </div>

    </div>
</div>
