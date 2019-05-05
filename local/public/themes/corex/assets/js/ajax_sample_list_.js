function sent_sample(rowid){
$('.ajrow_tr_new').hide();
$('.ajrow_tr_c').hide();
var formData = {
  'recordID': rowid,
  '_token':$('meta[name="csrf-token"]').attr('content')
};
$.ajax({
 url: BASE_URL+'/getSampleDetails',
 type: 'POST',
 data: formData,
 success: function(res) {
   //console.log(res.client_data.sample_code);
$('#status_sample  option[value="'+res.sample_details.status_id+'"]').prop("selected", true);
$('#courier_data  option[value="'+res.sample_details.courier_id+'"]').prop("selected", true);
//v_s_id

   if(res.sample_details.status_id!=2){
     $('.ajrow_tr_new').show();

        if(res.client_data.edit_pe==0){
           $('.ajrow_tr_new').hide();
        }

   }else{
      $('.ajrow_tr_c').show();
   }
   var samples=JSON.parse(res.sample_details.sample_details);
   var i=0;
   $('#itemdata').html(" ");
   $.each(samples, function (index, value) {
i++;

      $('#itemdata').append(`<tr>
        <th scope="row">${i}</th>
        <td>${value.txtItem}</td>
        <td>${value.txtDiscrption}</td>
      </tr>`);


    });


   $('#s_status').html();
   $('#v_s_id').val(res.client_data.s_id);
   $('#s_id').html(res.client_data.sample_code);
   $('#s_company').html(res.client_data.company);
   $('#s_company').html(res.client_data.address);
   $('#s_ship_address').html(res.client_data.address);
   $('#s_location').html(res.client_data.location);
   $('#s_status').html(res.sample_details.status);
   $('#s_courier_name').html(res.sample_details.courier_name);
   $('#s_track_id').html(res.sample_details.track_id);
   $('#s_sent_on').html(res.client_data.sent_on);
   $('#s_remarks').html(res.sample_details.courier_remarks);


    $('#view_sent_sample_form').modal('show');
 },
  dataType : 'json'
});
}

function clearSampleView(){
  $('#v_name').html('');
  $('#user_id').html('');
  $('#v_email').html('');
  $('#v_phone').html('');
  $('#v_companay').html('');
  $('#v_address').html('');
  $('#gst_details').html('');
  $('#brand_name').html('');
  $('#remarks').html('');
  $('#s_name').html('');
  $('#s_email').html('');
  $('#s_phone').html('');
  $('#sid_code').html('');
  $('#s_id').val('');
  $('#sample_details').html('');
  $('#courier_details').html('');
  $('#v_track_id').html('');
  $('#v_created_on').html('');
  $('#v_status').html('');
  $('#v_remarks').html('');
  $('#v_feedback').html('');
  $('#v_created_by').html('');
}
function m_view_sample_details_now(rowid){
  var formData = {
    'recordID': rowid
  };
  $.ajax({
   url: BASE_URL+'/api/getSampleDetails',
   type: 'POST',
   data: formData,
   success: function(res) {
     if(res.sample_details.status_id==2){
       $('.aj_sample_status').hide()
       $('.aj_sample_status_new').show()
     }else{
       $('.aj_sample_status').show()
       $('.aj_sample_status_new').hide()
     }
     clearSampleView();
     $('#v_name').html(res.client_data.contact_name);
     $('#user_id').html(res.client_data.user_id);
     $('#v_email').html(res.client_data.email);
     $('#v_phone').html(res.client_data.phone);
     $('#v_companay').html(res.client_data.company);
     $('#v_address').html(res.client_data.address);
     $('#gst_details').html(res.client_data.gst_details);
     $('#brand_name').html(res.client_data.brand_name);
     $('#remarks').html(res.client_data.remarks);
     $('#s_name').html(res.agent_data.name);
     $('#s_email').html(res.agent_data.email);
     $('#s_phone').html(res.agent_data.phone);
     $('#sid_code').html(res.client_data.sample_code);
     $('#v_s_id').val(rowid);
     var sampleJSON=res.sample_details.sample_details;
    // console.log(sampleJSON);
    var HTML='';
    var obj = JSON.parse(sampleJSON);
    var i=0;
     $(obj).each(function(i, item){
       i++;
       HTML +='<tr><th scope="row">'+i+'</th><td>'+item.txtItem+'</td><td>'+item.txtDiscrption+'</td></tr>';
     })


     $('#sample_details').html(`<table class="table table-sm m-table m-table--head-bg-primary">
													<thead class="thead-inverse">
														<tr>
															<th>#</th>
															<th>Item </th>
															<th>Discriptions</th>

														</tr>
													</thead>
													<tbody>
                          ${HTML}

													</tbody>
												</table>
`);
     $('#sent_on').html(res.client_data.sent_on);
     sent_on
     $('#courier_details').html(res.sample_details.courier_details);
     $('#v_track_id').html(res.sample_details.track_id);
     $('#v_created_on').html(res.sample_details.created_at);
     $('#v_status').html(res.sample_details.status);
     $('#v_remarks').html(res.sample_details.remarks);
     $('#v_feedback').html(res.sample_details.feedback);
     $('#v_created_by').html(res.sample_details.created_by);
     $('#m_view_sample_details').modal('show');

   }
 });

}
function delete_sample(rowid){
   swal({
       title: "Are you sure?",
       text: "You won't be able to revert this!",
       type: "warning",
       showCancelButton: !0,
       confirmButtonText: "Yes,Delete",
       cancelButtonText: "No, Cancel!",
       reverseButtons: !1
   }).then(function(ey) {
      if(ey.value){
        $.ajax({
             url:BASE_URL+"/deleteSample",
             type: 'POST',
             data: {_token:$('meta[name="csrf-token"]').attr('content'),s_id:rowid},
             success: function (resp) {
               console.log(resp);
               if(resp.status==0){
                 swal("Deleted Alert!", "Cann't not delete", "error").then(function(eyz){
                   if(eyz.value){
                     //location.reload();
                   }
                 });
               }else{
                 swal("Deleted!", "Your sample has been deleted.", "success").then(function(eyz){
                   if(eyz.value){
                     location.reload();
                   }
                 });
               }


             },
             dataType : 'json'
         });

     }

   })

}

function edit_sample(rowid){
  var formData = {
    'recordID': rowid
  };
  $.ajax({
   url: BASE_URL+'/api/getSampleDetails',
   type: 'POST',
   data: formData,
   success: function(res) {
     console.log(res.client_data);
      $('#edit_sample_id').val(res.sample_details.sample_id);
      $('#m_select2_2  option[value="'+res.client_data.user_id+'"]').prop("selected", true);
      $('#edit_m_courier  option[value="'+res.sample_details.courier_id+'"]').prop("selected", true);
      $('#edit_statusdata  option[value="'+res.sample_details.status_id+'"]').prop("selected", true);
      $('#edit_sample_details').val(res.sample_details.sample_details);
      $('#edit_client_address').val(res.client_data.address);
      $('#edit_track_id').val(res.sample_details.track_id);
      $('#edit_remarks').val(res.sample_details.remarks);
      var qsFromDate=res.client_data.sent_on;
      $('#m_datepicker_3A').val(qsFromDate);

      $('#edit_s_id').val(rowid);
     $('#m_modal_edit_samples').modal('show');

   }
 });




}



var DatatableRemoteAjaxDemo = {
    init: function() {

      $('#btnSaveSentInfomration').click(function(){
         var courier_details= $( "#courier_id option:selected" ).val();
         var track_id= $( "#track_id" ).val();
         var s_id= $( "#v_s_id" ).val();
         var remarks= $( "#c_remarks" ).val();
         var sent_date= $( "#m_datepicker_3" ).val();
         if(courier_details==""){
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

        var t;
        var delete_ink=BASE_URL+'/delete/sample/';
        var edit_ink=BASE_URL+'/edit/samples/';
        t = $(".ajax_data_samples").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: BASE_URL+'/api/getSamplesList',
                        data: {_token: 'CSRF_TOKEN'},
                        map: function(t) {
                            var e = t;
                            return void 0 !== t.data && (e = t.data), e
                        }
                    }
                },
                pageSize: 10,
                serverPaging: !0,
                serverFiltering: !0,
                serverSorting: !0
            },
            layout: {
                scroll: !1,
                footer: !1
            },
            sortable: !0,
            pagination: !0,
            toolbar: {
                items: {
                    pagination: {
                        pageSizeSelect: [10, 20, 30, 50, 100]
                    }
                }
            },
            search: {
                input: $("#generalSearch")
            },
            columns: [{
                field: "sample_id",
                title: "Sample ID",
                sortable: !1,
                width: 100,
                selector: !1,
                textAlign: "center"

            }, {
                field: "client_name",
                title: "Client Name",
                filterable: !1,
                width: 150,


            }, {
                field: "created_by_id",
                title: "Added By",
                template: function(t) {

                  var aj=t.created_by_id;
                    var e = {
                        aj: {
                            title: t.created_by,
                            class: "warning"
                        }
                    };
                    return t.created_by;
                }

            }, {
                field: "track_id",
                title: "Track ID",
                width: 100
            }, {
                field: "status",
                title: "Status",
                template: function(t) {
                    var e = {
                        1: {
                            title: "NEW",
                            class: "m-badge--primary"
                        },
                        2: {
                            title: "SENT",
                            class: " m-badge--accent"
                        },
                        3: {
                            title: "RECEIVED",
                            class: "m-badge--success"
                        },
                        4: {
                            title: "FEEDBACK",
                            class: " m-badge--warnnig"
                        }
                    };
                    return '<span onclick="m_view_sample_details_now('+t.rowid+')" title="view sample details" style="cursor:pointer" id="'+t.rowid+'" class="m-badge ' + e[t.status].class + ' m-badge--wide">' + e[t.status].title + "</span>"
                }

            }, {
                field: "Actions",
                width: 110,
                title: "Actions",
                sortable: !1,
                overflow: "visible",
                template: function(t, e, a) {
                  var rowid=t.rowid;
                  edit_URL=BASE_URL+'/sample/'+rowid+'/edit';
                  return '\t\t\t\t\t\t<a href="'+edit_URL+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details"  >\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="javascript:void(0)" onclick="delete_sample('+rowid+')"  class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t';


                }
            }]
        }), $("#m_form_status_sample").on("change", function() {

            t.search($(this).val(), "status")
        }), $("#m_form_sales").on("change", function() {
            t.search($(this).val(), "created_by_id")
        }), $("#m_form_status, #m_form_type").selectpicker(),
        $('.m-datatable__table0').click(function(e){          //
            let click_event_name = $(e.target).closest('.m-datatable__cell').text();
            if(click_event_name==='NEW' || click_event_name==='SENT' || click_event_name==='RECEIVED' ||click_event_name==='FEEDBACK' ){
             let recordID = $(e.target).closest('.m-datatable__row').find("span span").attr("id");
             var formData = {
               'recordID': recordID
             };
             $.ajax({
              url: BASE_URL+'/api/getSampleDetails',
              type: 'POST',
              data: formData,
              success: function(res) {
                if(res.sample_details.status_id==1){
                  $('.aj_sample_status').hide()
                  $('.aj_sample_status_new').show()
                }else{
                  $('.aj_sample_status').show()
                  $('.aj_sample_status_new').hide()
                }

                $('#v_name').html(res.client_data.name);
                $('#user_id').html(res.client_data.user_id);
                $('#v_email').html(res.client_data.email);
                $('#v_phone').html(res.client_data.phone);
                $('#v_companay').html(res.client_data.company);
                $('#v_address').html(res.client_data.address);
                $('#gst_details').html(res.client_data.gst_details);
                $('#brand_name').html(res.client_data.brand_name);
                $('#remarks').html(res.client_data.remarks);

                $('#s_name').html(res.agent_data.name);
                $('#s_email').html(res.agent_data.email);
                $('#s_phone').html(res.agent_data.phone);

                $('#sid_code').html(res.sample_details.sample_id);

                $('#s_id').val(recordID);
                $('#sample_details').html(res.sample_details.sample_details);
                $('#courier_details').html(res.sample_details.courier_details);

                $('#v_track_id').html(res.sample_details.track_id);
                $('#v_created_on').html(res.sample_details.created_at);
                $('#v_status').html(res.sample_details.status);
                $('#v_remarks').html(res.sample_details.remarks);
                $('#v_feedback').html(res.sample_details.feedback);
                $('#v_created_by').html(res.sample_details.created_by);
              }
            });
             $('#m_view_sample_details').modal('show');

           }//end of if new sent etc



        })

        //code row click


    }
};
jQuery(document).ready(function() {
    DatatableRemoteAjaxDemo.init()
});

var DatatablesSearchOptionsAdvancedSearchData = function() {
    $.fn.dataTable.Api.register("column().title()", function() {
        return $(this.header()).text().trim()
    });
    return {
        init: function() {
            var a;
            a = $("#m_table_1").DataTable({
                responsive: !0,
                // scrollY: "50vh",
                scrollX: !0,
                scrollCollapse: !0,
                dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                lengthMenu: [5, 10, 25, 50,100],
                pageLength: 10,
                language: {
                    lengthMenu: "Display _MENU_"
                },
                searchDelay: 500,
                processing: !0,
                serverSide: !0,
                ajax: {
                    // url: "https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/inc/api/datatables/demos/server.php",
                    url:BASE_URL+'/getRawClientData',
                    type: "POST",
                    data: {
                        columnsDef: ["RecordID", "product","company", "contact","website","application", "Status", "p_edit","p_delete","Actions"],
                        '_token':$('meta[name="csrf-token"]').attr('content')

                    }
                },
                columns: [
                  {
                    data: "RecordID"
                },
              {
                    data: "product"
                },{
                  data: "company"
              }, {
                    data: "contact"
                },
                {
                    data: "website"
                },
                {
                    data: "application"
                },
                {
                  data: "Status"
              },
                 {
                    data: "Actions"
                }],
                initComplete: function() {
                    this.api().columns().every(function() {

                        switch (this.title()) {

                          case "Status":

                          var a = {
                              1: {
                                  title: "RAW",
                                  class: "m-badge--brand"
                              },
                              2: {
                                  title: "LEAD",
                                  class: " m-badge--metal"
                              },
                              3: {
                                  title: "QUALIFIED",
                                  class: " m-badge--primary"
                              },
                              4: {
                                  title: "SAMPLING",
                                  class: " m-badge--success"
                              },
                              5: {
                                  title: "CUSTOMER",
                                  class: " m-badge--info"
                              },
                              6: {
                                  title: "LOST",
                                  class: " m-badge--danger"
                              }

                          };
                          this.data().unique().sort().each(function(t, e) {
                              $('.m-input[data-col-index="6"]').append('<option value="' + t + '">' + a[t].title + "</option>")
                          });
                          break;
                        }
                    })
                },
                columnDefs: [{
                    targets: -1,
                    title: "Actions",
                    orderable: !1,
                    render: function(a, t, e, n) {
                      console.log(e.p_edit);
                      var html="";
                      edit_URL=BASE_URL+'/rawclientdata/'+e.RecordID+'/edit';
                      if(e.p_edit){
                        html +=`<a href="${edit_URL}" title="EDIT" class="btn btn-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
 															<i class="la la-edit"></i>
 														</a>`
                      }
                      if(e.p_delete){
                        html +=`<a href="javascript:void(0)" onclick="delete_rawdata(${e.RecordID})"
                         title="DELETE" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                    <i class="flaticon-delete"></i>
                                                    </a>`
                      }
                      html +=`<a href="javascript:void(0)" onclick="delete_rawdata(${e.RecordID})"
                       title="ADD ME" class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                  <i class="flaticon-rotate "></i>
                                                  </a>`
                       return html;
                    }
                },
                {
                    targets: 6,
                    render: function(a, t, e, n) {
                        var i = {
                          1: {
                              title: "RAW",
                              class: "m-badge--brand"
                          },
                          2: {
                              title: "LEAD",
                              class: " m-badge--metal"
                          },
                          3: {
                              title: "QUALIFIED",
                              class: " m-badge--primary"
                          },
                          4: {
                              title: "SAMPLING",
                              class: " m-badge--success"
                          },
                          5: {
                              title: "CUSTOMER",
                              class: " m-badge--info"
                          },
                          6: {
                              title: "LOST",
                              class: " m-badge--danger"
                          }
                        };
                        return void 0 === i[a] ? a : '<span class="m-badge ' + i[a].class + ' m-badge--wide">' + i[a].title + "</span>"
                    }
                }
              ]
            }), $("#m_search").on("click", function(t) {
                t.preventDefault();
                var e = {};
                $(".m-input").each(function() {
                    var a = $(this).data("col-index");
                    e[a] ? e[a] += "|" + $(this).val() : e[a] = $(this).val()
                }), $.each(e, function(t, e) {
                    a.column(t).search(e || "", !1, !1)
                }), a.table().draw()
            }), $("#m_reset").on("click", function(t) {
                t.preventDefault(), $(".m-input").each(function() {
                    $(this).val(""), a.column($(this).data("col-index")).search("", !1, !1)
                }), a.table().draw()
            }), $("#m_datepicker").datepicker({
                todayHighlight: !0,
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            })
        }
    }
}();
jQuery(document).ready(function() {
    DatatablesSearchOptionsAdvancedSearchData.init()
});


//delete_rawdata
function delete_rawdata(rowid){
  swal({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Yes,Delete",
      cancelButtonText: "No, Cancel!",
      reverseButtons: !1
  }).then(function(ey) {
     if(ey.value){

       $.ajax({
            url:BASE_URL+'/rawclientdata/'+rowid,
            type: 'POST',
            data: {_token:$('meta[name="csrf-token"]').attr('content'),s_id:rowid,'_method':'DELETE'},
            success: function (resp) {
              console.log(resp);
              if(resp.status==0){
                swal("Deleted Alert!", "Cann't not delete", "error").then(function(eyz){
                  if(eyz.value){
                    location.reload();
                  }
                });
              }else{
                swal("Deleted!", "Your sample has been deleted.", "success").then(function(eyz){
                  if(eyz.value){
                    location.reload();
                  }
                });
              }


            },
            dataType : 'json'
        });

    }

  })

}


//datagrid Client list
var DatatablesSearchOptionsAdvancedSearchSampleDataList = function() {
    $.fn.dataTable.Api.register("column().title()", function() {
        return $(this.header()).text().trim()
    });
    return {
        init: function() {
            var a;
            a = $("#m_table_SampletList").DataTable({
                responsive: !0,
                // scrollY: "50vh",
                scrollX: !0,
                scrollCollapse: !0,
                dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                lengthMenu: [5, 10, 25, 50,100],
                pageLength: 10,
                language: {
                    lengthMenu: "Display _MENU_"
                },
                searchDelay: 500,
                processing: !0,
                serverSide: !0,
                ajax: {
                    // url: "https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/inc/api/datatables/demos/server.php",
                    url:BASE_URL+'/getSamplesList',
                    type: "POST",
                    data: {
                        columnsDef: ["RecordID","sample_code","company","phone", "created_on","created_by","location", "Status","sent_access", "Actions"],
                        '_token':$('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                  {
                    data: "RecordID"
                  },
                  {
                    data: "sample_code"
                  },
                  {
                    data: "company"
                  },
                  {
                    data: "phone"
                  },
                  {
                    data: "created_on"
                  },
                  {
                    data: "created_by"
                  },
                  {
                    data: "location"
                  },
                  {
                    data: "Status"
                  },
                  {
                    data: "Actions"
                  }
              ],
                initComplete: function() {
                    this.api().columns().every(function() {

                        switch (this.title()) {

                          case "Status":

                          var a = {
                              1: {
                                  title: "RAW",
                                  class: "m-badge--brand"
                              },
                              2: {
                                  title: "LEAD",
                                  class: " m-badge--metal"
                              },
                              3: {
                                  title: "QUALIFIED",
                                  class: " m-badge--primary"
                              },
                              4: {
                                  title: "SAMPLING",
                                  class: " m-badge--success"
                              },
                              5: {
                                  title: "CUSTOMER",
                                  class: " m-badge--info"
                              },
                              6: {
                                  title: "LOST",
                                  class: " m-badge--danger"
                              }

                          };
                          this.data().unique().sort().each(function(t, e) {
                              $('.m-input[data-col-index="6"]').append('<option value="' + t + '">' + a[t].title + "</option>")
                          });
                          break;
                        }
                    })
                },
                columnDefs: [{
                    targets: -1,
                    title: "Actions",
                    orderable: !1,
                    render: function(a, t, e, n) {
                      console.log();
                      edit_URL=BASE_URL+'/sample/'+e.RecordID+'/edit';
                      print_URL=BASE_URL+'/sample/print/'+e.RecordID;

                      view_URL=BASE_URL+'/sample/'+e.RecordID+'';

                        var html = `<a href="${view_URL}" title="INFO" class="btn btn-accent m-btn m-btn--icon btn-sm m-btn--icon-only">
															<i class="la la-info"></i>
														</a>
                            <a href="${edit_URL}" title="EDIT" class="btn btn-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
    															<i class="la la-edit"></i>
    														</a>

                            <a href="javascript:void(0)" onclick="delete_sample(${e.RecordID})"
                             title="DELETE" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            														<i class="flaticon-delete"></i>
                            														</a>
                                                        <a href="${print_URL}" title="Print" class="btn btn-secondary m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                              <i class="la la-print" style="color:#164426B"></i>
                                                            </a>

                                                        `;
                                  if(e.sent_access){
                                    html +=`<a style="margin-top:2px;" href="javascript:void(0)" onclick="sent_sample(${e.RecordID})"
                                     title="SENT SAMPLE" class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                                <i class="flaticon-paper-plane-1"></i>
                                                                </a>`;
                                  }


                                                        return html;
                    }
                },
                {
                    targets: 7,
                    render: function(a, t, e, n) {
                        var i = {
                          1: {
                              title: "NEW",
                              class: "m-badge--brand"
                          },
                          2: {
                              title: "SENT",
                              class: " m-badge--metal"
                          },
                          3: {
                              title: "RECIEVED",
                              class: " m-badge--primary"
                          },
                          4: {
                              title: "FEEDBACK",
                              class: " m-badge--success"
                          }

                        };
                        return void 0 === i[a] ? a : '<span class="m-badge ' + i[a].class + ' m-badge--wide">' + i[a].title + "</span>"
                    }
                }
              ]
            }), $("#m_search").on("click", function(t) {
                t.preventDefault();
                var e = {};
                $(".m-input").each(function() {
                    var a = $(this).data("col-index");
                    e[a] ? e[a] += "|" + $(this).val() : e[a] = $(this).val()
                }), $.each(e, function(t, e) {
                    a.column(t).search(e || "", !1, !1)
                }), a.table().draw()
            }), $("#m_reset").on("click", function(t) {
                t.preventDefault(), $(".m-input").each(function() {
                    $(this).val(""), a.column($(this).data("col-index")).search("", !1, !1)
                }), a.table().draw()
            }), $("#m_datepicker").datepicker({
                todayHighlight: !0,
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            })
        }
    }
}();
jQuery(document).ready(function() {
    DatatablesSearchOptionsAdvancedSearchSampleDataList.init()
});

//datagrid Client list



var e, r, i = $("#m_form_add_sample");
e=i.validate({
                ignore: ":hidden",
                rules: {
                    company: {
                        required: !0
                    },
                    name: {
                        required: !0
                    },

                    phone: {
                        required: !0,
                      },
                },
                invalidHandler: function(e, r) {
                    mUtil.scrollTop(), swal({
                        title: "",
                        text: "There are some errors in your submission. Please correct them.",
                        type: "error",
                        confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"

                    })
                },
                submitHandler: function(e) {}
            }), (n = i.find('[data-wizard-action="submit"]')).on("click", function(r) {
                r.preventDefault(), e.form() && (mApp.progress(n), i.ajaxSubmit({
                    success: function() {
                        mApp.unprogress(n), swal({
                            title: "",
                            text: "The client has been successfully added!",
                            type: "success",
                            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
                            onClose: function(e) {
                              window.location.href = BASE_URL+'/sample'
                            }
                        })

                    }
                }))
            })
