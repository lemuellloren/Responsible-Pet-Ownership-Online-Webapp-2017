<html lang="en-AU">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>RPO CERTIFICATE</title>
	<meta name="description" content="">

	<!-- STYLESHEETS -->
	<style type="text/css">

		@import url('https://fonts.googleapis.com/css?family=Varela+Round');

		body {
			box-sizing: border-box;
			width: auto;
			margin: 0;
		}
		h1{
			font-family: 'Varela Round', sans-serif;
		}
		h2, h3, h4, h5, p {
			font-family: "Arial",Helvetica Neue,Helvetica,sans-serif; 
		}
		h1 {
			font-size: 35px;
		}
		#RPOcertificate {
			width: 842px;
			height: 595px;
			border: solid 10px #2B2B2B;
			text-align: center;
			margin: 0 auto;
		}
		#main {
			width: 822px;
			height: 575px;
			border: solid 10px #747678;
			margin: 0 auto;
		}
		.left {
			width: 230px;
			height: 575px;
			display: inline-block;
			background-color: #F2AF00;
			text-align: left;
			vertical-align: top;
		}
		img.RPOlogo {
			height: 206px;
			padding-left: 15%;
			margin-top: 6%;
		}
		.leftImgCont{
			position: relative;
			height: 134px;
		}
		.right {
			width: 588px;
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
			margin-left: 10px;
		}
		.cover-pet{
			width: 60px;
			height: 60px;
			margin: 10px;
			border: solid 1px #747678;
			border-radius: 30px;
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
			margin-top: -110px;
		}
		.flex-container {
			height: 145px;
			text-align: center;
			padding: 0 19%;
			margin-top: 50px;
		}
		.pet{
			display: inline-block;
			width: 60px;
			margin: 0 10px;
			text-align: center;
		}
		.flex-item {
			width: 75px;
			height: auto;
			display: inline-block;
			padding: 0 10px;
		}

		.profile-image {
			width: 100%;
			display: inline-block;
			text-align: center;
			vertical-align: top;
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
	</style>

</head>
<body>
	<section id="RPOcertificate">

		<div id="main">
			<div class="left">
				<img class="RPOlogo" src="<?php echo url() ?>/assets/images/Logo.jpg" alt="Logo" >

				<div class="container leftImgCont">
					<img class="RPOlogo2" src="<?php echo url() ?>/assets/images/Logotext.jpg" alt="RPO Logo" >
				</div>
			</div>
			<div class="right">
				<center>
					<h1 class="Title">
						CERTIFICATE OF COMPLETION
					</h1>
					<p>Penrith Council Animal Services Division is proud to present</p>
					<div class="cover">
						<img class="avatar" src="<?php echo url() ?>/assets/images/avatar.jpg" alt="Avatar" width="100">
                    </div>
                    
					<?php $getID = s::get('hasOnlineAccess');
				   	$users = db::table('users');
					$result = $users->where('id', '=', $getID)->first();
					$fullname = $result->firstname()." ".$result->lastname(); 
                    ?>


					<h2 class="avatarName"><?php echo $fullname ?></h2>

					<div class="flex-container">
						<div class="profile-image">
							<div class="pet">
								<div class="cover-pet">
									<img class="avatar" src="<?php echo url() ?>/assets/images/dog.jpg" alt="Spot" width="130">
								</div>
								<h2 class="pet-name">Spot</h2>
							</div>
							<div class="pet">
								<div class="cover-pet">
									<img class="avatar" src="<?php echo url() ?>/assets/images/cat.jpg" alt="Fluffy" width="130">
								</div>
								<h2 class="pet-name">Fluffy</h2>
							</div>
							<div class="pet">
								<div class="cover-pet">
									<img class="avatar" src="<?php echo url() ?>/assets/images/cat.jpg" alt="Fluffy" width="130">
								</div>
								<h2 class="pet-name">Fluffy</h2>
							</div>
						</div>
					</div>

					<div class="award">
						<p>with this certificate, on the <strong>2nd of July 2017</strong>,<br>
							upon successful completion of our online course </p>
							<p class="award-title"><strong>Making Your Home Safe for Cats & Dogs</strong></p>
							<br>
							<div class="sign-container">
								<img class="signature" src="<?php echo url() ?>/assets/images/sign.jpg" alt="RPO Logo">
								<hr class="line-sign">
							</div>
							<div class="sign-director">
								<p><strong>John Smith • Director</strong></p>
								<p>Animal Services • Penrith Council</p>
							</div>

						</div>
					</center>
				</div>
			</div>

		</section>
    </body>
    
	</html>
