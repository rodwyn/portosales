<?php
/* @var $this DesignagencyController */
/* @var $model Designagency */

$this->breadcrumbs=array(
	'Designagencies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Designagency', 'url'=>array('index')),
	array('label'=>'Manage Designagency', 'url'=>array('admin')),
);
?>

<h1>Create Designagency</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>