<?php

function uploadUserImageProfile () {
	if(is_array($_FILES)) {
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
			$json = array('error' => '');
			$uploadOk = 1;
			$sourcePath = $_FILES['userImage']['tmp_name'];
			$avatar_path = "assets/images/users/avatar/";
			$file_name = time() . '_' . basename($_FILES['userImage']['name']);
			$targetPath = $avatar_path . $file_name;
			$imageFileType = pathinfo($targetPath,PATHINFO_EXTENSION);
			// Allow certain file formats
			if(
				strtolower($imageFileType) != "jpg" &&
				strtolower($imageFileType) != "png" && 
				strtolower($imageFileType) != "jpeg" && 
				strtolower($imageFileType) != "gif"
			){
				$uploadOk = 0;
				$json['error'] = 'Only image file are allowed';
			}
			 // Check file size
			if ($_FILES["userImage"]["size"] > 5000000) {
				$uploadOk = 0;
		
			    $json['error'] = 'File too large';
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$json['error'] = 'Sorry, your image was not uploaded';
			}
			else {
				if(move_uploaded_file($sourcePath,$targetPath)) {
					fix_orientation($targetPath);

					$userid = $_POST['userid'];
					$users = db::table('users');
					$update = $users->where('id', '=', $userid)->update(array(
						'image' => $file_name
					));
				}
			}
		}
	}
}

function uploadPetImageProfile () {
	$pet_ID = 0;

	if(is_array($_FILES)) {
		if(is_uploaded_file($_FILES['petImage']['tmp_name'])) {
			$json = array('error' => '');
			$uploadOk = 1;
			$sourcePath = $_FILES['petImage']['tmp_name'];
			$avatar_path =  "assets/images/pets/";
			$file_name = time() . '_' . basename($_FILES['petImage']['name']);
			$targetPath = $avatar_path . $file_name;
			$imageFileType = pathinfo($targetPath,PATHINFO_EXTENSION);
			// Allow certain file formats
			if(
				strtolower($imageFileType) != "jpg" &&
				strtolower($imageFileType) != "png" && 
				strtolower($imageFileType) != "jpeg" && 
				strtolower($imageFileType) != "gif"
			){
				$uploadOk = 0;
				$json['error'] = 'Only image file are allowed';
			} 
			// Check file size
			if ($_FILES["petImage"]["size"] > 5000000) {
				$uploadOk = 0;
			    $json['error'] = 'File too large';
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$json['error'] = 'Sorry, your image was not uploaded';
			}
			else {

				if(move_uploaded_file($sourcePath,$targetPath)) {
					fix_orientation($targetPath);

					$ppetid = $_GET['ppetid'];
					$pets = db::table('pets');
					$update = $pets->where('id', '=', $ppetid)->update(array(
						'image' => $file_name
					));

					$pet_ID = $ppetid;

				}
			}
		}
	}
	
	return getPetInfo($pet_ID);
}

function changeuserinfo () {

	$users = db::table('users');

	$update = $users->where('id', '=', $_POST['userid'])->update(array(
		'firstname' => $_POST['firstname'],
		'lastname' => $_POST['lastname'],
		'postcode' => $_POST['postcode'],
		'email' => $_POST['email']
	));

	$user = $users->where(array('id' => $_POST['userid']))->first();

	return array(
		'user' => $user,
 		'html' => snippet('userprofile', compact('user'), true)
	);
}

function uploadNewPet () {
	$pppetid = s::get('hasOnlineAccess');
	$pppetname = $_GET['pppetname'];
	$pets = db::table('pets');

	$getPetId = $pets->where(array('id' => $pppetid))->first();

	// used to get the pet data and pass back to the ajax function
	$pet_ID = 0;

	if($getPetId && $pppetid != 0) {
		$update = $pets->where('id', '=', $pppetid)->update(array(
		  	'name' => $_GET['pppetname']
		));
		$pet_ID = $pppetid;
	}
	else {

		$insert = 0;

		if($pppetname == '') {

		}
		else if ($_FILES["petNewImage"]["name"] == '') {
			$insert = $pets->insert(array(
				'user_id' => s::get('hasOnlineAccess'),
				'name' => $pppetname
			));
		}
		else if ($_FILES["petNewImage"]["name"]){
			$target_dir = "assets/images/pets/";
			$file_name = time() . '_' . basename($_FILES["petNewImage"]["name"]);
			$target_file = $target_dir . $file_name;
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["petNewImage"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$error = "Sorry, there was an error uploading your file."; 
					$uploadOk = 0;
				}
			}

			// Check file size
			if ($_FILES["petNewImage"]["size"] > 5000000) {
				$uploadOk = 0;
			}
				
			// Allow certain file formats
			if(
				strtolower($imageFileType) != "jpg" &&
				strtolower($imageFileType) != "png" && 
				strtolower($imageFileType) != "jpeg" && 
				strtolower($imageFileType) != "gif"
			){
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["petNewImage"]["tmp_name"], $target_file)) {
			    	fix_orientation($target_file);
			        
					$insert = $pets->insert(array(
						'user_id' => s::get('hasOnlineAccess'),
						'name' => $pppetname,
						'image' => $file_name
					));

			    }
			}
		}

		$pet_ID = $insert;

	}

	// if a pet was inserted
	return getPetInfo($pet_ID);
}


function deleteUserImage () {
	$userid = $_GET['userid'];
	$users = db::table('users');

	$update = $users->where('id', '=', $userid)->update(array(
	  'image' => null
	));
}

function deletePetImage () {
	$ppetid = $_GET['ppetid'];
	$pets = db::table('pets');

	$update = $pets->where('id', '=', $ppetid)->update(array(
	  'image' => null
	));
}

function deletepets () {

	$pets = db::table('pets');

	if($pets->where('id', '=', $_GET['ppetid'])->delete()) {

	}
}

function deleteAccount () {
	$users = db::table('users');
	$userid = s::get('hasOnlineAccess');
	s::remove('hasOnlineAccess');
	if($users->where('id', '=', $userid)->delete()) {
		s::remove('hasOnlineAccess');
	}
}

function renamepets () {
	$pets = db::table('pets');

	$getName = $_POST['ppetname'];
	$getId = $_POST['ppetid'];

	if ($getId != 0){
		$update = $pets->where('id', '=', $getId)->update(array(
			'name' => $getName
		));
	}

	return getPetInfo($getId);
}

function getPetInfo($pet_ID){
	$ajax_return = array(
		'pet' => null,
		'pet_id' => 0,
		'html' => array('list' => '', 'select' => '', 'hidden' => '')
	);
	if($pet_ID != 0){
		$pets = db::table('pets');
		$pet = $pets->where(array('id' => $pet_ID))->first();

		$ajax_return['pet_id'] = $pet_ID;

		if( $pet ){
			$ajax_return['html']['list'] = snippet('petlist', compact('pet'), true);
			$ajax_return['html']['select'] = snippet('petselect', compact('pet'), true);
			$ajax_return['html']['hidden'] = snippet('pethiddeninput', compact('pet'), true);
			$ajax_return['pet'] = $pet;
		}
	}

	return $ajax_return;
}