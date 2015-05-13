<?php
/* @var $this CustomerlegalentityController */
/* @var $model Customerlegalentity */

$this->breadcrumbs=array(
	'Customerlegalentities'=>array('index'),
	$model->customerlegalentityid,
);

$this->menu=array(
	array('label'=>'List Customerlegalentity', 'url'=>array('index')),
	array('label'=>'Create Customerlegalentity', 'url'=>array('create')),
	array('label'=>'Update Customerlegalentity', 'url'=>array('update', 'id'=>$model->customerlegalentityid)),
	array('label'=>'Delete Customerlegalentity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->customerlegalentityid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Customerlegalentity', 'url'=>array('admin')),
);
?>

<h1>View Customerlegalentity #<?php echo $model->customerlegalentityid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'customerlegalentityid',
		'legalentity',
		'rfc',
		'street',
		'number',
		'neighborhood',
		'zipcode',
		'cityid',
		'active',
		'customerid',
	),
)); ?>
