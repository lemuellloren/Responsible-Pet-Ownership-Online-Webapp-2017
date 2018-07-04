<?php

class CoursePage extends Page {

	public function getModuleTitles() {

		$modules = $this->module_items()->yaml();

		if (count($modules) > 0) {
			foreach ($modules as $mod) {
				$ids[] = ' id = ' . $mod['modules_select'];
			}
		}

		$sql = "SELECT title FROM modules WHERE " . implode(' OR ', $ids);
		$result = db::query($sql);

		$module_titles = array();

		foreach ($result as $value) {
			$module_titles[] = $value->title;
		}

		return $module_titles;

	}
}