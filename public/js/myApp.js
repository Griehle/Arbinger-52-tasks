var postId = 0;
var postBodyElement = null;

//  this is it

$('.interaction a.edit').on('click', function () {
    event.preventDefault();
    postBodyElement = event.target.parentNode.parentNode.childNodes[0];
    console.log(postBodyElement);
    var postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});

$('.interaction a.cmnt').on('click', function () {
    event.preventDefault();
    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    console.log(postBodyElement);
    var postBody = postBodyElement.textContent;

    $('#post-body').val(postBody);
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $('#comment-modal').modal();

});

$('#comment-save').on('click', function () {
    let comment = $('#comment-body').val();
    $.ajax({
        method: 'POST',
        url: urlComment,
        data: {commentBody: $('#comment-body').val(), postId: postId, _token: token}
    })
        .done(function (msg) {
            $(postBodyElement).text(msg['comment']);
            $('#comment-modal').modal('hide');
            $( "#p"+postId ).append( "<div class='comment'><p class='pad5 cmntBody'><span class =\"marginR10 pad5\" style=\"float: left; max-width: 100px;\" ><img class=\"commentImage \" src=\"{{ asset('storage/employees/'.$comment->user['name'] .'.png') }}\"></span>"+comment+"</p></div> " );
            console.log(comment);
        });
});

/*<div class="comment">
    <p class="pad5 cmntBody"></p>
    <p><span class ="marginR10 pad5" style="float: left; max-width: 100px;" ><img class="commentImage " src="{{ asset('storage/employees/'.$comment->user['name'] .'.png') }}"></span></p>
<p class="pad5 cmntBody">{{ $comment->body}}</p>
@if(Auth::user() == $comment->user)
<a href="{{route('comment.delete', ['comment_id' => $comment->id])}}">Delete</a>
@endif
</div>*/

$('#modal-save').on('click', function () {
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: {postBody: $('#post-body').val(), postId: postId, _token: token}
    })
        .done(function (msg) {
            $(postBodyElement).text(msg['newBody']);
            $('#edit-modal').modal('hide');
        });

});

$('.like').on('click', function(event) {
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    //console.log(postId);
    var isLike = event.target.previousElementSibling == null;

    if ($(this).html() === "Like") {
        $(this).html('Unlike');
    }
    else {
        $(this).html('Like');
    }

    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {isLike: isLike, postId: postId, _token: token}
    })
        .done(function() {
            console.log($(this));
        });
});


$('.fetchTask').on('click', function(event){
    console.log('task hit');
    event.preventDefault();
    $.ajax({
        method: 'GET',
        url: urlTask,
        data: {_token:token}
    })
        .done(function (result) {
            $('.hidden').removeClass('hidden').addClass('show');
            $('.taskToday').html(result.task);
            $('.taskToday').val(result.task);
        })
});

$('.taskAttach').click(function() {
    let el              = event.target.parentNode.parentNode.childNodes[1];
    let taskText        = el.innerHTML;
    let taskTextId      = ($(this.closest('li').getAttribute('data-task-id')));
    // console.log(taskTextId.selector);
    $('.taskText').val(taskText);
    $('.task_id').val(taskTextId.selector);
    $(el).css('background-color', 'yellow');

});

//delete old tasks in dashboard
$('.submit-nef2').on('click', function(){
    console.log( $('.taskToday').val());
});

$('.delete').on('click', function(){
    if (confirm("You will permanently delete this comment. Is that ok?")) {
        console.log(commentId);
    $.ajax({
            method: 'POST',
            url: '/commentDelete',
            data: { commentId: commentId, _token: token}
        })
    }

})

$('.changeDisplay').on('click', function(){
    $(".instructions").toggleClass('show');
})

/*$('.submitTask').on('click', function(event){
    event. preventDefault();
    $.ajax({
        method: 'GET',
        url: urlTask,
        data: {_token:token}
    })

})*/
