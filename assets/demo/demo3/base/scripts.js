$(() => {
  $('.section').load('/tportal/header/user/profile.html')

  $(".pages a.m-nav__link").on('click', (e) => {
    e.preventDefault()
    $('.section').load('/tportal/header/user/'+$(e.target).data("target"))
  })

  $('select.profession').on('change', (e) => {
    var t = $(e.target).val()
    $('form.auth').removeClass('active')
    $('form.'+t).addClass('active')
  })
})