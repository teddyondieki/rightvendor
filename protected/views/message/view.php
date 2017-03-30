<?php

/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs = array(
    'Messages' => array('index'),
    $model->ID,
);

$this->menu = array(
    array('label' => 'List Message', 'url' => array('index')),
    array('label' => 'Create Message', 'url' => array('create')),
    array('label' => 'Update Message', 'url' => array('update', 'id' => $model->ID)),
    array('label' => 'Delete Message', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Message', 'url' => array('admin')),
);
?>

<?php

echo $model->Content;
?>


<?php

$this->renderPartial('_reply', array(
    'model' => $message,
));
?>