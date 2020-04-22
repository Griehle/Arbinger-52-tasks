
    <div>
        Here is what has happened on the <a href=" htttp://wow.nef1.org">WOW board</a> recently <br>

        <br>

    @foreach($postarray as $post)
        <p>{{ $post['name'.$loop->index] }} Wrote: </p>
        <p>{{ str_limit($post['body'.$loop->index], $limit=60, $end = '...') }}</p>
        <p><a href="http://wow.nef1.org">Read more here</a></p>
            <br><br>
        @endforeach
    </div>

