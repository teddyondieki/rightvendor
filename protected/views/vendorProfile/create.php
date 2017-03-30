<?php
/* @var $this VendorProfileController */
/* @var $model VendorProfile */
/* @var $user User */


$this->breadcrumbs = array(
    'Vendor' => array('site/vendor'),
    '2: Business Details'
);
?>


<div class="container">

    <div class="panel panel-default vendorSignUp">
        <div class="panel-heading">
            <h3 class="panel-title">
                <!--Step 1: Create account-->
                <ul class="nav nav-pills nav-justified">
                    <li><a>1: User Details</a></li>
                    <li class="active"><a>2: Business Details</a></li>
                </ul>
            </h3>
        </div>
        <div class="panel-body">
            <?php $this->renderPartial('_form', array('model' => $model)); ?>                           
        </div>
    </div>
</div>


