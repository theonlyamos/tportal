$(() => {


  $(".protype[name='profession']").on('change', (e) => {
    $(".option-input").hide();
    $(".option-input."+e.target.value).show();
  })

  

})