$(() => {
  $('.section').load('../header/user/home.html')

  $(".pages a.m-nav__link").on('click', (e) => {
    e.preventDefault()
    $('.section').load('../header/user/'+$(e.target).data("target"))
  })
/*
  $('select.profession').on('change', (e) => {
    $('.form-section').load('./header/registration/'+e.target.value+'.html')
  })
*/
})