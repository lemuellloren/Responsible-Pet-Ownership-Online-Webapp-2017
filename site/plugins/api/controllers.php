<?php
    class Entity{
        // adding user
        public static function add($data){
            // assigning the body object on a variables.
            $email = $data['email'];
            $password = password::hash($data['userpass']);
            $fName = $data['firstname'];
            $lName = $data['lastname'];
            $postcode = $data['postcode'];
            $petName = $data['petname'];
            $startDate = time();
            


            // save a newly resource.
            $userId = db::insert('users', array(
                'email' => $email,
                'checksum' => $password,
                'firstname' => $fName,
                'lastname'  => $lName,
                'postcode'  => $postcode,
                'last_login' => date('Y-m-d H:i:s', strtotime('+0 day', $startDate))
            ));

            // save pet into database
            if($petName != ""){
                $petId = db::insert('pets', array(
                    'user_id' => $userId,
                    'name' => $petName
                ));
            }
            

            // save newly pet

            // if the user is successfully saved on the db
            if($userId != ''){
                return true;
            }
            // else
            return false;
        }
        // check if the user is exist
        public static function checkIfUserExist($query){
            // caching
            if (is_array($query)) {
                $email = $query['email'];
                $password = $query['userpass'];
            }
            else {
                $email = $query->email();
                $password = $query->password();
            }

            //check email from database 
            $getUser = db::query("SELECT id, checksum from users where email = '$email' ");
            // check if the collection has item.
            if($getUser->count() !==  0) {
                $hashPassword = $getUser->first()->checksum();
                if(password::match($password,$hashPassword))
                {
                    return $getUser;
                }                             
            }
            
            return 'Invalid email or password';                
            
        }
        public static function getUser($id){
            // query to database
            $result = db::query("SELECT * FROM users WHERE id = '$id'");

            return $result->first();
        }
        public static function updateUser($id, $data){
            // this will be the updated data for the user info.
            $update = array(
                'firstname' => $data['pfirstname'],
                'lastname' => $data['lfirstname'],
                'email' => $data['pemail']
            );

            // this will request to the database to update the data.
            $userId = db::update('users', $update, array('id' => $id));

            // get the update user information
            $result = db::query("SELECT * FROM users WHERE id = '$id'");

            // else
            return $result->first();
        }

        public static function updateUserPass($id, $data) {
            $newpassword = $data['newpassword'];
            $oldpassword = $data['oldpassword'];
            //check if id exist for security
            $checkID =  db::query("SELECT id,checksum FROM users where id = '$id' ");            
            if ($checkID->count() !== 0) {
                $hashPassword = $checkID->first()->checksum();
                //check if oldpassword == password in the database 
                if(password::match($oldpassword,$hashPassword))
                {
                    // this will request to the database to update the data.
                    $update = array(
                        'checksum' => password::hash($newpassword)
                    );

                    db::update('users', $update, array('id' => $id));
                    
                    return response::success('Password changed!', array(
                        'success' => true
                    ));
                }
                else {
                header($_SERVER['SERVER_PROTOCOL'] . ' Error');
                echo "Invalid Password!";
                return response::error("Invalid Password!");   
                }              
            }

        }

        public static function updatePetInfo($data) {
            $getPetId = $data['r-petid1'];
            $getPetName = $data['r-petname1'];

            $checkPetID =  db::query("SELECT name FROM pets where id = '$getPetId' ");

            if($checkPetID->count() !== 0) {
                $update = array(
                    'name' => $getPetName 
                );
                //update pet on the database 
                db::update('pets', $update, array('id' => $getPetId)); 
                //Select updated table of pets and assign it to result 
                $result = db::query("SELECT * from pets where id = '$getPetId' ");

                return response::success('Pet info updated!', array(
                    'success' => true,
                    'updatename' => $result
                ));
            }
            return response::error("An error occured!");     
        }

        public static function addPetInfo($id, $data) {
            $getPetName = $data['petname']; 
            $getPetId = s::get('hasOnlineAccess');
            
            $petId = db::insert('pets', array(
                'user_id' => $getPetId,
                'name' => $getPetName
            ));

            return response::success('Pet added!', array(
                'success' => true
            ));
        }

        public static function validate($data){
            $valid = true;
            $error = '';
            $passlength = 8;

            /***********************************

            *   expected data fields

                - username
                - password
                - confirm_password
                - email

            ***********************************/

            foreach($data as $field => $value) {
                switch ($field) {
                    case 'username':

                    break;
                    case 'password':
                        if( 
                            !isset($data['password']) || 
                            empty($data['password'])
                        ){
                            $valid = false;
                            $error = 'Invalid data.';
                        }
                        if( strlen($data['password']) < $passlength ){
                            $valid = false;
                            $error = 'Password minimum length is ' . $passlength;
                        }

                        if( !$valid ) break 2;

                    break;
                    case 'confirm_password':
                        if(
                            !isset($data['confirm_password']) ||
                            empty($data['confirm_password'])
                        ){
                            $valid = false;
                            $error = 'Invalid data.';
                        }

                        if( $data['password'] !== $data['confirm_password'] ){
                            $valid = false;
                            $error = 'Passwords do not match.';
                        }

                        if( !$valid ) break 2;

                    break;
                    case 'email':

                    break;
                }
            }

            return compact('valid', 'error');
        }

    }


    // for sessions
    class Session{
        // when logged in, provide a right to the user to access some private features
        public static function setHasOnlineAccess($userId) {
            s::start();
            s::set('hasOnlineAccess', $userId);
        }
        // check if the the user has access.
        public static function hasOnlineAccess() {
            if (s::get('hasOnlineAccess') !== NULL) {
                return true;
            }
            return false;
        }
        // removing the access rights
        public static function removeSession() {
            s::remove('hasOnlineAccess');
        }
        // get the decoded value on session
        public static function getSession() {
            return s::get('hasOnlineAccess');
        }
    }


 ?>
