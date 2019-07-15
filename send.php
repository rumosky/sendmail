<?php
/*
 * @Email: rumosky@163.com
 * @Author: rumosky
 * @Github: https://github.com/rumosky
 * @Date: 2019-06-01 14:40:54
 * @LastEditors: rumosky
 * @LastEditTime: 2019-06-24 15:25:12
 */
header("content-type: text/html; charset = utf8");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';
error_reporting(E_ALL ^ E_NOTICE);
$mail = new PHPMailer(true);
$mail->CharSet = "UTF-8";
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.qq.com';        //填写SMTP服务器地址        
$mail->SMTPAuth = true;
$mail->Username = 'xxxx@qq.com';        //填写邮箱地址
$mail->Password = 'xxxxxx';             //填写邮箱密码或授权码
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('xxxx@qq.com', 'xxxx');      //发件人信息
$mail->addAddress($_POST['receiver'], $_POST['receiver']);   //收件人信息
$mail->addReplyTo('xxxx@qq.com', 'xxxx');       //回复地址
$mail->isHTML(true);
$mail->Subject = $_POST['title'];       //邮件标题
$mail->Body    = $_POST['content'];     //邮件正文
$mail->AltBody = '对不起，您的邮件客户端不支持HTML内容预览，请联系发件人';

if (!$mail->send()) {
    echo json_encode(array('status' => 'error', 'message' => $mail->ErrorInfo), true);
    die();
} else {
    echo json_encode(array('status' => 'success', 'message' => '邮件发送成功'), true);
    die();
}
