<?php
/* @var $this TodocommentController */
/* @var $model Todocomment */

$this->breadcrumbs=array(
	'Todocomments'=>array('index'),
	$model->commentid=>array('view','id'=>$model->commentid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Todocomment', 'url'=>array('index')),
	array('label'=>'Create Todocomment', 'url'=>array('create')),
	array('label'=>'View Todocomment', 'url'=>array('view', 'id'=>$model->commentid)),
	array('label'=>'Manage Todocomment', 'url'=>array('admin')),
);
?>

<h1>Update Todocomment <?php echo $model->commentid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>