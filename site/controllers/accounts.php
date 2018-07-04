<?php
        return function($site, $pages, $page){
            $getID = s::get('hasOnlineAccess');
            $courses_users = db::table('courses_users');
            $courses = db::table('courses');
            
            $results = $courses_users->where(array('user_id' => $getID))->all()->paginate(5);
            $getCourses_Users_course_id = $courses_users->where(array('user_id' => $getID))->all();

            $getCoursetitle = $courses->select(array('title', 'uri'))
                 ->where('id', '=', $getCourses_Users_course_id->course_id)
                 ->all();

            $pagination = $results->pagination();

            if(kirby()->request()->ajax()){
                // in ajax request - this snippet will be returned by the server.. the site and page object should be redeclared in here...
                // in ajax, the global objects are unknown
                exit(snippet('mycourse', compact('results', 'pagination', 'page', 'site'), true));
                
            } else {
                return compact('accounts', 'results', 'pagination','getID','$getCoursetitle','getCourses_Users_course_id');
            }
        };
 ?>
