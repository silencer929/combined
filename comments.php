<?php
/**
 * 
 */
class Comments
{
	
	function __construct()
	{

	}
	public function insert_into_database($conn,$data)
	{
		$arr=[
			"action"=>$data['action'],
			"comment"=>$data['comment'],
			"app_id"=>$data['app_id'],
			"kefri_num"=>$data['kefri_num']
		];
		$query="INSERT INTO corrective_action(action,comment,app_id,kefri_num) values (:action,:comment,:app_id,:kefri_num)";
		$conn->execQuery($query,$arr);
	}
	public function get_comments($conn,$app_id):array
	{
		$query="SELECT * FROM corrective_action where corrective_action.app_id='$app_id'";
		$conn->execQuery($query,[]);
		$conn->load_data();
		return $conn->data;
	}
}
?>