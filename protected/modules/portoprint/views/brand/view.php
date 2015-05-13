<?php
/* @var $this BrandController */
/* @var $model Brand */

$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->brandid,
);

$this->menu=array(
	array('label'=>'List Brand', 'url'=>array('index')),
	array('label'=>'Create Brand', 'url'=>array('create')),
	array('label'=>'Update Brand', 'url'=>array('update', 'id'=>$model->brandid)),
	array('label'=>'Delete Brand', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->brandid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Brand', 'url'=>array('admin')),
);
?>

<h1>View Brand #<?php echo $model->brandid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'brandid',
		'customerid',
		'branddsc',
		'active',
	),
)); ?>
