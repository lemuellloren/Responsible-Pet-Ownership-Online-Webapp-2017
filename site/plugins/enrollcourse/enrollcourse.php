<?php

function enrollcourse () {

    $getCourse = $_POST['getCourse'];
    $getid = $_POST['getid'];
    $title = $_POST['title'];
    $courses_users = db::table('courses_users');
    $courses = db::table('courses');
    $courses_modules = db::table('courses_modules');

    //Check if Course is in courses_users table
    $checkIfUriExistinCourses_Users = $courses_users->where(array('uri' => $getCourse, 'user_id' => $getid))->all();

    //get the id course ID
    $getURIOfTheCourse = $courses->where(array('uri' => $getCourse))->first();
    if ($checkIfUriExistinCourses_Users->count()  == 0) {
        db::insert('courses_users', array(
            'user_id'    => $getid,
            'uri' => $getCourse,
            'course_id' => $getURIOfTheCourse->id()
        ));
    }
    else {
        return response::error('Failed', array(
            'success' => false
        ));
    }
}

function enrollcourses () {
    $getCourse = $_GET['getCourse'];
    var_dump($getCourse);
    $getid = $_GET['getid'];
    $title = $_GET['title'];
    $courses_users = db::table('courses_users');
    $courses = db::table('courses');
    $courses_modules = db::table('courses_modules');

    //Check if Course is in courses_users table
    $checkIfUriExistinCourses_Users = $courses_users->where(array('uri' => $getCourse, 'user_id' => $getid))->all();

    //get the id course ID
    $getURIOfTheCourse = $courses->where(array('uri' => $getCourse))->first();
    if ($checkIfUriExistinCourses_Users->count()  == 0) {
        db::insert('courses_users', array(
            'user_id'    => $getid,
            'uri' => $getCourse,
            'course_id' => $getURIOfTheCourse->id()
        ));
    }
    else {
        return response::error('Failed', array(
            'success' => false
        ));
    }
}