<?php
/* @var $this UserareaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Userareas',
);

$this->menu=array(
	array('label'=>'Create Userarea', 'url'=>array('create')),
	array('label'=>'Manage Userarea', 'url'=>array('admin')),
);
?>

<h1>Userareas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
