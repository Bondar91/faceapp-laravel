@if (!$loop->first)
    <hr style="margin: 10px 0;">
@endif

<div id="comment{{ $comment->id }}" class="{{ $comment->trashed() ? 'trashed' : '' }}">

    @if (belongs_to_auth($comment->user_id) || is_admin())

        @include('comments.include.dropdown-menu')

    @endif
    <img src="{{ url('images/user-avatar/' . $comment->user->id . '/20') }}" alt="Avatar" class="img-responsive pull-left">
    <div style="padding-left: 5px; overflow: hidden;">
        <a href="{{ url('/posts/' . $post->id . '#comment' . $comment->id) }}" class="text-muted pull-right"><small><span class="glyphicon glyphicon-time"></span> {{ $post->created_at }}</small></a>
        <a href="{{ url('/users/' . $comment->user->id) }}">{{ $comment->user->name }}</a><br>
        {{ $comment->content }}
    </div>

    @include('comments.include.likes')
</div>

@section('footer')
    <script>
        $(function(){

            function addHighlightClass() {
                let hash = window.location.hash.substring(1);
                let comment = document.getElementById(hash);
                let $comment = $(comment).addClass('highlight highlightYellow');
                setTimeout(function(){
                    $comment.removeClass('highlightYellow');
                }, 1500);
            } addHighlightClass();

            window.addEventListener('hashchange', function(){
                addHighlightClass();
            }, false);

        });
    </script>
@endsection



