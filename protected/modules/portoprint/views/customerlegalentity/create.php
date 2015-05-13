<?php
/* @var $this CustomerlegalentityController */
/* @var $model Customerlegalentity */

$this->breadcrumbs=array(
	'Customerlegalentities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Customerlegalentity', 'url'=>array('index')),
	array('label'=>'Manage Customerlegalentity', 'url'=>array('admin')),
);
?>

<h1>Create Customerlegalentity</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>