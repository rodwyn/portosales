<form method="post" action="?r=portoprint/rate/savecolor/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'ratecolor-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">
		<header>
				<strong>Prueba de color</strong>
		</header>
		<fieldset>
			<div class="row">
				<section class="col col-6">
					<label class="label">Fecha de elaboración</label>
					<label class="input">
						<input type="text" value="<?php echo $model->productiondate; ?>" class="date input-xs"  id="Ratecolortest_productiondate" name="Ratecolortest[productiondate]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Tipo de prueba de color</label>
					<label class="input">
						<input type="text" value="<?php echo $model->testcolortype; ?>" class="input-xs" id="Ratecolortest_testcolortype" name="Ratecolortest[testcolortype]">
					</label>					
				</section>
			</div>
			
			<div class="row">
				<section class="col col-6">
					<label class="label">Quién elaboró</label>
					<label class="input">
						<input type="text" value="<?php echo $model->production; ?>" class="input-xs" id="Ratecolortest_production" name="Ratecolortest[production]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Fecha de entrega de mensajería</label>
					<label class="input">
						<input type="text" value="<?php echo $model->courierdeliverydate; ?>" class="date input-xs" id="Ratecolortest_courierdeliverydate" name="Ratecolortest[courierdeliverydate]">
					</label>					
				</section>
			</div>
			
			<div class="row">
				<section class="col col-6">
					<label class="label">Quien recibe mensajería</label>
					<label class="input">
						<input type="text" value="<?php echo $model->receivercourier; ?>" class="input-xs" id="Ratecolortest_receivercourier" name="Ratecolortest[receivercourier]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Fecha de entrega a cliente</label>
					<label class="input">
						<input type="text" value="<?php echo $model->cutomerdeliverydate; ?>" class="date input-xs" id="Ratecolortest_cutomerdeliverydate" name="Ratecolortest[cutomerdeliverydate]">
					</label>					
				</section>
			</div>
			
			<div class="row">
				<section class="col col-6">
					<label class="label">Quien recibe cliente</label>
					<label class="input">
						<input type="text" value="<?php echo $model->receivercustomer; ?>" class="input-xs" id="Ratecolortest_receivercustomer" name="Ratecolortest[receivercustomer]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Fecha de entrega a proveedor</label>
					<label class="input">
						<input type="text" value="<?php echo $model->supplierdeliverydate; ?>" class="date input-xs" id="Ratecolortest_supplierdeliverydate" name="Ratecolortest[supplierdeliverydate]">
					</label>					
				</section>
			</div>
			
			<div class="row">
				<section class="col col-6">
					<label class="label">La prueba fue autorizada</label>
					<div class="inline-group">
						<label class="radio">
							<input type="radio" name="Ratecolortest[authorizationtest]" value="1" <?php echo ($model->authorizationtest)?"checked='checked'":""; ?> id="Ratecolortest_authorizationtest_0_<? echo $model->rateid; ?>">
							<i></i>Si
						</label>
						<label class="radio">
							<input type="radio" name="Ratecolortest[authorizationtest]" value="0" <?php echo ($model->authorizationtest)?"":"checked='checked'"; ?> id="Ratecolortest_authorizationtest_1_<? echo $model->rateid; ?>">
							<i></i>No
						</label>
					</div>					
				</section>
				<section class="col col-6">
					<label class="label">Motivo de rechazo</label>
					<label class="input">
						<input type="text" value="<?php echo $model->rejectreason; ?>" class="input-xs" id="Ratecolortest_rejectreason" name="Ratecolortest[rejectreason]">
					</label>					
				</section>
			</div>
			
			<div class="row">
				<section class="col col-6">
					<label class="label">Observaciones</label>
					<label class="input">
						<input type="text" value="<?php echo $model->comments; ?>" class="input-xs" id="Ratecolortest_comments" name="Ratecolortest[comments]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Fecha de autorización de modificación</label>
					<label class="input">
						<input type="text" value="<?php echo $model->authorizationdate; ?>" class="date input-xs" id="Ratecolortest_authorizationdate" name="Ratecolortest[authorizationdate]">
					</label>					
				</section>
			</div>
			<footer>
				<div style="text-align:center;" >
				<button type="submit" class="btn btn-primary">Guardar</button>	</div>
			</footer>
			
		</fieldset>
</form>