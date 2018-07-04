<?php 

require_once 'dompdf-2/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

function dompdf($request) {
	$getid = $request['getid'];
	$getlastname =  $request['getlastname'];
	$getfirstname =  $request['getfirstname'];
	$getcourse_title =  $request['getcourse_title'];
	$certificate_signatory =  $request['certificate_signatory'];
	$certificate_position =  $request['certificate_position'];
	$certificate_signature = $request['certificate_signature'];




	$pageuid =  $request['pageuid'];

	$datenow1 = date('j<\sup>S</\sup>');
	$datenow2 = ' of';
	$datenow3 = date(' F  Y');
	$datenow = $datenow1 . $datenow2 . $datenow3;


	$options = new Options();
	$options->set('isHtml5ParserEnabled', true);
	$options->set('defaultFont', 'Helvetica');
	

	$dompdf = new Dompdf($options);
	
	$contxt = stream_context_create([ 
		'ssl' => [ 
			'verify_peer' => FALSE, 
			'verify_peer_name' => FALSE,
			'allow_self_signed'=> TRUE
		] 
	]);
	$dompdf->setHttpContext($contxt);
	//get name

	$users = db::table('users');
	$getName = $users->where('id', '=', $getid)->first();
	$getUserimage = $getName->image();
	$fullname = $getfirstname .' '. $getlastname;
	$avatarWidth = 100;	
	$style = '';



	// if pet image is empty, use default
	if(empty($getUserimage)){
		$getUserimage = 'default.png';
		$avatarWidth = 100;
		$marginLeft = 0;
		$style = 'default'; 
	}	
	
	//get the width and height of the image
	$userImage = getimagesize('assets/images/users/avatar/'.$getUserimage);
	$width = $userImage[0];
	$height = $userImage[1];

	$imageStyleU = 'height: 100%';
	// if the height is greater than the width
	if($height > $width){
		$imageStyleU = 'width: 100%';
	}

	$petTemp = "";
	$widthCount = 0;

	$countPets = 0;

	// if no pet selected get 0 template 
	if(isset($_REQUEST['pets'])){
		$countPets = count($_REQUEST['pets']);

		$pets = db::table('pets');

		$petSelected = $_REQUEST['pets'];

		$getcourceid = db::table('courses')->select(array('id'))->where(array('title' => $getcourse_title ))->first();
		$pets_courses = db::table('pets_courses');
		foreach($petSelected as $key => $petId) {

			$pet = $pets->where(array('id' => $petId))->first();
			$petID = $pet->id();


			$now = new DateTime();
			$timestamp = $now->getTimestamp();

			$id = $pets_courses->insert(array(
				'pet_id' => $petId,
				'course_id' => $getcourceid->id(),
				'user_id' => $getid
			));

		}
	}

	// no pet domhtml
	if($countPets == 0) {

		$dompdf->load_html('<html lang="en-AU">
			<head>
			<meta charset="utf-8">
			<meta http-equiv="x-ua-compatible" content="ie=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			
			<title>RPO CERTIFICATE</title>
			<meta name="description" content="">
			
			<!-- STYLESHEETS -->
			<style type="text/css">
			
			/*@font-face {
				font-family: "GothamRoundedBold";
				src: url("/assets/fonts/GothamRoundedBold.ttf") format("ttf");
			}*/
			@import url("https://fonts.googleapis.com/css?family=Varela+Round");
			
			body {
				box-sizing: border-box;
				margin: 0;
			}
			h1{
				/*font-family: "GothamRoundedBold" !important; */
				font-family: "Varela Round", sans-serif;
			}
			h2, h3, h4, h5, p {
				font-family: "Arial",Helvetica Neue,Helvetica,sans-serif; 
			}
			h1 {
				font-size: 35px;
			}
			#RPOcertificate {
			width: 950px;
			height: 660px;
			border: solid 10px #2B2B2B;
			text-align: center;
			margin: 0 auto;
		}
			#main {
		width: 930px;
		height: 641px;
		border: solid 10px #747678;
		margin: 0 auto;
	}
	.left {
		width: 230px;
		height: 641px;
		display: inline-block;
		background-color: #F2AF00;
		text-align: left;
		vertical-align: top;
	}
	img.RPOlogo {
		height: 206px;
		/*width: 105.34px;
		margin-bottom: 5%;*/
		padding-left: 15%;
		margin-top: 6%;
	}
	.leftImgCont{
		position: relative;
		height: 134px;
	}
	.right {
		width: 700px;
		display: inline-block;
		vertical-align: top;
		text-align: center;
	}
	img.RPOlogo2 {
		width: 153px;
		height: 79px;
		padding-left: 30px;
		position: absolute;
		top: 235px;
	}
	h1.Title {
		color: #F26522;
		padding-top: 5%;
		line-height: 10px;
		font-size: 25px;
		margin-bottom: 15px;
		font-weight: 100;
		font-family: "Arial",Helvetica Neue,Helvetica,sans-serif; 
	}
	.right p{
		margin: 0 0 15px 0;
	}
	p{
		color: #747678;
		font-size: 16px;
	}
	.cover {
		border: solid 1px #F26522;
		border-radius: 37.2px;
		text-align: center;
		width: 75px;
		height: 75px;
		overflow: hidden;
		margin: 0 auto;
	}
	.cover img, .cover-pet img{
		text-align: center;
	}
	.cover-pet{
		width: 70px;
		height: 70px;
		border: solid 1px #747678;
		border-radius: 35px;
		text-align: center;
		overflow: hidden;
		margin: 0 auto;
	}
	.avatarName {
		color: #F26522;
		font-size: 16px;
	}
	
	img.mascotts {
		height: 90px;
		margin-top: -110px;
	}
	.flex-container {
		height: 160px;
		text-align: center;
		padding: 0;
		width: 580px;
		margin-top: 40px;
		align-items: center;
	}
	.pet{
		display: inline-block;
		width: 80px;
		padding: 0 5px;
		vertical-align: middle;
	}
	.flex-item {
		width: 75px;
		height: auto;
		display: inline-block;
		padding: 0 10px;
	}
	
	.profile-image {
		width: '.$widthCount.'%;
		display: inline-block;
		vertical-align: middle;
		align-items: center;
		margin-left: auto;
		margin-right: auto;
	}
	h2.pet-name {
		padding-top: 0;
		color: #747678;
		font-size: 16px;
		display: block;
	}
	.award {
		padding-left: 50px;
		padding-right: 50px;
		color: #747678;
		position: relative;
		top: -50px;
	}
	.award p{
		font-size: 16px;
		line-height: 20px;
	}
	.award-title {
		color: #2B2B2B;
	}
	.sign-container{
		position: relative;
		text-align: center;
	}
	hr.line-sign {
		width: 200px;
		border-bottom:1px solid #747678;
		position: absolute;
		bottom: 150px;
		left: 30%;
	}
	img.signature {
		height: 70px;
	}
	.sign-container {
		line-height: 0;
	}
	.sign-director {
		line-height: 0;
		position: relative;	
		top: -35px;
	}
	.sign-director p{
		font-size: 12px;
		margin: 0;
	}
	/*img.avatar {
		width: 60px;
		height: 60px;
	}*/
	img.default {
		/*width: 60px !important;
		height: 60px !important;*/
	}
	</style>
	
	</head>
	<body>
	<section id="RPOcertificate">
	
	<div id="main">
	<div class="left">
	<img class="RPOlogo" src="assets/images/Logo.jpg" alt="Logo" >
	
	<div class="container leftImgCont">
	<img class="RPOlogo2" src="assets/images/Logotext.jpg" alt="RPO Logo" >
	</div>
	</div>
	<div class="right">
	
	<h1 class="Title">
	CERTIFICATE OF COMPLETION
	</h1>
	<p>Penrith Council Animal Services Division is proud to present</p>
	<br><br><br>
	<div class="cover" style="object-fit: cover;">
	<img class="avatars '.$style.'" src="assets/images/users/avatar/'.$getUserimage.'" alt="Avatar" style="'.$imageStyleU.'">
	</div>
	<div style="position:relative;">
	<div style="left: 180px; top: -90px; position: absolute;">
	<img src="assets/images/boomer-2.jpg" width="100px">
	</div>
	<div style="right: 180px; top: -87px; position: absolute;">
	<img src="assets/images/boots-1.jpg" width="100px" >
	</div>
	</div>
	<h2 class="avatarName" style="font-size: 16px; padding-top: 10px;">'.ucwords($fullname).'</h2>
	<br><br><br><br><br><br>
	<div class="award">
	<p>with this certificate, on the <strong>'.$datenow.'</strong>,<br>
	upon successful completion of our online course </p>
	<p class="award-title"><strong>'.ucwords($getcourse_title).'</strong></p>
	<br>
	<div class="sign-container" style="margin-top: 20px;">
	<img class="signature" src="thumbs/'.$certificate_signature.'" alt="RPO Logo">
	<hr class="line-sign" style="margin-left: 20px; margin-bottom: 0px">
	</div>
	<div class="sign-director" style="padding-bottom: 0px">
	<p><strong>'.ucwords($certificate_signatory).' • '.ucwords($certificate_position).'</strong></p>
	<p>Animal Services • Penrith Council</p>
	</div>
	</div>
	
	
	</div>
	</div>
	
	</section>
	</body>
	</html>');

// if selected pet is more than 0 and <4 
}else if($countPets > 0 && $countPets < 4) {


	$idPets = $_REQUEST['pets'];

	foreach($idPets as $petId) {
			//$widthCount += 60;
		$pet = $pets->where(array('id' => $petId))->first();
		$petcount = $pets->where(array('id' => $petId))->all();
		$countThis = count((array)$idPets);
		$course = db::table('courses');
		$pets = db::table('pets');
		$pets_courses = db::table('pets_courses');
		

		$getcourseid = $course->select('id')->where(array('uri' => $pageuid))->first();
		$getcoursetitle = $course->select('title')->where(array('uri' => $pageuid))->first();
		$savepetdb = $pets_courses->where(array('pet_id' => $petId, 'course_id' => $getcourseid->id()))->all();

		if($savepetdb->count() !== 0) {

		}

		if($savepetdb->count() == 0) {
		}
		// if 3 selected pets, user this width
		if ($countThis == 3) {
			$widthCount += 110;
		}
		// if 2 selected pets, user this width
		elseif ($countThis == 2) {
			$widthCount += 130;
		}
		// if 1 selected pets, user this width
		elseif ($countThis == 1) {
			$widthCount += 192;
		}

		$petImg = $pet->image();
		$imgSize = 100;

		if(empty($petImg)){
			$petImg = 'default2.png';
			$imgSize = 60;
		}

		//get the width and height of the image
		$userImage = getimagesize('assets/images/pets/'.$petImg);
		$width = $userImage[0];
		$height = $userImage[1];

		$imageStyle = 'height: 100%';
	// if the height is greater than the width
		if($height > $width){
			$imageStyle = 'width: 100%';
		}

		$petTemp .= '<div class="pet">
		<div class="cover-pet" style="object-fit: cover;">
		<img class="avatar" src="assets/images/pets/'.$petImg.'" alt='.$pet->name().' style="'.$imageStyle.'">
		</div>
		<h2 class="pet-name">'.$pet->name().'</h2>
		</div>';

	}
	$dompdf->load_html('<html lang="en-AU">
		<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>RPO CERTIFICATE</title>
		<meta name="description" content="">

		<!-- STYLESHEETS -->
		<style type="text/css">

		/*@font-face {
			font-family: "GothamRoundedBold";
			src: url("/assets/fonts/GothamRoundedBold.ttf") format("ttf");
		}*/
		@import url("https://fonts.googleapis.com/css?family=Varela+Round");

		body {
			box-sizing: border-box;
			margin: 0;
		}
		h1{
			/*	font-family: "GothamRoundedBold" !important; */
			font-family: "Varela Round", sans-serif;
		}
		h2, h3, h4, h5, p {
			font-family: "Arial",Helvetica Neue,Helvetica,sans-serif; 
		}
		h1 {
			font-size: 35px;
		}
			#RPOcertificate {
			width: 950px;
			height: 660px;
			border: solid 10px #2B2B2B;
			text-align: center;
			margin: 0 auto;
		}
			#main {
		width: 930px;
		height: 641px;
		border: solid 10px #747678;
		margin: 0 auto;
	}
	.left {
		width: 230px;
		height: 641px;
		display: inline-block;
		background-color: #F2AF00;
		text-align: left;
		vertical-align: top;
	}
	img.RPOlogo {
		height: 206px;
		/*width: 105.34px;
		margin-bottom: 5%;*/
		padding-left: 15%;
		margin-top: 6%;
	}
	.leftImgCont{
		position: relative;
		height: 134px;
	}
	.right {
		width: 700px;
		display: inline-block;
		vertical-align: top;
		text-align: center;
	}
img.RPOlogo2 {
	width: 153px;
	height: 79px;
	padding-left: 30px;
	position: absolute;
	top: 235px;
}
h1.Title {
	color: #F26522;
	padding-top: 5%;
	line-height: 10px;
	font-size: 25px;
	margin-bottom: 15px;
	font-weight: 100;
	font-family: "Arial",Helvetica Neue,Helvetica,sans-serif; 
}
.right p{
	margin: 0 0 15px 0;
}
p{
	color: #747678;
	font-size: 16px;
}
.cover {
	border: solid 1px #F26522;
	border-radius: 30px;
	text-align: center;
	width: 60px;
	height: 60px;
	overflow: hidden;
	margin: 0 auto;
}
.cover img, .cover-pet img{
	text-align: center;
}
.cover-pet{
	width: 70px;
	height: 70px;
	border: solid 1px #747678;
	border-radius: 35px;
	text-align: center;
	overflow: hidden;
	margin: 0 auto;
}
.avatarName {
	color: #F26522;
	font-size: 16px;
}

img.mascotts {
	height: 90px;
	margin-top: -110px;
}
.flex-container {
	height: 160px;
	text-align: center;
	padding: 0;
	width: 580px;
	margin-top: 40px;
	align-items: center;
}
.pet{
	display: inline-block;
	width: 80px;
	padding: 0 5px;
	vertical-align: middle;
}
.flex-item {
	width: 75px;
	height: auto;
	display: inline-block;
	padding: 0 10px;
}

.profile-image {
	width: '.$widthCount.';
	display: inline-block;
	vertical-align: middle;
	align-items: center;
	margin-left: auto;
	margin-right: auto;
}
h2.pet-name {
	padding-top: 0;
	color: #747678;
	font-size: 16px;
	display: block;
}
.award {
	padding-left: 50px;
	padding-right: 50px;
	color: #747678;
	position: relative;
	top: -50px;
}
.award p{
	font-size: 16px;
	line-height: 20px;
}
.award-title {
	color: #2B2B2B;
}
.sign-container{
	position: relative;
	text-align: center;
}
hr.line-sign {
	width: 200px;
	border-bottom:1px solid #747678;
	position: absolute;
	bottom: 150px;
	left: 30%;
}
img.signature {
	height: 70px;
}
.sign-container {
	line-height: 0;
}
.sign-director {
	line-height: 0;
	position: relative;	
	top: -35px;
}
.sign-director p{
	font-size: 12px;
	margin: 0;
}

img.default {
	/*width: 60px;
	height: 60px;*/
}
</style>

</head>
<body>
<section id="RPOcertificate">

<div id="main">
<div class="left">
<img class="RPOlogo" src="assets/images/Logo.jpg" alt="Logo" >

<div class="container leftImgCont">
<img class="RPOlogo2" src="assets/images/Logotext.jpg" alt="RPO Logo" >
</div>
</div>
<div class="right">

<h1 class="Title">
CERTIFICATE OF COMPLETION
</h1>
<p>Penrith Council Animal Services Division is proud to present</p>

<div class="cover" style="object-fit: cover;">
<img class="avatars '.$style.'" src="assets/images/users/avatar/'.$getUserimage.'" alt="Avatar" style="'.$imageStyleU.'">
</div>
<h2 class="avatarName">'.ucwords($fullname).'</h2>

<div class="flex-container" style="text-align: center; margin-left: 55px">
<div class="profile-image" style="text-align: center;">
<img src="assets/images/boomer-2.jpg" width="80px">
'.ucwords($petTemp).'
<img src="assets/images/boots-1.jpg" width="80px">
</div>
</div>

<div class="award">
<p>with this certificate, on the <strong>'.$datenow.'</strong>,<br>
upon successful completion of our online course </p>
<p class="award-title"><strong>'.ucwords($getcourse_title).'</strong></p>
<br>

	<div class="sign-container" style="margin-top: 15px;">
	<img class="signature" src="thumbs/'.$certificate_signature.'" alt="RPO Logo">
	<hr class="line-sign" style="margin-left: 20px; margin-bottom: 0px">
	</div>
	<div class="sign-director" style="padding-bottom: 0px">
	<p><strong>'.ucwords($certificate_signatory).' • '.ucwords($certificate_position).'</strong></p>
	<p>Animal Services • Penrith Council</p>
	</div>
	</div>
	
	
	</div>
	</div>
	
	</section>
	</body>
	</html>');

}else{

	$idPets = $_REQUEST['pets'];

	foreach($idPets as $petId) {
		$pet = $pets->where(array('id' => $petId))->first();
		$petcount = $pets->where(array('id' => $petId))->all();
		$countThis = count((array)$idPets);

		if ($countThis == 6) {
			$marginleft = 0;
		}
		elseif ($countThis == 5) {
			$marginleft = 45;
		}
		elseif ($countThis == 4) {
			$marginleft = 90;
		}

		$widthCount += 80;

		$petImg = $pet->image();
		$imgSize = 100;
		$defaultStyles = '';

		if(empty($petImg)){
			$petImg = 'default2.png';
			$imgSize = 60;
			$defaultStyles = 'style="margin-left: 2px;"';
		}

		//get the width and height of the image
		$userImage = getimagesize('assets/images/pets/'.$petImg);
		$width = $userImage[0];
		$height = $userImage[1];

		$imageStyle = 'height: 100%';
	// if the height is greater than the width
		if($height > $width){
			$imageStyle = 'width: 100%';
		}

		$petTemp .= '<div class="pet" style="">
		<div class="cover-pet" style="object-fit: cover;">
		<img class="avatar" '.$defaultStyles.' src="assets/images/pets/'.$petImg.'" alt='.$pet->name().' style="'.$imageStyle.'">
		</div>
		<h2 class="pet-name">'.$pet->name().'</h2>
		</div>';

	}

	$dompdf->load_html('<html lang="en-AU">
		<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>RPO CERTIFICATE</title>
		<meta name="description" content="">

		<!-- STYLESHEETS -->
		<style type="text/css">

		/*@font-face {
			font-family: "GothamRoundedBold";
			src: url("/assets/fonts/GothamRoundedBold.ttf") format("ttf");
		}*/
		@import url("https://fonts.googleapis.com/css?family=Varela+Round");

		body {
			box-sizing: border-box;
			margin: 0;
		}
		h1{
			/*	font-family: "GothamRoundedBold" !important; */
			font-family: "Varela Round", sans-serif;
		}
		h2, h3, h4, h5, p {
			font-family: "Arial",Helvetica Neue,Helvetica,sans-serif; 
		}
		h1 {
			font-size: 35px;
		}
			#RPOcertificate {
			width: 950px;
			height: 660px;
			border: solid 10px #2B2B2B;
			text-align: center;
			margin: 0 auto;
		}
			#main {
		width: 930px;
		height: 641px;
		border: solid 10px #747678;
		margin: 0 auto;
	}
	.left {
		width: 230px;
		height: 641px;
		display: inline-block;
		background-color: #F2AF00;
		text-align: left;
		vertical-align: top;
	}
	img.RPOlogo {
		height: 206px;
		/*width: 105.34px;
		margin-bottom: 5%;*/
		padding-left: 15%;
		margin-top: 6%;
	}
	.leftImgCont{
		position: relative;
		height: 134px;
	}
	.right {
		width: 700px;
		display: inline-block;
		vertical-align: top;
		text-align: center;
	}
img.RPOlogo2 {
	width: 153px;
	height: 79px;
	padding-left: 30px;
	position: absolute;
	top: 235px;
}
h1.Title {
	color: #F26522;
	padding-top: 5%;
	line-height: 10px;
	font-size: 25px;
	margin-bottom: 15px;
	font-weight: 100;
	font-family: "Arial",Helvetica Neue,Helvetica,sans-serif; 
}
.right p{
	margin: 0 0 15px 0;
}
p{
	color: #747678;
	font-size: 16px;
}
.cover-photo{
	display: inline-block;
	width: 150px;
	text-align: center;
	margin-top: 15px;
}
.cover {
	border: solid 1px #F26522;
	border-radius: 30px;
	text-align: center;
	width: 60px !important;
	height: 60px;
	overflow: hidden;
	margin: 0 auto;
}
.cover img, .cover-pet img{
	text-align: center;
	margin-left: 0px;
}
.cover-pet{
	width: 70px;
	height: 70px;
	margin: 10px;
	border: solid 1px #747678;
	border-radius: 35px;
	text-align: center;
	overflow: hidden;
	margin: 0;
}
.avatarName {
	color: #F26522;
	font-size: 16px;
}

img.mascotts {
	height: 90px;
	/*margin-top: -110px;*/
}
.owner-container{
	width: 100%;
	height: 100px;
}
.owner{
	position: relative;
	text-align: center;
	width: 350px;
	margin: 0 auto;
}
.flex-container {
	height: 145px;
	text-align: center;
	padding: 0 10%;
	margin: 20px 0 30px 0;
}
.pet{
	display: inline-block;
	width: 60px;
	margin: 0 15px;
	text-align: center;
	vertical-align: top;
}
.flex-item {
	width: 75px;
	height: auto;
	/*margin-top: -10px;*/
	display: inline-block;
	padding: 0 10px;
}

.profile-image {
	width: '.$widthCount.'px;
	text-align: center;
	margin: 0 auto;
}
h2.pet-name {
	padding-top: 0;
	color: #747678;
	font-size: 16px;
	display: block;
}
.award {
	padding-left: 50px;
	padding-right: 50px;
	color: #747678;
	position: relative;
	top: -50px;
}
.award p{
	font-size: 16px;
	line-height: 20px;
}
.award-title {
	color: #2B2B2B;
}
.sign-container{
	position: relative;
	text-align: center;
}
hr.line-sign {
	width: 200px;
	border-bottom:1px solid #747678;
	position: absolute;
	bottom: 150px;
	left: 30%;
}
img.signature {
	height: 70px;
}
.sign-container {
	line-height: 0;
}
.sign-director {
	line-height: 0;
	position: relative;	
	top: -35px;
}
.sign-director p{
	font-size: 12px;
	margin: 0;
}
.cover img.avatar{
	/*width: '.$avatarWidth.'px;*/
	margin-left: -10px;
}
img.avatars{
	position: relative;
	margin-left: 0px;
}
img.default {
	/*position: relative;
	margin-left: 2px;
	width: 62px !important;
	height: 62px !important;*/
}
</style>

</head>
<body>
<section id="RPOcertificate">

<div id="main">
<div class="left">
<img class="RPOlogo" src="assets/images/Logo.jpg" alt="Logo" >

<div class="container leftImgCont">
<img class="RPOlogo2" src="assets/images/Logotext.jpg" alt="RPO Logo" >
</div>
</div>
<div class="right">

<h1 class="Title">
CERTIFICATE OF COMPLETION
</h1>
<p>Penrith Council Animal Services Division is proud to present</p>
<div class="owner-container">
<div class="owner">
<div class="flex-item"><img src="assets/images/boomer-2.jpg" width="80px"></div>
<div class="cover-photo">
<div class="cover" style="object-fit: cover;">
<img class="avatars '.$style.'" src="assets/images/users/avatar/'.$getUserimage.'" alt="Avatar" style="'.$imageStyleU.'">
</div>
<h2 class="avatarName">'.ucwords($fullname).'</h2>
</div>
<div class="flex-item"><img src="assets/images/boots-1.jpg" width="80px"></div>
</div>
</div>

<div class="flex-container" style="text-align: center;">
<div class="profile-image" style="text-align: center; margin-left: '.$marginleft.'px">
'.ucwords($petTemp).'
</div>
</div>

<div class="award">
<p>with this certificate, on the <strong>'.$datenow.'</strong>,<br>
upon successful completion of our online course </p>
<p class="award-title"><strong>'.ucwords($getcourse_title).'</strong></p>
<br>

	<div class="sign-container" style="margin-top: 15px;">
	<img class="signature" src="thumbs/'.$certificate_signature.'" alt="RPO Logo">
	<hr class="line-sign" style="margin-left: 20px; margin-bottom: 0px">
	</div>
	<div class="sign-director" style="padding-bottom: 0px">
	<p><strong>'.ucwords($certificate_signatory).' • '.ucwords($certificate_position).'</strong></p>
	<p>Animal Services • Penrith Council</p>
	</div>
	</div>
	
	
	</div>
	</div>
	
	</section>
	</body>
	</html>');
}

$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('certificate');	
}

?>