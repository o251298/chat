$(document).ready(function () {
    $('.btn-subscribe').click(function (event) {
        console.log(event.target.value);
        $.get("/users/subscribe/" + event.target.value)
            .done(function( data ){
                if (data.error){
                    console.log(data.error);
                    return false;
                }
                $("#btn_s_" + event.target.value).css('display', 'none');
                $("#btn_d_" + event.target.value).fadeIn("slow");
                console.log(data);
            });
    });
    $('.btn-describe').click(function (event) {
        console.log(event.target.value);
        $.get("/users/unsubscribe/" + event.target.value)
            .done(function( data ){
                if (data.error){
                    console.log(data.error);
                    return false;
                }
                $("#btn_d_" + event.target.value).css('display', 'none');
                $("#btn_s_" + event.target.value).fadeIn("slow");
                console.log(data);
            });
    });
});
