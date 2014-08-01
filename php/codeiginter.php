<?php


/** 
	PHP CodeIgniter2.1向数据库插入数据时报错Undefined property: User::$db (2012-03-26 17:41:47)转载▼
标签： php codeigniter userdb it	分类： PHP
A PHP Error was encountered
Severity: Notice
Message: Undefined property: User::$db
Filename: core/Model.php
Line Number: 51

解决方法有两种：

第一种：在你的Model类的构造方法中，加入 $this->load->database();   如下：
     public function MUser(){
         parent::__construct();
         $this->load->database();
     }
第二种方法：修改application\config\autoload.php文件，如下：
    将 $autoload['libraries'] = array();
    改为：  $autoload['libraries'] = array('database');

*/