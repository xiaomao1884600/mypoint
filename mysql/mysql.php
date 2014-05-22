<?php

/**提高 mysql limit 查询的性能*/
/**
 * 1.offset 比较小的时候： 
 *  //多次运行，时间保持在0.0004-0.0005之间
 *  select * from table limit 10,10
 * 
 *  //多次运行，时间保持在0.0005-0.0006 之间，主要是0.0006 
 *	select * from table where id >= (select id from table order by id limit 10,1) limit 10
 * 
 * 结论：偏移offset较小的时候，直接使用limit较优，这个显然是子查询的原因
 *
 * 2. offset 较大的时候：
 *  // 多次运行，时间保持在0.0187左右
 *  select * from table limit 10000, 10
 *  
 *  // 多次运行，时间保持在0.00061左右，只有前者的1/3。 可以预计offset越大，后者越优
 *   select * from table where id >= (select id from table order by id limit 10000,1) limit 10
 *
 */
 
 
 /** 查询效率 */
//   SELECT * FROM `studentconsultanthistory` AS history where history.category = 1 UNION ALL SELECT * FROM 	  	`studentconsultanthistory` AS history where history.category = 2;

// SELECT * FROM `studentconsultanthistory` AS history where history.category in (1,2)

/** 创建索引*/
/**
 * 1.创建主键索引
 *  alter table table_name add constrain index_name primark key (col1);
 * 2.创建唯一索引
 *  create unique index uk_name on table_name(col2);
 * 3.创建普通索引
 *  create index index_name on table_name(col3);
 *
 */
 
 /*
 所以要想查询速度变快，我们需要将limit第一个参数尽量变小
 然后开始说我们的那种比较好的查询方法
正常情况下页面会给我们传page，有时也有perPage，这次我们要加上三个参数currentPage,big,small //当前页，当前页最大主键id，当前页最小主键id
currentPage就是当前页，page是我们想要跳转到的页，然后每次查询出这个页面的数据后，比如我查出10条数据，big是10条数据里的uid最大值，small是最小值
我通常是每次查出数据后用foreach取出这一页id列表，用max，min取最大最小值
foreach($data as v){
$uids[] = $v['uid'];
}
取出主键uid列表后求最大最小值
$big = max($uids);
$small = min($uids);
我们接收到page,currentPage,big,small后
判断page和currentPage的关系
 
if page>currentPage
 select* fromuserwhereuid > big orderbyuid asclimit (page - currentPage - 1)*perpage,perpage;
if page<currentPage
select* fromuserwhereuid < small orderbyuid desclimit (currentPage - page - 1)*perpage,perpage;
也可以用(abs(page-currentPage)-1) * perpage来计算offset
这样的话如果用户访问的两个page差不是很大，offset会非常小，所以查询速度会很快，当然，需要注意下查询出来的数据内容排序问题，拿这里面的例子说，就是第2条sql查出的数据需要倒序下输出到页面。
 */