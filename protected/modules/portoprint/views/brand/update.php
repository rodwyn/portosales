<?php
/* @var $this BrandController */
/* @var $model Brand */

$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->brandid=>array('view','id'=>$model->brandid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Brand', 'url'=>array('index')),
	array('label'=>'Create Brand', 'url'=>array('create')),
	array('label'=>'View Brand', 'url'=>array('view', 'id'=>$model->brandid)),
	array('label'=>'Manage Brand', 'url'=>array('admin')),
);
?>

<h1>Update Brand <?php echo $model->brandid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>