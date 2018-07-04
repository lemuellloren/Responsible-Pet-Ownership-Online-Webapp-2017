<?php

function deletecourse () {
	$getCourse = $_GET['getCourse'];
	$getid = $_GET['getid'];
	$courses_users = db::table('courses_users');
	$courses_modules = db::table('courses_modules');
	$pets_courses = db::table('pets_courses');
	$users_courses_modules = db::table('users_courses_modules');

	$CourceID = $courses_users->select(array('course_id'))->where(array('uri' => $getCourse, 'user_id' => $getid))->first();
	$getallmods = $courses_modules->select(array('id', 'module_id', 'course_id'))->where('course_id', '=', $CourceID->course_id)->all();

	foreach ($getallmods as $key => $value) {
		if($users_courses_modules->where(array('courses_modules_id' => $value->id))->delete()) {
		}
	}

	//Delete ifwithdrawn
	if($courses_users->where(array('uri' => $getCourse, 'user_id' => $getid))->delete()) {
	}

	//delete pet_courses
	if($pets_courses->where(array('user_id' => $getid, 'course_id' => $CourceID->course_id))->delete()) {
	}

}