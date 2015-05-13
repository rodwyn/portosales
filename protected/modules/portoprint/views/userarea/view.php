<?php
/* @var $this UserareaController */
/* @var $model Userarea */

$this->breadcrumbs=array(
	'Userareas'=>array('index'),
	$model->userareaid,
);

$this->menu=array(
	array('label'=>'List Userarea', 'url'=>array('index')),
	array('label'=>'Create Userarea', 'url'=>array('create')),
	array('label'=>'Update Userarea', 'url'=>array('update', 'id'=>$model->userareaid)),
	array('label'=>'Delete Userarea', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->userareaid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Userarea', 'url'=>array('admin')),
);
?>

<h1>View Userarea #<?php echo $model->userareaid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'userareaid',
		'userid',
		'areaid',
	),
)); ?>
