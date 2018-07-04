<?php 

function savePetToDb() {
	$courses = db::table('courses');
	$getid = s::get('hasOnlineAccess');
	$pets_courses = db::table('pets_courses');

	$getCourseID = $courses->select(array('id'))->where(array('uri' => $_GET['course_uri']))->first();

	$checkifExist = $pets_courses->where(array('user_id' => $getid, 'course_id' => $getCourseID->id(), 'pet_id' => $_GET['petids']))->all();
	if($checkifExist->count() == 0){
		$results = db::insert('pets_courses', array(
			'pet_id' => $_GET['petids'],
			'course_id' => $getCourseID->id(),
			'user_id' => $getid
		));
		if($results) {
			echo "pet saved";
		}
	}
	else {
		deletePetToDb();
	}
}

function deletePetToDb() {
	$courses = db::table('courses');
	$getid = s::get('hasOnlineAccess');
	$pets_courses = db::table('pets_courses');

	$getCourseID = $courses->select(array('id'))->where(array('uri' => $_GET['course_uri']))->first();

	$checkifExist = $pets_courses->where(array('user_id' => $getid, 'course_id' => $getCourseID->id(), 'pet_id' => $_GET['petids']))->all();
	if($checkifExist->count() !== 0){
		$pets_courses->where(array('user_id' => $getid, 'course_id' => $getCourseID->id(), 'pet_id' => $_GET['petids']))->delete();
	}
	if($pets_courses) {
		echo "pets deleted!";
	}
}