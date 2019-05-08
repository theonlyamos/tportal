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
  $("#m_modal_tournament").on("show.bs.modal", ()=>{
    $("#m_form_tournament").resetForm();
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

  $("#bulk_fide_submit").on("click", (e) => {
    e.preventDefault();
    e = $(e.target)
    var r = $("#bulk_fide_form");
    r.validate({
      ignore: ":hidden",
      rules: {
        bulkFile: !0
      }
    }), r.valid() && (mApp.block("#bulk_fide_form", {}), r.ajaxSubmit({
      url: "/actions.php",
      method: "post",
      success: (s,t) => {
        console.log(s,t)
        mApp.unblock("#bulk_fide_form")
        Notify("Success", "File upload successful", "success", "fa fa-check")
      },
      error: (w) => {
        console.log(w)
        mApp.unblock("#bulk_fide_form")
        Notify("Error", w.responseText, "danger", "la la-close")
      }
    }))
  })


  $("#bulk_rating_submit").on("click", (e) => {
    e.preventDefault();
    e = $(e.target)
    var r = $("#bulk_rating_form");
    r.validate({
      ignore: ":hidden",
      rules: {
        bulkFile: !0
      }
    }), r.valid() && (mApp.block("#bulk_rating_form", {}), r.ajaxSubmit({
      url: "/actions.php",
      method: "post",
      success: (s,t) => {
        console.log(s,t)
        mApp.unblock("#bulk_rating_form")
        Notify("Success", "File upload successful", "success", "fa fa-check")
      },
      error: (w) => {
        console.log(w)
        mApp.unblock("#bulk_rating_form")
        Notify("Error", w.responseText, "danger", "la la-close")
      }
    }))
  })

  $("#income_sheet_submit").on("click", (e) => {
    e.preventDefault();
    e = $(e.target)
    var r = $("#income_sheet_form");
    r.validate({
      ignore: ":hidden",
      rules: {
        particular: !0,
        amount: !0,
      }
    }), r.valid() && (mApp.block("#income_sheet_form", {}), r.ajaxSubmit({
      url: "/actions.php",
      method: "post",
      success: (s,t) => {
        mApp.unblock("#income_sheet_form")
        r.clearForm().resetForm()
        Notify("Success", "Income sheet added", "success", "fa fa-check")
        var ignore = ["action", "name"];
        var data = JSON.parse(s);
        var total = $("#income_sheet_total").text();
        total = parseFloat(total) + parseFloat(data.amount);
        total = total.toFixed(2);
        var row = "<tr class='row-"+data.id+"'>";
        for (var key in data){
          if (!ignore.includes(key)){
            if (key === 'amount') row += "<td class='editable-amount'>"+parseFloat(data[key]).toFixed(2)+"</td>";
            else if (key === 'particular') row += "<td class='editable-particular'>"+data[key]+"</td>";
            else if (key === 'pan') row += "<td class='editable-pan'>"+data[key]+"</td>";
          }
        }
        row += "<td class='d-flex align-items-center justify-content-center'>";
        row += "<i class='fa flaticon-edit-1 text-primary sheet-edit mx-2' data-toggle='modal' ";
        row += "data-target='#m_modal_sheet' data-id='" + data.id
        row += "' data-sheet='income' style='cursor: pointer' title='Edit'></i> ";
        row += "<i class='fa fa-trash text-danger sheet-delete' data-target='";
        row += data.id + "'data-sheet='income' style='cursor: pointer' title='Delete'></i></td>";
        row += "</tr>";
        $("#income_sheet_table tbody").prepend(row);
        $("#income_sheet_total").text(total);
      },
      error: (w) => {
        console.log(w)
        mApp.unblock("#income_sheet_form")
        Notify("Error", w.responseText, "danger", "la la-close")
      }
    }))
  })

  $("#expense_sheet_submit").on("click", (e) => {
    e.preventDefault();
    e = $(e.target)
    var r = $("#expense_sheet_form");
    r.validate({
      ignore: ":hidden",
      rules: {
        particular: !0,
        amount: !0,
      }
    }), r.valid() && (mApp.block("#expense_sheet_form", {}), r.ajaxSubmit({
      url: "/actions.php",
      method: "post",
      success: (s,t) => {
        mApp.unblock("#expense_sheet_form")
        r.clearForm().resetForm()
        Notify("Success", "Expense sheet added", "success", "fa fa-check")
        var ignore = ["action", "name"];
        var data = JSON.parse(s);
        var total = $("#expense_sheet_total").text();
        total = parseFloat(total) + parseFloat(data.amount);
        total = total.toFixed(2);
        var row = "<tr class='row-"+data.id+"'>";
        for (var key in data){
          if (!ignore.includes(key)){
            if (key === 'amount') row += "<td class='editable-amount'>"+parseFloat(data[key]).toFixed(2)+"</td>";
            else if (key === 'particular') row += "<td class='editable-particular'>"+data[key]+"</td>";
          }
        }
        row += "<td class='d-flex align-items-center justify-content-center'>";
        row += "<i class='fa flaticon-edit-1 text-primary sheet-edit mx-2' data-toggle='modal' ";
        row += "data-target='#m_modal_sheet' data-id='" + data.id
        row += "' data-sheet='expense' style='cursor: pointer' title='Edit'></i> ";
        row += "<i class='fa fa-trash text-danger sheet-delete' data-target='";
        row += data.id + "'data-sheet='expense' style='cursor: pointer' title='Delete'></i></td>";
        row += "</tr>";
        $("#expense_sheet_table tbody").prepend(row);
        $("#expense_sheet_total").text(total);
      },
      error: (w) => {
        console.log(w)
        mApp.unblock("#income_sheet_form")
        Notify("Error", w.responseText, "danger", "la la-close")
      }
    }))
  })

  $("#m_sheet_edit").on("click", (e) => {
    e.preventDefault();
    e = $(e.target)
    var r = $("#m_form_sheet");
    r.validate({
      ignore: ":hidden",
      rules: {
        particular: !0,
        amount: !0,
      }
    }), r.valid() && (mApp.block("#m_form_sheet", {}), r.ajaxSubmit({
      url: "/actions.php",
      method: "post",
      success: (s,t) => {
        var changes = JSON.parse(s);
        var i = $(".editor-name").val();
        var amount = $(".old-amount").val();
        amount = parseFloat(amount);
        var totalel = $("#"+i+"_sheet_total")
        var total = parseFloat($(totalel).text());
        total -= amount;
        newAmount = parseFloat(changes.amount)
        total += newAmount;
        var parent = $("tr.row-"+changes.id)[0];
        $(parent).find(".editable-particular").text(changes.particular);
        $(parent).find(".editable-amount").text(newAmount.toFixed(2));
        if (changes.pan){
          $(parent).find(".editable-pan").text(changes.pan);
        }
        $(totalel).text(total.toFixed(2));
        mApp.unblock("#m_form_sheet")
        r.clearForm().resetForm()
        Notify("Success", "Change successful", "success", "fa fa-check")
        $("#m_sheet_dismiss").click();
      },
      error: (w) => {
        console.log(w)
        mApp.unblock("#m_form_sheet")
        Notify("Error", w.responseText, "danger", "la la-close")
      }
    }))
  })

  $("#m_tournament_submit").click(function (e) {
        e.preventDefault();
        e = $(e.target), e.attr("disabled", !0)
        l = $("#m_form_tournament");
        l.validate({
          rules: {
            title: {
              required: !0
            },
            author: {
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
            url: "../adminActions.php",
            method: "post",
            success: (w,s) => {
              console.log(w)
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
              e.attr("disabled", !1)
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

  $(".expand").on("click", (e) => {
    var target = $(e.target).data("target");
    var name = $(e.target).data("name");
    var type = $(e.target).data("type");
    if ($("table[data-id='"+target+"']").children().length == 0){
      mApp.block(".m-content", {})
      $.get('/assets/data/bulkuploads/'+type+'/'+name)
      .done((d) => {
        mApp.unblock(".m-content")
        var content = d.split("\n");
        var head = content[0].split(",");
        var thead = "<thead>";
        var tbody = "<tbody>";
        for (var i=0; i<head.length; i++){
          thead += "<th>"+head[i]+"</th>"
        }
        thead += "</thead>";
        var body = content;
        body.shift();
        for(var i=0; i<body.length; i++){
            tr = body[i].split(",");
            var row = "<tr>";
            for (var j = 0; j<tr.length; j++){
              row += "<td>"+tr[j]+"</td>";
            }
            row += "</tr>";
            tbody += row;
        }
        tbody += "</tbody>";
        $("table[data-id='"+target+"']").append(thead);
        $("table[data-id='"+target+"']").append(tbody);
      })
    }
  })

  $("table.sheet-table").on("click", ".sheet-delete", (e) => {
    var t = $(e.target)
    var i = t.data("target");
    var n = t.data("sheet")
    var parent = $(".row-"+i)[0];
    var amount = $(parent).find(".editable-amount");
    amount = parseFloat($(amount).text());
    var totalel = $("#"+n+"_sheet_total");
    var total = parseFloat($(totalel).text());
    $.get('/actions.php', {target: i, field: 'sheets', name: 'delete'})
     .done((d) => {
        total -= amount;
        total = total.toFixed(2);
        $(totalel).text(total);
        $(".row-"+i)[0].remove();
        Notify('Success', 'Operation successful', 'success','fa fa-trash')
     })
  })

  $("table.sheet-table").on("click", ".sheet-edit", (e) => {
    var t = $(e.target)
    var i = t.data("id");
    var parent = $(".row-"+i)[0];
    var sheet = t.data("sheet")
    $(".editor-target").val(i);
    $(".editor-particular").val($(parent).find("td.editable-particular").text());
    $(".editor-amount").val($(parent).find("td.editable-amount").text());
    $(".old-particular").val($(parent).find("td.editable-particular").text());
    $(".old-amount").val($(parent).find("td.editable-amount").text());
    if (sheet === 'income'){
      $(".income-only").show();
      if ($(".editor-pan")){
        $(".editor-name").val("income");
        $(".editor-pan").val($(parent).find("td.editable-pan").text());
        $(".old-pan").val($(parent).find("td.editable-pan").text());
      }
    }
    else {
      $(".editor-name").val("expense");
      $(".income-only").hide();
    }
  })

  $("#m_quick_sidebar_toggle").on("click", (e) => {
    var target = $(e.target).data("target");
    var parent = $("#ticket-"+target)[0];
    var username = $(parent).find(".m-widget3__username").text().trim().split("-")[0];
    var img = $(parent).find(".m-widget3__img").prop("src");
    var time = $(parent).find(".m-widget3__time").text().trim();
    var msg = $(parent).find(".m-widget3__text").text().trim();

    var message = '<div class="m-messenger__wrapper">'
    message += '<div class="m-messenger__message m-messenger__message--in">'
    message += '<div class="m-messenger__message-pic">'
    message += '<img src="'+img+'" alt="user picture" /></div>'
    message += '<div class="m-messenger__message-body">'
    message += '<div class="m-messenger__message-arrow"></div>'
    message += '<div class="m-messenger__message-content">'
    message += '<div class="m-messenger__message-username">'+username+'</div>'
    message += '<div class="m-messenger__message-text">'+msg+'</div>'
    message += '</div></div></div></div>'
    message += '<div class="m-messenger__datetime">'+time+'</div>'

    $(".m-messenger__messages").html(message);
  })

  $(".m-messenger__form-input").on("keypress", (e)=> {
    if (e.which === 13) {
      var msg = e.target.value
      if (msg) {
        mApp.block(".m-messenger__messages", {})
        $.post("/actions.php", {message: msg, user : 1234})
         .done((d) =>{
            console.log(d);
            var d = JSON.parse(d);
            var message = '<div class="m-messenger__wrapper">'
            message += '<div class="m-messenger__message m-messenger__message--out">'
            message += '<div class="m-messenger__message-body">'
            message += '<div class="m-messenger__message-arrow"></div>'
            message += '<div class="m-messenger__message-content">'
            message += '<div class="m-messenger__message-text">'+d.message+'</div>'
            message += '</div></div></div></div>'

            $(".m-messenger__messages").append(message);
            $(".m-messenger__form-input").val("");

            mApp.unblock(".m-messenger__messages");
         })
        
      }
    }
  })

  $(".tournament_details").on("click", (e) => {
    var id = $(e.target).data("id");
    $(".action_tournament").data("target", id);
    $("input[name='action']").val("update");
    $("input[name='target']").val(id);
    $("#arbiters_list").html("");
    $("#coaches_list").html("");
    mApp.block(".m-content", {})
    $.get('/actions.php', {name: "details", target: id, field: 'tournaments'})
     .done((d) => {
        var data = JSON.parse(d);
        var tournament = data.tournament;
        var formFields = ["title", "description", "address", "city", "country", "venue", "users",
                          "tentativeDates", "price", "contactName", "contactPhone", "contactEmail",
                          "organizerName", "organizerEmail", "organizerPhone", "author", "arbiters", "coaches"]
        for (var i = 0; i<formFields.length; i++){
          if (formFields[i] == 'tentativeDates'){
            for (var j = 0; j<tournament.tentativeDates.length; j++){
              var el = $("[name='tentativeDates[]']")[j]
              $(el).val(tournament.tentativeDates[j])
            }
          }
          else if (formFields[i] == 'arbiters'){
            if (tournament.arbiters){
              for (var j = 0; j<tournament.arbiters.length; j++){
                var arbiter = tournament.arbiters[j]
                var line = '<div class="col-11 m-form__group-sub mt-2 input">'
                line += '<input type="phone" name="arbiters[]" class="form-control m-input bg-secondary"'
                line += ' placeholder="" value="'+arbiter+'" readonly></div>'
                line += '<div class="col-1 m-form__group-sub mt-2">'
                line += '<button type="button" class="btn m-btn btn-danger" id="remove_arbiter"'
                line += ' title="Remove Arbiter">-</button></div>'
                $("#arbiters .form-group").append(line);
              }
          }
          }
          else if (formFields[i] == 'coaches'){
            if (tournament.coaches){
              for (var j = 0; j<tournament.coaches.length; j++){
                var coache = tournament.coaches[j]
                var line = '<div class="col-11 m-form__group-sub mt-2 input">'
                line += '<input type="phone" name="arbiters[]" class="form-control m-input bg-secondary"'
                line += ' placeholder="" value="'+coache+'" readonly></div>'
                line += '<div class="col-1 m-form__group-sub mt-2">'
                line += '<button type="button" class="btn m-btn btn-danger" id="remove_arbiter"'
                line += ' title="Remove Arbiter">-</button></div>'

                $("#coaches .form-group").append(line);
              }
            }
          }
          else if (formFields[i] == 'users'){

            for (var j in tournament.users){
              if (tournament.users[j].profession == 'arbiter'){
                var line = '<option>'+tournament.users[j].fullname+'</option>'
                $("#arbiters_list").append(line);
              }
              else if (tournament.users[j].profession == 'coach'){
                var line = '<option>'+tournament.users[j].fullname+'</option>'
                $("#coaches_list").append(line);
              }
            }
          }
          else {
            $("[name='"+formFields[i]+"']").val(tournament[formFields[i]]);
          }
        }
        mApp.unblock(".m-content");
     })
  })

  $(".action_tournament").on("click", (e) => {
    var t = $(e.target);
    var target = t.data("target")
    var action = t.data("action")
    mApp.block(".modal-body", {})
    $.get('/actions.php', {name: action, target: target, field: "tournaments"})
     .done((d) => {
       if (action == 'approve'){
        $(".approved-"+t.data("target")).removeClass("m-badge--danger").addClass("m-badge--primary").text("approved");
        $("#m_tournament_dismiss").click();
        Notify("Success", "Tournament approved successfully!", "success", "fa fa-check")
       }
       else if (action == 'reject'){
        $(".approved-"+t.data("target")).removeClass("m-badge--primary").addClass("m-badge--danger").text("rejected");
        $("#m_tournament_dismiss").click();
        Notify("Success", "Tournament rejected!", "success", "fa fa-times-circle");
       }
       else if (action == 'delete'){
        $("tr."+t.data("target")).remove();
        $("#m_tournament_dismiss").click();
        Notify("Success", "Tournament deleted successfully!", "success", "fa fa-trash");
       }
       mApp.unblock(".modal-body")
     })
  })

  $("#add_arbiter").on("click", (e) => {
    if ($("#add_arbiter_input").val()){
      var arbiter = $("#add_arbiter_input").val()
      var line = '<div class="col-11 m-form__group-sub mt-2 input">'
      line += '<input type="phone" name="arbiters[]" class="form-control m-input bg-secondary"'
      line += ' placeholder="" value="'+arbiter+'" readonly></div>'
      line += '<div class="col-1 m-form__group-sub mt-2">'
      line += '<button type="button" class="btn m-btn btn-danger" id="remove_arbiter"'
      line += ' title="Remove Arbiter">-</button></div>'

      $("#arbiters .form-group").append(line);
      $("#add_arbiter_input").val("")
    }
  })

  $("#add_coache").on("click", (e) => {
    if ($("#add_coache_input").val()){
      var coache = $("#add_coache_input").val()
      var line = '<div class="col-11 m-form__group-sub mt-2 input">'
      line += '<input type="phone" name="coaches[]" class="form-control m-input bg-secondary"'
      line += ' placeholder="" value="'+coache+'" readonly></div>'
      line += '<div class="col-1 m-form__group-sub mt-2">'
      line += '<button type="button" class="btn m-btn btn-danger" id="remove_coache"'
      line += ' title="Remove Coache">-</button></div>'

      $("#coaches .form-group").append(line);
      $("#add_coache_input").val("")
    }
  })

  $("#arbiters").on("click", "#remove_arbiter", (e) => {
    var t = $(e.target).parent().closest(".input")

  })

    // Users edit
  $(".user_details").on("click", (e) => {
    var id = $(e.target).data("id");
    $("#userModalTitle").text("User - "+id);
    $(".action_user").data("target", id);
    $("input[name='action']").val("update");
    $("input[name='target']").val(id);
    $("#m_form_user").resetForm();
    mApp.block(".m-content", {})
    $.get('/adminActions.php', {action: "details", target: id, field: 'users'})
     .done((d) =>{
      var data = JSON.parse(d);
      var user = data.user;
      var formFields = ["fullname", "email", "username", "profession", "trainertitle", "dob", "gender",
                        "blindness", "address", "postal", "district", "city", "state", "country", "cell",
                        "phone", "fideid", "fiderating ", "pan", "adhar", "national", "experience",
                        "communication", "picture", "medcert"]
      for (var i = 0; i<formFields.length; i++){
        if (user.hasOwnProperty(formFields[i])){
          if (formFields[i] == "gender"){
            $("[value='"+user[formFields[i]]+"']").prop("checked", true);
          }
          else if (formFields[i] == "picture") {
            $(".profile-pic").attr("href", '/assets/data/profiles/'+user[formFields[i]])
          }
          else if (formFields[i] == "medcert") {
            $(".medcert").attr("href", '/assets/data/medical/'+user[formFields[i]])
          }
          else {
            $("[name='"+formFields[i]+"']").val(user[formFields[i]]);
          }
        }
      }
      mApp.unblock(".m-content");
    })
  })

  $(".action_user").on("click", (e) => {
    var t = $(e.target);
    var target = t.data("target")
    var action = t.data("action")
    mApp.block(".modal-body", {})
    $.get('/adminActions.php', {action: action, target: target, field: "users"})
     .done((d) => {
       if (action == 'approve'){
        $(".approved-"+t.data("target")).removeClass("m-badge--danger").addClass("m-badge--success").text("approved");
        $("#m_tournament_dismiss").click();
        Notify("Success", "User approved successfully!", "success", "fa fa-check")
       }
       else if (action == 'reject'){
        $(".approved-"+t.data("target")).removeClass("m-badge--primary").addClass("m-badge--danger").text("rejected");
        $("#m_tournament_dismiss").click();
        Notify("Success", "User rejected!", "success", "fa fa-times-circle");
       }
       else if (action == 'delete'){
        $("tr."+t.data("target")).remove();
        $("#m_tournament_dismiss").click();
        Notify("Success", "User deleted successfully!", "success", "fa fa-trash");
       }
       mApp.unblock(".modal-body")
     })
  })

  $(".organization_details").on("click", (e) => {
    var id = $(e.target).data("id");
    $("#organizationModalTitle").text("Organization - "+id);
    $(".action_organization").data("target", id);
    $("input[name='action']").val("update");
    $("input[name='target']").val(id);
    $("#m_form_organization").resetForm();
    mApp.block(".m-content", {})
    $.get('/adminActions.php', {action: "details", target: id, field: 'organizations'})
     .done((d) =>{
      var data = JSON.parse(d);
      var orgs = data.orgs;
      var formFields = ["name", "email", "secondEmail", "country", "contact", "phone", "website",
                        "organizer", "organizerEmail", "document", "pan", "objectives", "bearerNames",
                        "bearerPhones", "bearerEmails", "bearerPans", "bearerDesignations",
                        "contactPerson", "contactPhone", "logo"]
      for (var i = 0; i<formFields.length; i++){
        if (orgs.hasOwnProperty(formFields[i])){
          if (formFields[i] == "document"){
            $("a.document").attr("href", "/assets/data/documents/"+orgs[formFields[i]])
          }
          else if (formFields[i] == "logo") {
            $("a.logo").attr("href", "/assets/data/documents/"+orgs[formFields[i]])
          }
          else if (formFields[i] == "bearerNames") {
            for (var j = 0; j<orgs.bearerNames.length; j++){
              var el = $("[name='bearerNames[]']")[j]
              $(el).val(orgs.bearerNames[j])
            }
          }
          else if (formFields[i] == "bearerPhones") {
            for (var j = 0; j<orgs.bearerPhones.length; j++){
              var el = $("[name='bearerPhones[]']")[j]
              $(el).val(orgs.bearerPhones[j])
            }
          }
          else if (formFields[i] == "bearerEmails") {
            for (var j = 0; j<orgs.bearerEmails.length; j++){
              var el = $("[name='bearerEmails[]']")[j]
              $(el).val(orgs.bearerEmails[j])
            }
          }
          else if (formFields[i] == "bearerPans") {
            for (var j = 0; j<orgs.bearerPans.length; j++){
              var el = $("[name='bearerPans[]']")[j]
              $(el).val(orgs.bearerPans[j])
            }
          }
          else if (formFields[i] == "bearerDesignations") {
            for (var j = 0; j<orgs.bearerDesignations.length; j++){
              var el = $("[name='bearerDesignations[]']")[j]
              $(el).val(orgs.bearerDesignations[j])
            }
          }
          else {
            $("[name='"+formFields[i]+"']").val(orgs[formFields[i]]);
          }
        }
      }
      mApp.unblock(".m-content");
    })
  })

  $(".action_organization").on("click", (e) => {
    var t = $(e.target);
    var target = t.data("target")
    var action = t.data("action")
    mApp.block(".modal-body", {})
    $.get('/adminActions.php', {action: action, target: target, field: "organizations"})
     .done((d) => {
       if (action == 'approve'){
        $(".approved-"+t.data("target")).removeClass("m-badge--danger").addClass("m-badge--success").text("approved");
        $("#m_tournament_dismiss").click();
        Notify("Success", "Organization approved!", "success", "fa fa-check")
       }
       else if (action == 'reject'){
        $(".approved-"+t.data("target")).removeClass("m-badge--primary").addClass("m-badge--danger").text("rejected");
        $("#m_tournament_dismiss").click();
        Notify("Success", "Organization rejected!", "warning", "fa fa-times-circle");
       }
       else if (action == 'delete'){
        $("tr."+t.data("target")).remove();
        $("#m_tournament_dismiss").click();
        Notify("Success", "Organization deleted!", "danger", "fa fa-trash");
       }
       mApp.unblock(".modal-body")
     })
  })
})