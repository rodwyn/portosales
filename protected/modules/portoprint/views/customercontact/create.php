<?php
/* @var $this CustomercontactController */
/* @var $model Customercontact */

$this->breadcrumbs=array(
	'Customercontacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Customercontact', 'url'=>array('index')),
	array('label'=>'Manage Customercontact', 'url'=>array('admin')),
);
?>

<h1>Create Customercontact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>