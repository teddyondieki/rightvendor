<?php
/* @var $this SiteController */

$this->breadcrumbs = array(
    'Vendor',
);
?>

<div class="container">
    We do the marketing for you.
<br/>
    <?php
    echo CHtml::link('Sign Up', array('user/registerVendor'), array('class'=>'btn btn-primary btn-lg'));
    ?>
</div>