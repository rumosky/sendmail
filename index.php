<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sendmails</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</head>

<body>
    <div class="main">
        <div class="introduce">
            Make it easier to send emails
        </div>
        <div class="abstract">
            后端使用phpmailer封装、前端使用bootstrap、jQuery，编辑器采用wangeditor
        </div>
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">开始编辑邮件内容</button>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" action="" method="post">
                        <div class="modal-header">
                            <div class="form-group">
                                <label for="name">标题</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="请输入标题">
                                <br>
                                <label for="name">收件人</label>
                                <input type="email" class="form-control" id="receiver" name="receiver" placeholder="请输入正确的邮件地址">
                            </div>
                        </div>
                        <div class="modal-body" id="editor" name="content">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="button" id="senMail" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="./js/wangEditor.min.js"></script>
    <script type="text/javascript" src="./js/wangEditor.js"></script>
    <script>
        $(document).ready(function() {
            var E = window.wangEditor
            var editor = new E('#editor')
            editor.customConfig.menus = [
                'head', // 标题
                'bold', // 粗体
                'fontSize', // 字号
                'fontName', // 字体
                'italic', // 斜体
                'underline', // 下划线
                'strikeThrough', // 删除线
                'foreColor', // 文字颜色
                'backColor', // 背景颜色
                'link', // 插入链接
                'list', // 列表
                'justify', // 对齐方式
                'quote', // 引用
                'emoticon', // 表情
                'image', // 插入图片
                'table', // 表格
                'video', // 插入视频
                'code', // 插入代码
                'undo', // 撤销
                'redo' // 重复
            ];
            editor.create();

            /**
             * [点击发送邮件]
             */
            $('#senMail').click(function() {
                $(this).attr("disabled", "true"); //只能点击一次
                var content = editor.txt.html(); //获取邮件内容
                var title = $('#title').val(); //获取邮件标题
                var receiver = $('#receiver').val(); //获取收件人地址
                //Ajax POST发送
                $.ajax({
                    type: 'post',
                    url: 'send.php',
                    data: {
                        content: content,
                        title: title,
                        receiver: receiver
                    },
                    dataType: "json",
                    success: function(res) {
                        alert(res.message);
                        setTimeout(function() {
                            location.reload()
                        }, 500); //发送成功后点击确定0.5秒内刷新页面
                    },
                    error: function() {
                        console.log('请求失败');
                    }
                })
            })
        })
    </script>
</body>

</html>