<?php

// get the title of this module
$module = db::table('modules')->select(array('title'))->where(array('id' => $values->modules_select))->first();

echo $module->title;