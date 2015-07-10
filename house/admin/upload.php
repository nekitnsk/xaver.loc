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

$folder = $_POST['file_name'];
$file_name = $_POST['file_name'].'-'.mt_rand(1, 1000).'.'. $extension;

if(move_uploaded_file($_FILES['upl']['tmp_name'], '../files/images/house/'. $folder . '/'. $file_name )){
	
	$file_data = '<input id="'.$file_name.'" type="radio" name="'.$folder.'" value="'.$file_name.'" /><label class="house-cc" style="background-image:url(../files/images/house/'.$folder.'/'.$file_name.');" for="'.$file_name.'"></label>' ;
	$res['status']='sucess';
	$res['file_data']=$file_data;
	echo json_encode($res); 
	exit;
}

}

echo '{"status":"error"}';
exit;

?>

<script type="text/javascript">





</script>