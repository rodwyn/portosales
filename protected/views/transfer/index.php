<style>
    .form-horizontal .form-group {margin-bottom: 0px;}

    .form-horizontal .form-group .form-control-static {padding-top: 3px; padding-bottom: 3px;}

    .etrans-info {margin: 5px 0px 0px 0px; padding: 2px; border: 1px solid #E0E2E5; background-color: #F8FAFC;}

    .tbl-transfer div.row {display: none;}
</style>

<div class="page-content-area">

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">

                <div class="col-xs-12">
                    <div class="table-header">
                        Transferencia de Propiedad
                    </div>
                    <!--origen, combos y detalles-->
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form">
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label no-padding-right" for="form-field-select-1">Origen</label>
                                        <div class="col-sm-8">
                                            <select class="col-xs-10 col-sm-10" id="form-field-select-1">
                                                <option value="">Salinas Distributions</option>
                                                <option value="">Proctec & Gamber</option>
                                                <option value="">Bacardi</option>
                                                <option value="">Pfizer</option>
                                            </select>
                                            <div class="space-18"></div>
                                            <div class="etrans-info align-left col-xs-10 col-sm-10">
                                                Paseo Ciruelos 4562 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ger_vtas@salinasd.com<br />
                                                Lomas Bandera  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  55-1234-5678 <br />
                                                Miguel Hidalgo,   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;SAD140415HD4 <br />
                                                C.P. 11580, M&eacute;xico D.F.
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form">
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label no-padding-right" for="form-field-select-1">Almac&eacute;n</label>
                                        <div class="col-sm-10">
                                            <select class="col-xs-10 col-sm-10" id="form-field-select-1">
                                                <option value="">Toluca Col&oacute;n</option>
                                                <option value="">Puebla Centro</option>
                                                <option value="">DF Chalco</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="space-8"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label no-padding-right" for="form-field-select-1">C&oacute;digo</label>
                                        <div class="col-sm-10">
                                            <input id="form-field-1" placeholder="" class="col-xs-12 col-sm-2" type="text" style="padding: 1px 4px 6px">
                                            <select class="col-xs-12 col-sm-9" id="form-field-select-1">
                                                <option value="">Pasta de Tomate "Del Campo" lata 174g</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 tbl-transfer">
                            <table id="transfer_table" class="table table-striped table-bordered table-hover tbl-display">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Descripci&oacute;n</th>
                                        <th>Piezas x Caja</th>
                                        <th>Orden de Entrada</th>
                                        <th>Lote</th>
                                        <th>Precio</th>
                                        <th>Caducidad</th>
                                        <th>Existencias</th>
                                        <th>Transferir</th>
                                        <th>Acci&oacute;n</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>435671</td>
                                        <td>Pasta de Tomate "Del Campo" lata 174g</td>
                                        <td>48</td>
                                        <td>002345</td>
                                        <td>GH3456</td>
                                        <td>9.87</td>
                                        <td>2015-03-21</td>
                                        <td>4,350</td>
                                        <td>735</td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a href="#newProduct-form" class="blue" data-target="#newTransfer-form" data-toggle="modal">
                                                    <i class="ace-icon fa fa-plus bigger-130"></i>
                                                </a>
                                                <a class="blue" href="#newTransferResumenCodigo-form" data-target="#newTransferResumenCodigo-form" data-toggle="modal">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>
                                                <a href="#" class="red">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>435671</td>
                                        <td>Pasta de Tomate "Del Campo" lata 174g</td>
                                        <td>50</td>
                                        <td>004567</td>
                                        <td>JT0987</td>
                                        <td>9.87</td>
                                        <td>2015-03-21</td>
                                        <td>3875</td>
                                        <td>420</td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a href="#newProduct-form" class="blue" data-target="#newTransfer-form" data-toggle="modal">
                                                    <i class="ace-icon fa fa-plus bigger-130"></i>
                                                </a>
                                                <a class="blue" href="#newTransferResumenCodigo-form" data-target="#newTransferResumenCodigo-form" data-toggle="modal">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>
                                                <a href="#" class="red">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>    
                                    <tr>
                                        <td>447698</td>
                                        <td>Pasta de Tomate "Del Campo" lata 174g</td>
                                        <td>48</td>
                                        <td>002307</td>
                                        <td>KL9078</td>
                                        <td>8.54</td>
                                        <td>2015-05-17</td>
                                        <td>2,100</td>
                                        <td></td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a href="#newProduct-form" class="blue" data-target="#newTransfer-form" data-toggle="modal">
                                                    <i class="ace-icon fa fa-plus bigger-130"></i>
                                                </a>
                                                <a class="blue" href="#newTransferResumenCodigo-form" data-target="#newTransferResumenCodigo-form" data-toggle="modal">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>
                                                <a href="#" class="red">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>398745</td>
                                        <td>Pasta de Tomate "Del Campo" lata 174g</td>
                                        <td>48</td>
                                        <td>002311</td>
                                        <td>KI9876</td>
                                        <td>8.32</td>
                                        <td>2014-12-12</td>
                                        <td>2,100</td>
                                        <td></td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a href="#newProduct-form" class="blue" data-target="#newTransfer-form" data-toggle="modal">
                                                    <i class="ace-icon fa fa-plus bigger-130"></i>
                                                </a>
                                                <a class="blue" href="#newTransferResumenCodigo-form" data-target="#newTransferResumenCodigo-form" data-toggle="modal">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>
                                                <a href="#" class="red">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>                                                                  
                                </tbody>
                            </table>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Cancelar
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <a class="btn btn-info" href="<?php echo Yii::app()->createUrl('request/printOrderTransfer ');?>">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Transferir
                                    </a>

                                    &nbsp; &nbsp; &nbsp;
                                    <a class="btn btn-warning" href="#newTransferVistaprevia-form" data-target="#newTransferVistaprevia-form" data-toggle="modal">
                                        <i class="ace-icon fa fa-search bigger-110"></i>
                                        Vista Previa
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PAGE CONTENT ENDS -->

<!--Ventana modal para mostrar opciones y agregar la cantidad de articulos a transferir y el destino -->
<div id="newTransfer-form" class="modal" tabindex="-1">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Agregar Destino</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="text-info"><strong>1346789012257</strong> Pasta de tomate  "Del Campo" lata 174g </h5>
                            </div>
                        </div>
                        <div class="space-8"></div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-horizontal etrans-info" role="form">
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Item</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">447698</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Piezas/Caja</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">48</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Orden de Entrada</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">002307</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Precio</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">8.54</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Caducidad</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">2015-05-17</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Existencia</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">2,100</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <p class="form-control-static text-right">Destino</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <select class="col-xs-10 col-sm-10" id="form-field-select-1">
                                                <option value="">Abarrotera Central (Suc. Centro)</option>
                                                <option value="">Abarrotera Central (Suc. Lomas Verdes)</option>
                                                <option value="">Abarrotera Central (Suc. Sta. Ursula)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <p class="form-control-static text-right"></p>
                                        </div>
                                        <div class="col-sm-10">
                                            <p class="form-control-static col-xs-10 col-sm-10 etrans-info">
                                                <small>Hidalgo 3345, Centro Cuauht&eacute;moc, M&eacute;xico D.F.</small><br>
                                                <small>C.P. 06190, 55-4321-8765</small><br>
                                                <small>admon@abacen.com.mx, ABC100522JK3</small><br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="space-8"></div>
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <p class="form-control-static text-right">Transferir</p>
                                        </div>
                                        <div class="col-sm-10">
                                            <input id="form-field-1" placeholder="" class="col-xs-10 col-sm-10" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="button">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Guardar
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8" style="display: none;" id="box_msg">
                        <h5 class="header smaller" style="border-bottom:0px; display: none;" id="img_procesing">
                            <i class="ace-icon fa fa-spinner fa-spin blue bigger-125"></i>
                            Procesando petici&oacute;n....
                        </h5>
                        <div class="alert alert-danger" style="display: block;" id="msg_alert">
                            <p>

                            </p>    
                        </div>
                        <div class="alert alert-block alert-success" style="display: block;" id="msg_sucess">
                            <p>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->



<div id="newTransferResumenCodigo-form" class="modal" tabindex="-1">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Transferencia por c&oacute;digo - Detalle</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="text-info"><strong>1346789012257</strong> Pasta de tomate  "Del Campo" lata 174g </h5>
                            </div>
                        </div>
                        <div class="space-8"></div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-horizontal etrans-info" role="form">
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Item</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">447698</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Piezas/Caja</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">48</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Orden de Entrada</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">002307</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Precio</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">8.54</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Caducidad</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">2015-05-17</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-7">
                                            <p class="form-control-static text-right">Existencia</p>
                                        </div>
                                        <div class="col-sm-5">
                                            <p class="form-control-static">2,100</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7 tbl-transfer">
                                <table id="resumenTransferCodigo_table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Destino</th>
                                            <th>Transferir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Abarrotera Central (Suc. Centro)</td>
                                            <td>350</td>
                                        </tr>
                                        <tr>
                                            <td>Abarrotera Central (Suc. Lomas Verdes)</td>
                                            <td>220</td>
                                        </tr>
                                        <tr>
                                            <td>Abarrotera Central (Suc. Sta. Ursula)</td>
                                            <td>165</td>
                                        </tr>
                                        <tr>
                                            <td><p class="text-right"><strong>A Transferir</strong></p></td>
                                            <td><strong>735</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="button">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Guardar
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8" style="display: none;" id="box_msg">
                        <h5 class="header smaller" style="border-bottom:0px; display: none;" id="img_procesing">
                            <i class="ace-icon fa fa-spinner fa-spin blue bigger-125"></i>
                            Procesando petici&oacute;n....
                        </h5>
                        <div class="alert alert-danger" style="display: block;" id="msg_alert">
                            <p>

                            </p>    
                        </div>
                        <div class="alert alert-block alert-success" style="display: block;" id="msg_sucess">
                            <p>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->

<!-- ventana modal para vista previa -->
<div id="newTransferVistaprevia-form" class="modal" tabindex="-1">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Transferencia de propiedad - Consulta</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                    <!--
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="text-info"><strong>1346789012257</strong> Pasta de tomate  "Del Campo" lata 174g </h5>
                            </div>
                        </div>
                        <div class="space-8"></div>-->
                        <div class="row">
                            <div class="col-sm-12 tbl-transfer">
                                <table id="transferVistaPrevia_table" class="table table-striped table-bordered">
                                    <caption class="table-header text-left"><strong>1346789012257 Pasta de tomate "Del Campo" lata 174g</strong></caption>
                                    <tbody>
                                        <tr>
                                            <th colspan="4">435671 &nbsp;&nbsp;&nbsp; O.E. 002345 &nbsp;&nbsp;&nbsp; $ 9.87 &nbsp;&nbsp;&nbsp; 2015-03-21</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-left:40px;">Abarrotera Central (Suc. Centro)</td>
                                            <td>350</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-left:40px;">Abarrotera Central (Suc. Lomas Verdes)</td>
                                            <td>220</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-left:40px;">Abarrotera Central (Suc. Sta. Ursula)</td>
                                            <td>165</td>
                                            <td>735</td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                    <tr>
                                        <th colspan="4">435664 &nbsp;&nbsp;&nbsp; O.E. 002345 &nbsp;&nbsp;&nbsp; $ 9.87 &nbsp;&nbsp;&nbsp; 2015-03-21</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding-left:40px;">Abarrotera Central (Suc. San Joaqu&oacute;n)</td>
                                        <td>420</td>
                                        <td>420</td>
                                    </tr>
                                    <tr><td colspan="4"></td></tr>
                                    <tr class="info">
                                        <td colspan="3" style="font-weight: bolder;"><p class="text-right">Total a Transferir</p></td>
                                        <td class="text-right"><strong>1,730</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- PAGE CONTENT ENDS -->