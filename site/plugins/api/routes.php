<?php
    // ----------------------------------------------------------------------------
    // Module to add the Routes and Logic for SnipCart Login
    // ----------------------------------------------------------------------------
    // require_once 'controllers.php';

    // for adding user
    kirby()->set('route',
        array(
            // 'pattern' is the url being called from our form's ajax javascript function
            'pattern'=> 'api/users',
            'method' => 'POST',
            'action' => function() {
                  //checks kirby request
                  if(!kirby()->request()->ajax()){ return response::error("Page Not Found!","404");}
                  $result = array();
                  // creating response object, if successfull
                  if(saveUser(kirby()->request()->data())){
                      return response::success('Data save successful.');
                  }
                  // error response
                  $error = 'We are unable to process your request at this time. Please try again later.';
                  return response::error($error, 400);

              }
        )
    );
?>
