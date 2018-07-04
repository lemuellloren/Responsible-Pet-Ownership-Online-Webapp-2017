<?php

class ModselectField extends SelectField {

	public function options() {
		$results = db::query("SELECT id, title FROM modules");

		foreach ($results as $key => $value) {
			$modules[$value->id] = $value->title;
		}

		return $modules;
	}

}