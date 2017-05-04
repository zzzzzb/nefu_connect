<!doctype html>
<html lang="zh-CN" id="index">
<head>
    <base href="<?php echo site_url();?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="format-detection" content="telephone=no, email=no" />
    <title>PhotoClip</title>
    <style>
        body {
            margin: 0;
            text-align: center;
        }
        #clipArea {
            height: 300px;
        }
        #file,
        #clipBtn {
            margin: 20px;
        }
        #view {
            margin: 0 auto;
            width: 200px;
            height: 200px;
            background-color: #666;
        }
    </style>
</head>
<body ontouchstart="">
<div id="clipArea"></div>
<input type="file" id="file">
<button id="clipBtn">截取</button>
<div id="view"></div>

<script src="assets/js/iscroll-zoom.js"></script>
<script src="assets/js/hammer.min.js"></script>
<script src="assets/js/lrz.all.bundle.js"></script>
<script src="assets/js/PhotoClip.js"></script>
<script>
    var pc = new PhotoClip('#clipArea', {
        size: 260,
        outputSize: 640,
//		adaptive: ['60%', '80%'],
        file: '#file',
        view: '#view',
        ok: '#clipBtn',
        loadStart: function() {
            console.log('开始读取照片');
        },
        loadComplete: function() {
            console.log('照片读取完成');
        },
        done: function(dataURL) {
            console.log(dataURL);
        },
        fail: function(msg) {
            alert(msg);
        }
    });
</script>

</body>
</html>