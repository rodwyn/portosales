<?php
/* @var $this WarehouseController */
/* @var $model Warehouse */

$this->breadcrumbs=array(
	'Warehouses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Warehouse', 'url'=>array('index')),
	array('label'=>'Create Warehouse', 'url'=>array('create')),
	array('label'=>'Update Warehouse', 'url'=>array('update', 'id'=>$model->warehouseid)),
	array('label'=>'Delete Warehouse', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->warehouseid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Warehouse', 'url'=>array('admin')),
);
?>

<h1>View Warehouse #<?php echo $model->warehouseid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'warehouseid',
		'customerid',
		'name',
		'adress',
		'neighborhood',
		'schedule',
		'contact',
		'phone',
		'email',
		'special',
		'active',
	),
)); ?>
