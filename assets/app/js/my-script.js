var SnippetLogin = function () {
  var e = $("#m_login"),
    i = function (e, i, a) {
      var l = $('<div class="m-alert m-alert--outline alert alert-' + i + ' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
      e.find(".alert").remove(), l.prependTo(e), mUtil.animateClass(l[0], "fadeIn animated"), l.find("span").html(a)
    };
  return {
    init: function () {
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
          setTimeout(function () {
            var tour = '<div class="col-xl-4"><div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">';
            tour += '<div class="m-portlet__head m-portlet__head--fit"><div class="m-portlet__head-caption"><div class="m-portlet__head-action">';
            tour += '<button type="button" class="btn btn-sm m-btn--pill  btn-brand"><i class="flaticon-placeholder-2"></i>';
            tour += $("[name='city']").val()+'</button></div></div></div><div class="m-portlet__body"><div class="m-widget19">';
            tour += '<div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides"><img src="../assets/app/media/img//blog/blog1.jpg" alt="">';
            tour += '<h3 class="m-widget19__title m--font-light">'+$("[name='title']").val()+'</h3><div class="m-widget19__shadow"></div></div>';
            tour += '<div class="m-widget19__content"><div class="m-widget19__header"><div class="m-widget19__user-img">';
            tour += '<img class="m-widget19__img" src="../assets/app/media/img/users/neutral.png" alt=""></div><div class="m-widget19__info">';
            tour += '<span class="m-widget19__username">';
            tour += 'Amos Amissah</span><br><span class="m-widget19__time">amosamissah@outlook.com</span></div><div class="m-widget19__stats">';
            tour += '<span class="m-widget19__number m--font-brand">0</span><span class="m-widget19__comment">Registered</span></div></div>';
            tour += '<div class="m-widget19__header"><div class="m-widget19__info"><span class="m-widget19__username">'
            tour += '<i class="flaticon-calendar-with-a-clock-time-tools"></i>Sun, 17 Mar 2019 11:45:13 GMT</span></div></div></div>';
            tour += '<div class="m-widget19__action"><button type="button" class="btn m-btn--pill btn-info m-btn"><i class="fa fa-check"></i>';
            tour += 'Approve</button></div></div></div></div></div>';

            $(tour).prependTo(".tournaments-section");
            a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !0)
            a.removeClass("btn-warning").addClass("btn-success").html("<i class='fa fa-check'>Saved");
          }, 2e3))
  
      }),$("#m_login_forget_password_submit").click(function (l) {
        l.preventDefault();
        var t = $(this),
          r = $(this).closest("form");
        r.validate({
          rules: {
            email: {
              required: !0,
              email: !0
            }
          }
        }), r.valid() && (t.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), r.ajaxSubmit({
          url: "",
          success: function (l, s, n, o) {
            setTimeout(function () {
              t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), r.clearForm(), r.validate().resetForm(), a();
              var l = e.find(".m-login__signin form");
              l.clearForm(), l.validate().resetForm(), i(l, "success", "Cool! Password recovery instruction has been sent to your email.")
            }, 2e3)
          }
        }))
      })
    }
  }
}();


jQuery(document).ready(function () {
  SnippetLogin.init()

});