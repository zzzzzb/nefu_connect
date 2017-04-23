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
    <title>campusInfo</title>
</head>
<body>
<div id="index">
    <div class="title navbar navbar-fixed-top">
        <div class="title-left" id="logo">
            <img src="assets/fonts/favicon.ico" alt="">
        </div>
        <div class="title-center" id="title">
            campus
        </div>
        <div class="title-right" id="open">
            <img src="assets/fonts/add.ico" alt="">
        </div>
    </div>
    <div class="content">
        <ul>
            <?php foreach($messages as $message){ ?>
            <li>
                <div class="wrapper">
                    <div class="content-header">
                        <div class="content-header-left">
                            <img src="<?php
                                if($message->is_anonymity){
                                    echo 'assets/img/man2.jpg';
                                }else{
                                    echo $message->portrait;
                                }
                            ?>" alt="">
                            <span>
                                <?php
                                if($message->is_anonymity){
                                    echo "某同学·".$message->sex;
                                }else{
                                    echo $message->username;
                                }
                                ?>
                            </span>
                        </div>
                        <div class="content-header-right"><?php echo $message->post_date;?></div>
                    </div>
                    <div class="content-middle">
                        <div class="middle-text"><?php echo $message->content;?></div>
                    </div>
                    <div class="content-footer">
                        <div class="content-footer-love">
                            <a href="javascript:;"><img src="assets/fonts/love.ico" alt=""></a>
                            <span><?php echo $message->love_num;?></span>
                        </div>
                        <div class="content-footer-comment">
                            <a href="javascript:;"><img src="assets/fonts/comment.ico" alt=""></a>
                            <span><?php echo $message->com_num;?></span>
                        </div>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <footer class="footer">
        <div class="footer-left">
            <img src="assets/fonts/page-2.ico" alt="">
        </div>
        <div class="footer-right">
            <a href="welcome/user"><img src="assets/fonts/person-1.ico" alt=""></a>
        </div>
    </footer>
</div>
<script src="assets/js/jquery-2.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/require.js" data-main="assets/js/index"></script>
</body>
</html>