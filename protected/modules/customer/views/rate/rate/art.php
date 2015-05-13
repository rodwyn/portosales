<form method="post" action="?r=portoprint/rate/saveart/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'rateart-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">
		<header>
				<strong>Arte</strong>
		</header>
		<fieldset>
			<div class="row">
				<section class="col col-6">
					<label class="label">Fecha de Recepción</label>
					<label class="input">
						<input type="text" value="<?php echo $model->receptiondate; ?>" class="date input-xs" id="Rateart_receptiondate_<? echo $model->rateid; ?>" name="Rateart[receptiondate]">
					</label>					
				</section>
				<section class="col col-6">
					<div class="inline-group">
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->filerevision1)?"checked='checked'":""; ?> value="1" id="Rateart_filerevision1_<? echo $model->rateid; ?>" name="Rateart[filerevision1]">
							<i></i>Overprint</label>
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->filerevision2)?"checked='checked'":""; ?> value="1" id="Rateart_filerevision2_<? echo $model->rateid; ?>" name="Rateart[filerevision2]">
							<i></i>Fuentes</label>
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->filerevision3)?"checked='checked'":""; ?> value="1" id="Rateart_filerevision3_<? echo $model->rateid; ?>" name="Rateart[filerevision3]">
							<i></i>Imagenes CMYK</label>
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->filerevision4)?"checked='checked'":""; ?> value="1" id="Rateart_filerevision4_<? echo $model->rateid; ?>" name="Rateart[filerevision4]">
							<i></i>Resolución</label>
					</div>
					
				</section>
			</div>
			<div class="row">
				<section class="col col-12">
					<label class="label">Modificaciones</label>
					<div class="inline-group">
						<label class="radio">
							<input type="radio" name="Rateart[changes]" value="1" <?php echo ($model->changes)?"checked='checked'":""; ?> id="Rateart_changes_0_<? echo $model->rateid; ?>">
							<i></i>Si
						</label>
						<label class="radio">
							<input type="radio" name="Rateart[changes]" value="0" <?php echo ($model->changes)?"":"checked='checked'"; ?> id="Rateart_changes_1_<? echo $model->rateid; ?>">
							<i></i>No
						</label>
					</div>
					
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Observación especifica</label>
					<label class="input">
						<input type="text" value="<?php echo $model->specifiedobservation; ?>" class="input-xs" id="Rateart_specifiedobservation" name="Rateart[specifiedobservation]">
					</label>
				</section>
				<section class="col col-6">
					<label class="label">Método de Recepción</label>
					<label class="input">
						<input type="text" value="<?php echo $model->receivemethod?>" class="input-xs" id="Rateart_receivemethod" name="Rateart[receivemethod]">
					</label>
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Quien autoriza la modificación</label>
					<label class="input">
						<input type="text" value="<?php echo $model->authorization; ?>" id="Rateart_authorization" name="Rateart[authorization]" class="input-xs">
					</label>
				</section>
				<section class="col col-6">
					<label class="label">Responsable de diseño</label>
					<label class="input">
						<input type="text" value="<?php echo $model->designhead; ?>" id="Rateart_designhead" name="Rateart[designhead]" class="input-xs">
					</label>
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Recibido de</label>
					<label class="input">
						<input type="text" value="<?php echo $model->receipt; ?>" id="Rateart_receipt" name="Rateart[receipt]" class="input-xs">
					</label>
				</section>
				<section class="col col-6">
					<label class="label">Tipo de archivo / versión</label>
					<label class="input">
						<input type="text" value="<?php echo $model->filetype; ?>" id="Rateart_filetype" name="Rateart[filetype]" class="input-xs">
					</label>
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Tipo de modificaciones</label>
					<label class="input">
						<input type="text" value="<?php echo $model->changestype; ?>" id="Rateart_changestype" name="Rateart[changestype]" class="input-xs">
					</label>
				</section>
				<section class="col col-6">
					<label class="label">Fecha de envio de modificación</label>
					<label class="input">
						<input type="text" value="<?php echo $model->senddate;?>" id="Rateart_senddate_<? echo $model->rateid; ?>" name="Rateart[senddate]" class="date input-xs">
					</label>
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Fecha de autorización de modificación</label>
					<label class="input">
						<input type="text" value="<?php echo $model->authorizationdate; ?>" id="Rateart_authorizationdate_<? echo $model->rateid; ?>" name="Rateart[authorizationdate]"  class="date input-xs">
					</label>
				</section>
				<section class="col col-6">
					<label class="label">Metodo de autorización</label>
					<label class="input">
						<input type="text" value="<?php echo $model->authorizationmethod;?>" id="Rateart_authorizationmethod" name="Rateart[authorizationmethod]"  class="input-xs">
					</label>
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Método de envío</label>
					<label class="input">
						<input type="text" value="<?php echo $model->sendmethod?>" id="Rateart_sendmethod" name="Rateart[sendmethod]" class="input-xs">
					</label>
				</section>
			</div>
			<footer>
				<div style="text-align:center;" >
				<button type="submit" class="btn btn-primary">Guardar</button>	</div>
			</footer>
		</fieldset>
</form>
<script>
$('.date').datepicker({
	dateFormat : 'yy-mm-dd'
	
});
</script>