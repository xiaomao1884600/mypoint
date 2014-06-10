<?php

/** LDAP��ȫ����'������Ŀ¼����Э�飨Lightweight Directory Access Protocol��', ��һ�ּ򵥵�Ŀ¼Э�飬��νĿ¼����
	һ��ר�ŵ����ݿ⣬���������������κ�Ӧ�ó�������ҵӦ����ʹ�� LDAP ��������ҵ��Χ�ڵ�����Ӧ�ó��� LDAP Ŀ¼��
	��ȡ��Ϣ��Ӧ�ó������ ��������ֱ�Ӵ�LDAPĿ¼��ȡ��Ϣ�����������ڲ���ϵͳ������������͡�
*/

//���� LDAP ������  ldap_connect([string hostname [, int port]])

//$ldap_host = "ldap://192.168.3.1"; //LDAP ��������ַ
$ldap_host = "hxsddc.hxsd.local";
$ldap_port = "389"; //LDAP �������˿ں�
$ldap_user = "adread"; //�趨�������û���
$ldap_pwd = "Hxsdp@ssword"; //�趨����������
$ldap_conn = ldap_connect($ldap_host, $ldap_port) or die ("Can't connect to LDAP server");

//�� LDAP ��������ʹ���ض����û�������������½LDAP��������PHP�����ڰ�LDAP�������ĺ�����ldap_bind
// ldap_bind(ldap_conn [, string username [, string password]])

ldap_bind($ldap_conn, $ldap_user, $ldap_pwd) or die ("Can't bind to LDAP server");


//��ѯLDAPĿ¼����
/**
 ldap_search(ldap_conn, base_dn, conditions);
 ���� ldap_conn��ǰ�������LDAP�����������Ӷ���base_dn ��LDAP�������Ĳ�ѯ������conditions��
 ���� LDAPĿ¼��ѯ���õ��������ú�������һ��������󣬸ý�����󱣴��ѯ�������м�¼����������������
 ����ʹ��ldap_get_entries �������м򵥵Ķ�ȡ
 ldap_get_entries(ldap_conn, result)
 result ��ȫ���ѯLDAPĿ¼ʱ���صĶ��󡣸ú�������һ�����飬�������еĽ����¼
*/

$base_on = "DC=hxsd,DC=local"; //����Ҫ���в�ѯ��Ŀ¼����
$filter_col = "Value"; //�������ѯ����
$filter_val = "admin"; //��������ƥ���ֵ
$result = ldap_search($ldap_conn, $base_on, "($filter_col=$filter_val)"); //ִ�в�ѯ
$count = ldap_count_entries($ldap_conn, $result); //�����ѯ����еļ�¼��
echo "Total records count :" . $count; //�����ѯ����еļ�¼��

//�Ͽ�LDAP������
//ldap_unbind($ldap_conn);
ldap_unbind($ldap_conn) or die ("Can't unbind from LDAP server"); //��������Ͽ�����