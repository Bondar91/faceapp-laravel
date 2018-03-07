<form action="{{ url('/likes') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
    <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-thumbs-up"></span> Polub <span class="label label-info">{{$comment->likes->count()}}</span></button>
</form>