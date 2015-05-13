<form method="post" action="?r=portoprint/rate/savezero/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'ratezero-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">
		<header>
				<strong>Prueba Cero</strong>
		</header>
		<fieldset>
			<div class="row">
				<section class="col col-6">
					<label class="label">Fecha de entrega mensajería</label>
					<label class="input">
						<input type="text" class="date input-xs" value="<?php echo $model->courierdeliverydate; ?>" id="Ratezerotest_courierdeliverydate_<? echo $model->rateid; ?>" name="Ratezerotest[courierdeliverydate]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Fecha de entrega cliente</label>
					<label class="input">
						<input type="text" class="date input-xs" value="<?php echo $model->customerdeliverydate; ?>" id="Ratezerotest_customerdeliverydate_<? echo $model->rateid; ?>" name="Ratezerotest[customerdeliverydate]">
					</label>					
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Quién recibe cliente</label>
					<label class="input">
						<input type="text" class="input-xs" value="<?php echo $model->receivercustomer; ?>" id="Ratezerotest_receivercustomer" name="Ratezerotest[receivercustomer]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Cantidad de pruebas entregadas</label>
					<label class="input">
						<input type="text" class="input-xs" value="<?php echo $model->deliverytestnumber; ?>" id="Ratezerotest_deliverytestnumber" name="Ratezerotest[deliverytestnumber]">
					</label>					
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Autorizó</label>
					<div class="inline-group">
						<label class="radio">
							<input type="radio" class="input-xs" <?php echo ($model->authorization)?"checked='checked'":""; ?> name="Ratezerotest[authorization]" value="1" id="Ratezerotest_authorization_0_<? echo $model->rateid; ?>">
							<i></i>Si
						</label>	
						<label class="radio">
							<input type="radio"  class="input-xs" <?php echo ($model->authorization)?"":"checked='checked'"; ?> name="Ratezerotest[authorization]" value="0" id="Ratezerotest_authorization_1_<? echo $model->rateid; ?>">
							<i></i>No
						</label>
					</div>					
				</section>
				<section class="col col-6">
					<label class="label">Motivo de rechazo</label>
					<label class="input">
						<input type="text" class="input-xs" value="<?php echo $model->rejectreason; ?>" id="Ratezerotest_rejectreason" name="Ratezerotest[rejectreason]">
					</label>		
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Prueba cero autorizada por</label>
					<label class="input">
						<input type="text" class="input-xs" value="<?php echo $model->zerotestauthorization; ?>" id="Ratezerotest_zerotestauthorization" name="Ratezerotest[zerotestauthorization]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Fecha de autorización</label>
					<label class="input">
						<input type="text" class="date input-xs" value="<?php echo $model->authorizationtest; ?>" id="Ratezerotest_authorizationtest" name="Ratezerotest[authorizationtest]">
					</label>					
				</section>
			</div>
			<div class="row">				
				<section class="col col-6">
					<label class="label">Entrega Programada</label>
					<label class="input">
						<input type="text" class="date input-xs" value="<?php echo $model->scheduleddelivery; ?>" id="Ratezerotest_scheduleddelivery" name="Ratezerotest[scheduleddelivery]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Entrega Real</label>
					<label class="input">
						<input type="text" class="date input-xs" value="<?php echo $model->realdelivery; ?>" id="Ratezerotest_realdelivery" name="Ratezerotest[realdelivery]">
					</label>					
				</section>
			</div>
			<footer>
				<div style="text-align:center;" >
				<button type="submit" class="btn btn-primary">Guardar</button>	</div>
			</footer>
		</fieldset>
</form>
