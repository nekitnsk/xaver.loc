<?php


// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}


if(!is_dir('../files/images/house/' . $_POST['file_name'])){
		mkdir('../files/images/house/' . $_POST['file_name'], 0777);

	}


if(move_uploaded_file($_FILES['upl']['tmp_name'], '../files/images/house/'. $_POST['file_name'] . '/'. $_POST['file_name'] . time() .'.'. $extension )){
	
	$file_data = '<input id='.$_POST['file_name'].' type="radio" name="credit-card" value='.$_POST['file_name'].' /><label class="drinkcard-cc" style="background-image:url("../files/images/house/'.$_POST['file_name'].time().'.'. $extension .');" for="visa"></label>' ;
	
	echo '{"status":"success", "file": "'.$file_data.'"}';

	exit;
}

}

echo '{"status":"error"}';
exit;

?>

<script type="text/javascript">





</script>