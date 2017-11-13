<form method="POST" action="{{ url('posts/') }}">
    <div class="form-group{{ $errors->has('post_content') ? ' has-error' : '' }}">
        {{ csrf_field() }}

        @if ($errors->has('post_content'))
            <span class="help-block">
                <strong>{{ $errors->first('post_content') }}</strong>
            </span>
         @endif

        <textarea name="post_content" class="form-control" cols="30" rows="5" placeholder="O czym myślisz?"></textarea>
        <button type="submit" class="btn btn-default pull-right" style="margin-top: 10px;">Dodaj post!</button>
    </div>
</form>

