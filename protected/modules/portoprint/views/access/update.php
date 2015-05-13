<?php
/* @var $this AccessController */
/* @var $model Access */

$this->breadcrumbs=array(
	'Accesses'=>array('index'),
	$model->accessid=>array('view','id'=>$model->accessid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Access', 'url'=>array('index')),
	array('label'=>'Create Access', 'url'=>array('create')),
	array('label'=>'View Access', 'url'=>array('view', 'id'=>$model->accessid)),
	array('label'=>'Manage Access', 'url'=>array('admin')),
);
?>

<h1>Update Access <?php echo $model->accessid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>