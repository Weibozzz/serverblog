<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理修改页面</title>

    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.bootcss.com/animate.css/3.5.2/animate.css">
    <link rel="stylesheet" href="editor/css/wangEditor.min.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <!--引入html5shiv.js 和 respond.js 是IE8支持HTML5新标签和媒体查询-->

    <!--    网页加载进度条-->
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
</head>
<body>
<?php

//模态框
include_once "./tpl/modal.php";
//导航条-
include_once "./tpl/header.php";
?>
<?php
include_once "./api/dbConnect.php";
//根据传入的id从数据库获取相应文章的信息
$id = $_REQUEST['id'];
$sql = "select * from article2 where id=$id";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

//对文章内容进行一次urldecode()解密

$row['content'] = urldecode($row['content']);
//将时间戳转化成时间日期格式
date_default_timezone_set('prc');
$row['createTime'] = date("Y-m-d H:i",$row['createTime']);
//$row -->id , user ,title,content,url,visitor,like,createTime
?>
<h2 class="page-header text-center" style="margin-top: 100px">后台管理系统</h2>
<div class="container col-sm-8 col-sm-offset-2">
    <?php
    echo <<<tagName1
    <form action="" method="post" class="form-horizontal">
                    <!--文章标题-->
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" placeholder="文章标题" value="{$row['title']}">
                        </div>
		     <!-- 文章分类-->
                       <div class="form-group">
                            <div class="col-sm-2">
                                <select class="form-control" name="articleType"  id="">
                                    <option value="0">文章类型</option>
                                    <option value="h5">html</option>
                                    <option value="css">css</option>
                                    <option value="js">javascript</option>
                                    <option value="php">php</option>
                                    <option value="mysql">mysql</option>
                                    <option value="server">服务器</option>
                                    <option value="others">其他</option>
                                    <option value="interesting">生活搞笑</option>
                                    <option value="fight">激励向上</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--原文url链接地址-->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="url" placeholder="原文的URL链接地址" value="{$row['url']}">
                        </div>
                    </div>
                    <!--原文其他信息-->
                    <div class="form-group">
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="id" readonly  placeholder="原文的id" value="{$row['id']}">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="user" readonly placeholder="原文的user" value="{$row['user']}">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="createTime" readonly placeholder="原文的createTime" value="{$row['createTime']}">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="visitor" readonly placeholder="原文的visitor" value="{$row['visitor']}">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="like" readonly placeholder="原文的like" value="{$row['like']}">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="img" readonly placeholder="原文的img" value="{$row['img']}">
                        </div>
                    </div>
                    <!--原文文章简介-->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="short" placeholder="原文文章简介" value="{$row['short']}">
                        </div>
                    </div>
                    <!--文章内容在线编辑器-->
                    <div class="form-group">
                        <div class="col-sm-12">
                            <!--将id为editor的div变成在线编辑器-->
                            <div id="editor" style="min-height: 500px;">
                                {$row['content']}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success pull-right" type="submit" id="submit">修改文章</button>
                        </div>
                    </div>
                </form>
tagName1
    ?>
</div>

<!--回到顶部-->
<div class="fixtop "><span class="glyphicon glyphicon-chevron-up"></span></div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="./editor/js/wangEditor.min.js"></script>




<script src="js/min/common.min.js"></script>

<!--在线编辑器初始化-->
<script src="./js/min/editorInit.min.js"></script>
<script src="./js/min/adminUpdateArticle.min.js"></script>
<script>
    $("#editor").on('blur',function () {
        $("#submit").click();
    })
</script>
<script>
    NProgress.start();
    NProgress.done();
</script>
</body>
</html>