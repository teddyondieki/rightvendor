<?php
/* @var $this VendorProfileController */
/* @var $model VendorProfile */

$this->breadcrumbs = array(
    'Dashboard',
);
?>

<div class="container">
    <div class="row">

        <div class="col-lg-5">
            <?php $this->renderPartial('_sidebar'); ?>
        </div> 
        <div class="col-lg-15">

            <div class="panel panel-default">
                <div class="panel-body">


                    Business Name:   <?php
            echo CHtml::encode($model->BusinessName);
            ?>
                    <br/>
                    Location:   <?php
                    echo CHtml::encode($model->city->Name);
            ?>
                    <br/>
                    Category:   <?php
                    echo CHtml::encode($model->category->Name);
            ?>
                    <br/>
                    Logo:   <?php
                    echo CHtml::encode($model->userProfile->ProfilePic);
            ?>
                    <br/>
                    Website:   <?php
                    echo CHtml::encode($model->Website);
            ?>
                    <br/>
                    Email:   <?php
                    echo CHtml::encode($model->Email);
            ?>
                    <br/>
                    Phonenumber:   <?php
                    echo CHtml::encode($model->Phonenumber);
            ?>
                    <br/>
                    Address:   <?php
                    echo CHtml::encode($model->Address);
            ?>
                    <br/>
                </div>
                <div class="panel-footer">
                    <?php
                    echo CHtml::link('Update business information', array('vendorProfile/updateProfile'));
                    ?> | 
                    <?php
                    echo CHtml::link('Update business logo', array('vendorProfile/updateLogo'));
                    ?>
                </div>
            </div>
        </div>       
    </div>
</div>


