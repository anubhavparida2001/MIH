<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false) {
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
    }
}

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "connection.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		if ($img_size > 1250000000) {
			$em = "Sorry, your file is too large.";
		    header("Location: imagei.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "UPDATE usertable SET image_url ='$new_img_name' WHERE email ='$email'";
				mysqli_query($con, $sql);
				header("Location: view.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: imagei.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: imagei.php?error=$em");
	}

}else {
	header("Location: imagei.php");
}