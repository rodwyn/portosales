<!-- form <?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
-->
<div class="row">
        <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                        <div class="center">
                                <h1>
                                        <i class="ace-icon fa fa-leaf green"></i>
                                        <span class="red">Ace</span>
                                        <span class="white" id="id-text2">Application</span>
                                </h1>
                                <h4 class="blue" id="id-company-text">&copy; Company Name</h4>
                        </div>

                        <div class="space-6"></div>

                        <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                        <div class="widget-body">
                                                <div class="widget-main">
                                                        <h4 class="header blue lighter bigger">
                                                                <i class="ace-icon fa fa-coffee green"></i>
                                                                LOGIN
                                                        </h4>

                                                        <div class="space-6"></div>

                                                        <?php $form=$this->beginWidget('CActiveForm', array(
                                                                'id'=>'login-form',
                                                                'enableClientValidation'=>false,
                                                                'clientOptions'=>array(
                                                                        'validateOnSubmit'=>true,
                                                                ),
                                                                'htmlOptions'=>array("class"=>"")
                                                        )); ?>
                                                        
                                                        <!--<form>-->
                                                                <fieldset>
                                                                    
                                                                  
                                                                    
                                                                    
                                                                        <label class="block clearfix">
                                                                                <span class="block input-icon input-icon-right">
                                                                                    <?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
                                                                                    
                                                                                    <!--    <input type="text" class="form-control" placeholder="Username" />-->
                                                                                        <i class="ace-icon fa fa-user"></i>
                                                                                </span>
                                                                        </label>

                                                                        <label class="block clearfix">
                                                                                <span class="block input-icon input-icon-right">
                                                                                    <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
                                                                                    
                                                                                       <!-- <input type="password" class="form-control" placeholder="Password" />-->
                                                                                        <i class="ace-icon fa fa-lock"></i>
                                                                                </span>
                                                                        </label>

                                                                    <!--<div class="space">-->
                                                                        
                                                                          <?php if($form->error($model,'username')!="" || $form->error($model,'password')){?>
                                                                                  <div class="alert alert-danger">
                                                                                            <button type="button" class="close" data-dismiss="alert">
                                                                                                    <i class="ace-icon fa fa-times"></i>
                                                                                            </button>

                                                                                            <strong>
                                                                                                    
                                                                                                   <?php echo $form->error($model,'username')." ".$form->error($model,'password'); ?>
                                                                                            </strong>

                                                                                            
                                                                                            <br />
                                                                                    </div>
                                                                                  <?php } ?>
                                                                        
                                                                    <!--</div>-->

                                                                        <div class="clearfix">
                                                                                <label class="inline">
                                                                                        <input type="checkbox" class="ace" />
                                                                                        <span class="lbl"> Recordar</span>
                                                                                </label>
                                                                                <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                                                        <i class="ace-icon fa fa-key"></i>
                                                                                        <span class="bigger-110">Accesar</span>
                                                                                </button>
                                                                        </div>

                                                                        <div class="space-4"></div>
                                                                </fieldset>
                                                        <!--</form>-->
                                                        <?php $this->endWidget(); ?>
                                                        
                                                        
                                                        
                                                </div><!-- /.widget-main -->

                                                <div class="toolbar clearfix">
                                                        <div>
                                                                <a data-target="#forgot-box" class="forgot-password-link" href="javascript:void(0)">
                                                                        <i class="ace-icon fa fa-arrow-left"></i>
                                                                        Olvidaste Contraseña?
                                                                </a>
                                                        </div>

                                                        
                                                </div>
                                        </div><!-- /.widget-body -->
                                </div><!-- /.login-box -->

                                <div id="forgot-box" class="forgot-box widget-box no-border">
                                        <div class="widget-body">
                                                <div class="widget-main">
                                                        <h4 class="header red lighter bigger">
                                                                <i class="ace-icon fa fa-key"></i>
                                                                Regresar Contraseña
                                                        </h4>

                                                        <div class="space-6"></div>
                                                        <p>
                                                                Ingresa un usuario valido, se enviara por correo la contraseña vinculada al Usuario.
                                                        </p>

                                                        <form>
                                                                <fieldset>
                                                                        <label class="block clearfix">
                                                                                <span class="block input-icon input-icon-right">
                                                                                        <input type="email" class="form-control" placeholder="Email" />
                                                                                        <i class="ace-icon fa fa-envelope"></i>
                                                                                </span>
                                                                        </label>

                                                                        <div class="clearfix">
                                                                                <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                                                                        <i class="ace-icon fa fa-lightbulb-o"></i>
                                                                                        <span class="bigger-110">Enviar!</span>
                                                                                </button>
                                                                        </div>
                                                                </fieldset>
                                                        </form>
                                                </div><!-- /.widget-main -->

                                                <div class="toolbar center">
                                                        <a href="#" data-target="#login-box" class="back-to-login-link">
                                                                Regresar a Login
                                                                <i class="ace-icon fa fa-arrow-right"></i>
                                                        </a>
                                                </div>
                                        </div><!-- /.widget-body -->
                                </div><!-- /.forgot-box -->

                                
                        </div><!-- /.position-relative -->

                        <div class="navbar-fixed-top align-right">
                                <br />
                                &nbsp;
                                <a id="btn-login-dark" href="#">Dark</a>
                                &nbsp;
                                <span class="blue">/</span>
                                &nbsp;
                                <a id="btn-login-blur" href="#">Blur</a>
                                &nbsp;
                                <span class="blue">/</span>
                                &nbsp;
                                <a id="btn-login-light" href="#">Light</a>
                                &nbsp; &nbsp; &nbsp;
                        </div>
                </div>
        </div><!-- /.col -->
</div><!-- /.row -->
                                