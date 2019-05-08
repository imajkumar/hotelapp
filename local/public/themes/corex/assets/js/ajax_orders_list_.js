//== Class definition
var AjaxOrdersList = function() {
  //== Private functions
  // basic demo
  var demo = function() {
function toasterOptions() {
toastr.options = {
"closeButton": false,
"debug": false,
"newestOnTop": false,
"progressBar": true,
"positionClass": "toast-top-right",
"preventDuplicates": true,
"onclick": null,
"showDuration": "100",
"hideDuration": "1000",
"timeOut": "3000",
"extendedTimeOut": "1000",
"showEasing": "swing",
"hideEasing": "linear",
"showMethod": "show",
"hideMethod": "hide"
};
};


    var e, r, i = $("#m_form_add_order");
    e=i.validate({
                    ignore: ":hidden",
                    rules: {
                        client_id: {
                            required: !0
                        },
                        order_due_date: {
                            required: !0
                        }

                    },
                    invalidHandler: function(e, r) {
                        mUtil.scrollTop();
                    },
                    submitHandler: function(e) {}
                }), (n = i.find('[data-wizard-action="submit"]')).on("click", function(r) {
                    r.preventDefault(), e.form() && (mApp.progress(n), i.ajaxSubmit({
                        success: function() {
                            mApp.unprogress(n);
                            toasterOptions();
                            toastr.success('New order is created!', 'Order')
                            setTimeout(function(){
                                // window.location.href = BASE_URL+'/orders'
                            }, 3000);




                        }
                    }))
                })

  };

  return {
    // public functions
    init: function() {
      demo();
    },
  };
}();

jQuery(document).ready(function() {
  AjaxOrdersList.init();
});


var DatatablesSearchOptionsAdvancedSearchOrderList = function() {
    $.fn.dataTable.Api.register("column().title()", function() {
        return $(this.header()).text().trim()
    });
    return {
        init: function() {
            var a;
            a = $("#m_table_13").DataTable({
                responsive: !0,
                // dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                language: {
                    lengthMenu: "Display _MENU_"
                },
                searchDelay: 500,
                processing: !0,
                serverSide: !0,
                ajax: {
                      url:BASE_URL+'/getRoomsList',
                    type: "POST",
                    data: {
                        columnsDef: ["RecordID", "hotel_name", "room_type", "room_price", "no_adult", "no_child", "Status", "Actions"],
                        _token:$('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                    data: "RecordID"
                }, {
                    data: "hotel_name"
                }, {
                    data: "room_type"
                }, {
                    data: "room_price"
                }, {
                    data: "no_adult"
                }, {
                    data: "no_child"
                }, {
                    data: "Status"
                },  {
                    data: "Actions"
                }],
                initComplete: function() {
                    this.api().columns().every(function() {
                        switch (this.title()) {
                            case "Country":
                                this.data().unique().sort().each(function(a, t) {
                                    $('.m-input[data-col-index="2"]').append('<option value="' + a + '">' + a + "</option>")
                                });
                                break;
                            case "Status":
                                var a = {
                                    1: {
                                        title: "Pending5",
                                        class: "m-badge--brand"
                                    },
                                    2: {
                                        title: "Delivered",
                                        class: " m-badge--metal"
                                    },
                                    3: {
                                        title: "Canceled",
                                        class: " m-badge--primary"
                                    },
                                    4: {
                                        title: "Success",
                                        class: " m-badge--success"
                                    },
                                    5: {
                                        title: "Info",
                                        class: " m-badge--info"
                                    },
                                    6: {
                                        title: "Danger",
                                        class: " m-badge--danger"
                                    },
                                    7: {
                                        title: "Warning",
                                        class: " m-badge--warning"
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

                      edit_URL=BASE_URL+'/room/'+e.RecordID+'/edit';
                      view_URL=BASE_URL+'/room/'+e.RecordID+'';


                        return `
                            <a href="${edit_URL}" title="EDIT" class="btn btn-primary m-btn m-btn--icon btn-sm m-btn--icon-only">
    															<i class="la la-edit"></i>
    														</a>

                            <a href="javascript:void(0)" onclick="delete_room(${e.RecordID})"
                             title="DELETE" class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only">
                            														<i class="flaticon-delete"></i>
                            														</a>`
                    }
                }, {
                    targets: 6,
                    render: function(a, t, e, n) {
                        var i = {
                            1: {
                                title: "OPEN",
                                class: "m-badge--success"
                            },
                            2: {
                                title: "BOOKED",
                                class: " m-badge--danger"
                            },


                        };
                        return void 0 === i[a] ? a : '<span class="m-badge ' + i[a].class + ' m-badge--wide">' + i[a].title + "</span>"
                    }
                },
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
    DatatablesSearchOptionsAdvancedSearchOrderList.init()
});

//datagrid Client list
var DatatablesSearchOptionsAdvancedSearchOrderMainDataList = function() {
    $.fn.dataTable.Api.register("column().title()", function() {
        return $(this.header()).text().trim()
    });
    return {
        init: function() {
            var a;
            a = $("#m_table_OrderMainList").DataTable({
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

                    url:BASE_URL+'/getOrderMainList',
                    type: "POST",
                    data: {
                        columnsDef: ["RecordID","order_id","company","phone", "created_on","created_by","due_date", "Status","sent_access", "Actions"],
                        '_token':$('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                  {
                    data: "RecordID"
                  },
                  {
                    data: "order_id"
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
                    data: "due_date"
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
                                  title: "New Order",
                                  class: "m-badge--brand"
                              },
                              2: {
                                  title: "Addded BOM",
                                  class: " m-badge--metal"
                              },
                              3: {
                                  title: "Processing",
                                  class: " m-badge--primary"
                              },
                              4: {
                                  title: "PRODUCTION",
                                  class: " m-badge--success"
                              },
                              5: {
                                  title: "Dispatched",
                                  class: " m-badge--info"
                              },
                              6: {
                                  title: "DELIVERED",
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
                      edit_URL=BASE_URL+'/orders/'+e.RecordID+'/edit';
                      print_URL=BASE_URL+'/orders/print/'+e.RecordID;

                      view_URL=BASE_URL+'/orders/'+e.RecordID+'';
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
                              title: "New",
                              class: "m-badge--brand"
                          },
                          2: {
                              title: "BOM",
                              class: " m-badge--metal"
                          },
                          3: {
                              title: "Processing",
                              class: " m-badge--primary"
                          },
                          4: {
                              title: "PRODUCTION",
                              class: " m-badge--success"
                          },
                          5: {
                              title: "Dispatched",
                              class: " m-badge--info"
                          },
                          6: {
                              title: "DELIVERED",
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
    DatatablesSearchOptionsAdvancedSearchOrderMainDataList.init()
});

//datagrid Client list

function m_add_order_bill_material(rowid){
//alert(rowid);
var formData = {
  'recordID': rowid,
  '_token':$('meta[name="csrf-token"]').attr('content')
};
$.ajax({
 url: BASE_URL+'/getOrderData',
 type: 'POST',
 data: formData,
 success: function(res) {
   $('#modal_add_order_bill_material').modal('show');
 }
});

}
//delete room
function delete_room(rowid){
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
             url:BASE_URL+"/deleteRoom",
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
                 swal("Deleted!", "Your Room has been deleted.", "success").then(function(eyz){
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
