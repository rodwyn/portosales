<?php
$this->breadcrumbs=array(
	'Rates'=>array('index'),
	$model->rateid=>array('view','id'=>$model->rateid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Rate','url'=>array('index')),
	array('label'=>'Create Rate','url'=>array('create')),
	array('label'=>'View Rate','url'=>array('view','id'=>$model->rateid)),
	array('label'=>'Manage Rate','url'=>array('admin')),
);
?>

<h1>Update Rate <?php echo $model->rateid; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>