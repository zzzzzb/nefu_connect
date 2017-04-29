<!--时间友好转换开始-->
<?php
header("Content-type: text/html; charset=utf8");
date_default_timezone_set("Asia/Shanghai");   //设置时区
function time_tran($the_time) {
    $now_time = date("Y-m-d H:i:s", time());
    //echo $now_time;
    $now_time = strtotime($now_time);
    $show_time = strtotime($the_time);
    $dur = $now_time - $show_time;
    if ($dur < 0) {
        return $the_time;
    } else {
        if ($dur < 60) {
            return $dur . '秒前';
        } else {
            if ($dur < 3600) {
                return floor($dur / 60) . '分钟前';
            } else {
                if ($dur < 86400) {
                    return floor($dur / 3600) . '小时前';
                } else {
                    if ($dur < 259200) {//3天内
                        return floor($dur / 86400) . '天前';
                    } else {
                        return $the_time;
                    }
                }
            }
        }
    }
}
?>
<!--时间友好转换结束-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?php echo site_url();?>">
    <link rel="shortcut icon" href="assets/fonts/favicon.ico" type="assets/img/x-icon" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/detail.css">
    <title>campus</title>
</head>
<body>
<div id="index">
    <!--导航栏开始-->
    <div class="title navbar navbar-fixed-top">
        <div class="title-left" id="logo">
            <a href="">首页</a>
        </div>
        <div class="title-center" id="title">
            campus
        </div>
        <div class="title-right" >

        </div>
    </div>
    <!--导航栏结束-->
    <!--内容主体开始-->
    <div class="content">
        <ul>
            <?php foreach($details as $detail){ ?>
                <li>
                    <div class="wrapper">
                        <div class="content-header">
                            <div class="content-header-left">
                                <img src="<?php
                                if($detail->is_anonymity){
                                    if($detail->sex == '男'){
                                        echo 'assets/img/man2.jpg';
                                    }else{
                                        echo 'assets/img/woman2.jpg';
                                    }
                                }else{
                                    echo $detail->portrait;
                                }
                                ?>" alt="">
                                <span>
                                <?php
                                if($detail->is_anonymity){
                                    echo "某同学·".$detail->sex;
                                }else{
                                    echo $detail->username;
                                }
                                ?>
                            </span>
                            </div>
                            <div class="content-header-right content-date"><?php
                                $posttime = $detail->post_date;
                                echo time_tran($posttime);
                                ?></div>
                        </div>
                        <div class="content-middle">
                            <div class="middle-text"><?php echo $detail->content;?></div>
                        </div>
                        <div class="content-footer">
                            <div class="content-footer-love">
                                <a href="javascript:;"><img src="assets/fonts/love.ico" alt=""></a>
                                <span><?php echo $detail->love_num;?></span>
                            </div>
                            <div class="content-footer-comment">
                                <a href="javascript:;"><img src="assets/fonts/comment.ico" alt=""></a>
                                <span><?php echo $detail->com_num;?></span>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!--评论主体开始-->
    <div class="comment">
        <ul>
            <?php foreach ($comments as $comment){?>
            <li>
                <div class="wrapper-com">
                    <div class="comment-header">
                        <div class="comment-header-left">
                            <img src="assets/img/default.jpg" alt="">
                            <div class="column">
                                <div class="column-one">banana</div>
                                <div class="column-two">
                                    <?php
                                    $posttimesecond=$comment->post_date_com;
                                    echo time_tran($posttimesecond);
                                    ?>
                                </div>
                            </div>
                            <div class="comment-header-right">
                                <img src="assets/fonts/smile.ico" alt="">
                                <span>0</span>
                            </div>
                        </div>

                    </div>
                    <div class="comment-footer">
                        <?php echo $comment->content_com;?>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!--评论主体结束-->
    <!--内容主体结束-->
    <!--尾部开始-->
    <div class="footer">
        <textarea name="" id="" cols="30" rows="1" placeholder="请登录后再评论"></textarea>
        <div>发送</div>
    </div>
    <!--尾部结束-->
</div>
</div>
<script src="assets/js/jquery-2.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>