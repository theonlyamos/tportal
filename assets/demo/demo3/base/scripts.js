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

$(() => {


  $(".protype[name='profession']").on('change', (e) => {
    $(".option-input").hide();
    $(".option-input."+e.target.value).show();
  });

/* Feedback onclick
  $(".m-widget3__item").on("click", (e) => {
    mApp.block("#feedbacks .m-portlet__body", {})

    var name = $(e.currentTarget).find(".m-widget3__username").text().trim()
    var time = $(e.currentTarget).find(".m-widget3__time").text().trim()
    var status = $(e.currentTarget).find(".m-widget3__status").text().trim()
    var text = $(e.currentTarget).find(".m-widget3__text").text().trim()

    console.log([name, time, status, text]);
    mApp.unblock("#feedbacks .m-portlet__body")
  });
*/

  $("#newTicket").on("click", ()=> {
    $(".new-ticket-portlet").hide();
    $(".tickets-portlet").removeClass("d-none");
  });

  $("#backToTickets").on("click", ()=> {
    $(".tickets-portlet").addClass("d-none");
    $(".new-ticket-portlet").show();
  });

  $("#registerTournament").on("click", (e) => {
    var target = $(e.target).data("target")
    mApp.block(".m-tournament", {})
    $.get("/actions.php", {name: "register", target: target, field: "tournaments"})
     .done((d) => {
       var s = JSON.parse(d);
       if (s.success){
         $(e.target).attr("disabled", !0);
         $(e.target).html("<i class='fa fa-check'> Registered");
         var registrants = parseInt($(".m-widget19__number").text());
         $(".m-widget19__number").text(registrants += 1);
         Notify("Success", "Successfully registered for tournament!", "success", "fa fa-check")
       }
       else {
          Notify("Error", "Registration for tournament failed!", "danger", "la la-close")
       }
       mApp.unblock(".m-tournament");
     })
  })
})