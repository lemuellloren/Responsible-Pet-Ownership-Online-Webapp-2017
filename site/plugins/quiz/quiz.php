<?php

	function quiz() {

		$courses_users = db::table('courses_users');
		$courses = db::table('courses');

		// get course id
		$getCourseID = $courses->select(array('id'))->where(array('uri' => $_GET['page_uri']))->first();

		// update score based on course_id and login user
		$updateScore = $courses_users->where(array('user_id' => $_GET['user_id'], 'course_id' => $getCourseID->id()))->update(array('score' => $_GET['score']
		));

		// if the update is success
		if($updateScore) {
			return response::success('Success', array(
	            'success' => true
	        )); 
		}
		else {
		    return response::error('Failed', array(
	            'success' => false
	        ));			
		}


	}  

?>