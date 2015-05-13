<form method="post" action="?r=portoprint/rate/saveproduction/id/<? echo Utils::encrypt($model->rateid, 'rate'); ?>" id="<? echo 'rateproduction-'.$model->rateid.'-form'; ?>" novalidate="novalidate" class="smart-form">
		<header>
				<strong>Producción</strong>
		</header>
		<fieldset>
			<div class="row">
				<section class="col col-6">
					<label class="label">Fecha de Autorización</label>
					<label class="input">
						<input type="text" value="<?php echo $model->authorizationdate; ?>" class="date input-xs" id="Rateproduction_authorizationdate_<? echo $model->rateid; ?>" name="Rateproduction[authorizationdate]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Quien Autoriza</label>
					<label class="input">
						<input type="text" value="<?php echo $model->authorized; ?>" class="input-xs" id="Rateproduction_authorized" name="Rateproduction[authorized]">
					</label>					
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Fecha y hora de entrada a maquina</label>
					<label class="input">
						<input type="text" value="<?php echo $model->datetimeproduction; ?>" class="date input-xs" id="Rateproduction_datetimeproduction_<? echo $model->rateid; ?>" name="Rateproduction[datetimeproduction]">
					</label>					
				</section>
				
				<section class="col col-6">
					<label class="label">Tipo de archivo / versión</label>
					<label class="input">
						<input type="text" value="<?php echo $model->filetype; ?>" class="input-xs" id="Rateproduction_filetype" name="Rateproduction[filetype]">
					</label>					
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<div class="inline-group">
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->color)?"checked='checked'":""; ?> value="1" id="Rateproduction_color_<? echo $model->rateid; ?>" name="Rateproduction[color]">
							<i></i>Color</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->record)?"checked='checked'":""; ?> value="1" id="Rateproduction_record_<? echo $model->rateid; ?>" name="Rateproduction[record]">
							<i></i>Registro</label>			
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->piojos)?"checked='checked'":""; ?> value="1" id="Rateproduction_piojos_<? echo $model->rateid; ?>" name="Rateproduction[piojos]">
							<i></i>Piojos</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->banded)?"checked='checked'":""; ?> value="1" id="Rateproduction_banded_<? echo $model->rateid; ?>" name="Rateproduction[banded]">
							<i></i>Bandeado</label>	
					</div>			
				</section>
				<section class="col col-6">
					<label class="label">Cantidad y empaque</label>
					<label class="input">
						<input type="text" value="<?php echo $model->quantity; ?>" class="input-xs" id="Rateproduction_quantity" name="Rateproduction[quantity]">
					</label>					
				</section>
			</div>
			<div class="row">
				<section class="col col-12">
					<div class="inline-group">
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->font)?"checked='checked'":""; ?> value="1" id="Rateproduction_font_<? echo $model->rateid; ?>" name="Rateproduction[font]">
							<i></i>Fuente</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->text)?"checked='checked'":""; ?> value="1" id="Rateproduction_text_<? echo $model->rateid; ?>" name="Rateproduction[text]">
							<i></i>Texto</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->uvrecord)?"checked='checked'":""; ?> value="1" id="Rateproduction_uvrecord_<? echo $model->rateid; ?>" name="Rateproduction[uvrecord]">
							<i></i>Uv Registro</label>								
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->uvcake)?"checked='checked'":""; ?> value="1" id="Rateproduction_uvcake_<? echo $model->rateid; ?>" name="Rateproduction[uvcake]">
							<i></i>Uv Plasta</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->splice)?"checked='checked'":""; ?> value="1" id="Rateproduction_splice_<? echo $model->rateid; ?>" name="Rateproduction[splice]">
							<i></i>Empalme</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->laminate)?"checked='checked'":""; ?> value="1" id="Rateproduction_laminate_<? echo $model->rateid; ?>" name="Rateproduction[laminate]">
							<i></i>Laminado</label>		
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->measures)?"checked='checked'":""; ?> value="1" id="Rateproduction_measures_<? echo $model->rateid; ?>" name="Rateproduction[measures]">
							<i></i>Medidas</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->reline)?"checked='checked'":""; ?> value="1" id="Rateproduction_reline_<? echo $model->rateid; ?>" name="Rateproduction[reline]">
							<i></i>Rebases</label>									
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->suaje)?"checked='checked'":""; ?> value="1" id="Rateproduction_suaje_<? echo $model->rateid; ?>" name="Rateproduction[suaje]">
							<i></i>Suaje</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->paste)?"checked='checked'":""; ?> value="1" id="Rateproduction_paste_<? echo $model->rateid; ?>" name="Rateproduction[paste]">
							<i></i>Pegue</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->refine)?"checked='checked'":""; ?> value="1" id="Rateproduction_refine_<? echo $model->rateid; ?>" name="Rateproduction[refine]">
							<i></i>Refine</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->fold)?"checked='checked'":""; ?> value="1" id="Rateproduction_fold_<? echo $model->rateid; ?>" name="Rateproduction[fold]">
							<i></i>Doblez</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->images)?"checked='checked'":""; ?> value="1" id="Rateproduction_images_<? echo $model->rateid; ?>" name="Rateproduction[images]">
							<i></i>Imagenes</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->inks)?"checked='checked'":""; ?> value="1" id="Rateproduction_inks_<? echo $model->rateid; ?>" name="Rateproduction[inks]">
							<i></i>Tintas</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->staple)?"checked='checked'":""; ?> value="1" id="Rateproduction_staple_<? echo $model->rateid; ?>" name="Rateproduction[staple]">
							<i></i>Engrapados</label>	
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->hotmelt)?"checked='checked'":""; ?> value="1" id="Rateproduction_hotmelt_<? echo $model->rateid; ?>" name="Rateproduction[hotmelt]">
							<i></i>Hot melt</label>
						<label class="checkbox">
							<input type="checkbox" <?php echo ($model->maquilas)?"checked='checked'":""; ?> value="1" id="Rateproduction_maquilas_<? echo $model->rateid; ?>" name="Rateproduction[maquilas]">
							<i></i>Maquilas</label>
					</div>			
				</section>
				
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Tiraje</label>
					<label class="input">
						<input type="text" value="<?php echo $model->printing; ?>" class="input-xs"id="Rateproduction_printing" name="Rateproduction[printing]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Muestras revisadas</label>
					<label class="input">
						<input type="text" value="<?php echo $model->revisedsamples; ?>" class="input-xs" id="Rateproduction_revisedsamples" name="Rateproduction[revisedsamples]">
					</label>					
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Autorizó producción</label>
					<label class="input">
						<input type="text" value="<?php echo $model->authorizationproduccion; ?>" class="input-xs" id="Rateproduction_authorizationproduccion" name="Rateproduction[authorizationproduccion]">
					</label>					
				</section>
				<section class="col col-6">
					<label class="label">Fecha de autorización</label>
					<label class="input">
						<input type="text"  value="<?php echo $model->authorizationdate2; ?>" class="date input-xs" id="Rateproduction_authorizationdate2_<? echo $model->rateid; ?>" name="Rateproduction[authorizationdate2]">
					</label>					
				</section>
			</div>
			<div class="row">
				<section class="col col-6">
					<label class="label">Observaciones</label>
					<label class="input">
						<input type="text"  value="<?php echo $model->comments; ?>" class="input-xs" id="Rateproduction_comments" name="Rateproduction[comments]">
					</label>					
				</section>
				<section class="col col-6"></section>
			</div>
			<footer>
				<div style="text-align:center;" >
				<button type="submit" class="btn btn-primary">Guardar</button>	</div>
			</footer>
		</fieldset>
</form>

