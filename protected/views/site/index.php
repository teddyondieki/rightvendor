<?php
/* @var $this SiteController */
/* @var $model VendorProfile */

$this->pageTitle = Yii::app()->name;

Yii::app()->clientScript->registerCoreScript("jquery");
//Yii::app()->clientScript->registerScriptFile("http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/bootstrap.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/masonry.pkgd.js");
//Yii::app()->clientScript->registerScriptFile("js/jquery.isotope.min.js");
//Yii::app()->clientScript->registerScriptFile("js/mql.js");
//Yii::app()->clientScript->registerScriptFile("js/reddit.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/script.js");
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=781878328510041&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div id="searchDiv">
    <div class="container">
        <div class="col-lg-15">
            <?php
            $this->renderPartial('search', array(
                'model' => $model,
            ));
            ?> 
        </div>
        <div class="col-lg-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Wedding Geek Online Community
                </div>
                <div class="panel-body">
                    <div class="fb-like-box" data-href="https://www.facebook.com/FacebookDevelopers" data-colorscheme="light" data-show-faces="false" data-header="true" data-stream="false" data-show-border="true"></div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="container">
    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php elseif (Yii::app()->user->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>

    <div class="text-center">

        <div class="colorPallete">  
            <span style="background-color: #fff;">
                <?php
                echo CHtml::link('&nbsp;&nbsp;/&nbsp;&nbsp;', array('site/index'));
                ?>
            </span>
            <?php
            $str = '["#D52C38", "#FDB54F", "#FEF08E", "#91CA77", "#53BCC3", "#476CB0", "#8E67B3", "#F0C0CD", "#EB338E", "#E5CFA2", "#A86C5D", "#FFFFFF", "#D6D6D6", "#333333"]';

            $hexs = json_decode($str);

            foreach ($hexs as $hex) {
                ?>

                <?php
                if ($colorTag == $hex) {
                    echo '>>';
                }
                ?>
                <span style="background-color: <?php echo $hex; ?>">

                    <?php
                    echo CHtml::link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', array('site/index', 'hex' => $hex));
                    ?>
                </span>


                <?php
                if ($colorTag == $hex) {
                    echo '<<';
                }
                ?>
                <?php
            }
            ?>

        </div>
    </div>

    <?php if ($colorTag == NULL): ?>
        <?php $this->widget('FeaturedProjects'); ?>
    <?php else: ?>
        <div id="posts" class="row isotope">
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_colorView',
                'summaryText' => ''
            ));
            ?>
        </div>
    <?php endif; ?>
</div>

