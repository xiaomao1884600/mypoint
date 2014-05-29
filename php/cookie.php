<?php

/** PHP 如何清除COOKIE？ PHP无法删除COOKIE？设置COOKIE有效期、COOKIE过期 
	PHP 透明地支持 HTTP cookie,  cookie是一种在远程浏览器端存储数据并以此来跟踪和识别用户的机制。可以用
	setcookie() 或 setrawcookie()函数来设置cookie, cookie是HTTP标头的一部分，因此 setcookie()函数必须在
	其他信息被输出到浏览器前调用，这和对header()函数的限制类似。
	setcookie();
*/

//删除cookie的方法是把这个cookie的有效期设置为当前时间以前
setcookie('test', 'true', time() + 300); // 创建 cookie
//setcookie('test',<pre></pre>time() - 3600 );  // 清除建立的 cookie
//setcookie('test'); //只是将 $_COOKIE['test'] 的值清空
//如果直接setcookie('test', '');
echo '<pre>';
print_r($_COOKIE); //attay();
 
/**会发现$_COOKIE数组是空的，而非仅仅$_COOKIE['test'] 为空，于是winsock抓包，观察返回的
	http 头，竟然是：  set-cookie:test=deleted; expires=Mon, 29-May-2014 10:22:15 GMT
	
	
	php  cookie 无法删除/清除过期？
	
	登陆：
	setcookie('username', 'zhangsan', time()+1000, "/php100");
	
	退出：
	setcookie('username', '', time()-3600);
	
	发现做退出时 在IE下没问题，但是在Firefox中测试，登陆正常，无法退出，查看IE、Firefox中cookie记录的区别，经过测试
	才发现原来没有指定 setcookie()的第四个参数（合法路径参数），所以导致登陆和退出时所设置cookie的路径不同（Firefox比较严格，导致又重新建了各变量）
	
	参数详解：
	bool setcookie(string name[, string value[, int expire[, string path[, string domain[,bool secure]]]]]);
	
	参数        说明                                    举例
	
	 name       cookie的名字                 使用$_COOKIE['cookiename']调用名为 cookiename 的 cookie
	 
	 value      cookie的值，放在客户         假定name是 'cookiename'， 可以通过 $_COOKIE['cookiename']取值
				端，不要放敏感数据
				
	expire      cookie的过期时间，通常       time()+3600  设定1小时后失效
	            用time()加上秒数来设定
				cookie的失效期。或者用
				mktime()来实现
	
	
	path        cookie在服务器端的有效路径	  如果参数设定为 '/'的话，cookie就在整个 domain内有效；
	                                           如果设定为'/foo/', cookie就只在domain下的 /foo/目录及其子陌路有效，如/foo/bar/;
											   默认值为设定cookie的当前目录。
	
	domain      改 cookie有效的域名            要使 cookie能在如example.com域名下的所有子域名有效的话， 
                                               该参数应该设置为'.exaple.com'。
											   加上 '.'会兼容更多的浏览器；
											   如果参数设置为 www.example.com, 就只在www子域内有效
	
	secure      指明cookie是否仅通过安全的
	            HTTPS连接传送。
				当设置成 TRUE时，cookie仅在
				安全的连接中被设置，默认false
*/


$value = 'something';
setcookie('TestCookie', $value, time() + 3600);
setcookie('mytest', $value, time() + 3600, "~rasmus", ".maoge.com", 1);

if (isset($_COOKIE['TestCookie']))
{
	echo 'TestCookie :' . $_COOKIE['TestCookie'];
}


