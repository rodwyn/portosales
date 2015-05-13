<?php
/* @var $this UserareaController */
/* @var $model Userarea */

$this->breadcrumbs=array(
	'Userareas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Userarea', 'url'=>array('index')),
	array('label'=>'Manage Userarea', 'url'=>array('admin')),
);
?>

<h1>Create Userarea</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>