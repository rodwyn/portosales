<?php
/* @var $this CustomercontactController */
/* @var $model Customercontact */

$this->breadcrumbs=array(
	'Customercontacts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Customercontact', 'url'=>array('index')),
	array('label'=>'Create Customercontact', 'url'=>array('create')),
	array('label'=>'Update Customercontact', 'url'=>array('update', 'id'=>$model->contactid)),
	array('label'=>'Delete Customercontact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->contactid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Customercontact', 'url'=>array('admin')),
);
?>

<h1>View Customercontact #<?php echo $model->contactid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'customerid',
		'contactid',
		'name',
		'plastname',
		'mlastname',
		'position',
		'phone1',
		'phone2',
		'mobilephone',
		'mail',
		'birthday',
		'active',
	),
)); ?>
