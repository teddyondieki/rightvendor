<div class="panel panel-default">
    <div class="panel-body">
        <h3 class="vendorName">
            <?php
            echo $model->BusinessName;
            ?>                    
        </h3>
        <div class="media">
            <?php
            echo CHtml::image($model->userProfile->ProfilePic == NULL ? Yii::app()->request->baseUrl . '/images/square.png' : Yii::app()->request->baseUrl . '/images/profile/' . $model->userProfile->ProfilePic, $model->BusinessName, array('class' => 'media-object pull-left'));
//            echo CHtml::link($imgHtml, array('vendorProfile/view', 'id' => $model->VendorID), array('class' => 'pull-left'));
            ?>

            <div class="media-body">
                <h5 class="media-heading"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $model->city->Name ?>, Kenya</h5>
                <h5 class="media-heading"><span class="glyphicon glyphicon-pushpin"></span> <?php echo $model->category->Name; ?></h5>
            </div>
        </div>

        <hr/>

        <?php
        echo CHtml::link('Price List / Offers', array('vendorProfile/priceList', 'id' => $model->VendorID), array('class' => 'btn btn-info btn-md btn-block text-uppercase'));
        ?>

        <hr/>


        <h4 class="contact">
            <span class="glyphicon glyphicon-globe"></span> 
            <small>
                <a href="<?php echo $model->Website; ?>" target="_blank"><?php echo $model->Website; ?></a>
            </small>
        </h4>

        <h4 class="contact"> 
            <span class="glyphicon glyphicon-envelope"></span>
            <small>
                <a href="mailto:<?php echo $model->Email; ?>"> <?php echo $model->Email; ?></a>
            </small>
        </h4>
        <h4 class="contact">
            <span class="glyphicon glyphicon-earphone"></span> 
            <small>
                <a href="tel:<?php echo $model->Phonenumber; ?>"><?php echo $model->Phonenumber; ?></a>                
            </small>
        </h4>

        <hr/>
        <span>
            <?php echo $model->Address; ?>
        </span>
        <?php if ($model->VendorID != Yii::app()->user->id): ?>
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
