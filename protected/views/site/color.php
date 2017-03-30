<?php
/* @var $this GalleryImageController */
/* @var $dataProvider CActiveDataProvider */

//$this->breadcrumbs = array(
//    'Gallery Images',
//);


Yii::app()->clientScript->registerCoreScript("jquery");
//Yii::app()->clientScript->registerScriptFile("http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/bootstrap.min.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/masonry.pkgd.js");
//Yii::app()->clientScript->registerScriptFile("js/jquery.isotope.min.js");
//Yii::app()->clientScript->registerScriptFile("js/mql.js");
//Yii::app()->clientScript->registerScriptFile("js/reddit.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/script.js");
?>

<div id="searchDiv">
    <div class="container">

        <?php
        $this->renderPartial('search', array(
            'model' => $model,
        ));
        ?> 
    </div>
</div>

<div class="container">
    <div class="text-center">

        <div class="colorPallete">                 
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
                    echo CHtml::link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', array('site/color', 'hex' => $hex));
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

    <div id="posts" class="row isotope">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_colorView',
//            'summaryText' => ''
        ));
        ?>
    </div>

</div>