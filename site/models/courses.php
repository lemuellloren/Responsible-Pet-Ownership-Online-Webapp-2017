<?php

// For a content file called `project.txt`
// In general the class name is {{ProjectFileName}}Page

class CoursesPage extends Page {
	// all methods of the Page class are inherited and can be overridden here now.

	public function getModules() {
		$modules = $this->module_items()->yaml();

		return $this;
	}
}