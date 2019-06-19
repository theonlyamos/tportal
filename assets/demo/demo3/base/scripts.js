$(() => {


  $(".protype[name='profession']").on('change', (e) => {
    $(".option-input").hide();
    $(".option-input."+e.target.value).show();
  });

  $(".m-widget3__item").on("click", (e) => {
    mApp.block("#feedbacks .m-portlet__body", {})

    var name = $(e.currentTarget).find(".m-widget3__username").text().trim()
    var time = $(e.currentTarget).find(".m-widget3__time").text().trim()
    var status = $(e.currentTarget).find(".m-widget3__status").text().trim()
    var text = $(e.currentTarget).find(".m-widget3__text").text().trim()

    console.log([name, time, status, text]);
    mApp.unblock("#feedbacks .m-portlet__body")
  });

})