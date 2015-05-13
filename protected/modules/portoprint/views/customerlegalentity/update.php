<?php
/* @var $this CustomerlegalentityController */
/* @var $model Customerlegalentity */

$this->breadcrumbs=array(
	'Customerlegalentities'=>array('index'),
	$model->customerlegalentityid=>array('view','id'=>$model->customerlegalentityid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Customerlegalentity', 'url'=>array('index')),
	array('label'=>'Create Customerlegalentity', 'url'=>array('create')),
	array('label'=>'View Customerlegalentity', 'url'=>array('view', 'id'=>$model->customerlegalentityid)),
	array('label'=>'Manage Customerlegalentity', 'url'=>array('admin')),
);
?>

<h1>Update Customerlegalentity <?php echo $model->customerlegalentityid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>