<?php
/* @var $this TodocommentController */
/* @var $model Todocomment */

$this->breadcrumbs=array(
	'Todocomments'=>array('index'),
	$model->commentid,
);

$this->menu=array(
	array('label'=>'List Todocomment', 'url'=>array('index')),
	array('label'=>'Create Todocomment', 'url'=>array('create')),
	array('label'=>'Update Todocomment', 'url'=>array('update', 'id'=>$model->commentid)),
	array('label'=>'Delete Todocomment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->commentid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Todocomment', 'url'=>array('admin')),
);
?>

<h1>View Todocomment #<?php echo $model->commentid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'commentid',
		'todoid',
		'userid',
		'comment',
		'cdate',
	),
)); ?>
