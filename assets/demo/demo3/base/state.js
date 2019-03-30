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
        var a = $(this),
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
        }), l.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), 
          l.ajaxSubmit({
            url: "../stateActions.php",
            method: "post",
            success: (w,s) => {
              console.log(w, s)
              var tour = '<div class="col-xl-4"><div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">';
              tour += '<div class="m-portlet__head m-portlet__head--fit"><div class="m-portlet__head-caption"><div class="m-portlet__head-action">';
              tour += '<button type="button" class="btn btn-sm m-btn--pill  btn-brand"><i class="flaticon-placeholder-2"></i>';
              tour += $("[name='city']").val()+'</button></div></div></div><div class="m-portlet__body"><div class="m-widget19">';
              tour += '<div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides"><img src="../assets/app/media/img/bg/chess.png" alt="">';
              tour += '<h3 class="m-widget19__title m--font-light">'+$("[name='title']").val()+'</h3><div class="m-widget19__shadow"></div></div>';
              tour += '<div class="m-widget19__content"><div class="m-widget19__header"><div class="m-widget19__user-img">';
              tour += '<img class="m-widget19__img" src="../assets/app/media/img/users/neutral.png" alt=""></div><div class="m-widget19__info">';
              tour += '<span class="m-widget19__username">';
              tour += 'Amos Amissah</span><br><span class="m-widget19__time">amosamissah@outlook.com</span></div><div class="m-widget19__stats">';
              tour += '<span class="m-widget19__number m--font-brand">0</span><span class="m-widget19__comment">Registered</span></div></div>';
              tour += '<div class="m-widget19__header"><div class="m-widget19__info"><span class="m-widget19__username">'
              tour += '<i class="flaticon-calendar-with-a-clock-time-tools"></i>Sun, 17 Mar 2019 11:45:13 GMT</span></div></div></div>';
              tour += '</div></div></div></div></div>';

              $(tour).prependTo(".tournaments-section");
              a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !0)
              a.removeClass("btn-warning").addClass("btn-success").html("<i class='fa fa-check'>Saved");
            },
            error: (e)=>{
              console.log(e)
            }
          })
          
          )
  
      })
})