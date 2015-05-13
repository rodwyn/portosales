<?php
 class messages{
  static public function  getMessagesSupplierSend($rate, $contact){
            
            $model=  Rate::model()->modelByRateid($rate);
            
            $datet = $model->ratedate;
            $nuevafecha = strtotime('+5 hours', strtotime($datet));
            $fechaff = date('Y-m-j H:i:s', $nuevafecha);
            
           return $message="<p>Hola ".$contact."</p>"
            ."<p>Este correo electr&oacute;nico est&aacute; referido al pedido de cotizaci&oacute;n para el ID ".$model->idVersion()  . "  " . $model->servicedsc ." mencionado abajo. Por favor, ingrese a la aplicaci&oacute;n y responda el requerimiento. Recuerde que el tiempo m&aacute;ximo de respuesta es de 2 hs.</p>"
	    ."<p>Puede hacerlo seleccionando el siguiente v&iacute;nculo.</p>"
	    ."<p><a href='http://www.sps-portoprint.com/Portal'>http://www.sps-portoprint.com/Portal</a></p>"
	    ."<p><strong><i>Informaci&oacute;n de Cotizaci&oacute;n:</i></strong><br />"
	    ."Portoprint ID: ".$model->idVersion()  . "<br />"
	    ."Nombre de Cotizaci&oacute;n: " . $model->servicedsc ."<br />"
	    ."Usuario:  ".Yii::app()->user->userid."<br />"
	    ."Fecha de Entrega del trabajo: XXX</p>"
	    ."<p><strong><i>Informaci&oacute;n del Evento:</i></strong><br />"
	    ."Tipo de Cotizaci&oacute;n: ".$model->ratetype  ."<br />"
	    ."Fecha de Invitaci&oacute;n: ".$model->ratebidsheet  ."<br />"
	    ."Fecha Esperada de Respuesta: ".$fechaff."<br />"
	    ."Fecha Inicio: ".$model->ratedate  ."<br />"
	    ."Fecha Finalizaci&oacute;n: ".$fechaff."</p>"
	    ."<p><strong><i>Informaci&oacute;n de Contacto Portoprint:</i></strong><br />"
	    ."Nombre del Contacto Portoprint: Maximiliano Douek<br />"
	    ."Tel&eacute;fono del Contacto Portoprint: 3088-4300<br />"
	    ."Correo electr&oacute;nico del Contacto Portoprint: ndouek@portoprint.mx</p>"
	    ."<p>Por favor no responda este correo electr&oacute;nico ya que no se reciben mensajes en esta direcci&oacute;n.</p>"
	    ."<p>Si ha recibido este correo electr&oacute;nico autom&aacute;tico por error cont&aacute;ctenos en info@portoprint.mx</p>";		
		//return $message;		
	}
        static public function getMessagerating($bundleid,$userid,$rateid,$evaluationid,$cantidad) {
            $model = Rate::model()->bundleByRate($bundleid, $userid, $rateid);
            $mensaje = "";
            foreach($model as $row){
                
                $mensaje .= "<p>Hola ".$row->proveedor.".</p>"
                         .  "<p>Esta notificación de correo electrónico está referida al ID ".$row->rateid." ".$row->servicedsc.".</p>"
                         .  "<p>Este ID ha sido calificado y se ha asignado un número de confirmación para el trabajo. Recuerde que es indispensable presentar este documento impreso al momento de ingresar su factura a revisión.</p>"
                         .  "<p>Información de Cotización:</p>"
                         .  "<p>Portoprint ID: ".$row->rateid."</p>"
                         .  "<p>Nombre de Cotización: ".$row->servicedsc."</p>"
                         .  "<p>Usuario: ".$row->usuario."</p>"
                         .  "<p>Cantidad: ".$row->quantityselect."</p>"
                         .  "<p>Cantidad por calificar: ".$row->resto."</p>"
                         .  "<p>Cantidad calificada: ".$cantidad."</p>"
                         .  "<p>Numero de confirmación: ".str_pad($evaluationid, 8, "0", STR_PAD_LEFT)."</p>"
                         .  "<br>"
                         .  "<p>Información de Contacto Portoprint:</p>"
                         
                         .  "<p>Teléfono del Contacto Portoprint: 30-88-43-00</p>"
                         .  "<p>Correo electrónico del Contacto Portoprint: info@portoprint.mx</p>"
                         .  "<p>Por favor no responda este correo electrónico ya que no se reciben mensajes en esta dirección.</p>"
                         .  "<p>Si ha recibido este correo electrónico automático por error contáctenos en info@portoprint.mx</p>";
            }
            
            return $mensaje;
            
        }
 }