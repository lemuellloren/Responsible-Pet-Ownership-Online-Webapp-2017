<?php
        return function($site, $pages, $page){
            $getID = s::get('hasOnlineAccess');
            $dd = db::table('courses');
            $results = $dd->where('user_id', '=', $getID)->all()->paginate(5);
            $pagination = $results->pagination();
            if(kirby()->request()->ajax()){
                // in ajax request - this snippet will be returned by the server.. the site and page object should be redeclared in here...
                // in ajax, the global objects are unknown
                return compact('accounts', 'pagination');
                
            } else {
                return compact('accounts', 'pagination');
            }
        };
 ?>
