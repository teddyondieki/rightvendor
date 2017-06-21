<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs = array(
    $model->vendorProfile->BusinessName => array('vendorProfile/permalink', 'permalink' => $model->Permalink),
    $model->Title,
);

Yii::app()->clientScript->registerCoreScript("jquery");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/bootstrap.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/imagesloaded.pkgd.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/masonry.pkgd.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/script.js");
?>

<div class="container">
    <?php
    $this->renderPartial('/vendorProfile/_flash');
    ?>

    <div class="row">

        <div class="col-lg-5 col-md-5 col-sm-10 col-xs-20" id="vendorSection">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="vendorName">
                        <?php
                        echo CHtml::link($model->vendorProfile->BusinessName, array('vendorProfile/permalink', 'permalink' => $model->vendorProfile->Permalink));
                        ?>                    
                    </h3>
                    <div class="media">
                        <?php
                        $imgHtml = CHtml::image($model->userProfile->ProfilePic == NULL ? Yii::app()->request->baseUrl . '/images/square.png' : Yii::app()->request->baseUrl . '/images/profile/' . $model->userProfile->ProfilePic, $model->vendorProfile->BusinessName, array('class' => 'media-object'));
                        echo CHtml::link($imgHtml, array('vendorProfile/view', 'id' => $model->UserID), array('class' => 'pull-left'));
                        ?>

                        <div class="media-body">
                            <h5 class="media-heading"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $model->vendorProfile->city->Name ?>, Kenya</h5>
                            <h5 class="media-heading"><span class="glyphicon glyphicon-pushpin"></span> <?php echo $model->vendorProfile->category->Name; ?></h5>
                        </div>
                    </div>
                    <hr/>

                    <?php
                    echo CHtml::link('Price List / Offers', array('vendorProfile/priceList', 'id' => $model->vendorProfile->VendorID), array('class' => 'btn btn-info btn-md btn-block text-uppercase'));
                    ?>
                    <hr/>
                    <h4 class="contact">
                        <span class="glyphicon glyphicon-globe"></span> 
                        <small>
                            <a href="<?php echo $model->vendorProfile->Website; ?>" target="_blank"><?php echo $model->vendorProfile->Website; ?></a>
                        </small>
                    </h4>

                    <h4 class="contact"> 
                        <span class="glyphicon glyphicon-envelope"></span>
                        <small>
                            <a href="mailto:<?php echo $model->vendorProfile->Email; ?>"> <?php echo $model->vendorProfile->Email; ?></a>
                        </small>
                    </h4>
                    <h4 class="contact">
                        <span class="glyphicon glyphicon-earphone"></span> 
                        <small>
                            <a href="tel:<?php echo $model->vendorProfile->Phonenumber; ?>"><?php echo $model->vendorProfile->Phonenumber; ?></a>                
                        </small>
                    </h4>

                    <?php if ($model->UserID != Yii::app()->user->id): ?>

                        <hr/>
                        <h5>
                            <strong>
                                Ask vendor
                            </strong>  
                        </h5>      
                        <?php
                        $this->renderPartial('/message/_form', array(
                            'model' => $message,
                        ));
                        ?>
                    <?php endif; ?>

                </div>
            </div>

        </div>


        <div class="col-lg-15 col-md-15 col-sm-10 col-xs-20">

            <ul class="nav nav-tabs" role="tablist">
                <li>
                    <?php echo CHtml::link('Projects <span class="badge">' . $model->vendor->projectCount . '</span>', array('vendorProfile/permalink', 'permalink' => $model->vendorProfile->Permalink)); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Reviews <span class="badge">' . $model->vendorProfile->reviewCount . '</span>', array('vendorProfile/reviews', 'id' => $model->UserID)); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Price List / Offers', array('vendorProfile/priceList', 'id' => $model->UserID)); ?>
                </li>

            </ul>

            <div class="text-center">
                <h1 class="projectTitle"><?php echo $model->Title; ?> <small>by <?php echo $model->vendorProfile->BusinessName; ?></small></h1>

                <div class="projectSub">
                    <span class="glyphicon glyphicon-heart">
                    </span> <?php
                    echo $model->TotalLikes;
                    ?> 
                    <span class="separator">
                        |
                    </span>
                    <span class="text-muted">
                        at  <?php echo $model->Venue; ?>, updated on <?php echo date('F j, Y', strtotime($model->UpdateTime)); ?>
                    </span>

                </div>    <hr/>
                <p class="projectDesc">
                    <?php echo $model->Description; ?>
                </p>
            </div>

            <div id="posts" class="isotope row">

                <?php foreach ($model->gallery as $image): ?>
                    <div class="item col-lg-5 col-md-5 col-sm-10 col-xs-20">
                        <div class="thumbnail">
                            <?php
                            $imgHtml = CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->ID . '/thumbs/' . $image->Name, "image", array('alt' => $model->Title, 'width' => '100%'));
                            echo CHtml::link($imgHtml, array('GalleryImage/view', 'id' => $image->ID));
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr/>

            <div class="clear">

            </div>

            <div id="comments">


                <?php if (Yii::app()->user->isGuest) { ?>
                    <div class="well well-lg text-center">
                        Please <?php echo CHtml::link('Sign In', array('site/login')); ?> or <?php echo CHtml::link('Register', array('user/create')); ?> to leave comments.
                    </div>
                    <?php
                } else {
                    ?>


                    <h5 class="text-uppercase">Leave a Comment</h5>
                    <?php if (Yii::app()->user->hasFlash('commentSubmitted')): ?>
                        <div class="flash-success">
                            <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
                        </div>
                    <?php else: ?>
                        <?php
                        $this->renderPartial('/comment/_form', array(
                            'model' => $comment,
                        ));
                        ?>
                    <?php endif; ?>


                    <?php
                }
                ?>
                <?php if ($model->commentCount >= 1): ?>
                    <h5 class="text-uppercase">
                        Comments
                    </h5>
                    <?php
                    $this->renderPartial('_comments', array(
                        'comments' => $model->comments,
                    ));
                    ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>


