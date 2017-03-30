<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

    </head>

    <body>
        <div style="background-color: black;">

            <div class="container">
                <div class="text-center" id="logo">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="<?php echo CHtml::encode(Yii::app()->name); ?>"/>
                    </a>
                    <br/>
                    inspiration for couples
                    <div id="socialIcons">
                        <ul class="nav-pills">
                            <li>
                                <a href="https://facebook.com/weddingvibe">
                                    <img src="<?php echo Yii::app()->request->baseUrl ?>/images/social/facebook.png"/>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/weddingvibe">
                                    <img src="<?php echo Yii::app()->request->baseUrl ?>/images/social/twitter.png"/>
                                </a>
                            </li>
                            <li>
                                <a href="https://pinterest.com/weddingvibe">
                                    <img src="<?php echo Yii::app()->request->baseUrl ?>/images/social/pinterest.png"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Static navbar -->
        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div>
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => '<span class="glyphicon glyphicon-home hidden-xs"></span><span class="visible-xs-block"> Home</span>', 'url' => array('/site/index')),
                            array('label' => 'Vendor List', 'url' => array('/vendorProfile/index')),
                            array('label' => '<span class="glyphicon glyphicon-star"></span> Featured', 'url' => array('/vendorProfile/featured')),
                            array('label' => 'Are you a vendor?', 'url' => array('/site/vendor'), 'visible' => !Yii::app()->authManager->checkAccess("vendor", Yii::app()->user->id)),
//                            array('label' => 'Blog', 'url' => array('/blog')),
                            array('label' => 'Dashboard', 'url' => array('/vendorProfile/dashboard'), 'visible' => Yii::app()->authManager->checkAccess("vendor", Yii::app()->user->id)),
                            array('label' => 'My Projects', 'url' => array('/vendorProfile/projects'), 'visible' => Yii::app()->authManager->checkAccess("vendor", Yii::app()->user->id)),
                        ),
                        'htmlOptions' => array(
                            'class' => 'nav navbar-nav navbar-collapse collapse text-center',
                        ),
                        'encodeLabel' => false,
                    ));
                    ?>

                    <form class="navbar-form navbar-right" role="search" action="<?php echo Yii::app()->createUrl('site/search'); ?>">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="Quick search...">
                            <span class="input-group-btn">
                                <input class="btn btn-default searchButton" type="submit" value="Search."/>
                            </span>
                        </div>
                    </form>

                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => '<span class="glyphicon glyphicon-bell"></span> ' . User::getUnreadNotifications(), 'url' => array('/notification/index'), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => '<span class="glyphicon glyphicon-envelope"></span> ' . User::getUnreadMessages(), 'url' => array('/message/index'), 'visible' => !Yii::app()->user->isGuest), //                        
                            array('label' => 'Sign In', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Sign Out', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Register', 'url' => array('/user/create'), 'visible' => Yii::app()->user->isGuest),
                            //                        array('label' => 'Be a cook', 'url' => array('/user/cookRegister')),
                            array('label' => '<span class="glyphicon glyphicon-comment"></span> Talk To Us', 'url' => array('/site/contact')),
                        ),
                        'htmlOptions' => array(
                            'class' => 'nav navbar-nav navbar-right navbar-collapse collapse text-center',
                        ),
                        'encodeLabel' => false,
                    ));
                    ?>
                </div><!--/.nav-collapse -->
            </div>
        </div>


        <div class="container">

            <?php
            if (isset($this->breadcrumbs)):

//                if (Yii::app()->controller->route !== 'site/index') {
//                    $this->breadcrumbs = array_merge(array(Yii::t('zii', 'Home') => Yii::app()->homeUrl), $this->breadcrumbs);
//                }

                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
//                    'homeLink' => false,
//                    'tagName' => 'ul',
//                    'separator' => '',
//                    'activeLinkTemplate' => '<li><a href="{url}">{label}</a> </li>',
//                    'inactiveLinkTemplate' => '<li><span>{label}</span></li>',
//                    'htmlOptions' => array('class' => 'breadcrumb')
                ));
                ?><!-- breadcrumbs -->
            <?php endif; ?>


        </div><!-- page -->

        <?php echo $content; ?>

        <div class="clear">

        </div>

        <div id="footer">
            <div class="container">
                <p class="pull-left">Copyright &copy; <?php echo date('Y'); ?>  <a href="http://rightvendor.co.ke">Right Vendor</a></p>
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'About Us', 'url' => array('/site/page', 'view' => 'about')),
                        array('label' => 'Advertising', 'url' => array('/site/page', 'view' => 'advertising')),
                        array('label' => 'Terms and Conditions', 'url' => array('/site/page', 'view' => 'terms-conditions')),
                    ),
                    'htmlOptions' => array(
                        'class' => 'nav-pills pull-right',
                    ),
                    'encodeLabel' => false,
                ));
                ?>
            </div>
        </div>
    </body>
</html>
