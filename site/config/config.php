<?php

/*
---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license
*/

// Kirby License
c::set('license', 'K2-PRO-dbb36222cffd0f96dfa7dbb6737fb495');

// Toggle DEBUG mode
c::set('debug',true);

// Force using SSL connection

c::set('ssl',false);

// Toggle autocompletion inside textareas
c::set('textarea.autocomplete', true);

c::set('panel.widgets', array(
  'pages'    => true,
  'site'     => true,
  'account'  => true,
  'history'  => true,
  'mywidget' => true
));
c::set('panel.stylesheet', 'assets/css/panel.css');

c::set('starthook', function($page) {
  return array(
    'users' => db::table('users'),
    'pets' => db::table('pets'),
    'courses' => db::table('courses'),
    'courses_users' => db::table('courses_users'),
    'modules' => db::table('modules'),
    'getID' => s::get('hasOnlineAccess')
);
});


kirby()->hook('panel.page.create', function($page) {

  if($page->intendedTemplate() == 'course') {
      if($courses = db::table('courses')->insert(array(
        'uri' => $page->uid(),
        'title'    => $page->title(),
        'status' => 1
    )));

  }

  elseif ($page->intendedTemplate() == 'module') {
      if($courses = db::table('modules')->insert(array(
        'uri' => $page->uid(),
        'title'    => $page->title()
    )));
  }
});

kirby()->hook('panel.page.update', function($page) {

  if($page->intendedTemplate() == 'course') {
      $update = db::table('courses')->where('uri', '=', $page->uid())->update(array(
        'title' => $page->title()
    ));

  }

  elseif ($page->intendedTemplate() == 'module') {
      $update = db::table('modules')->where('uri', '=', $page->uid())->update(array(
        'title' => $page->title()
    ));
  }


  $course_id = db::table('courses')->select(array('id'))->where(array('uri' => $page->uid()))->first();
  $course_id = $course_id->id;

  // delete existing course records
  $pastmods = db::table('courses_modules')->select(array('id', 'module_id', 'course_id'))->where('course_id', '=', $course_id)->all();
  db::table('courses_modules')->where('course_id', '=', $course_id)->delete();



  $getModulesList = $page->module_items()->yaml();
  foreach ($getModulesList as $key => $value) {

    $module_ids[] = $value['modules_select'];
    
}

  // remove duplicate module ids
$module_ids = array_unique($module_ids);

foreach ($module_ids as $id) {

    if($course_mods = db::table('courses_modules')->insert(array(
      'course_id' => $course_id,
      'module_id' => $id
  )));
      
}

$newmods = db::table('courses_modules')->select(array('id', 'module_id', 'course_id'))->where('course_id', '=', $course_id)->all();

$updatedmods = [];
$cound = 0;
foreach ($newmods as $nkey => $nvalue) {
  foreach ($pastmods as $pkey => $pvalue) {
      if ($nvalue->module_id == $pvalue->module_id) {
        $updatedmods[$cound]['old_id'] = $pvalue->id;
        $updatedmods[$cound]['new_id'] = $nvalue->id;
    }
}
$cound++;
}

foreach ($updatedmods as $key => $value) {
    if($update = db::table('users_courses_modules')->where('courses_modules_id', '=', $value['old_id'])->update(array(
        'courses_modules_id' => $value['new_id']
    )));
}

});

kirby()->hook('panel.page.delete', function($page) {
  
  if($page->intendedTemplate() == 'course') {
      if(db::table('courses')->where('uri', '=', $page->uid())->delete()) {
        
      }
  }

  elseif ($page->intendedTemplate() == 'module') {
      if(db::table('modules')->where('uri', '=', $page->uid())->delete()) {
        
      }
  }
});


c::set('routes', array(
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/exportsql',
    'method' => 'GET',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        exportsql();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/exportcsv',
    'method' => 'GET',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        exportcsv();
        return response::json($result);
    }
),
 array(
    'pattern' => 'api/dompdf',
    'method' => 'POST',
    'action' => function() {
        $result = array();
        $requestObject = kirby()->request();
        $result['success'] = true;
        $result['pet'] = dompdf($requestObject->data());
        return response::json($result);
    }
),
 array(
    'pattern' => 'api/dompdfNoPet',
    'method' => 'POST',
    'action' => function() {
        $result = array();
        $requestObject = kirby()->request();
        $result['success'] = true;
        $result['pet'] = dompdf($requestObject->data());
        return response::json($result);
    }
),
 array(
    'pattern' => 'api/dompdfTwoRows',
    'method' => 'POST',
    'action' => function() {
        $result = array();
        $requestObject = kirby()->request();
        $result['success'] = true;
        $result['pet'] = dompdf($requestObject->data());
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/enrollcourse',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        enrollcourse();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/enrollcourses',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        enrollcourses();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/deletecourse',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        deletecourse();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/saveModule',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        saveModule();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/savePetToDb',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        savePetToDb();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/deleteModule',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        deleteModule();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/deletePetToDb',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        deletePetToDb();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/changepetImage',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        changepetImage();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/mailFormData',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        mailFormData();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/deleteAccount',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        deleteAccount();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/quiz',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        quiz();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/addpet',
    'method' => 'POST',
    'action' => function() {
        if(!kirby()->request()->ajax()){ return response::error("Page Not Found!","404");}
            $result = array();
            // the router action code
            $result['success'] = false;
            $pets = db::table('pets');
            $getpetnumber = $pets->where(array('user_id' => s::get('hasOnlineAccess')))->all();
            if ($getpetnumber->count() == 6) {
                // error response
                header($_SERVER['SERVER_PROTOCOL'] . ' Success');
                echo "You maxed the pet allowed! Delete a pet and try again.";
            }
            else {
            // get the query which is part of the URL.
                addpet();
                return response::json($result);
            }
        }
    ),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/changeuserinfo',
    'method' => 'POST',
    'action' => function() {
            // get the query which is part of the URL.
        $data = changeuserinfo();
        $data['success'] = true;
        return response::json($data);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/renamepets',
    'method' => 'POST',
    'action' => function() {
            // get the query which is part of the URL.
        $data = renamepets();
        $data['success'] = true;
        return response::json($data);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/deletepets',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        deletepets();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/percentBar',
    'method' => 'GET',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
        $result['percent'] = 50;
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/uploadUserImage',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        uploadUserImage();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/uploadUserImageProfile',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        uploadUserImageProfile();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/uploadPetImageProfile',
    'method' => 'POST',
    'action' => function() {
            // get the query which is part of the URL.
        $data = uploadPetImageProfile();
        $data['success'] = true;
        return response::json($data);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/deleteUserImage',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        deleteUserImage();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/deletePetImage',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code
        $result['success'] = true;
            // get the query which is part of the URL.
        deletePetImage();
        return response::json($result);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/uploadNewPet',
    'method' => 'POST',
    'action' => function() {
            // get the query which is part of the URL.
        $data = uploadNewPet();
        $data['success'] = true;
        return response::json($data);
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/forgotpassword',
    'method' => 'POST',
    'action' => function() {
        $result = array();
            // the router action code

        $data = kirby()->request()->data();
        $email = $data['email'];

        $user = db::select('users', 'id', array('email' => $email));

        if(!empty($user->data)){
                // get the query which is part of the URL.
            forgotpassword();

            return response::success('Success');
        }

        return response::error('Error');
    }
),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/loadResources',
    'method' => 'GET',
    'action' => function() {
            //checks kirby request
        if(!kirby()->request()->ajax()){ return response::error("Page Not Found!","404");}

            $result = array();
            $result['success'] = true;
            $result['message'] = 'Successfull load the resources';
            $result['docs'] = loadResources();
            return response::json($result);
        }
    ),
 array(
        // 'pattern' is the url being called from our form's ajax javascript function
    'pattern'=> 'api/users',
    'method' => 'POST',
    'action' => function() {
            //checks kirby request
        if(!kirby()->request()->ajax()){ return response::error("Page Not Found!","404");}
            $result = array();
            // creating response object, if successfull
            $data = kirby()->request()->data();
            if(Entity::add($data)){
                $result = Entity::checkIfUserExist($data);
                Session::setHasOnlineAccess($result->first()->id());
                return response::success('Data save successful. Sign in your account now.', [
                  'hasOnlineAccess' => true,
                  'url' => page('accounts')->url()
              ]);
            }
            // error response
            $error = 'This email is already taken!';
            return response::error($error, 400);
        }
    ),
 array(
    'pattern' => 'api/users/login',
    'method' => 'GET',
    'action' => function(){
          //checks kirby request
      if(!kirby()->request()->ajax()){ return response::error("Page Not Found!","404");}

          // cache
          $userHasOnlineAccess = false;
          //  creating result object
           // query function will return query from the current URL as object
          $result = Entity::checkIfUserExist(kirby()->request()->query());
          
          // try login, check if the return value of the function is not null
          if( gettype($result) !== "string" && $result->count() !== 0){
              // start the session
              Session::setHasOnlineAccess($result->first()->id());
              $userHasOnlineAccess = true;
              $users = db::table('users');
              $startDate = time();
              $addDate = date('Y-m-d H:i:s', strtotime('+0 day', $startDate));

              $update = $users->where('id', '=', s::get('hasOnlineAccess'))->update(array(
                'last_login' => $addDate
            ));

              // return the my account page url
              return response::success('Youre authenticated!', [
                  'hasOnlineAccess' => $userHasOnlineAccess,
                  'url' => page('accounts')->url()
              ]);

          }elseif(gettype($result) === "string"){
            // error response, not authenticated
            Session::removeSession();

            return response::error($result, 400);
        }
    }
),
 array(
        'pattern' => 'api/users', // api/users/812409238409, api/users/234234
        'method' => 'GET',
        'action' => function(){
            //checks kirby request
            if(!kirby()->request()->ajax()){ return response::error("Page Not Found!","404");}

            //  creating result object
            $result = Entity::getUser(kirby()->request()->params()->id()); // pass the params from the URL object.

            if($result !== NULL){
                return response::success('Getting Data', $result);
            }
            $error = 'Invalid Id';

            return response::error($error, $result);
        }
    ),
 array(
    'pattern' => 'api/users/logout',
    'method' => 'GET',
    'action' => function(){
            //checks kirby request
        if(!kirby()->request()->ajax()){ return response::error("Page Not Found!","404");}

            // removing the session for this user
            Session::removeSession();

            return response::success('Youre signout!', [
                'url' => page('home')->url()
            ]);
        }
    ),
 array(
  'pattern' => 'api/users',
  'method' => 'PUT',
  'action' => function(){
          //checks kirby request
      if(!kirby()->request()->ajax()){ return response::error("Page Not Found!","404");}
          $requestObject = kirby()->request();
          $result = Entity::updateUser($requestObject->params()->id(), $requestObject->data());
          // creating response object, if successfull
          if($result !== NULL){
              return response::success('Successfully update the data.', $result);
          }
          // error response
          $error = 'We are unable to process your request at this time. Please try again later.';
          return response::error($error, 400);
      }
  ),
 array(
    'pattern' => 'api/changepass',
    'method' => 'PUT',
    'action' => function(){
            //check kirby request if ajax
        $requestObject = kirby()->request();
            // invoke
        return Entity::updateUserPass($requestObject->params()->id(), $requestObject->data());
    }
),
 array(
    'pattern' => 'api/updatepets',
    'method' => 'PUT',
    'action' => function(){
        $requestObject = kirby()->request();
        return Entity::updatePetInfo($requestObject->data());
    }
),
 array(
    'pattern' => 'api/changepasstoken',
    'method' => 'POST',
    'action' => function(){
        if(!kirby()->request()->ajax()){ return response::error("Page Not Found!","404");}

            $data = kirby()->request()->data();

            $valid = true;
            $error = 'Your request has been rejected due to it being invalid.';

            if( $check = Entity::validate($data) ){
                if( !$check['valid'] ) {
                    $valid = $check['valid'];
                    $error = $check['error'];
                }
            }

            if( isset($_GET['token']) && $valid ){
                $token = $_GET['token'];

                // query db if token exists
                $user = db::select('tokens', 'user_id', array('token' => $token))->first();

                if( !empty( $user ) ){
                    db::update(
                        'users',
                        array('checksum' => password::hash($data['password'])),
                        array('id' => $user->user_id)
                    );

                    db::delete('tokens', array('user_id' => $user->user_id));

                    return response::success('Success', 'Please log in to your account using your new password.');
                }
                else {
                    $error = 'User does not exist.';
                }
            }


            return response::error($error, 400);
        }
    )));


/*
---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/


//database
c::set('db.host', site()->dbhost());
c::set('db.user', site()->dbusername());
c::set('db.password', site()->dbpassword());
c::set('db.name', site()->dbname());