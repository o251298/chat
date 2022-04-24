$(document).ready(function () {
    $('.btn_post').click(function () {
        alert(111);
        var post_id = $(this).val();
        console.log(post_id);
        $.get("/post/mark/" + post_id)
            .done(function( data ){
                if (data.error){
                    console.log(data.error);
                    return false;
                }
                $("#mark_" + post_id).text('');
                $("#mark_" + post_id).text(data + ' Likes');
                console.log(data);
            });
    });
});
