//add client with modal
$('#btnAddClient_withModal').click(function(){
  $('#m_select2_modal').modal('show');
});
//add client with modal
$('.ajfileupload').hide();
$('#btnImportSample').click(function(){
$(".ajfileupload").slideToggle('slow');
});

$('#btnImportCancel').click(function(){
$(".ajfileupload").slideToggle('slow');
});

$("select.client_name").change(function(){
           var formData = {
             'cid'              : $(this).children("option:selected").val()
           };
           $.ajax({
            url: BASE_URL+'/api/getClientAddress',
            type: 'GET',
            data: formData,
            success: function(res) {
              $('#client_address').val(res);
            }
          });

});



$('#btnSaveSampleSent').click(function(){
     var courier_details= $( "#courier_data option:selected" ).val();
     var status_sample= $( "#status_sample option:selected" ).val();

     var track_id= $("#track_id" ).val();
     var s_id= $( "#v_s_id" ).val();
     var remarks= $( "textarea#txtRemarksArea" ).val();
     var sent_date= $( "#m_datepicker_3" ).val();
     if(courier_details=="" ||courier_details=='NULL' ){
       swal({
           title: "Select Courier",
           text: "",
           type: "error",
           confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
           onClose: function(e) {
               console.log("on close event fired!")
           }
       })
       return false;
     }
     if(track_id==""){
       swal({
           title: "Enter Tracking ID",
           text: "",
           type: "error",
           confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
           onClose: function(e) {
               console.log("on close event fired!")
           }
       })
       return false;
     }

     //ajax request
     var formData = {
       's_id':s_id,
       'courier_id':courier_details,
       'track_id':track_id,
       'remarks':remarks,
       'sample_status':status_sample,
       'sent_date':sent_date,
       '_token':$('meta[name="csrf-token"]').attr('content')

     };

     $.ajax({
      url: BASE_URL+'/api/saveSampleCourier',
      type: 'POST',
      data: formData,
      success: function(res) {
         if(res.status){
           swal({
               title: "",
               text: "Sample Information successfully updated",
               type: "success",
               confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
               onClose: function(e) {
                  location.reload();
               }
           })
         }
      }  ,
      dataType : 'json'
    });

     //ajax request

  });


  //print samples
      $('#btnPrintSample').click(function(){
        var divToPrint=document.getElementById('div_printme');

          var newWin=window.open('','Print-Window');

          newWin.document.open();

          newWin.document.write('<html><body onload="window.print()">'+div_printme.innerHTML+'</body></html>');

          newWin.document.close();

          setTimeout(function(){newWin.close();},10);
      });
