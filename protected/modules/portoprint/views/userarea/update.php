<?php
/* @var $this UserareaController */
/* @var $model Userarea */

$this->breadcrumbs=array(
	'Userareas'=>array('index'),
	$model->userareaid=>array('view','id'=>$model->userareaid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Userarea', 'url'=>array('index')),
	array('label'=>'Create Userarea', 'url'=>array('create')),
	array('label'=>'View Userarea', 'url'=>array('view', 'id'=>$model->userareaid)),
	array('label'=>'Manage Userarea', 'url'=>array('admin')),
);
?>

<h1>Update Userarea <?php echo $model->userareaid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>