<?php
/* @var $this VendorProfileController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs = array(
    'Featured Vendors',
);
?>


<div class="container">

    <div class="row">

        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            'summaryText' => ''
        ));
        ?>
    </div>

</div>