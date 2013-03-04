<?php

$near_users = array(
	array('id'=>1, 'name'=>'xuanxuan', 'coor'=>array('x'=>1.2907523, 'y'=>103.7820889),'status'=>'hello world'),
	array('id'=>2, 'name'=>'qiqi', 'coor'=>array('x'=>1.2937323, 'y'=>103.7820829),'status'=>'what a big world'),
	array('id'=>3, 'name'=>'peggy', 'coor'=>array('x'=>1.2951384,'y'=>103.7737209),'status'=>'I love peggy too')
	);

echo json_encode($near_users);

?>