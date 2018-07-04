
<?php 
    return array(
      'title' => 'Students',
      'options' => array(

      ),
      'html' => function() {
            return tpl::load(__DIR__ . DS . 'mywidget.html.php', array(
              'resultcourse' => db::query("SELECT user.last_login, user.id, user.firstname, user.postcode, user.lastname, count(course.user_id) course_count from users user left join courses_users course on user.id = course.user_id where user.id > 0 group by user.id order by firstname asc")              
            ));
            
      }
  );