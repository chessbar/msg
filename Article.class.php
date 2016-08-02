<?php
  class Article{
  	public $db;
  	public function __construct(){
  		$this->db=include './db/db.php';
  	}
	public function index(){
		$data=include './db/db.php';
		if(isset($_POST) && !empty($_POST)){

				$pre=current($data);
				$msg_id=$pre['msg_id']?$pre['msg_id']+1:1;
				$newMsg=array(
							'msg_id'=>$msg_id,
							'msger'=>htmlspecialchars($_POST['msger']),
							'msger_head'=>mt_rand(1,5),
							'msg_content'=>htmlspecialchars($_POST['msg_content']),
							'msg_up'=>0,
							'msg_down'=>0,
							'msg_time'=>time(),
							'msg_reply'=>array(),
					);
				array_unshift($data, $newMsg);
			    add($data);
			}
		include "./template/index.html";
	}
	public function detail(){
		$data=include './db/db.php';
      if(isset($_GET['m_id']) && !empty($_GET['m_id'])){
			$id=$_GET['m_id'];
			$k=getKey($id,'msg_id',$data);
			$msg=$data[$k];
			$reply=$msg['msg_reply'];
		}else{
			header("Location: http://localhost/msg/index.php");
		}
		if(isset($_POST) && !empty($_POST)){
			$pid=(int)$_POST['pid'];
			$k=getKey($pid,'msg_id',$data);
			$p_msg=$data[$k];
		//p($p_msg);
			$newReply=array(
						'msg_id'=>count($p_msg['msg_reply'])+1,
						'msger'=>htmlspecialchars($_POST['msger']),
						'msger_head'=>mt_rand(1,5),
						'msg_content'=>htmlspecialchars($_POST['msg_content']),
				);
			/*$newData[]=$newMsg;
			$newData=array_merge($newData,$data);*/
			array_push($p_msg['msg_reply'],  $newReply);
			$data[$k]=$p_msg;
			$reply=$p_msg['msg_reply'];
			$newData=$data;
		    add($newData);
		}
		include "./template/detail.html";
	}
	public function up(){
		$data=include './db/db.php';
		if(isset($_GET['uid']) && !empty($_GET['uid'])){
			$mid=$_GET['uid'];
			$k=getKey($mid,'msg_id',$data);
			$data[$k]['msg_up']+=1;
			$re['status']=1;
			$re['num']=$data[$k]['msg_up'];
			add($data);
			exit(json_encode($re));
			
		}
	}
	public function down(){
		$data=include './db/db.php';
		if(isset($_GET['did']) && !empty($_GET['did'])){
			$mid=$_GET['did'];
			$k=getKey($mid,'msg_id',$data);
			$data[$k]['msg_down']+=1;
			$re['status']=1;
			$re['num']=$data[$k]['msg_down'];
			add($data);
			exit(json_encode($re));
		}
	}
	public function del(){
		$data=include './db/db.php';
		if(isset($_GET['del_id']) && !empty($_GET['del_id'])){
			$mid=(int)$_GET['del_id'];
			$k=getKey($mid,'msg_id',$data);
			unset($data[$k]);
			$re['status']=1;
			add($data);
			exit(json_encode($re));
		}

	}
	public function edit(){
			$data=include './db/db.php';
      if(isset($_GET['m_id']) && !empty($_GET['m_id'])){
			$id=$_GET['m_id'];
			$k=getKey($id,'msg_id',$data);
			$msg=$data[$k];
			$reply=$msg['msg_reply'];
		}else{
			header("Location: http://localhost/msg/index.php");
		}
		if(isset($_POST) && !empty($_POST)){
			$pid=(int)$_POST['pid'];
			$k=getKey($pid,'msg_id',$data);
			$data[$k]['msger']=htmlspecialchars($_POST['msger']);
			$data[$k]['msg_content']=htmlspecialchars($_POST['msg_content']);
			$newData=$data;
		    add($newData);
		    header("Location: http://localhost/msg_oop/index.php");
		}

		include "./template/edit.html";
	}
}
?>