<li class="ups">
        <a href="#" title="" data-rel="colorbox" >
            <img width="100" height="100" src="<?php echo Yii::app()->request->baseUrl . '/protected/cats/categoria.jpg' ?>" />
            <div class="text">
                <div class="inner" >
                    <i class="ace-icon glyphicon glyphicon-chevron-left bigger-160"></i>
                    Atras
                </div>
            </div>
        </a>
    </li>
<?php foreach ($pro as $row) { ?>
    <li class="producto" id="pro<?php echo $row->productid; ?>" data-productoid="<?php echo $row->productid; ?>" data-dsc="<?php echo $row->name ?>" data-precio="<?php echo $row->listprice ?>" data-stock="<?php echo $row->stock ?>" data-cantidad="0">
        <a href="#" title="" data-rel="colorbox" >
            <img width="100" height="100" src="<?php echo Yii::app()->request->baseUrl . '/protected/producto/' . $row->image; ?>" />
            <div class="text">
                <div class="inner" ><?php echo $row->name; ?></div>
            </div>
        </a>
    </li>
<?php } ?>
<script type="text/javascript">
   $(".ups").click(function(){
      var cats = $.ajax({ type: "GET", url: '?r=product/getcats', async: false })
		               .responseText;
                       $("#producto-selector").html(cats); 
   });
    $(".producto").click(function() {
        if (parseInt($(this).data("cantidad")) < parseInt($(this).data("stock"))) {
            $("#cobrar").show();
            $("#apartado").show();
            $("#remision").empty();
            var c = parseInt($(this).data("cantidad")) + 1;

            $(this).data("cantidad", c);
            var total = 0.00;
            $(".producto").each(function() {
                total += parseInt($(this).data("cantidad")) * parseFloat($(this).data("precio"));
                if (parseInt($(this).data("cantidad")) > 0) {
                    $('#remision').append('<tr id = "tr_' + $(this).data("productoid") + '">' +
                            '<td >' +
                            '<div class = "ace-spinner middle touch-spinner" style = "width: 125px;" >' +
                            '<div class = "input-group" >' +
                            '<div class = "spinbox-buttons input-group-btn" >' +
                            '<button type="button" onclick="decrease(' + $(this).data("productoid") + ')" class = "btn spinbox-down btn-sm btn-danger decrease">' +
                            '<i class = "icon-only  ace-icon ace-icon fa fa-minus bigger-110" > </i>' +
                            '</button>' +
                            '</div>' +
                            '<input type = "text" id = "spinner_pro' + $(this).data("productoid") + '" value="' + parseInt($(this).data("cantidad")) + '" onchange="change(' + $(this).data("productoid") + ')" class = "spinbox-input form-control text-center" >' +
                            '<div class = "spinbox-buttons input-group-btn" >' +
                            '<button type="button" onclick="increase(' + $(this).data("productoid") + ')" class="btn spinbox-up btn-sm btn-success increase" >' +
                            '<i class = "icon-only  ace-icon ace-icon fa fa-plus bigger-110" > </i>' +
                            '</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '<td>' + $(this).data("dsc") + '</td>' +
                            '<td>' + parseFloat($(this).data("precio")) + '</td>' +
                            '<td id = "importe_pro' + $(this).data("productoid") + '">' + (parseInt($(this).data("cantidad")) * parseFloat($(this).data("precio"))) + '</td>' +
                            '</tr>' +
                            '<script>' +
                            'function increase(id){' +
                            'var total = 0;' +
                            'if (parseInt($("#pro"+id).data("cantidad")) < parseInt($("#pro"+id).data("stock"))) {' +
                            'var c = parseInt($("#pro"+id).data("cantidad"))+1;' +
                            '$("#pro"+id).data("cantidad",c);' +
                            '$("#spinner_pro"+id).val(c);' +
                            '$("#importe_pro"+id).html(c*parseFloat($("#pro"+id).data("precio")));' +
                            '$(".producto").each(function(i) {' +
                            'total += parseInt($(this).data("cantidad"))*parseFloat($(this).data("precio"));' +
                            '});' +
                            '$("#total").html(Math.round(total * 100) / 100);' +
                            '}' +
                            '}' +
                            'function change(id){' +
                            'var total = 0;' +
                            'var spinnerval = $("#spinner_pro"+id).val();' +
                            'console.log($("#spinner_pro"+id).val());' +
                            'if(spinnerval < parseInt($("#pro"+id).data("cantidad"))){' +
                            'var c = spinnerval;' +
                            '$("#pro"+id).data("cantidad",c);' +
                            '$("#importe_pro"+id).html(c*parseFloat($("#pro"+id).data("precio")));' +
                            '$(".producto").each(function(i) {' +
                            'total += parseInt($(this).data("cantidad"))*parseFloat($(this).data("precio"));' +
                            '});' +
                            '$("#total").html(Math.round(total * 100) / 100);' +
                            '}' +
                            'else{' +
                            'var s = $("#pro"+id).data("stock");' +
                            '$("#spinner_pro"+id).val(s);' +
                            '$("#pro"+id).data("cantidad",s);' +
                            '$("#importe_pro"+id).html(s*parseFloat($("#pro"+id).data("precio")));' +
                            '$(".producto").each(function(i) {' +
                            'total += parseInt($(this).data("cantidad"))*parseFloat($(this).data("precio"));' +
                            '});' +
                            '$("#total").html(Math.round(total * 100) / 100);' +
                            '}' +
                            '}' +
                            'function decrease(id){' +
                            'var total = 0;' +
                            'if (parseInt($("#pro"+id).data("cantidad")) > 1 ) {' +
                            'var c = parseInt($("#pro"+id).data("cantidad"))-1;' +
                            '$("#pro"+id).data("cantidad",c);' +
                            '$("#spinner_pro"+id).val(c);' +
                            '$("#importe_pro"+id).html(c*parseFloat($("#pro"+id).data("precio")));' +
                            '$(".producto").each(function(i) {' +
                            'total += parseInt($(this).data("cantidad"))*parseFloat($(this).data("precio"));' +
                            '});' +
                            '$("#total").html(Math.round(total * 100) / 100);' +
                            '}' +
                            'else{' +
                            '$("#pro"+id).data("cantidad",0);' +
                            'var cnt = 0;' +
                            '$(".producto").each(function(i) {' +
                            'if(parseInt($(this).data("cantidad"))>0){cnt++;}' +
                            'total += parseInt($(this).data("cantidad"))*parseFloat($(this).data("precio"));' +
                            '});' +
                            'if(cnt===0){$("#cobrar").hide();$("#apartado").hide();}' +
                            '$("#total").html(Math.round(total * 100) / 100);' +
                            '$("#tr_"+id).remove();' +
                            '}' +
                            '}' +
                            '</' +
                            'script>'
                            );
                }
            });
            $("#total").html(Math.round(total * 100) / 100);
        }

        console.log($(this).data("cantidad"));
    });
</script>