<?php

/**
 * Widget to display grid of featured projects.
 */
class FeaturedProjects extends CWidget {

    private $_projects;
    public $displayLimit = 25;

    public function init() {
        $this->_projects = Project::model()->findFeaturedProjects($this->displayLimit);
    }

    public function getFeaturedProjects() {
        return $this->_projects;
    }

    public function run() {
// this method is called by CController::endWidget()
        $this->render('featuredProjects');
    }

}
