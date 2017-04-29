/*使用弹出层组件开始*/
require(["publish"], function(publish){
    var oOpen = document.getElementById("open");
    oOpen.onclick = function() {
        var settings = {};
        publish.open(settings);
    }
});
/*使用弹出层组件结束*/
$(function(){
    var scrollFunc = function (e) {
        e = e || window.event;
        if (e.wheelDelta) {  //判断浏览器IE，谷歌滑轮事件
            if (e.wheelDelta > 0) { //当滑轮向上滚动时
                $(".title").fadeIn();
            }
            if (e.wheelDelta < 0) { //当滑轮向下滚动时
                $(".title").fadeOut();
            }
        } else if (e.detail) {  //Firefox滑轮事件
            if (e.detail> 0) { //当滑轮向上滚动时
                $(".title").fadeIn();
            }
            if (e.detail< 0) { //当滑轮向下滚动时
                $(".title").fadeOut();
            }
        }
    };
    if (document.addEventListener) {//firefox
        document.addEventListener('DOMMouseScroll', scrollFunc, false);
    }
//滚动滑轮触发scrollFunc方法  //ie 谷歌
    window.onmousewheel  = scrollFunc;
    var beforeScrollTop = $(window).scrollTop();
    $(window).scroll(function(){
        var afterScrollTop = $(window).scrollTop();
        var delta=afterScrollTop-beforeScrollTop;
        if(delta>0){
            $(".title").fadeOut();
        }else{
            $(".title").fadeIn();
        }
        beforeScrollTop=afterScrollTop;
    });
    var bFlag=false;
    $(".footer-left img").on("click",function(){
        if(bFlag){
            $(this).attr("src","assets/fonts/page-2.ico");
            $(".footer-right img").attr("src","assets/fonts/person-1.ico");
            bFlag=false;
        }

    });
    $(".footer-right img").on("click",function(){
        if(bFlag){

        }else{
            $(".footer-left img").attr("src","assets/fonts/page-1.ico");
            $(this).attr("src","assets/fonts/person-2.ico");
            bFlag=true;
        }
    });

    $(".content li .middle-text").each(function(){
        var btn="<div></div>";
        var text=$(this).html();
        var text2=text.substring(0,80)+".....";
        $(this).html(text.length > 80 ? text2:text);
        if(text.length>text2.length){
            var bFlag=false;
            $(btn).appendTo($(this).parent());
            $(this).siblings().addClass("middle-btn");
            $(this).siblings().html("展开全文");
            // $(".content-middle div").last().addClass("middle-btn");
            // $(".content-middle div").last().html("展开全文");
            $(this).siblings().on("click",function(){
                if(bFlag){
                    $(this).last().html("展开全文");
                    $(this).siblings().html(text2);
                    bFlag=false;
                }else{
                    $(this).last().html("收起");
                    $(this).siblings().html(text);
                    bFlag=true;
                }
            });
        }
    });

    function loadData(){
        var Li=$('<li></li>'),
            Wrapper=$('<div class="wrapper"></div>'),
            content_header=$('<div class="content-header"></div>'),
            content_header_left=$(' <div class="content-header-left"></div>'),
            content_header_img=$('<img src="assets/img/woman1.jpg" alt="">'),
            content_header_span=$('<span>某同学·女</span>'),
            content_header_right=$('<div class="content-header-right">3分钟前</div>'),
            content_middle=$(' <div class="content-middle"></div>'),
            middle_text=$(' <div class="middle-text">想帮同学问一下 有一个互联网研究的访谈项目，需要绵阳的城市负责人，找地方，访谈的时候负责现场事情 两天4.24-4.25 路费住宿费报销 报酬一天二百左右 需要传简历过去 有没有人想去的 她说可以学到很多市场调研的东西</div>'),
            content_footer=$('<div class="content-footer"></div>'),
            content_footer_love=$('<div class="content-footer-love"></div>'),
            footer_love_a=$(' <a href="javascript:;"></a>'),
            footer_love_img=$('<img src="assets/fonts/love.ico" alt="">'),
            footer_love_span=$('<span>3</span>'),
            content_footer_comment=$('<div class="content-footer-comment"></div>'),
            footer_comment_a=$(' <a href="javascript:;"></a>'),
            footer_comment_img=$('<img src="assets/fonts/comment.ico" alt="">'),
            footer_comment_span=$('<span>0</span>');
            var flag=false;
            footer_love_img.on("click",function(){
                var html=$(this).parent().siblings().html();
                var html2=parseInt(html);
                if(flag){
                    html2-=1;
                    $(this).parent().siblings().html(html2);
                    $(this).attr("src","assets/fonts/love.ico");
                    flag=false;
                }else{
                    html2+=1;
                    $(this).parent().siblings().html(html2);
                    $(this).attr("src","assets/fonts/love-2.ico");
                    flag=true;
                }
            });
        content_header_left.append(content_header_img).append(content_header_span);
        content_header.append(content_header_left).append(content_header_right);
        content_middle.append(middle_text);
        footer_love_a.append(footer_love_img);
        content_footer_love.append(footer_love_a).append(footer_love_span);
        footer_comment_a.append(footer_comment_img);
        content_footer_comment.append(footer_comment_a).append( footer_comment_span);
        content_footer.append( content_footer_love).append(content_footer_comment);
        Wrapper.append(content_header).append(content_middle).append(content_footer);
        Li.append(Wrapper);
        setTimeout(function(){
            $(".content ul").append(Li);
        },500);

    }
    loadData();
    var flag2=false;
    $(window).on("scroll",function(){
        var scrollTop=$(window).scrollTop();
        if(scrollTop+$(window).height() > $("#index").height() && $("#index").height()<=8000){
            loadData();
        }else if($("#index").height()>8000 && flag2==false){
            flag2=true;
            $(".content").append('<div class="show-more"><button>显示更多</button></div>');
            return false;
        }else if(flag2==true){
            $(".show-more button").on("click",function(){
                loadData();
                $(this).remove();
                $(".show-more").remove();
                flag2=false;
            });
        }


    });
    /*点赞开始*/
    $(".content-footer-love img").each(function(){
        $(this).siblings().on('click',function(){
            $(this).siblings().click();
        });
        var flag = false;
        $(this).on("click",function(){
            var url = $(this).attr("src");
            if(url == 'assets/fonts/love.ico'){
                flag = false;
            }else{
                flag = true;
            }
            var html=$(this).parent().siblings().html();
            var html2=parseInt(html);
            if(flag){
                html2-=1;
                $(this).parent().siblings().html(html2);
                $(this).attr("src","assets/fonts/love.ico");
                flag=false;
                var str = $(this).siblings().val();
                var that = this;
                $.get('welcome/reduce_like',{
                    'ids' : str
                }, function (data) {
                    if(data == 'fail'){
                        html2+=1;
                        $(that).parent().siblings().html(html2);
                        $(that).attr("src","assets/fonts/love-2.ico");
                        flag=true;
                    }
                });
            }else{
                html2+=1;
                $(this).parent().siblings().html(html2);
                $(this).attr("src","assets/fonts/love-2.ico");
                flag=true;
                var str = $(this).siblings().val();
                var that = this;
                $.get('welcome/add_like',{
                    'ids' : str
                }, function (data) {
                    if(data == 'fail'){
                        html2-=1;
                        $(that).parent().siblings().html(html2);
                        $(that).attr("src","assets/fonts/love.ico");
                        flag=false;
                    }
                });
            }
        });
    });
    /*点赞结束*/

    /*双击导航栏回到顶部开始*/
    $('#logo').on('click', function () {
        $('html, body').animate({scrollTop: 0}, 'fast');
        return false;
    });
    $('#title').on('click', function () {
        $('html, body').animate({scrollTop: 0}, 'fast');
        return false;
    });
    /*双击导航栏回到顶部结束*/
});





