<?php
/* @var $this VendorProfileController */
/* @var $model VendorProfile */

$this->breadcrumbs = array(
    $model->BusinessName => array('vendorProfile/permalink', 'permalink' => $model->Permalink),
    'Price list'
);

Yii::app()->clientScript->registerCoreScript("jquery");
//Yii::app()->clientScript->registerScriptFile("http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/bootstrap.min.js");
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/masonry.pkgd.js");
//Yii::app()->clientScript->registerScriptFile("js/jquery.isotope.min.js");
//Yii::app()->clientScript->registerScriptFile("js/mql.js");
//Yii::app()->clientScript->registerScriptFile("js/reddit.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/script.js");
?>

<div class="container">
    <?php
    $this->renderPartial('_flash');
    ?>
    <div class="row">
        <div class="col-lg-5" id="vendorSection">
            <?php
            $this->renderPartial('_profile', array(
                'model' => $model,
                'message' => $message,
            ));
            ?>
        </div>
        <div class="col-lg-15">

            <ul class="nav nav-tabs" role="tablist">
                <li>
                    <?php echo CHtml::link('Projects <span class="badge">' . $model->projectCount . '</span>', array('vendorProfile/permalink', 'permalink' => $model->Permalink)); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Reviews <span class="badge">' . $model->reviewCount . '</span>', array('vendorProfile/reviews', 'id' => $model->VendorID)); ?>
                </li>
                <li class="active">
                    <?php echo CHtml::link('Price List / Offers', array('vendorProfile/priceList', 'id' => $model->VendorID)); ?>
                </li>

            </ul>

            <div class="tab-content">
                <div class="tab-pane active">
                    <?php
                    foreach ($model->priceList as $priceList) {
                        ?>
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <h4>
                                    <strong>
                                        <?php echo $priceList->Service; ?>
                                    </strong>
                                </h4>

                                <?php echo $priceList->Description; ?>
                                <h5>
                                    <strong>
                                        Budget: <?php echo Yii::app()->params['currency']; ?><?php echo $priceList->Budget; ?>
                                    </strong>
                                </h5>
                            </div>

                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

</div>



