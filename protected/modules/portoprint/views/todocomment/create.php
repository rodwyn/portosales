<?php
/* @var $this TodocommentController */
/* @var $model Todocomment */

$this->breadcrumbs=array(
	'Todocomments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Todocomment', 'url'=>array('index')),
	array('label'=>'Manage Todocomment', 'url'=>array('admin')),
);
?>

<h1>Create Todocomment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>