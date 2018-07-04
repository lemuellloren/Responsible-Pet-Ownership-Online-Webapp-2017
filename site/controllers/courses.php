<?php
        return function($site, $pages, $page){
            // paginate the course pages - subpages
            $results = $pages->find('courses')->children()->visible()->paginate(5);
            // we create here another object. This will be used in navigating pages.
            $pagination = $results->pagination();
            $getID = s::get('hasOnlineAccess');
            // ajax request
            if(kirby()->request()->ajax()){
                // in ajax request - this snippet will be returned by the server.. the site and page object should be redeclared in here...
                // in ajax, the global objects are unknown
                exit(snippet('courselisting', compact('results', 'pagination', 'page', 'site'), true));
                
            } else {
                return compact('results', 'pagination','getID');
            }
        };
 ?>
