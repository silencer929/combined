<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" media="screen">
	<link rel="stylesheet" type="text/css" href="css/correctiveaction.css">
</head>
<body>
<!-----------------------corrective action view on both laptop and tablet-->
<?php session_start(); 
if(isset($_GET["app_id"])){

}else{
	header("location:inspect.php");
}
?>
	<div class="corrective_action_wrapper">
		<a href="process.php?id=<?php echo $_SESSION['details']['application_id']?>"> <button id="end-evaluation"> submit</button></a>
	    <form class="add-action"  action="http://localhost:8080/cert/process.php" autocomplete="off" method="POST">
        <label></label>
	        <input type="text" value="" placeholder="collective action....." name="action" required>
	        <input type="text" value="" placeholder="comment....." name="comment" required>
	        <input type="hidden" name="app_id" value="<?php echo $_SESSION['details']['application_id']?>">
	        <input type="hidden" name="kefri_num" value="<?php echo $_SESSION['details']['kefri_num']?>">
	        <div class="corrective-action-btns">
	            <button type="submit" class="add-action-btn btn">add action</button>
	        </div>
	    </form>
	    <div class="corrective-action">
	        <table id="myTable">
	            <thead>
	                <tr>
	                    <th>id</th>
	                    <th>action</th>
	                    <th>comment</th>
	                    <th>edit</th>
	                    <th>delete</th>
	                </tr>
	            </thead>
	            <tbody>
	            </tbody>
	            <tfoot>
	                <tr>
	                    <th>id</th>
	                    <th>action</th>
	                    <th>comment</th>
	                    <th>edit</th>
	                    <th>delete</th>
	                </tr>
	            </tfoot>

	        </table>
	    </div>

	</div>
	<!-----------------------end of corrective action view on both laptop and tablet-->
	
	
	
	
<!-----------------------------------------	mobile view of the corrective-action -->
	<div class="content-wrapper">
		<a href="process.php?id=<?php echo $_SESSION['details']['application_id']?>"> <button id="end-evaluation"> submit</button></a>
        <form class="add-action"  action="http://localhost:8080/cert/process.php" autocomplete="off" method="POST">
        <label></label>
	        <input type="text" value="" placeholder="collective action....." name="action" required>
	        <input type="text" value="" placeholder="comment....." name="comment" required>
	        <div class="corrective-action-btns">
	            <button type="submit" class="add-action-btn btn">add action</button>
	        </div>
	    </form>
	    <div class="table2">
        
	    </div>
	</div>
	<!-----------------------------------------end of	mobile view of the corrective-action -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/main.js"?t=<?php echo time();?>></script>
	<script type="text/javascript" src="js/ajax.js"?t=<?php echo time();?>></script>
</body>
</html>