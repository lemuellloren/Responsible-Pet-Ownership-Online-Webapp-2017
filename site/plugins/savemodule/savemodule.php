<?php 

function saveModule () {
	$courses_modules = db::table('courses_modules');
	$courses = db::table('courses');
	$modules = db::table('modules');
	$users_courses_modules = db::table('users_courses_modules');
	$modname = urldecode($_GET['name']);

	$getCourseID = $courses->select(array('id'))->where(array('uri' => $_GET['course_uri']))->first();
	$getModulesID = $modules->select(array('id'))->where(array('title' => $modname))->first();
	$getCoursesModulesID = $courses_modules->select(array('id'))->where(array(
		'course_id' => $getCourseID->id(),
		'module_id' => $getModulesID->id()))->first();

	$checkifExist = $users_courses_modules->where(array('user_id' => $_GET['user_id'], 'courses_modules_id' => $getCoursesModulesID->id()))->all();
	print_r($getCoursesModulesID->id());
	if($checkifExist->count() == 0){
		$results = db::insert('users_courses_modules', array(
			'user_id' => $_GET['user_id'],
			'courses_modules_id' => $getCoursesModulesID->id(),
			'completed' => 1
		));
		if($results) {
			echo "Module saved";
		}
	}
	else {
		deleteModule();
	}
}

function deleteModule () {
	$courses_modules = db::table('courses_modules');
	$courses = db::table('courses');
	$modules = db::table('modules');
	$users_courses_modules = db::table('users_courses_modules');
	$modname = urldecode($_GET['name']);

	$getCourseID = $courses->select(array('id'))->where(array('uri' => $_GET['course_uri']))->first();
	$getModulesID = $modules->select(array('id'))->where(array('title' => $modname))->first();
	$getCoursesModulesID = $courses_modules->select(array('id'))->where(array(
		'course_id' => $getCourseID->id(),
		'module_id' => $getModulesID->id()))->first();

	$checkifExist = $users_courses_modules->where(array('user_id' => $_GET['user_id'], 'courses_modules_id' => $getCoursesModulesID->id()))->all();
	print_r($getCoursesModulesID->id());
	if($checkifExist->count() !== 0){
		$users_courses_modules->where(array('user_id' => $_GET['user_id'], 'courses_modules_id' => $getCoursesModulesID->id()))->delete();
	}
	if($users_courses_modules) {
		echo "Module deleted!";
	}

}