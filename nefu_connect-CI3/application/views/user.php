<?php $loginedUser=$this->session->userdata('loginedUser') ;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo site_url();?>">
    <meta charset="UTF-8">
    <title>campusInfo</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="assets/fonts/favicon.ico" type="assets/img/x-icon" />
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div id="index">
    <header class="user-header">
        <a href="welcome/exit_login"><span class="user-more glyphicon glyphicon-option-horizontal"></span></a>
        <div class="user-photo">
            <img src="<?php echo $loginedUser->portrait;?>" alt="username">
            <div><?php echo $loginedUser->username;?></div>
        </div>
        <div class="user-info">
            <div class="user-info-left">
                <span>帖子</span>
                <span class="number">
                    <?php foreach ($msg_counts as $msg_count){?><?php echo $msg_count->num;?><?php }?>
                </span>
            </div>
            <div class="user-info-right">
                <span>回复</span>
                <span class="number">
                    <?php foreach ($com_counts as $com_count){?><?php echo $com_count->num;?><?php }?>
                </span>
            </div>
        </div>
    </header>
    <div class="user-content">
        <div class="user-content-title">
            nfuconnect服务
        </div>
        <div class="user-content-item">
            <ul>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-music"></p><br/>
                        <span>123</span>
                    </div>
                 </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-glass"></p><br/>
                        <span>123</span>
                    </div>
                </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-pencil"></p><br/>
                        <span>123</span>
                    </div>
                </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-search"></p><br/>
                        <span>123</span>
                    </div>
                </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-time"></p><br/>
                        <span>123</span>
                    </div>
                </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-headphones"></p><br/>
                        <span>123</span>
                    </div>
                </li>
                <li class="col-xs-6 col-sm-4">
                    <div>
                        <p class="glyphicon glyphicon-book"></p><br/>
                        <span>123</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-left">
            <a href="welcome/index"><img src="assets/fonts/page-1.ico" alt=""></a>
        </div>
        <div class="footer-right">
            <img src="assets/fonts/person-2.ico" alt="">
        </div>
    </footer>
</div>
<script src="assets/js/jquery-2.1.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>