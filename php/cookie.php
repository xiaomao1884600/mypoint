<?php

/** PHP ������COOKIE�� PHP�޷�ɾ��COOKIE������COOKIE��Ч�ڡ�COOKIE���� 
	PHP ͸����֧�� HTTP cookie,  cookie��һ����Զ��������˴洢���ݲ��Դ������ٺ�ʶ���û��Ļ��ơ�������
	setcookie() �� setrawcookie()����������cookie, cookie��HTTP��ͷ��һ���֣���� setcookie()����������
	������Ϣ������������ǰ���ã���Ͷ�header()�������������ơ�
	setcookie();
*/

//ɾ��cookie�ķ����ǰ����cookie����Ч������Ϊ��ǰʱ����ǰ
setcookie('test', 'true', time() + 300); // ���� cookie
//setcookie('test',<pre></pre>time() - 3600 );  // ��������� cookie
//setcookie('test'); //ֻ�ǽ� $_COOKIE['test'] ��ֵ���
//���ֱ��setcookie('test', '');
echo '<pre>';
print_r($_COOKIE); //attay();
 
/**�ᷢ��$_COOKIE�����ǿյģ����ǽ���$_COOKIE['test'] Ϊ�գ�����winsockץ�����۲췵�ص�
	http ͷ����Ȼ�ǣ�  set-cookie:test=deleted; expires=Mon, 29-May-2014 10:22:15 GMT
	
	
	php  cookie �޷�ɾ��/������ڣ�
	
	��½��
	setcookie('username', 'zhangsan', time()+1000, "/php100");
	
	�˳���
	setcookie('username', '', time()-3600);
	
	�������˳�ʱ ��IE��û���⣬������Firefox�в��ԣ���½�������޷��˳����鿴IE��Firefox��cookie��¼�����𣬾�������
	�ŷ���ԭ��û��ָ�� setcookie()�ĵ��ĸ��������Ϸ�·�������������Ե��µ�½���˳�ʱ������cookie��·����ͬ��Firefox�Ƚ��ϸ񣬵��������½��˸�������
	
	������⣺
	bool setcookie(string name[, string value[, int expire[, string path[, string domain[,bool secure]]]]]);
	
	����        ˵��                                    ����
	
	 name       cookie������                 ʹ��$_COOKIE['cookiename']������Ϊ cookiename �� cookie
	 
	 value      cookie��ֵ�����ڿͻ�         �ٶ�name�� 'cookiename'�� ����ͨ�� $_COOKIE['cookiename']ȡֵ
				�ˣ���Ҫ����������
				
	expire      cookie�Ĺ���ʱ�䣬ͨ��       time()+3600  �趨1Сʱ��ʧЧ
	            ��time()�����������趨
				cookie��ʧЧ�ڡ�������
				mktime()��ʵ��
	
	
	path        cookie�ڷ������˵���Ч·��	  ��������趨Ϊ '/'�Ļ���cookie�������� domain����Ч��
	                                           ����趨Ϊ'/foo/', cookie��ֻ��domain�µ� /foo/Ŀ¼������İ·��Ч����/foo/bar/;
											   Ĭ��ֵΪ�趨cookie�ĵ�ǰĿ¼��
	
	domain      �� cookie��Ч������            Ҫʹ cookie������example.com�����µ�������������Ч�Ļ��� 
                                               �ò���Ӧ������Ϊ'.exaple.com'��
											   ���� '.'����ݸ�����������
											   �����������Ϊ www.example.com, ��ֻ��www��������Ч
	
	secure      ָ��cookie�Ƿ��ͨ����ȫ��
	            HTTPS���Ӵ��͡�
				�����ó� TRUEʱ��cookie����
				��ȫ�������б����ã�Ĭ��false
*/


$value = 'something';
setcookie('TestCookie', $value, time() + 3600);
setcookie('mytest', $value, time() + 3600, "~rasmus", ".maoge.com", 1);

if (isset($_COOKIE['TestCookie']))
{
	echo 'TestCookie :' . $_COOKIE['TestCookie'];
}


