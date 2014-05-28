<?php

/** 如何解决多浏览器下载文件中文名称乱码 
	例如chrome浏览器类型  Mozilla/5.0 (Windows; U; Windows NT 6.1; tr-TR) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27
*/

/*
private function set_headers()
{
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revallidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
	header("Content-Type:application/download");
	header("Content-Disposition: attachment;filename='中文名.xls'");
	header("Content-Transfer-Encoding: binary");
}

*/

//一般我们需要判断浏览器类型来处理中文名称文件名

$ua = $_SERVER['HTTP_USER_AGENT'];
$filename = '中文名.xls';
$encoded_filename = urlencode($filename);
$encoded_filename = str_replace('+', '%20', $encoded_filename);
header('Content-Type: application/octet-stream');
if (preg_match("/MSIE/", $ua))
{
	header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
}
else if (preg_match("/Firefox/", $ua))
{
	header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
}
else
{
	header('Content-Disposition: attachment; filename="' . $filename .'"');
}

print '<table width="800" border="1"><tr><th>序号</th><th>标题</th><th>操作</th></tr><tr><td>1</td><td>解决浏览器保存中文文件名乱码问题</td><td>编辑</td></tr></table>';