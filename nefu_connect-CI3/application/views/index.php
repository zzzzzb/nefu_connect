<!--时间友好转换开始-->
<?php
    header("Content-type: text/html; charset=utf8");
    date_default_timezone_set("Asia/Shanghai");   //设置时区
    function time_tran($the_time) {
        $now_time = date("Y-m-d H:i:s", time());
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
    <base href="<?php echo site_url();?>">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="assets/fonts/favicon.ico" type="assets/img/x-icon" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/publish.css">
    <title>测试平台</title>
</head>
<body>
<div id="index">
    <!--导航栏开始-->
    <div class="title navbar navbar-fixed-top">
        <div class="title-left" id="logo">
            <img src="assets/fonts/favicon.ico" alt="">
        </div>
        <div class="title-center" id="title">
            NfuConnect
        </div>
        <div class="title-right" >
            <?php
            if($is_login == 'yes'){
                $open_defalt = '<img id="open" src="assets/fonts/add.ico" alt="">';
            }else{
                $open_defalt = '<img id="to_login" src="assets/fonts/add.ico" alt="">';
            }
            echo $open_defalt;
            ?>
        </div>
    </div>
    <!--导航栏结束-->
    <!--内容主体开始-->
    <div class="content">
        <ul>
            <?php foreach($messages as $message){ ?>
            <li>
                <div class="wrapper">
                    <div class="content-header">
                        <div class="content-header-left">
                            <img src="<?php
                                if($message->is_anonymity) {
                                    if ($message->sex == '男') {
                                        echo 'assets/img/man2.jpg';
                                    } else {
                                        echo 'assets/img/woman2.jpg';
                                    }
                                }else {
                                    echo $message->portrait;
                                }
                            ?>" alt="">
                            <span>
                                <?php
                                    if($message->is_anonymity){
                                        echo "某同学·".$message->sex;
                                    }else{
                                        echo $message->realname;
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="content-header-right content-date"><?php
                                $posttime = $message->post_date;
                                echo time_tran($posttime);
                            ?></div>
                    </div>
                    <div class="content-middle">
                        <div class="middle-text"><?php echo $message->content;?></div>
                    </div>
                    <div class="content-footer">
                        <div class="content-footer-love">
                            <p class="content-footer-love-pic">
                                <img src="<?php
                                    $defalt = 'assets/fonts/love.ico';
                                    if($results) {
                                        foreach ($results as $result) {
                                            if ($message->msg_id == $result->msg_id) {
                                                $defalt = 'assets/fonts/love-2.ico';
                                                break;
                                            }
                                        }
                                    }
                                    echo $defalt;
                                ?>" alt="">
                                <input type="checkbox" value="<?php echo $message->msg_id;?>">
                            </p>
                            <span><?php echo $message->love_num;?></span>
                        </div>
                        <div class="content-footer-comment">
                            <a href="welcome/details?msg_id=<?php echo $message->msg_id;?>"><img src="assets/fonts/comment.ico" alt=""></a>
                            <span><?php echo $message->com_num;?></span>
                        </div>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!--内容主体结束-->
    <!--底部导航栏开始-->
    <footer class="footer">
        <div class="footer-left">
            <img src="assets/fonts/page-2.ico" alt="">
        </div>
        <div class="footer-right">
            <a href="welcome/user"><img src="assets/fonts/person-1.ico" alt=""></a>
        </div>
    </footer>
    <!--底部导航栏结束-->
</div>
<script src="assets/js/jquery-2.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/require.js" data-main="assets/js/index"></script>
</body>
</html>