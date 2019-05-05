//btnClientNotes

$('#btnClientNotes').click(function(){
   var message= $('textarea#txtNotes').val();

   var user_id= $('#user_id').val();

      if(message==""){
        swal({
            title: "Alert",
            text: "Note's Message must not be empty",
            type: "error",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
        })
        return false;
          }
        //ajax call
        var formData = {
          'message': message,
          'user_id': user_id,
          '_token':$('meta[name="csrf-token"]').attr('content')
        };
        $.ajax({
         url: BASE_URL+'/add.notes',
         type: 'POST',
         data: formData,
         success: function(res) {
           if(res.status==1){
             swal("Success", "Note's Message added successfully", "success").then(function(eyz){
               if(eyz.value){


                   window.location.href = BASE_URL+'/client'

               }
             });
           }
         },
         dataType : 'json'
       });
        //ajax call

});

//btnClientNotes




//== Class definition
var AjaxClientsList = function() {
  //== Private functions
  // basic demo
  var demo = function() {


    var e, r, i = $("#m_form_add_client");
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
                                text: "Submited successfully",
                                type: "success",
                                confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
                                onClose: function(e) {
                                  location.reload();
                                }
                            })

                        }
                    }))
                })



    var datatable = $('.m_client_list').mDatatable({
      // datasource definition
      data: {
        type: 'remote',

        source: {
          read: {
            url: BASE_URL+'/getClientsList',
            params: {
              'user_id': UID,
               '_token': _TOKEN,
              headers: {
                 '_token': 'BO-INTL'
              }
           },
            map: function(raw) {
              // sample data mapping
              var dataSet = raw;
              if (typeof raw.data !== 'undefined') {
                dataSet = raw.data;
              }
              return dataSet;
            },
          },
        },
        pageSize: 10,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true,
        orderable: !0,
      },

      // layout definition
      layout: {
        scroll: false,
        footer: false
      },

      // column sorting
      sortable: true,

      pagination: true,

      toolbar: {
        // toolbar items
        items: {
          // pagination
          pagination: {
            // page size select
            pageSizeSelect: [10, 20, 30, 50, 100],
          },
        },
      },

      search: {
        input: $('#generalSearch'),
      },

      // columns definition
      columns: [
        {
          field: 'index_id',
          title: '#',
          sortable: false, // disable sort for this column
          width: 40,
          selector: false,
          textAlign: 'center',
        }, {
          field: 'company',
          title: 'Company',
          // sortable: 'asc', // default sort
          filterable: false, // disable or enable filtering
          width: 100,
          template: '{{company}} ({{brand}})',

        },{
          field: 'created_on',
          title: 'Created On',
          width: 100,
        },{
          field: 'created_by',
          title: 'Added By'
        }, {
          field: 'phone',
          title: 'Phone',
          width: 80,
        },
        {
         field: 'location',
         title: 'Location',
         width: 150,
       },
         {
          field: 'Actions',
          width: 110,
          title: 'Actions',
          sortable: false,
          overflow: 'visible',
          template: function (row, index, datatable) {

             var rowid=row.rowid;
            var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';
            return '\
						<div class="dropdown ' + dropup + '">\
							<a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                <i class="la la-ellipsis-h"></i>\
                            </a>\
						  	<div class="dropdown-menu dropdown-menu-right">\
						    	<a class="dropdown-item"  onclick="view_client('+rowid+')"   href="javascript:void(0)"><i class="la la-edit"></i> View Details</a>\
						    	<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Last Activity</a>\
						    	\
						  	</div>\
						</div>\
						<a href="javascript:void(0)" onclick="edit_client('+rowid+')"  class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\
							<i class="la la-edit"></i>\
						</a>\
						<a href="javascript:void(0)"  onclick="delete_client('+rowid+')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\
							<i class="la la-trash"></i>\
						</a>\
					';
          },
        }],
    });

    $('#m_form_status').on('change', function() {
      datatable.search($(this).val(), 'Status');
    });

    $('#m_form_type').on('change', function() {
      datatable.search($(this).val(), 'Type');
    });

    $('#m_form_status, #m_form_type').selectpicker();

  };

  return {
    // public functions
    init: function() {
      demo();
    },
  };
}();

jQuery(document).ready(function() {
  AjaxClientsList.init();
});

//delete client
function delete_client(rowid){
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
             url:BASE_URL+"/softdeleteClient",
             type: 'POST',
             data: {_token:$('meta[name="csrf-token"]').attr('content'),userId:rowid},
             success: function (resp) {
               console.log(resp);
               if(resp.status==0){
                 swal("Deleted Alert!", "Cann't not delete", "error").then(function(eyz){
                   if(eyz.value){
                     location.reload();
                   }
                 });
               }else{
                 swal("Deleted!", "Your Hotel has been deleted.", "success").then(function(eyz){
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

// delete_client_note
function delete_client_user(rowid){
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
             url:BASE_URL+"/delete.client",
             type: 'POST',
             data: {_token:$('meta[name="csrf-token"]').attr('content'),rowid:rowid},
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

// delete_client_note

//delete client
//edit_client
function edit_client(rowid){
    var formData = {
      'recordID': rowid,
      '_token':$('meta[name="csrf-token"]').attr('content')
    };
    $.ajax({
     url: BASE_URL+'/getClientDetails',
     type: 'POST',
     data: formData,
     success: function(res) {
      $('#name').val(res.name);
      $('#email').val(res.email);
      $('#phone').val(res.phone);
      $('#company').val(res.company);
      $('#brand').val(res.brand);
      $('#gst').val(res.gst);
      $('#address').val(res.address);
      $('#edit_rowid').val(rowid);
      $('#m_modal_edit_client').modal('show');

     }
   });



}
//edit_client

//view client
function view_client(rowid){
  var formData = {
    'recordID': rowid,
      '_token':$('meta[name="csrf-token"]').attr('content')
  };
  $.ajax({
   url: BASE_URL+'/getClientDetails',
   type: 'POST',
   data: formData,
   success: function(res) {
      $('#vm_userid').html(res.id);
      $('#vm_name').html(res.name);
      $('#vm_phone').html(res.phone);
      $('#vm_email').html(res.email);
      $('#vm_company').html(res.company);
      $('#vm_brand').html(res.brand_name);
      $('#vm_address').html(res.address);
      $('#vm_gst').html(res.gst_details);
      $('#vm_remarks').html(res.remarks);
      $('#m_modal_views_client').modal('show');
   }
 });
}

//datagrid Client list
var DatatablesSearchOptionsAdvancedSearchClientDataList = function() {
    $.fn.dataTable.Api.register("column().title()", function() {
        return $(this.header()).text().trim()
    });
    return {
        init: function() {
            var a;
            a = $("#m_table_clientList").DataTable({
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
                    url:BASE_URL+'/getClientsList',
                    type: "POST",
                    data: {
                        columnsDef: ["RecordID","hotel_name","type", "category","location","city","address" ,"Status", "Actions"],
                        '_token':$('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                  {
                    data: "RecordID"
                  },
                  {
                    data: "hotel_name"
                  },
                  {
                    data: "type"
                  },
                  {
                    data: "category"
                  },
                  {
                    data: "location"
                  },
                  {
                    data: "city"
                  },
                  {
                    data: "address"
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

                      edit_URL=BASE_URL+'/hotel/'+e.RecordID+'/edit';
                      view_URL=BASE_URL+'/hotel/'+e.RecordID+'';


                        return `
                            <a href="${edit_URL}" title="EDIT" class="btn btn-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
    															<i class="la la-edit"></i>
    														</a>

                            <a href="javascript:void(0)" onclick="delete_client(${e.RecordID})"
                             title="DELETE" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            														<i class="flaticon-delete"></i>
                            														</a>`
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
                              title: "MEMBER",
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



//datagrid Client list
var DatatListOffer = function() {
    $.fn.dataTable.Api.register("column().title()", function() {
        return $(this.header()).text().trim()
    });
    return {
        init: function() {
            var a;
            a = $("#m_table_OffersList").DataTable({
                responsive: !0,
                // scrollY: "50vh",
                scrollX: !0,
                scrollCollapse: !0,

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
                    url:BASE_URL+'/getOffersList',
                    type: "POST",
                    data: {
                        columnsDef: ["RecordID","offer_type","offer_name", "offer_code","created_on","Status","Actions"],
                        '_token':$('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                  {
                    data: "RecordID"
                  },
                  {
                    data: "offer_type"
                  },
                  {
                    data: "offer_name"
                  },
                  {
                    data: "offer_code"
                  },
                  {
                    data: "created_on"
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

                      edit_URL=BASE_URL+'/hotel/'+e.RecordID+'/edit';
                      view_URL=BASE_URL+'/hotel/'+e.RecordID+'';


                        return `
                            <a href="${edit_URL}" title="EDIT" class="btn btn-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
    															<i class="la la-edit"></i>
    														</a>

                            <a href="javascript:void(0)" onclick="delete_client(${e.RecordID})"
                             title="DELETE" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            														<i class="flaticon-delete"></i>
                            														</a>`
                    }
                },
                {
                    targets: 6,
                    render: function(a, t, e, n) {
                        var i = {
                          1: {
                              title: "NEW",
                              class: "m-badge--brand"
                          },
                          2: {
                              title: "MEMBER",
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


// nates list
var DatatablesSearchOptionsAdvancedSearchNotesDataList = function() {
    $.fn.dataTable.Api.register("column().title()", function() {
        return $(this.header()).text().trim()
    });
    return {
        init: function() {
            var a;
            a = $("#m_table_clientsList").DataTable({
                responsive: !0,
                // scrollY: "50vh",
                scrollX: !0,
                scrollCollapse: !0,
                lengthMenu: [5, 10, 25, 50,100],
                pageLength: 10,
                language: {
                    lengthMenu: "Display _MENU_"
                },
                searchDelay: 500,
                processing: !0,
                serverSide: !0,
                ajax: {
                    url:BASE_URL+'/getClientData',
                    type: "POST",
                    data: {
                        columnsDef: ["RecordID","name","email", "phone","created_by","created_on", "Status", "Actions"],
                        '_token':$('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                  {
                    data: "RecordID"
                  },
                  {
                    data: "name"
                  },
                  {
                    data: "email"
                  },
                  {
                    data: "phone"
                  },
                  {
                    data: "created_by"
                  },
                  {
                    data: "created_on"
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

                      edit_URL=BASE_URL+'/client/'+e.RecordID+'/edit';
                      view_URL=BASE_URL+'/client/'+e.RecordID+'';


                        return `

                            <a href="javascript:void(0)" onclick="delete_client_user(${e.RecordID})"
                             title="DELETE" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            														<i class="flaticon-delete"></i>
                            														</a>
                                                        <a href="${edit_URL}" title="EDIT" class="btn btn-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                                                    <i class="flaticon-edit"></i>
                                                                                    </a>
                                                        `
                    }
                },
                {
                    targets: 6,
                    render: function(a, t, e, n) {
                        var i = {
                          1: {
                              title: "Active",
                              class: "m-badge--success"
                          },
                          2: {
                              title: "Block",
                              class: " m-badge--danger"
                          },

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

// nates list

jQuery(document).ready(function() {
    DatatablesSearchOptionsAdvancedSearchClientDataList.init()
    DatatablesSearchOptionsAdvancedSearchNotesDataList.init()
    DatatListOffer.init()



});

//datagrid Client list


// delte notes
function delete_note(rowid){
   swal({
       title: "Are you sure?",
       text: "You won't be able to revert this Message!",
       type: "warning",
       showCancelButton: !0,
       confirmButtonText: "Yes,Delete",
       cancelButtonText: "No, Cancel!",
       reverseButtons: !1
   }).then(function(ey) {
      if(ey.value){
        $.ajax({
             url:BASE_URL+"/delete.note",
             type: 'POST',
             data: {_token:$('meta[name="csrf-token"]').attr('content'),rowid:rowid},
             success: function (resp) {
               console.log(resp);
               if(resp.status==0){
                 swal("Deleted Alert!", "Cann't not delete", "error").then(function(eyz){
                   if(eyz.value){
                     location.reload();
                   }
                 });
               }else{
                 swal("Deleted!", "Your note has been deleted.", "success").then(function(eyz){
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

// delte notes

// datalist for notes
var DatatablesDataSourceHtml = {
    init: function() {
        $("#m_table_clientNotesList").DataTable({
            responsive: !0,

            columnDefs: [{
                targets: -1,
                title: "Actions",
                orderable: !1,
                render: function(a, t, e, n) {
                  console.log(e[0]);
                    return '\t\t\t\t\t\t<a href="javascript:void(0)" onclick="delete_note('+e[0]+')"  class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t';

                }
            }
          ]
        })
    }
};
jQuery(document).ready(function() {
    DatatablesDataSourceHtml.init()
});
