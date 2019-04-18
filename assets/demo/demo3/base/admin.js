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
    $.get('/actions.php', {action: "delete", target: i, field: 'sheets', name: 'delete'})
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
})