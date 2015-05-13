<!--<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
		<h1 class="txt-color-red login-header-big">SMART PRINT SOFTWARE 2.0</h1>
		<div class="hero">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" alt="">
		</div>

		<div class="row">
			
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				Copyright &copy; <?php echo date('Y'); ?> by PortoPrint. All Rights Reserved.
			</div>
		</div>

	</div>
	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
		<div class="well no-padding">
			<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>false,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
					'htmlOptions'=>array("class"=>"smart-form client-form")
				)); ?>
				<header>
					LOGIN
				</header>

				<fieldset>
					<?php if($form->error($model,'username')!="" || $form->error($model,'password')){?>
					<div class="alert alert-danger fade in">
						<button data-dismiss="alert" class="close">
							×
						</button>
						<?php echo $form->error($model,'username')." ".$form->error($model,'password'); ?>
					</div>
					<?php } ?>
					<section>
						<label class="label">Usuario</label>
						<label class="input"> <i class="icon-append fa fa-user"></i>
							<?php echo $form->textField($model,'username',array('maxlength'=>45,'class'=>'box')); ?>
							<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i>Utilice el usuario proporcionado por el administrador</b></label>
					</section>

					<section>
						<label class="label">Contraseña</label>
						<label class="input"> <i class="icon-append fa fa-lock"></i>
							<?php echo $form->passwordField($model,'password',array('maxlength'=>45,'class'=>'box')); ?>
							<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i>Utilice la contraeña proporcionada por el administrador</b> </label>
						<div class="note">
							<a href="javascript:void(0)">Recuperar contraseña</a>
						</div>
					</section>

				</fieldset>
				<footer>
					<button type="submit" class="btn btn-primary">
						Entrar
					</button>
				</footer>
			<?php $this->endWidget(); ?>

		</div>
		
		
	</div>
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
                                
                                

