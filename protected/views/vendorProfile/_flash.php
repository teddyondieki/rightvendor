
    <?php if (Yii::app()->user->hasFlash('messageFailed')): ?>
        <div class="alert alert-warning fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <strong>Please <?php echo CHtml::link('Sign In', array('site/login')); ?> or <?php echo CHtml::link('Register', array('user/create')); ?> to send messages to vendors</strong> 
        </div>
    <?php endif; ?>