<?php
//php下载功能
header('Content-Type: text/html;charset=utf-8');
if (!isset($_GET['file']) || !isset($_GET['type']))
{
	print 'no file select';
	exit();
}
$file = $_GET['file'] . '.' . $_GET['type'];
//print_r($file);
//iconv('UTF-8','GB2312','测试手册.doc')   将字符串按要求的字符编码来转换
//mb_convert_encoding('测试手册.doc', 'GB2312', 'UTF-8')  转换字符的编码
//@ 该符号错误控制运算符前缀
if (@$fp = fopen($file, 'r'))
{
	header('content-type: octet/stream');
	if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
	{
		header('Content-Disposition: filename=' . mb_convert_encoding('wwj测试手册.doc', 'GB2312', 'UTF-8'));
	}
	else
	{
		header('Content-Disposition: filename=' . mb_convert_encoding('测试手册.doc', 'GB2312', 'UTF-8'));
	}
	while(!@feof($fp))
	{
		echo fread($fp, 1024);
	}
	exit();
	
}
else
{
	print '此文件不存在';
}
