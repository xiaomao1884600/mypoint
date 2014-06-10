<?php

/** LDAP的全称是'轻量级目录访问协议（Lightweight Directory Access Protocol）', 是一种简单的目录协议，所谓目录，是
	一种专门的数据库，可以用来服务于任何应用程序，在企业应用中使用 LDAP 可以让企业范围内的所有应用程序 LDAP 目录中
	获取信息，应用程序可以 从网络上直接从LDAP目录获取信息，而不局限于操作系统与服务器的类型。
*/

//连接 LDAP 服务器  ldap_connect([string hostname [, int port]])

//$ldap_host = "ldap://192.168.3.1"; //LDAP 服务器地址
$ldap_host = "hxsddc.hxsd.local";
$ldap_port = "389"; //LDAP 服务器端口号
$ldap_user = "adread"; //设定服务器用户名
$ldap_pwd = "Hxsdp@ssword"; //设定服务器密码
$ldap_conn = ldap_connect($ldap_host, $ldap_port) or die ("Can't connect to LDAP server");

//绑定 LDAP 服务器：使用特定的用户名或密码来登陆LDAP服务器，PHP中用于绑定LDAP服务器的函数是ldap_bind
// ldap_bind(ldap_conn [, string username [, string password]])

ldap_bind($ldap_conn, $ldap_user, $ldap_pwd) or die ("Can't bind to LDAP server");


//查询LDAP目录内容
/**
 ldap_search(ldap_conn, base_dn, conditions);
 其中 ldap_conn是前面的连接LDAP服务器的连接对象，base_dn 是LDAP服务器的查询主键，conditions是
 用于 LDAP目录查询所用的条件，该函数返回一个结果对象，该结果对象保存查询到的所有记录。对于这个结果对象，
 可以使用ldap_get_entries 函数进行简单的读取
 ldap_get_entries(ldap_conn, result)
 result 是全面查询LDAP目录时返回的对象。该函数返回一个数组，包含所有的结果记录
*/

$base_on = "DC=hxsd,DC=local"; //定义要进行查询的目录主键
$filter_col = "Value"; //定义与查询的列
$filter_val = "admin"; //定义用于匹配的值
$result = ldap_search($ldap_conn, $base_on, "($filter_col=$filter_val)"); //执行查询
$count = ldap_count_entries($ldap_conn, $result); //计算查询结果中的记录数
echo "Total records count :" . $count; //输出查询结果中的记录数

//断开LDAP服务器
//ldap_unbind($ldap_conn);
ldap_unbind($ldap_conn) or die ("Can't unbind from LDAP server"); //与服务器断开连接