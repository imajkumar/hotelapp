
$("select.client_city").change(function(){
    var selectedcityid = $(this).children("option:selected").val();
   $('#namecountry').html('');
  $.ajax({
       url:BASE_URL+"/api/getCountry/"+selectedcityid,
       type: 'GET',
       success: function (resp) {
         console.log();
         console.log(resp.name);

         $('#namecountry').append('<option value="'+resp.id+'">'+resp.name+'<option>');
       }
     });


});


var FormControlsAyra = {
    init: function() {

    $.validator.addMethod("gst", function(value3, element3) {
    var gst_value = value3.toUpperCase();
    var reg = /^([0-9]{2}[a-zA-Z]{4}([a-zA-Z]{1}|[0-9]{1})[0-9]{4}[a-zA-Z]{1}([a-zA-Z]|[0-9]){3}){0,15}$/;
    if (this.optional(element3)) {
      return true;
    }
    if (gst_value.match(reg)) {
      return true;
    } else {
      return false;
    }

  }, "Please specify a valid GSTTIN Number");




  $("#m_form_2_reset").validate({
    rules: {
        email: {
            required: !0,
            email: !0
        },
        url: {
            required: !0
        },
        digits: {
            required: !0,
            digits: !0
        },
        creditcard: {
            required: !0,
            creditcard: !0
        },
        phone: {
            required: !0,
            phoneUS: !0
        },
        option: {
            required: !0
        },
        options: {
            required: !0,
            minlength: 2,
            maxlength: 4
        },
        memo: {
            required: !0,
            minlength: 10,
            maxlength: 100
        },
        checkbox: {
            required: !0
        },
        checkboxes: {
            required: !0,
            minlength: 1,
            maxlength: 2
        },
        radio: {
            required: !0
        }
    },
    invalidHandler: function(e, r) {
        mUtil.scrollTo("m_form_2", -200)
    },
    submitHandler: function(e) {}
}),
          $("#frm_edit_raw_data").validate({
  rules: {

      name: {
          required: !0
      },



  },
    invalidHandler: function(e, r) {
        mUtil.scrollTo("m_form_3", -200), swal({
            title: "",
            text: "There are some errors in your submission. Please correct them.",
            type: "error",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
            onClose: function(e) {
                console.log("on close event fired!")
            }
        }), e.preventDefault()
    },
    submitHandler: function(form) {
        var rowid=$('#rowid_edit').val();
        $.ajax({
         url: BASE_URL+'/rawclientdata/'+rowid,
         type: 'POST',
         data: $(form).serialize(),
         success: function(res) {
           console.log(res);
           swal({
               title: "",
               text: "Data  modified successfully",
               type: "success",
               confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
               onClose: function(e) {

                window.location.href = BASE_URL+'/rawclientdata';
               }
           }), !1

         },
         error: function(res) {

           if(res.responseJSON.errors.email[0]){
                return swal({
                  title:  res.responseJSON.errors.email[0],
                  text: 'Please enter valid email',
                  type: "error",
                  confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
              }), !1
           }
         },
          dataType : 'json'
     });


    }
}),$("#m_form_222").validate({
    rules: {

        name: {
            required: !0
        },

        phone: {
            required: !0

        },
        company: {
            required: !0

        }

    },
      invalidHandler: function(e, r) {
          mUtil.scrollTo("m_form_3", -200), swal({
              title: "",
              text: "There are some errors in your submission. Please correct them.",
              type: "error",
              confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
              onClose: function(e) {
                  console.log("on close event fired!")
              }
          }), e.preventDefault()
      },
      submitHandler: function(form) {
          $.ajax({
           url: BASE_URL+'/edit/client',
           type: 'POST',
           data: $(form).serialize(),
           success: function(res) {
             console.log(res);
             swal({
                 title: "",
                 text: "Client data modified successfully",
                 type: "success",
                 confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
                 onClose: function(e) {
                  location.reload();
                 }
             }), !1

           },
           error: function(res) {

             if(res.responseJSON.errors.email[0]){
                  return swal({
                    title:  res.responseJSON.errors.email[0],
                    text: 'Please enter valid email',
                    type: "error",
                    confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                }), !1
             }
           },
            dataType : 'json'
       });


      }
  }),$("#m_form_12").validate({
    rules: {
        sample_details: {
            required: !0,
            maxlength: 400
        },
        sample_id: {
            required: !0
        },
        client_name: {
            required: !0,

        },
        client_address: {
            required: !0,

        },
        courier_name: {
            required: !0,

        },
        track_id: {
            required: !0
        }

    },
    invalidHandler: function(e, r) {
        mUtil.scrollTo("m_form_3", -200), swal({
            title: "",
            text: "There are some errors in your submission. Please correct them.",
            type: "error",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
            onClose: function(e) {
                console.log("on close event fired!")
            }
        }), e.preventDefault()
    },
    submitHandler: function(form) {
        $.ajax({
         url: BASE_URL+'/samples/edits/datainfo',
         type: 'POST',
         data: $(form).serialize(),
         success: function(res) {
           console.log(res);
           swal({
               title: "",
               text: "Sample modified successfully",
               type: "success",
               confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
               onClose: function(e) {
                location.reload();
               }
           }), !1

         },
         error: function(res) {

           if(res.responseJSON.errors.email[0]){
                return swal({
                  title:  res.responseJSON.errors.email[0],
                  text: 'Please enter valid email',
                  type: "error",
                  confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
              }), !1
           }
         },
          dataType : 'json'
     });


    }
}),$("#m_form_1").validate({
            rules: {
                sample_details: {
                    required: !0,
                    maxlength: 400
                },
                sample_id: {
                    required: !0
                },
                client_name: {
                    required: !0,

                },
                client_address: {
                    required: !0,

                },
                client_city: {
                    required: !0,

                },
                txtDiscrption: {
                    required: !0,

                },
                track_id: {
                    required: !0
                }

            },
            invalidHandler: function(e, r) {
                mUtil.scrollTo("m_form_3", -200), swal({
                    title: "",
                    text: "There are some errors in your submission. Please correct them.",
                    type: "error",
                    confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
                    onClose: function(e) {
                        console.log("on close event fired!")
                    }
                }), e.preventDefault()
            },
            submitHandler: function(form) {
                $.ajax({
                 url: BASE_URL+'/sample',
                 type: 'POST',
                 data: $(form).serialize(),
                 success: function(res) {
                   console.log(res);
                   swal({
                       title: "",
                       text: "Sample Added successfully",
                       type: "success",
                       confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
                       onClose: function(e) {
                          location.reload();
                           window.location.href = BASE_URL+'/sample'
                       }
                   }), !1

                 },
                 error: function(res) {

                   if(res.responseJSON.errors.email[0]){
                        return swal({
                          title:  res.responseJSON.errors.email[0],
                          text: 'Please enter valid email',
                          type: "error",
                          confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                      }), !1
                   }
                 },
                  dataType : 'json'
             });


            }
        }), $("#m_form_2").validate({
            rules: {
                name: {
                    required: !0
                },
                phone: {
                    required: !0

                },
                company:{
                  required: !0
                }

            },
            invalidHandler: function(e, r) {
                mUtil.scrollTo("m_form_3", -200), swal({
                    title: "",
                    text: "There are some errors in your submission. Please correct them.",
                    type: "error",
                    confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
                    onClose: function(e) {
                        console.log("on close event fired!")
                    }
                }), e.preventDefault()
            },
            submitHandler: function(form) {
                $.ajax({
                 url: BASE_URL+'/client',
                 type: 'POST',
                 data: $(form).serialize(),
                 success: function(res) {
                   console.log(res);
                   swal({
                       title: "",
                       text: "Client Added successfully",
                       type: "success",
                       confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
                       onClose: function(e) {
                          location.reload();
                       }
                   }), !1

                 },
                 error: function(res) {

                   if(res.responseJSON.errors.email[0]){
                        return swal({
                          title:  res.responseJSON.errors.email[0],
                          text: 'Please enter valid email',
                          type: "error",
                          confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                      }), !1
                   }
                 },
                  dataType : 'json'
             });


            }
        }), $("#m_form_3").validate({
            rules: {
                name: {
                    required: !0
                },

            },
            invalidHandler: function(e, r) {
                mUtil.scrollTo("m_form_3", -200), swal({
                    title: "",
                    text: "There are some errors in your submission. Please correct them.",
                    type: "error",
                    confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
                    onClose: function(e) {
                        console.log("on close event fired!")
                    }
                }), e.preventDefault()
            },
            submitHandler: function(e) {
                return swal({
                    title: "",
                    text: "Form validation passed. All good!",
                    type: "success",
                    confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                }), !1
            }
        })
    }
};
jQuery(document).ready(function() {
    FormControlsAyra.init()
});


var Select2 = {
    init: function() {
        $("#m_select2_1, #m_select2_1_validate").select2({
            placeholder: "Select a state"
        }), $("#m_select2_2, #m_select2_2_validate").select2({
            placeholder: "Select a state"
        }), $("#m_select2_3, #m_select2_3_validate").select2({
            placeholder: "Select a state"
        }), $("#m_select2_4").select2({
            placeholder: "Select a state",
            allowClear: !0
        }), $("#m_select2_5").select2({
            placeholder: "Select a value",
            data: [{
                id: 0,
                text: "Enhancement"
            }, {
                id: 1,
                text: "Bug"
            }, {
                id: 2,
                text: "Duplicate"
            }, {
                id: 3,
                text: "Invalid"
            }, {
                id: 4,
                text: "Wontfix"
            }]
        }), $("#m_select2_6").select2({
            placeholder: "Search for git repositories",
            allowClear: !0,

            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: "json",
                delay: 250,
                data: function(e) {
                    return {
                        q: e.term,
                        page: e.page
                    }
                },
                processResults: function(e, t) {
                    return t.page = t.page || 1, {
                        results: e.items,
                        pagination: {
                            more: 30 * t.page < e.total_count
                        }
                    }
                },
                cache: !0
            },
            escapeMarkup: function(e) {
                return e
            },
            minimumInputLength: 1,
            templateResult: function(e) {
                if (e.loading) return e.text;
                var t = "<div class='select2-result-repository clearfix'><div class='select2-result-repository__meta'><div class='select2-result-repository__title'>" + e.full_name + "</div>";

                return e.description && (t += "<div class='select2-result-repository__description'>" + e.description + "</div>"), t += "<div class='select2-result-repository__statistics'><div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + e.forks_count + " Forks</div><div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + e.stargazers_count + " Stars</div><div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + e.watchers_count + " Watchers</div></div></div></div>"
            },
            templateSelection: function(e) {
                return e.full_name || e.text
            }
        }), $("#m_select2_12_1, #m_select2_12_2, #m_select2_12_3, #m_select2_12_4").select2({
            placeholder: "Select an option"
        }), $("#m_select2_7").select2({
            placeholder: "Select an option"
        }), $("#m_select2_8").select2({
            placeholder: "Select an option"
        }), $("#m_select2_9").select2({
            placeholder: "Select an option",
            maximumSelectionLength: 2
        }), $("#m_select2_10").select2({
            placeholder: "Select an option",
            minimumResultsForSearch: 1 / 0
        }), $("#m_select2_11").select2({
            placeholder: "Add a tag",
            tags: !0
        }), $(".m-select2-general").select2({
            placeholder: "Select an option"
        }), $("#m_select2_modal").on("shown.bs.modal", function() {
            $("#m_select2_1_modal").select2({
              placeholder: "Select a city",
              allowClear: !1,
              ajax: {
                  url: BASE_URL+'/api/getCity',
                  dataType: "json",
                  delay: 250,
                  data: function(e) {
                  return {
                          q: e.term,
                          page: e.page
                      }
                  },
                  processResults: function(e, t) {
                      return t.page = t.page || 1, {
                          results: e.items,
                          pagination: {
                              more: 30 * t.page < e.total_count
                          }
                      }
                  },
                  cache: !0
              },
              escapeMarkup: function(e) {
                  return e
              },
              minimumInputLength: 1,
              templateResult: function(e) {
                  if (e.loading) return e.name;
                  var t = "<option>"+e.name+"</value>";
                  return t;
              },
              templateSelection: function(e) {
                  return e.name || e.id
              }

            }),  $("#m_select2_1_modal_edit").select2({
                placeholder: "Select a city",
                allowClear: !1,
                ajax: {
                    url: BASE_URL+'/api/getCity',
                    dataType: "json",
                    delay: 250,
                    data: function(e) {
                    return {
                            q: e.term,
                            page: e.page
                        }
                    },
                    processResults: function(e, t) {
                        return t.page = t.page || 1, {
                            results: e.items,
                            pagination: {
                                more: 30 * t.page < e.total_count
                            }
                        }
                    },
                    cache: !0
                },
                escapeMarkup: function(e) {
                    return e
                },
                minimumInputLength: 1,
                templateResult: function(e) {
                    if (e.loading) return e.name;
                    var t = "<option>"+e.name+"</value>";
                    return t;
                },
                templateSelection: function(e) {
                    return e.name || e.id
                }

              }), $("#m_select2_2_modal").select2({
                placeholder: "Select a state"
            }), $("#m_select2_3_modal").select2({
                placeholder: "Select a state"
            }), $("#m_select2_4_modal").select2({
                placeholder: "Select a state",
                allowClear: !0
            })
        })
    }
};
jQuery(document).ready(function() {
    Select2.init()
});


//== Class definition
var FormRepeater = function() {

    //== Private functions
    var demo1 = function() {
        $('#m_repeater_1').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }

    var demo2 = function() {
        $('#m_repeater_2').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });
    }


    var demo3 = function() {
        $('#m_repeater_3').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });
    }

    var demo4 = function() {
        $('#m_repeater_4').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }

    var demo5 = function() {
        $('#m_repeater_5').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }

    var demo6 = function() {
        $('#m_repeater_6').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    }
    return {
        // public functions
        init: function() {
            demo1();
            demo2();
            demo3();
            demo4();
            demo5();
            demo6();
        }
    };
}();

jQuery(document).ready(function() {
    FormRepeater.init();
});

var DropzoneDemo = {
    init: function() {
        Dropzone.options.mDropzoneOne = {
            paramName: "file",
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: !0,
            accept: function(e, o) {
                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
            }
        }, Dropzone.options.mDropzoneTwo = {
            paramName: "file",
            maxFiles: 10,
            maxFilesize: 10,
            addRemoveLinks: !0,
            accept: function(e, o) {
                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
            }
        }, Dropzone.options.mDropzoneThree = {
            paramName: "file",
            maxFiles: 10,
            maxFilesize: 10,
            addRemoveLinks: !0,
            acceptedFiles: "image/*,application/pdf,.psd",
            accept: function(e, o) {
                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o()
            }
        }
    }
};
DropzoneDemo.init();


var BootstrapDatepicker = function() {
    var t;
    t = mUtil.isRTL() ? {
        leftArrow: '<i class="la la-angle-right"></i>',
        rightArrow: '<i class="la la-angle-left"></i>'
    } : {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
    };
    return {
        init: function() {
            $("#m_datepicker_1, #m_datepicker_1_validate").datepicker({
                rtl: mUtil.isRTL(),
                todayHighlight: !0,
                orientation: "bottom left",
                templates: t,
                autoclose: true,

            }), $("#m_datepicker_1_modal").datepicker({
                rtl: mUtil.isRTL(),
                todayHighlight: !0,
                orientation: "bottom left",
                templates: t
            }), $("#m_datepicker_2, #m_datepicker_2_validate").datepicker({
                rtl: mUtil.isRTL(),
                todayHighlight: !0,
                orientation: "bottom left",
                templates: t
            }), $("#m_datepicker_2_modal").datepicker({
                rtl: mUtil.isRTL(),
                todayHighlight: !0,
                orientation: "bottom left",
                templates: t
            }), $("#m_datepicker_3,#m_datepicker_3A, #m_datepicker_3_validate").datepicker({
                rtl: mUtil.isRTL(),
                todayBtn: "linked",
                clearBtn: !0,
                todayHighlight: !0,
                templates: t,
                 setDate: new Date(),
                autoclose: true,
                format: 'dd-M-yyyy',

            }), $("#m_datepicker_3_modal").datepicker({
                rtl: mUtil.isRTL(),
                todayBtn: "linked",
                clearBtn: !0,
                todayHighlight: !0,
                templates: t
            }), $("#m_datepicker_4_1").datepicker({
                rtl: mUtil.isRTL(),
                orientation: "top left",
                todayHighlight: !0,
                templates: t
            }), $("#m_datepicker_4_2").datepicker({
                rtl: mUtil.isRTL(),
                orientation: "top right",
                todayHighlight: !0,
                templates: t
            }), $("#m_datepicker_4_3").datepicker({
                rtl: mUtil.isRTL(),
                orientation: "bottom left",
                todayHighlight: !0,
                templates: t
            }), $("#m_datepicker_4_4").datepicker({
                rtl: mUtil.isRTL(),
                orientation: "bottom right",
                todayHighlight: !0,
                templates: t
            }), $("#m_datepicker_5").datepicker({
                rtl: mUtil.isRTL(),
                todayHighlight: !0,
                templates: t
            }), $("#m_datepicker_6").datepicker({
                rtl: mUtil.isRTL(),
                todayHighlight: !0,
                templates: t
            })
        }
    }
}();
jQuery(document).ready(function() {
    BootstrapDatepicker.init()
});

var ToastrDemo = function() {
    var t = function() {
        var t, o = -1,
            e = 0;
        $("#showtoast").click(function() {
            var n, a = $("#toastTypeGroup input:radio:checked").val(),
                i = $("#message").val(),
                s = $("#title").val() || "",
                r = $("#showDuration"),
                l = $("#hideDuration"),
                c = $("#timeOut"),
                p = $("#extendedTimeOut"),
                u = $("#showEasing"),
                d = $("#hideEasing"),
                h = $("#showMethod"),
                v = $("#hideMethod"),
                g = e++,
                f = $("#addClear").prop("checked");
            toastr.options = {
                closeButton: $("#closeButton").prop("checked"),
                debug: $("#debugInfo").prop("checked"),
                newestOnTop: $("#newestOnTop").prop("checked"),
                progressBar: $("#progressBar").prop("checked"),
                positionClass: $("#positionGroup input:radio:checked").val() || "toast-top-right",
                preventDuplicates: $("#preventDuplicates").prop("checked"),
                onclick: null
            }, $("#addBehaviorOnToastClick").prop("checked") && (toastr.options.onclick = function() {
                alert("You can perform some custom action after a toast goes away")
            }), r.val().length && (toastr.options.showDuration = r.val()), l.val().length && (toastr.options.hideDuration = l.val()), c.val().length && (toastr.options.timeOut = f ? 0 : c.val()), p.val().length && (toastr.options.extendedTimeOut = f ? 0 : p.val()), u.val().length && (toastr.options.showEasing = u.val()), d.val().length && (toastr.options.hideEasing = d.val()), h.val().length && (toastr.options.showMethod = h.val()), v.val().length && (toastr.options.hideMethod = v.val()), f && (i = function(t) {
                return t = t || "Clear itself?", t += '<br /><br /><button type="button" class="btn btn-outline-light btn-sm m-btn m-btn--air m-btn--wide clear">Yes</button>'
            }(i), toastr.options.tapToDismiss = !1), i || (++o === (n = ["New order has been placed!", "Are you the six fingered man?", "Inconceivable!", "I do not think that means what you think it means.", "Have fun storming the castle!"]).length && (o = 0), i = n[o]), $("#toastrOptions").text("toastr.options = " + JSON.stringify(toastr.options, null, 2) + ";\n\ntoastr." + a + '("' + i + (s ? '", "' + s : "") + '");');
            var k = toastr[a](i, s);
            t = k, void 0 !== k && (k.find("#okBtn").length && k.delegate("#okBtn", "click", function() {
                alert("you clicked me. i was toast #" + g + ". goodbye!"), k.remove()
            }), k.find("#surpriseBtn").length && k.delegate("#surpriseBtn", "click", function() {
                alert("Surprise! you clicked me. i was toast #" + g + ". You could perform an action here.")
            }), k.find(".clear").length && k.delegate(".clear", "click", function() {
                toastr.clear(k, {
                    force: !0
                })
            }))
        }), $("#clearlasttoast").click(function() {
            toastr.clear(t)
        }), $("#cleartoasts").click(function() {
            toastr.clear()
        })
    };
    return {
        init: function() {
            t()
        }
    }
}();
jQuery(document).ready(function() {
    ToastrDemo.init()
});
