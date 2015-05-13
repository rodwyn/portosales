
var changeartid;
var nchangea = 0;
var ndistribution=0;
var ndistributionplace = "";
var ndistributionquantity = "";

function addrowdistribution(){		
	ndistributionplace = $('#distributionplacef').val();
	ndistributionquantity = $('#distributionquantityf').val();
	if(ndistributionplace!='' && ndistributionquantity!=''){
		ndistribution++;
		var content = '<tr class="drdl" id="drd_'+ndistribution+'">';
		    content+= '<td>'+ndistributionplace+'<input type="hidden" name="ndpf_'+ndistribution+'" id="ndpf_'+ndistribution+'" value="'+ndistributionplace+'"></td>';
		    content+= '<td>'+ndistributionquantity+'<input type="hidden" name="ndcf_'+ndistribution+'" id="ndcf_'+ndistribution+'" value="'+ndistributionquantity+'"></td>';
		    content+= '<td><li class="btn btn-mini btn-danger icon-trash" id="delrdistributionbtn_'+ndistribution+'" onclick="deletedistribution('+ndistribution+');"></li></td>';
			content+= '</tr>';
		$('#ratedistributiontable').append(content);		  	
		$('#distributionplacef, #distributionquantityf').val('');
	} else
		bootbox.alert("Los campos no pueden estar vac’os, por favor verifique", function() {});
}

function deletedistribution(nd){
	$('#drd_'+nd).remove();
}

function deletechangeart(idfix){
	$('#calr_'+idfix).remove();
}

function caclean(id){
	$("#cal_"+id+"_table").empty();

	if( $("#ca_"+id).val() != '' && $("#ca_"+id).val() > 0 ){
		 if(id < 6){
		   id++;
		   $("#ca_"+id).attr('disabled', false);
		 }
	} else {
		 id++;
		 while(id <= 6){
		   $("#ca_"+id).attr('disabled', true).val('0');
		   $("#cal_"+id+"_table").empty();
		   id++;		   
		 }
	}
}

function showchangeartform(id){
	changeartid = id;
	$("#changeartname").focus();
	$("#changeartname, #changeartquantity").val("");
	$('#ChangeArtD').modal();
}

function savechangeart() {
    var tot = 0;
    $('[id^="caqf_'+changeartid+'"]').each( function(){
        tot += Number($(this).val());
    });
    tot += eval($("#changeartquantity").val());
    if( $("#changeartname").val()=='' || $("#changeartquantity").val()=='' ){
    	bootbox.alert("Los campos no pueden estar vac’os, por favor verifique", function() {});
    } else if( eval($("#ca_"+changeartid).val()) < tot ){
 	  bootbox.alert("La suma de los cambios de arte ("+tot+") no puede ser mayor a la cantidad a cotizar ("+eval($("#ca_"+changeartid).val())+"), por favor verifique ", function() {});
    } else{
        nchangea++;
        cacontent = '<tr id="calr_'+changeartid+'_'+nchangea+'">';
        cacontent+= '<td>'+$("#changeartname").val()+'<input type="hidden" name="canf_'+changeartid+'_'+nchangea+'" id="canf_'+changeartid+'_'+nchangea+'" value="'+$("#changeartname").val()+'"></td>';
        cacontent+= '<td>'+$("#changeartquantity").val()+'<input type="hidden" name="caqf_'+changeartid+'_'+nchangea+'" id="caqf_'+changeartid+'_'+nchangea+'" value="'+$("#changeartquantity").val()+'"></td>';
        cacontent+= '<td width="15"><li class="btn btn-mini btn-danger icon-trash" id="delcabtn_'+changeartid+'_'+nchangea+'" onclick="deletechangeart(\''+changeartid+'_'+nchangea+'\');"></li></td>';
        cacontent+= '</tr>';
        $('#cal_'+changeartid+'_table').append(cacontent);
    }
}
