<?php foreach ($reviews as $userReview): ?>
    <div class="comment">
        <div class="author">
            <?php echo $userReview->author->Name; ?>: on <?php echo date('F j, Y \a\t h:i a', strtotime($userReview->CreateTime)); ?>
        </div>
        <div class="content">
            <?php
            $this->widget('CStarRating', array(
                'name' => $userReview->ID,
                'value' => $userReview->Rating,
                'readOnly' => true,
                'minRating' => 1,
                'maxRating' => 5,
            ));
            ?><br/>
            <?php echo nl2br(CHtml::encode($userReview->Content)); ?>

        </div>
        <hr>
    </div><!-- comment -->
<?php endforeach; ?>