<?php
/* @var $this DesignagencyController */
/* @var $model Designagency */

$this->breadcrumbs=array(
	'Designagencies'=>array('index'),
	$model->designagencyid,
);

$this->menu=array(
	array('label'=>'List Designagency', 'url'=>array('index')),
	array('label'=>'Create Designagency', 'url'=>array('create')),
	array('label'=>'Update Designagency', 'url'=>array('update', 'id'=>$model->designagencyid)),
	array('label'=>'Delete Designagency', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->designagencyid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Designagency', 'url'=>array('admin')),
);
?>

<h1>View Designagency #<?php echo $model->designagencyid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'designagencyid',
		'customerid',
		'designagencydsc',
		'active',
	),
)); ?>
