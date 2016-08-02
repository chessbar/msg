<?php
header('Content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
 function p($a){
 	echo'<pre>';
 	print_r($a);
 }
 //
 function add($data){
 	$newData=var_export($data,true);
$newData=<<<str
<?php
	return $newData;
?>
str;
	file_put_contents('./db/db.php', $newData);
 }
 function getKey($value,$value_name,$arr){
	foreach ($arr as $k => $v) {
		if($v[$value_name]==$value){
			return $k;
		}
	}
}
?>
