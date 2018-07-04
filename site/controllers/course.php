<?php
return function($site, $pages, $page){

    $allQuestion = $page->questions()->toStructure()->shuffle()->limit(10);

    // getting the questions and convert it to Collection object and limit the content and shuffle the collectionm.
    // then add pagination
    $questions = $allQuestion->paginate(10);
    // get the previously added pagination
    $pagination = $questions->pagination();
    // get module_items from panel as object
    $data = $page->module_items()->toStructure();
    // get module_items from panel as array
    $dataArray = $page->module_items()->yaml();
    // get course_id from courses
    $getcourseid = db::table('courses')->where('uri', '=', $page->uid())->first();
    if(empty($getcourseid)) {
        go('/error');
    }
    // get total entries from courses_modules table
    $getcoursemodulestotal = db::table('courses_modules')->where('course_id', '=', $getcourseid->id())->all();
    // count $getcoursemodulestotal
    $getcount = $getcoursemodulestotal->count();
    $totalQ = $getcount;
    // count entries from module_items
    $getc = $page->module_items()->toStructure()->count();
    $getQ = $page->questions()->toStructure()->count();
    //get login user
    $getID = s::get('hasOnlineAccess');
    // progress bar
    $get_prog = @(1 / $totalQ); 
    $get_progbar = $get_prog * 100;
    $get_progs = @(1 / 10); 
    $get_progbars = $get_progs * 100;
    // page url
    $getpageuri = $page->url();
    // page uid
    $courseURL = $page->uid();

    $courses_users = db::table('courses_users');
    $courses_modules = db::table('courses_modules');
    $users_courses_modules = db::table('users_courses_modules');
    $courses = db::table('courses');

    $userCourse = $courses_users->where(array('uri' => $page->uid()))->first();
    $userCourses = $courses_users->where(array('user_id' => $getID, 'uri' => $courseURL))->first();
    $userCoursesScore = $courses_users->select(array('score'))->where(array('user_id' => $getID, 'uri' => $courseURL))->first();
    if($userCoursesScore == null) {
        $userCoursesScore = 0;
    }
    $getImage = $page->mainImage();
    $sigImage = $site->signature_image();
    $modules = db::table('modules');
    $users = db::table('users');
    $pets = db::table('pets');
    $count = 0;
    $correctAnswers = array();
    $questionIndex = 0;
    $questionNumber = 1;
    $xcount = 0;
    $getpagetitle = $page->title();
    $result_course = $courses_users->where(array('user_id' => $getID))->all();
    $result_user = $users->where(array('id' => $getID))->all();
    $result_pet = $pets->where(array('user_id' => $getID))->all();


    // ajax request
    if(kirby()->request()->ajax()){
    // in ajax request - this snippet will be returned by the server.. the site and page object should be redeclared in here...
    // in ajax, the global objects are unknown
        exit(snippet('course/questions', compact('page', 'questions', 'pagination'), true));
    } else {
        return compact('page', 'questions', 'pagination', 'percentOfEactItem','data', 'getc', 'getQ','getID','totalQ','get_prog','get_progbar','getpageuri','courses','userCourse','getImage','modules','getModules','get_progs','get_progbars','count','correctAnswers','questionIndex','questionNumber','xcount','getpagetitle','userCourses','courses_modules','users_courses_modules','dataArray','getAlModules','mod','allModules','userCoursesScore','result_course', 'result_user', 'result_pet','sigImage');
    }
};


?>
