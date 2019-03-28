var WizardDemo = function () {
  $("#m_wizard");
  var e, r, i = $("#m_form");
  return {
    init: function () {
      var n;
      $("#m_wizard"), i = $("#m_form"), (r = new mWizard("m_wizard", {
        startStep: 1
      })).on("beforeNext", function (r) {
        !0 !== e.form() && r.stop()
      }), r.on("change", function (e) {
        mUtil.scrollTop()
      }), r.on("change", function (e) {
        1 === e.getStep()
      }), e = i.validate({
        ignore: ":hidden",
        rules: {
          profession: {
            required: !0,
          },
          name: {
            required: !0
          },
          email: {
            required: !0,
            email: !0
          },
          phone: {
            required: !0
          },
          city: {
            required: !0
          },
          state: {
            required: !0
          },
          country: {
            required: !0
          },
          username: {
            required: !0,
            minlength: 4
          },
          password: {
            required: !0,
            minlength: 6
          },
          adhar: {
            required: !0,
          },
          pan: {
            required: !0
          }
        },
        invalidHandler: function (e, r) {
          mUtil.scrollTop(), swal({
            title: "",
            text: "There are some errors in your submission. Please correct them.",
            type: "error",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
          })
        },
        submitHandler: function (e) {}
      }), (n = i.find('[data-wizard-action="submit"]')).on("click", function (r) {
        r.preventDefault(), e.form() && (mApp.progress(n), i.ajaxSubmit({
          url: "register.php",
          method: "post",
          success: function (r,s) {
            mApp.unprogress(n), swal({
              title: "Registration Successful!",
              text: "You can log in when your application has been approved. Try later!",
              type: "success",
              confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
            })
          },
          error: function(e) {
            mApp.unprogress(n), swal({
              title: "Error",
              text: e.responseText,
              type: "danger",
              confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
            })
          }
        }))
      })
    }
  }
}();
jQuery(document).ready(function () {
  WizardDemo.init()
});