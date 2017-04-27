$(function(){
    $('.btn-login').on('click',function () {
        $('.btn-login').removeClass('btn-default').addClass('btn-primary');
        $('.btn-reg').removeClass('btn-primary').addClass('btn-default');
        $('.reg').removeClass('login-select');
        $('.login').addClass('login-select');
    });
    $('.btn-reg').on('click',function () {
        $('.btn-login').removeClass('btn-primary').addClass('btn-default');
        $('.btn-reg').removeClass('btn-default').addClass('btn-primary');
        $('.reg').addClass('login-select');
        $('.login').removeClass('login-select');
    });
    $("#regSubmit").on("click",function(){
        var opts={
            bSubmit:true
        };
        if($("#name").val() && $("#pass").val() && $("#repass").val()){
            opts.bSubmit=true;
        }else{
            opts.bSubmit=false;
        }
        if($("#pass").val() != $("#repass").val()){
            $(".danger").css("display","inline-block");
            opts.bSubmit=false;
        }else{
            $(".danger").css("display","none");
        }
      return opts.bSubmit;

    });
});
