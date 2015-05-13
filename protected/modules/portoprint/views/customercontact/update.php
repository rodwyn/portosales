<?php
/* @var $this CustomercontactController */
/* @var $model Customercontact */

$this->breadcrumbs=array(
	'Customercontacts'=>array('index'),
	$model->name=>array('view','id'=>$model->contactid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Customercontact', 'url'=>array('index')),
	array('label'=>'Create Customercontact', 'url'=>array('create')),
	array('label'=>'View Customercontact', 'url'=>array('view', 'id'=>$model->contactid)),
	array('label'=>'Manage Customercontact', 'url'=>array('admin')),
);
?>

<h1>Update Customercontact <?php echo $model->contactid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>