<?php

// ----------------------------------------------------------------------------
// Module to add the Routes and Logic for SnipCart Login
// ----------------------------------------------------------------------------
require_once 'controllers.php';



function loadResources(){
	return db::query("SELECT u.firstname, u.lastname, u.postcode, count(p.user_id) pet_count, count(c.user_id) course_count from users u left join pets p on u.id = p.user_id left join courses c on u.id = c.user_id group by p.user_id, c.user_id order by firstname asc");
}