<?php
/* @var $this VendorProfileController */
/* @var $dataProvider CActiveDataProvider */

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

    <!--<div class="row">-->
    <!--<div class="col-sm-14 col-sm-offset-3">-->
    <!--<div class="welcomeText">-->
    <h3 class="searchResult text-muted">
        Category: 
        <?php
        if ($model->Category != NULL) {
            echo $model->category->Name;
        } else {
            echo 'All';
        }
        ?>
        | Location: 
        <?php
        if ($model->City != NULL) {
            echo $model->city->Name;
        } else {
            echo 'All';
        }
        ?>
        (<?php echo $dataProvider->itemCount; ?> Vendors)
    </h3>
    <!--            </div>
            </div>
        </div>-->

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