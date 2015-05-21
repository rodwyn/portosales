<?php

class ProductController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionGetCats() {
        $this->layout=false;
        $cats = Category::model()->findAllByAttributes(array("corporateid" => Yii::app()->user->corporateid, "active" => 1, "parentid" => 0));
        $this->renderPartial('cats', array('cats'=>$cats));
    }
    
    public function actionGetProducts() {
        $this->layout=false;
        $pro = Product::model()->productbycat($_GET["categoryid"]);
        $this->renderPartial('product', array('pro'=>$pro));
    }
    public function actionGetProducts2() {
        $this->layout=false;
        $pro = Product::model()->productbytxt($_GET["txt"]);
        $this->renderPartial('product', array('pro'=>$pro));
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
