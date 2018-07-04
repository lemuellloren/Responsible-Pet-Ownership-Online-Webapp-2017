<?php 
    return array(
      'title' => 'Pets',
      'options' => array(
        array(
          'text' => 'Go to page',
          'icon' => 'pencil',
          'link' => '#',
          'modal' => 'true'
          
        )
      ),
      'html' => function() {
            return tpl::load(__DIR__ . DS . 'mywidget.html.php', array(
              'resultss' => db::query("SELECT u.id, u.firstname, u.lastname, count(p.user_id) pet_count from users u left join pets p on u.id = p.user_id where u.id > 0 group by p.user_id order by firstname ASC")
            ));
            
      } 
  );