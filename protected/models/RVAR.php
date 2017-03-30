<?php

abstract class RVAR extends CActiveRecord {

    /**
     * Prepares create_time, create_user_id, update_time and update_user_
      id attributes before performing validation.
     */
    protected function beforeValidate() {
        if ($this->isNewRecord) {
            // set the create date, last updated date and the user doing the creating
            $this->CreateTime = $this->UpdateTime = new CDbExpression('NOW()');

//            $this->create_user_id = $this->update_user_id = Yii::app()->user->id;
        } else {
            //not a new record, so just set the last updated time and last updated user id
            $this->UpdateTime = new CDbExpression('NOW()');
//            $this->update_user_id = Yii::app()->user->id;
        }
        return parent::beforeValidate();
    }

}
