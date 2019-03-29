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
})