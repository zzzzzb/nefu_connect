/**
 * Created by Administrator on 2017/4/14.
 */
require.config({
    paths : {
        "jquery" : "jquery-2.1.1.min"
    }
});
define(["jquery"],function(){
    return {
        open : function(settings){
            var defaultSettings = {

            };
            $.extend(defaultSettings,settings);
            /*创建DOM结构开始*/
            var html =
                '<div class="publish-container">'
                    +'<div class="publish-mask"></div>'
                    +'<div class="publish-box">'
                         +'<header class="publish-header">'
                             +'<span class="publish-btn1 glyphicon glyphicon-remove"></span>'
                             +'<span class="publish-title">发布</span>'
                             +'<span class="publish-btn2 glyphicon glyphicon-ok"></span>'
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
                    +'</div>';
                +'</div>';
            $("#index").append(html);
            /*创建DOM结构结束*/

            /*设置点击事件开始*/
            $(".dialog-box").css({
                width: defaultSettings.width,
                height: defaultSettings.height
            });
            $(".publish-btn1").on('click',function(){
                $(".publish-container").remove();
            });
            $(".publish-mask").on('click',function(){
                $(".publish-container").remove();
            });
            /*设置点击事件结束*/
        }
    };
});