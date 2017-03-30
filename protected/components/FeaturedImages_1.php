<?php

/**
 * Widget to display grid of featured projects.
 */
class FeaturedImages extends CWidget {

    private $_images;
    public $displayLimit = 20;
    public $colorTag = null;

    public function init() {
        $this->_images = GalleryImage::model()->findFeaturedImages($this->displayLimit, $this->colorTag);
    }

    public function getFeaturedImages() {
        return $this->_images;
    }

    public function run() {
// this method is called by CController::endWidget()
        $this->render('featuredImages');
    }

}
