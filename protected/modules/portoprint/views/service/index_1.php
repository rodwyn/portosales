
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <div class="jarviswidget  jarviswidget-sortable" id="wid-id-0" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-th-large "></i> </span><h2>Servicios </h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <div class="widget-body-toolbar">
                            <form novalidate="novalidate" class="smart-form" >
                                <fieldset style="background-color: #FAFAFA;">
                                    <div class="row">								
                                        <section class="col col-3" >
                                            
                                            <div id="tree" style="float: left; height: 400px; width: 400px; border:1px solid black; overflow-y: scroll; overflow-x:none; ">
                                                <h1 style="position: relative; left: 30%; top:40%; margin: auto; ">
                                                <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...
                                               </h1>
                                            </div>
                                             
                                        </section>
                                        <section class="col col-4">
                                            <div id="edit" style="position:absolute; left: 50%; height: 200px; width: 400px; ">
                                               <div class="modal-content">
                                                    <div class="modal-header">
                                                        <br>    
                                                        <h4 class="modal-title" id="title-modal-crea"></h4>
                                                    </div>
                                                    <div class="modal-body no-padding" >
                                                        <form method="post" action="#" id="nproyectnewuser" novalidate="novalidate" class="smart-form">	
                                                            <fieldset style="height: 50px; overflow-x: none; overflow-y: auto;" id="relista1">

                                                                <table class="table table-bordered" id="list-modal-newuser">
                                                                    <tbody>
                                                                           <thead>
                                                                               <tr id="sendnew-t">
                                                                                    <th style="width: 95%;">Nombre</th>
                                                                                    <th style="width: 5%;" id="all-sendnew"><input type="text" id="allspecial-sendnew" onkeyup="this.value = this.value.toUpperCase()" ></th> 
                                                                                </tr>
                                                                                <tr id="sendrename-t">
                                                                                    <th style="width: 95%;">Renombre</th>
                                                                                    <th style="width: 5%;" id="all-sendrename"><input type="text" id="allspecial-sendrename" onkeyup="this.value = this.value.toUpperCase()"  ></th> 
                                                                                </tr>
                                                                                <tr id="senddelet-t">
                                                                                    <th style="width: 95%;">¿Esta seguro de querer eliminar?
                                                                                        <input type="hidden" id="allspecial-senddelet"  ></th>
                                                                                </tr>
                                                                    </tbody>
                                                                 </table>
                                                                 </fieldset>
                                                            <footer>
                                                                <button class="btn btn-primary" class="btn btn-default" id="sendnew" type="button" onclick="next_form('1')" data-dismiss="modal" >Aceptar</button>
                                                                <button class="btn btn-primary" class="btn btn-default" id="sendrename"  type="button"   onclick="next_form('2')" >Aceptar</button>
                                                                <button class="btn btn-danger" class="btn btn-default" id="senddelet"  type="button" onclick="next_form('3')" >Aceptar</button>
                                                                <button  class="btn btn-default" id="sendproject4_c" onclick="next_form('4')" type="button"  data-dismiss="modal" >Cancelar</button>
                                                            </footer>
                                                        </form>
                                                    </div>

                                                </div><!-- /.modal-content -->
                                            </div>
                                            
                                            <div id="details" style="position:absolute; left: 50%; height: 200px; width: 500px; ">
                                               <div class="modal-content">
                                                    <div class="modal-header">
                                                        <br>    
                                                        <h4 class="modal-title" id="title-modal-details"></h4>
                                                    </div>
                                                    <div class="modal-body no-padding" >
                                                        <form method="post" action="#" id="nproyectdetails" novalidate="novalidate" class="smart-form">	
                                                            <fieldset style="height: 300px; width: 470px; overflow-x: none; overflow-y: auto;" id="relista1">

                                                                <table class="table table-bordered" id="list-modal-details">
                                                                    <thead>
                                                                        <th style="width: 95%; text-align:left; "> <div class="btn-group btn-group-xs ">
                                                                            <a  class="btn btn-success" id="btndetail"  onclick="allchecks()"  <?php if ($edt != 1) { ?> disabled <?php } ?> ><i class="glyphicon glyphicon-check"></i></a>
                                                                        </div>&nbsp;&nbsp;Todo</th>
                                                                        
                                                                    </thead>
                                                                    <tbody>
                                                                           
                                                                              
                                                                    </tbody>
                                                                 </table>
                                                                 </fieldset>
                                                            <footer>
                                                                
                                                                
                                                            </footer>
                                                        </form>
                                                    </div>

                                                </div><!-- /.modal-content -->
                                            </div>
                                            
                                        </section>
                                        <section class="col col-5">
                                           
                                        </section>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <br><br>

                    </div>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>
<!-- WIDGET END -->

<!-- NEW WIDGET START -->

<!-- WIDGET END -->

</div>

<!-- end row -->

</section>
<!-- end widget grid -->


<script type="text/javascript">
    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    pageSetUp();
    var oTable;
    actioncreat();
    $("#edit").hide();
    $("#details").hide();
    var global_check=1;
    
    
    function actioncreat(){ 
        $.ajax({
        async : true,
        type : "GET",
        'url': '<?php echo Yii::app()->createAbsoluteUrl('portoprint/service/getservicesbycompany') ?>',
        'dataType' : "json",    

        success : function(json) {
           createJSTrees(json);
        },    

        error : function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
   }
    
    function createJSTrees(jsonData) {
        var obj = jQuery.parseJSON ( jsonData );
        $('#tree').on('changed.jstree', function (e, data) {
           
           if(data.action=="select_node"){
              var level=$("#"+data.node.id).data("level");
              if(level==4){
                 newdetails(data.node.id);
              }else{
                 $("#edit").hide();
                 $("#details").hide();
                }
           }

        }).jstree(
                   {   
                       'core' : {
                           'themes' : { "stripes" : true },
                            'data' :  obj 

                            },
                         'sort' : function(a, b) {
                                        return this.get_type(a) === this.get_type(b) ? (this.get_text(a) > this.get_text(b) ? 1 : -1) : (this.get_type(a) >= this.get_type(b) ? 1 : -1);
                                },
                                'plugins' : ['state','dnd','sort','types','contextmenu','unique'],
                                'contextmenu': {
                                    "items": function (node) {
                                        return {
                                            <?php if ($add == 1) { ?> "Create": {
                                                "label": "Agregar dentro Nueva Categoria",

                                                 "action": function (data) {
                                                       this.demo_create(data);
                                                 }
                                            }, <?php } ?> <?php if ($edt == 1) { ?>
                                             "Rename": {
                                                "label": "Renombrar Categoria",

                                                 "action": function (data) {
                                                       this.demo_rename(data);
                                                 }
                                            },<?php } ?> <?php if ($del == 1) { ?>
                                            "Delete": {
                                                "label": "Eliminar Categoria",
                                                "action": function (obj) {
                                                    this.demo_delete(obj);
                                                }
                                            }<?php } ?> 
                                        };
                                    }
                                }


                    });
    }    

    function demo_create(c) {
        var bol =   $.jstree.reference('#tree');
        var ref = c.reference.prevObject.selector.split("#");
        var level=$("#"+ref[1]).data('level');
        if(level<4){
            var parent=ref[1]-1; 
             $("#title-modal-crea").html("&nbsp;&nbsp;Nuevo Categoria");
             $("#allspecial-sendnew").attr("data-parent",parent);
             $("#sendnew").show();
             $("#sendrename").hide();
             $("#senddelet").hide();

             $("#sendnew-t").show();
             $("#sendrename-t").hide();
             $("#senddelet-t").hide();

             $("#details").hide();
             $("#edit").show();
            }
    }
    function demo_rename(c) {
        var bol =   $.jstree.reference('#tree');
        var ref = c.reference.prevObject.selector.split("#");
        
        var parent=ref[1]-1; 
         $("#title-modal-crea").html("&nbsp;&nbsp;Renombrar Categoria");
         $("#allspecial-sendrename").attr("data-parent",parent);
         $("#sendnew").hide();
         $("#sendrename").show();
         $("#senddelet").hide();
         $("#sendnew-t").hide();
         $("#sendrename-t").show();
         $("#senddelet-t").hide();
         $("#details").hide();
        $("#edit").show();

    }
    function demo_delete(c) {
        var bol =   $.jstree.reference('#tree');
        var ref = c.reference.prevObject.selector.split("#");
        var parent=ref[1]-1; 
        $("#title-modal-crea").html("&nbsp;&nbsp;Renombrar Categoria");
        $("#allspecial-senddelet").attr("data-parent",parent);
        $("#sendnew").hide();
         $("#sendrename").hide();
         $("#senddelet").show();
         $("#sendnew-t").hide();
         $("#sendrename-t").hide();
         $("#senddelet-t").show();
         $("#details").hide();
        $("#edit").show();

    }
    
    function newdetails(c) {
        
        var serviceid=$( "#"+c ).data("atrib");
       
        var idparen=c-1;
        
        $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/service/getdetails') ?>',{'serviceid':serviceid, 'idparent':idparen }, function(response){
                if(response!=0){  
                    $("#title-modal-details").html("&nbsp;&nbsp;Atributos");
                    $("#list-modal-details").attr("data-parent",serviceid);
                    $("#list-modal-details").find("tbody").html(response);
                    
                    <?php if ($edt != 1) { ?>
                    $("#list-modal-details").find('input[type="checkbox"]').each(function() {
                        var elemento = this;
                        $("#" + elemento.id).prop( "disabled", true );;
                    });
                    <?php } ?>
                        
                    $("#edit").hide();
                    $("#details").show();
                
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/service/getdetailscheck') ?>',{'serviceid':idparen}, function(response){
                       if(response!=0){
                           var list=response.split(',');
                               for(i=0;i<list.length;i++){
                                 
                                   $("#list-modal-details").find("#btnitemdetail_"+list[i]).prop("checked", true);
                               }

                           }
                     });
                    
                }
          });
          
                
                
           
    }
      function next_form(x){

          switch(x){
              case "1":
               var parent= $("#allspecial-sendnew").data("parent");
               var servicedsc= $("#allspecial-sendnew").val();
                $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/service/createservice') ?>',{'parent':parent, 'servicedsc':servicedsc}, function(response){
                  
                    if(response!=0){
                         alert('Categoria Creada Correctamente .');
                         $("#details").hide();
                          $("#edit").hide();
                          location.reload();
                          
                    }else{
                          $("#all-sendnew").find(".error").remove();
                                $('<label class="error" generated="true">El nombre ya existe</label>').appendTo("#all-sendnew");
                        
                    }
                  });
                  break;
              case "2":
                  
                 var parent= $("#allspecial-sendrename").data("parent");
                 var servicedsc= $("#allspecial-sendrename").val();
                 $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/service/updateservice') ?>',{'parent':parent, 'servicedsc':servicedsc}, function(response){
                            
                        if(response!=0){
                             alert('Categoria renombrada Correctamente .');
                              $("#edit").hide();
                              location.reload();

                        }else{
                              $("#all-sendnew").find(".error").remove();
                                    $('<label class="error" generated="true">El nombre ya existe</label>').appendTo("#all-sendrename");
                            
                        }
                    });
                  break;
              case "3":
                   var parent= $("#allspecial-senddelet").data("parent");
                   
                    $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/service/deleteservice') ?>',{'parent':parent}, function(response){
                          if(response!=0){
                               alert('Categoria Borrada Correctamente .');
                               $("#details").hide();
                               $("#edit").hide();
                               location.reload();
                          }else{
                               $("#all-senddelet").find(".error").remove();
                                    $('<label class="error" generated="true">No se a podido eliminar</label>').appendTo("#all-senddelet");
                          }
                    });
                  break;
              case "4":
                  $("#details").hide();
                  $("#edit").hide();
                  break;

          }

      }              

    function allchecks(){
        var x=global_check;
        switch(x){
            case 1:
                global_check=2;
                $("#btndetail").find("i").removeClass("glyphicon glyphicon-check");
                $("#btndetail").find("i").addClass("glyphicon glyphicon-share");
                $("#btndetail").removeClass("btn btn-success");
                $("#btndetail").addClass("btn btn-danger");
                 $("#list-modal-details").find('input[type="checkbox"]').each(function() {
                        var elemento = this;
                        $("#" + elemento.id).prop("checked", true);
                    });
                
            break;
            case 2:
                 global_check=1;
                $("#btndetail").find("i").removeClass("glyphicon glyphicon-share");
                $("#btndetail").find("i").addClass("glyphicon glyphicon-check");
                $("#btndetail").removeClass("btn btn-danger");
                $("#btndetail").addClass("btn btn-success");
                $("#list-modal-details").find('input[type="checkbox"]').each(function() {
                        var elemento = this;
                        $("#" + elemento.id).prop("checked", false);
                 });
            break;
            }
    }
   function valid_itemdetail(id){
         if ($("#" + id).is(':checked')) {
                var valor=$("#"+id).val();
                var list=valor.split(",");
                 $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/service/createatrib') ?>',{'serviceid':list[1], 'itemdetailid':list[0] }, function(response){
                           if(response!=0){
                               alert('Atributo asignado Correctamente .');
                           }
                    });
            }else{
                var valor=$("#"+id).val();
                 var list=valor.split(",");
                 $.post('<?php echo Yii::app()->createAbsoluteUrl('portoprint/service/deleteatrib') ?>',{'serviceid':list[1], 'itemdetailid':list[0]}, function(response){
                       
                        if(response!=0){
                               alert('Atributo borrado Correctamente .');
                              
                          }
                    });
            }
   }

</script>
<style>
.glyphicon-refresh-animate {
    -animation: spin .7s infinite linear;
    -webkit-animation: spin2 .7s infinite linear;
}

@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
</style>

