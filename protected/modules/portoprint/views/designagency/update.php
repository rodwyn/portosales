<?php
/* @var $this DesignagencyController */
/* @var $model Designagency */

$this->breadcrumbs=array(
	'Designagencies'=>array('index'),
	$model->designagencyid=>array('view','id'=>$model->designagencyid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Designagency', 'url'=>array('index')),
	array('label'=>'Create Designagency', 'url'=>array('create')),
	array('label'=>'View Designagency', 'url'=>array('view', 'id'=>$model->designagencyid)),
	array('label'=>'Manage Designagency', 'url'=>array('admin')),
);
?>

<h1>Update Designagency <?php echo $model->designagencyid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>