<?php

/** ��ν��������������ļ������������� 
	����chrome���������  Mozilla/5.0 (Windows; U; Windows NT 6.1; tr-TR) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27
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
	header("Content-Disposition: attachment;filename='������.xls'");
	header("Content-Transfer-Encoding: binary");
}

*/

//һ��������Ҫ�ж�������������������������ļ���

$ua = $_SERVER['HTTP_USER_AGENT'];
$filename = '������.xls';
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

print '<table width="800" border="1"><tr><th>���</th><th>����</th><th>����</th></tr><tr><td>1</td><td>�����������������ļ�����������</td><td>�༭</td></tr></table>';