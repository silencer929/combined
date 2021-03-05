<?php 
$con = mysqli_connect("localhost","root","","nurseries");
if (isset($_POST['upload'])) {
	$file = $_FILES['image']['name'];

	$query = "INSERT INTO nurseryimages(image) VALUES('$file')";

	$res = mysqli_query($con,$query);

	if ($res) {
		move_uploaded_file($_FILES['image']['tmp_name'], "nurseryimages/$file");
	} 
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>upload image</title>
	<link rel="stylesheet" type="text/css" href="
https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css
">
</head>
<body>
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<h3 class="text-center">Uplaod Image</h3>
					<form class="my-5" method="post" enctype="multipart/form-data">
						<input type="file" name="image" class="form-control">
						<input type="submit" name="upload" value="Upload" class="btn-success" my-3>
						
					</form>
				</div>
				<div class="col-md-6">
					<h3 class="text-center"> Display Image</h3>

					<?php
					$sel = "SELECT * FROM nurseryimages";
					$que = mysqli_query($con,$sel);

					$output ="";
					if (mysqli_num_rows($que) < 1) {
						$output .= "<h3 class='text-center'> No images uploaded</h3>";
					}
					while ($row = mysqli_fetch_array($que)) {
						$output .= "<img src='".$row["image"]."' class='my-3' style='width:400px; height:300px;'>";
					}

					?>
				</div>
			</div>
		</div>
	</div>

</body>
</html>