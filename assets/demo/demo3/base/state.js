function Notify(title,message,state,icon) {
  var e = {
    message: message
  };
  title && (e.title = title), "" != icon && (e.icon = "icon " + icon);
  var t = $.notify(e, {
    type: state,
    allow_dismiss: true,
    newest_on_top: true,
    mouse_over: true,
    showProgressbar: false,
    spacing: 10,
    timer: 2000,
    placement: {
      from: "top",
      align: "right"
    },
    offset: {
      x: 30,
      y: 30
    },
    delay: 1000,
    z_index: 10000,
    animate: {
      enter: "animated " + "bounce",
      exit: "animated " + "bounce"
    }
  });
}

$(() =>{
  $("#name_modal").on("bs.modal.show", ()=>{
    //alert("Opened modal")
  })

  $(".editable").on("mouseenter", (e) => {
    $(e.target).children(".editor").show();
  }).mouseleave((e) => {
    $(e.target).children(".editor").hide();
  })

  $(".edit").on("mouseenter", (e) => {
    $(e.target).css("opacity", 1);
  }).mouseleave((e) => {
    $(e.target).css("opacity", 0);
  })

  $(".edit-picture").on("click", (e) => {
    $("#input-picture").click();
  })

  $(".editor").on("click", (e) => {
    $("span.field").text($(e.target).parent().data("field"))
    $("#editing_form [name='field']").val($(e.target).parent().data("field"));
    $("#editing_form [name='value']").val($(e.target).parent().text());
  })

  $("[type='file']").on("change", (e) => {
    mApp.block(".m-content", {})
    var r = $("form#edit_picture")
    r.ajaxSubmit({
      url: "../stateActions.php",
      method: "post",
      success: (s, t) => {
        console.log(s,t)
        mApp.unblock(".m-content")
        Notify("Success", "Operation performed successfully", "success", "fa fa-check")
      },
      error: (w) => {
        console.log(w)
        mApp.unblock(".m-content")
        Notify("Error", w.statusText, "danger", "la la-close")
      }
    })
  })

  $("#edit_name").on("click", (e) => {
    e = $(e.target), e.attr("disabled", !0)
    var r = $("#editing_form");
    r.validate({
      ignore: ":hidden",
      rules: {
        name: !0
      }
    }), r.valid() && (mApp.block("#name_modal .modal-content", {}), r.ajaxSubmit({
      url: "../stateActions.php",
      method: "post",
      success: (s,t) => {
        console.log(s,t)
        e.attr("disabled", !1)
        mApp.unblock("#name_modal .modal-content")
        Notify("Success", "Operation performed successfully", "success", "fa fa-check")
      },
      error: (w) => {
        console.log(w)
        e.attr("disabled", !1)
        mApp.unblock("#name_modal .modal-content")
        Notify("Error", w.statusText, "danger", "la la-close")
      }
    }))
  })

  $("#m_tournament_submit").click(function (e) {
        e.preventDefault();
        e = $(e.target), e.attr("disabled", !1)
        l = $("#m_form_tournament");
        l.validate({
          rules: {
            title: {
              required: !0
            },
            organization: {
              required: !0
            },
            description: {
              required: !0
            },
            address: {
              required: !0
            },
            city: {
              required: !0
            }
          }
        }), l.valid() && (mApp.block("#m_modal_tournament .modal-content", {}), 
          l.ajaxSubmit({
            url: "../stateActions.php",
            method: "post",
            success: (w,s) => {
/*
              var tour = '<div class="col-xl-4 col-lg-3 col-md-2"><div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">';
              tour += '<div class="m-portlet__head m-portlet__head--fit"><div class="m-portlet__head-caption"><div class="m-portlet__head-action">';
              tour += '<button type="button" class="btn btn-sm m-btn--pill btn-primary"><i class="flaticon-placeholder-2"></i>';
              tour += w['country']+'</button></div></div></div><div class="m-portlet__body"><div class="m-widget19">';
              tour += '<div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides"><img src="../assets/app/media/img/bg/chess.png" alt="">';
              tour += '<h3 class="m-widget19__title m--font-light">'+w['title']+'</h3><div class="m-widget19__shadow"></div></div>';
              tour += '<div class="m-widget19__content"><div class="m-widget19__header"><div class="m-widget19__user-img">';
              tour += '<img class="m-widget19__img" src="../assets/app/media/img/users/neutral.png" alt=""></div><div class="m-widget19__info">';
              tour += '<span class="m-widget19__username">';
              tour += w['author']+'</span><br><span class="m-widget19__time">'+w['city']+'</span></div><div class="m-widget19__stats">';
              tour += '<span class="m-widget19__number m--font-brand">0</span><span class="m-widget19__comment">Registered</span></div></div>';
              tour += '<div class="m-widget19__header" row w-100><table class="table table-striped table-borderless table-info col-12">'
						  tour += '<thead><tr><th>Start Dates</th><th>End Dates</th></tr></thead><tbody>';
              
              for (var i = 0; i < w['startDates'].length; i++){
                tour += '<tr><td>'+w['startDates'][i]+'</td><td>'+w['endDates'][i]+'</td></tr>';
              }

							tour += '</tbody></table></div></div>';
              tour += '</div></div></div></div>';

              $(tour).prependTo(".tournaments-section");
*/
              e.attr("disabled", !0)
              mApp.unblock("#m_modal_tournament .modal-content")
              l.clearForm().resetForm()
              $("#m_tournament_dismiss").click();
              Notify("Success", "Tournament Created Successfully!", "success", "fa fa-check")
              window.location.reload()
            },
            error: (e)=>{
              console.log(e)
              e.attr("disabled", !1)
              mApp.unblock("#m_modal_tournament .modal-content")
              Notify("Error", "Tournament not created. Try again", "danger", "fa fa-check")
            }
          })
          
        )
  
    })

    $(".approve_user").on("click", (e) => {
      var t = $(e.target)
      mApp.block(".m-content", {})
      $.get('/actions.php', {name: "approve", target: t.data("target"), field: "users"})
       .done((d) => {
         t.attr("disabled", !0)
         mApp.unblock(".m-content")
         $(".approved-"+t.data("target")).addClass("m-badge--success");
         Notify("Success", "User approved successfully!", "success", "fa fa-check")
       })
    })

    $(".approve_tournament").on("click", (e) => {
      var t = $(e.target)
      mApp.block(".m-content", {})
      $.get('/actions.php', {name: "approve", target: t.data("target"), field: "tournaments"})
       .done((d) => {
         t.attr("disabled", !0)
         mApp.unblock(".m-content")
         $(".approved-"+t.data("target")).addClass("m-badge--primary");
         Notify("Success", "Tournament approved successfully!", "success", "fa fa-check")
       })
    })

    $(".approve_organization").on("click", (e) => {
      var t = $(e.target)
      mApp.block(".m-content", {})
      $.get('/actions.php', {name: "approve", target: t.data("target"), field: "organizations"})
       .done((d) => {
         t.attr("disabled", !0)
         mApp.unblock(".m-content")
         $(".approved-"+t.data("target")).addClass("m-badge--success");
         Notify("Success", "Organization approved successfully!", "success", "fa fa-check")
       })
    })
})