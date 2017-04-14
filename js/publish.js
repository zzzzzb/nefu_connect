/**
 * Created by Administrator on 2017/4/14.
 */
require.config({
    paths : {
        "jquery" : "jquery-1.12.4"
    }
});
define(["jquery"],function(){
    return {
        open : function(settings){
            var defaultSettings = {

            };
            $.extend(defaultSettings,settings);
            var html =
                '<div class="publish-container">'
                    +'<div class="mask"></div>'
                    +'<div class="publish-box">'
                         +'<header class="publish-header">'
                             +'<span class="publish-btn1">×</span>'
                             +'<span class="publish-title">发布</span>'
                             +'<span class="publish-btn2">√</span>'
                         +'</header>'
                         +'<textarea placeholder="你想说的话" maxlength="200" required="required"></textarea>'
                         +'<footer class="publish-footer">'
                             +'<div class="publish-checkbox">'
                                +'<input type="checkbox"/>'
                                +'<label></label>'
                                +'<span>匿名</span>'
                             +'</div>'
                             +'<div class="publish-send">'
                                 +'<span>发送</span>'
                             +'</div>'
                         +'</footer>'
                    +'</div>'
                +'</div>';
            $("body").append(html);
            $(".dialog-box").css({
                width: defaultSettings.width,
                height: defaultSettings.height
            });
            $(".publish-btn1").on('click',function(){
                $(".publish-container").remove();
            });
            $(".mask").on('click',function(){
                $(".publish-container").remove();
            });

        }
    };
});