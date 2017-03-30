<?php

class VendorSearchForm  extends CActiveRecord {

    public $City;
    public $Category;

    public function rules() {
        return array(
            array('City, Category', 'required'),
        );
    }

    public function attributeLabels() {
        return array(
            'City' => 'Location',
            'Category' => 'Category',
        );
    }

}
