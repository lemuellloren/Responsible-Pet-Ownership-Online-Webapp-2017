<?php
        return function($site, $pages, $page){
            $getID = s::get('hasOnlineAccess');
            $dd = db::table('courses');
            $results = $dd->where(array('user_id' => $getID, 'status' => 1))->all()->paginate(5);
            $pagination = $results->pagination();
            $getID = s::get('hasOnlineAccess');
            $foo = "123123";
            if(kirby()->request()->ajax()){
                // in ajax request - this snippet will be returned by the server.. the site and page object should be redeclared in here...
                // in ajax, the global objects are unknown
                exit(snippet('addpet', compact('page', 'questions', 'pagination'), true));
                
            } else {
                return compact('page', 'questions', 'pagination', 'percentOfEactItem', 'foo');
            }
        };
 ?>
