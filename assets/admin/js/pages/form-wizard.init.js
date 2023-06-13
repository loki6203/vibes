$(function(){
    $("#form-horizontal").steps({
        headerTag:"h3",
        bodyTag:"fieldset",
        transitionEffect:"slide",
        onFinished: function (event, currentIndex) {
            var form = $(this);
            form.submit();
        },
    })
});