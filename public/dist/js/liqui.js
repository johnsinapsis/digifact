       
       $(document).ready(function() {
    $('#detservi').DataTable({
      "paging":   false,
      "searching":false,
      "info": false,
      "ordering": false,
      "rowId": "data-id",
      "columnDefs": [
            {
                "targets": [ 4 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 5 ],
                "visible": false,
                "searchable": false
            }
        ],
      "language": {
      "emptyTable": "",
      "zeroRecords": ""
       }
    });

    $('#detservi').on( 'click', 'tr', function () {
      /*var id = $(this).data("id");
    alert( 'Clicked row id '+id );*/
      if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            $("#borrafila").attr('disabled', true);
        }
        else {
            $('#detservi').DataTable().$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $("#borrafila").attr('disabled', false);
            //var unitario = $('#detservi').DataTable().column(4).$('tr.selected').find("td").eq(4).html();
            //$('#detservi').DataTable().column(4).visible(true);
            //var unitario = $('#detservi').DataTable().column(4).$('tr.selected').find("td").eq(4).html();
            //$('#detservi').DataTable().column(4).visible(false);
            //alert(unitario);

        }

    } );

    } );


  $(document).ready(function() {
    $('#detprod').DataTable({
      "paging":   false,
      "searching":false,
      "info": false,
      "ordering": false,
      "rowId": "data-id",
      "columnDefs": [
            {
                "targets": [ 5 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 6 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 7 ],
                "visible": false,
                "searchable": false
            }
        ],
      "language": {
      "emptyTable": "",
      "zeroRecords": ""
       }
    });

    $('#detprod').on( 'click', 'tr', function () {
      /*var id = $(this).data("id");
    alert( 'Clicked row id '+id );*/
      if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            $("#borrafila").attr('disabled', true);
        }
        else {
            $('#detprod').DataTable().$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $("#borrafila").attr('disabled', false);
            //var unitario = $('#detservi').DataTable().column(4).$('tr.selected').find("td").eq(4).html();
            //$('#detservi').DataTable().column(4).visible(true);
            //var unitario = $('#detservi').DataTable().column(4).$('tr.selected').find("td").eq(4).html();
            //$('#detservi').DataTable().column(4).visible(false);
            //alert(unitario);

        }

    } );

    } );


function AgregaFilaProd(){
  if(MayorQueCero("cantidad"))
  {
    
    //console.clear();
    var nompro = $("#productob").val();
    var idpro  = $("#idprod").val();
    var cant   = $("#cantidad").val();
    var valuni = $("#valuni").val();
    var valtot = valuni * cant;
    var valiva = ($("#valiva").val()/100)*valtot;
    //alert(valiva);
    valtot = valtot+valiva;
    valtot = valtot.toFixed(2);
    //valiva = valiva.toFixed(2);

    var unit  = "$"+formatNumber.new(valuni);
    var total = "$"+formatNumber.new(valtot);
    var iva   = "$"+formatNumber.new(valiva);
    //total = total.toFixed(2);

    $("#productob").val("");
    $("#cantidad").val("");

    var tmp = "p"+idpro;
    var band = 0;
    var idtr = "";

    //alert(valiva);
     $("#detprod tbody tr").each(function (index) {
      idtr = $(this).attr('data-id');
      if(idtr==tmp)
        {band=1;}
     });

     //alert(band);
     if(band==0)
     {
    //obtenemos el numero de filas quitando la cabecera
    num = $("#detprod tbody tr").length-1;
    //habilitamos el boton de previsualizar
    $("#previa2").attr('disabled', false);
    
    var x = "p"+idpro;
    $('#detprod').DataTable().row.add([nompro,cant,unit,iva,total,valuni,valtot,valiva]).draw(false);
    $("#detprod tr:last").attr('data-id', x);

     }
     else
     {
      alert("Verifique si el producto ya se encuentra en la grilla o no existe");
     }
  }
  else
    alert("La cantidad debe ser mayor que cero");
}






function AgregaFilaServ(){
  if(MayorQueCero("cantidad"))
  {
    
    console.clear();
    var nomser = $("#servicio").val();
    var idser  = $("#idserv").val();
    var cant   = $("#cantidad").val();
    var valuni = $("#valuni").val();
    var valtot = valuni * cant;
    valtot = valtot.toFixed(2);

    var unit = "$"+formatNumber.new(valuni);
    var total = "$"+formatNumber.new(valtot);
    //total = total.toFixed(2);

    $("#servicio").val("");
    $("#cantidad").val("");

    var tmp = "p"+idser;
    var band = 0;
    var idtr = "";


     $("#detservi tbody tr").each(function (index) {
      idtr = $(this).attr('data-id');
      if(idtr==tmp)
        {band=1;}
     });

     //alert(band);
     if(band==0)
     {
    //obtenemos el numero de filas quitando la cabecera
    num = $("#detservi tbody tr").length-1;
    //habilitamos el boton de previsualizar
    $("#previa").attr('disabled', false);
    
    var x = "p"+idser;
    $('#detservi').DataTable().row.add([nomser,cant,unit,total,valuni,valtot]).draw(false);
    $("#detservi tr:last").attr('data-id', x);

     }
     else
     {
      alert("Verifique si el servicio ya se encuentra en la grilla o no existe");
     }
  }
  else
    alert("La cantidad debe ser mayor que cero");
}



function BorraFilaServ(){
   var num = $("#detservi tbody tr").length;
   //alert(num);
   $('#modif').hide(1000);
   $('#liqui').hide(1000);
   $('#previa').show();
   $("#previa").attr('disabled', false); 
   $('#detservi').DataTable().row('.selected').remove().draw( false );
   $("#borrafila").attr('disabled', true);
    if(num==1)
      $("#previa").attr('disabled', true);
}

function BorraFilaProd(){
   var num = $("#detprod tbody tr").length;
   //alert(num);
   $('#modif').hide(1000);
   $('#liqui').hide(1000);
   $('#previa2').show();
   $("#previa2").attr('disabled', false); 
   $('#detprod').DataTable().row('.selected').remove().draw( false );
   $("#borrafila").attr('disabled', true);
    if(num==1)
      $("#previa2").attr('disabled', true);
}



$("#liqui").click(function(){
 var ident = $("#ident").val();
 var idserv = new Array();
 var cant = new Array();
 var route = "liq/fact";
 var valuni = new Array();
 var token = $("#token").val();
 var fecha = $("#fecha").val();
 var resol = $("#resol").val();
 var fullDate = new Date();
 var startDate = new Date($('#fecha').val());
 if(startDate>fullDate){
  alert("la fecha no puede ser mayor a la actual");
 }
 else{
  $('#detservi').DataTable().column(4).visible(true);
  $("#detservi tbody tr").each(function (index){
    idserv[index] = $(this).attr("data-id").substring(1);
     cant[index]  = $(this).find("td").eq(1).html();
     valuni[index]  = $(this).find("td").eq(4).html();
    });
   $('#detservi').DataTable().column(4).visible(false);
  
  $.ajax({
       url: route,
       headers:{'X-CSRF-TOKEN':token},
       type: "POST",
       dataType: "json",
       data:{ident:ident,fecha:fecha,idserv:idserv,cantidad:cant,valuni:valuni,resol:resol},
       success: function(data) {
                var pdf = "pdffact/"+data.numfac+"/"+resol;
                //alert(data.numfac);
                window.location="liq/"+data.numfac+"/"+resol;
                window.open(pdf, '_blank');
             }
    });
 }
});


$("#liqui2").click(function(){
 var ident = $("#ident").val();
 var idprod = new Array();
 var cant = new Array();
 var route = "liq/fact";
 var valuni = new Array();
 var valiva = new Array();
 var token = $("#token").val();
 var fecha = $("#fecha").val();
 var resol = $("#resol").val();
 var fullDate = new Date();
 var startDate = new Date($('#fecha').val());
 if(startDate>fullDate){
  alert("la fecha no puede ser mayor a la actual");
 }
 else{
  $('#detprod').DataTable().column(5).visible(true);
  $('#detprod').DataTable().column(6).visible(true);
  $('#detprod').DataTable().column(7).visible(true);
  $("#detprod tbody tr").each(function (index){
    idprod[index] = $(this).attr("data-id").substring(1);
     cant[index]  = $(this).find("td").eq(1).html();
     valuni[index]  = $(this).find("td").eq(5).html();
     valiva[index]  = $(this).find("td").eq(7).html();
    });
 $('#detprod').DataTable().column(5).visible(false);
 $('#detprod').DataTable().column(6).visible(false);
 $('#detprod').DataTable().column(7).visible(false);
  
  $.ajax({
       url: route,
       headers:{'X-CSRF-TOKEN':token},
       type: "POST",
       dataType: "json",
       data:{ident:ident,fecha:fecha,idprod:idprod,cantidad:cant,valuni:valuni,valiva:valiva,resol:resol},
       success: function(data) {
                var pdf = "pdffact/"+data.numfac+"/"+resol;
                //alert(data.numfac);
                window.location="liq/"+data.numfac+"/"+resol;
                window.open(pdf, '_blank');
             }
    });
 }
});


function delete_precio(ident,idprod){
var token = $("#token").val();
var route = 'eraseprec';
  if (confirm('¿Estas seguro de eliminar este precio?')){ 
    $.ajax({
      url: route,
      headers:{'X-CSRF-TOKEN':token},
      type: "POST",
      dataType: "json",
      data:{codent:ident,codpro:idprod},
      success: function(data) {
      window.location.href = "prec_postdelete";
      }
     });
  }
}

function delete_tarifa(ident,idser){
var token = $("#token").val();
var route = 'erasetar';
  if (confirm('¿Estas seguro de eliminar esta tarifa?')){ 
    $.ajax({
      url: route,
      headers:{'X-CSRF-TOKEN':token},
      type: "POST",
      dataType: "json",
      data:{codent:ident,codser:idser},
      success: function(data) {
      window.location.href = "tar_postdelete";
      }
     });
  }
}



function queryfact(op){
if(op=='1'){
  if($("#fact").is(':checked'))
  {
    $("#numfac").prop('disabled', false);
    $("#fecini").prop('disabled', true);
    $("#inifec").removeAttr('checked')
    $("#fecfin").prop('disabled', true);
    $("#finfec").removeAttr('checked')
    $("#entidad").prop('disabled', true);
    $("#enti").removeAttr('checked');
    $("#entidad").val("");
    $("#select").val("1");
  }
  else{
    $("#numfac").prop('disabled', true);
    $("#select").val("0");
  }
}
if(op=='2'){ //chequeada la fecha de inicio
  var con = $("#select").val();
  if($("#inifec").is(':checked'))
  {
    $("#fecini").prop('disabled', false);
    $("#select").val("2");
  }
  else{
    $("#fecini").prop('disabled', true);
    $("#fecfin").prop('disabled', true);
    $("#finfec").removeAttr('checked');
  }
}
if(op=='3'){
  if($("#finfec").is(':checked'))
  {
    $("#fecfin").prop('disabled', false);
    $("#inifec").prop('checked', true);
    $("#fecini").prop('disabled', false);
    $("#select").val("3");
    //alert($("#fecini").val());
  }
  else{
    $("#fecfin").prop('disabled', true);
    $("#select").val("2");
  }
}
if(op=='4'){ //chequeada la entidad
  var con = $("#select").val();

 if($("#enti").is(':checked'))
  {
    $("#entidad").prop('disabled', false);
  }
  else{
    $("#entidad").prop('disabled', true);
    $("#entidad").val("");
  }
}
}



function fecmin(){
 var min = $("#fecini").val();
 $("#fecfin").prop('min', min);

}


function anupago(id){
  if (confirm('¿Estas seguro de eliminar este pago?')){
    window.location.href = "borrapago/"+id;
  }

}