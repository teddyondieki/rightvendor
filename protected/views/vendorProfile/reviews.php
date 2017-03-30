<?php
/* @var $this VendorProfileController */
/* @var $model VendorProfile */

$this->breadcrumbs = array(
    $model->BusinessName => array('vendorProfile/permalink', 'permalink' => $model->Permalink),
    'Reviews'
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
                <li class="active">
                    <?php echo CHtml::link('Reviews <span class="badge">' . $model->reviewCount . '</span>', array('vendorProfile/reviews', 'id' => $model->VendorID)); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Price List / Offers', array('vendorProfile/priceList', 'id' => $model->VendorID)); ?>
                </li>

            </ul>

            <div class="tab-content">
                <div class="tab-pane active">

                    <?php if ($model->reviewCount >= 1): ?>
                        <h3>
                            <?php echo $model->reviewCount > 1 ? $model->reviewCount . ' reviews' : 'One review'; ?>
                        </h3>
                        <?php
                        $this->renderPartial('_reviews', array(
                            'reviews' => $model->reviews,
                        ));
                        ?>
                    <?php endif; ?>

                    <?php if (Yii::app()->user->isGuest) { ?>
                        <div class="well well-lg text-center">
                            Please <?php echo CHtml::link('Sign In', array('site/login')); ?> or <?php echo CHtml::link('Register', array('user/create')); ?> to leave a review
                        </div>
                        <?php
                    } elseif (Yii::app()->user->id != $model->VendorID) {
                        ?>

                        <h3>Review <?php echo $model->BusinessName; ?></h3>
                        <?php if (Yii::app()->user->hasFlash('reviewSubmitted')): ?>
                            <div class="flash-success">
                                <?php echo Yii::app()->user->getFlash('reviewSubmitted'); ?>
                            </div>
                        <?php else: ?>
                            <?php
                            $this->renderPartial('/review/_form', array(
                                'model' => $review,
                            ));
                            ?>
                        <?php endif; ?>

                        <?php
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>

</div>



