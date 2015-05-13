<?php
/* @var $this TodocommentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Todocomments',
);

$this->menu=array(
	array('label'=>'Create Todocomment', 'url'=>array('create')),
	array('label'=>'Manage Todocomment', 'url'=>array('admin')),
);
?>

<h1>Todocomments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
