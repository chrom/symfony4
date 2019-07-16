$(document).ready(
  function () {
    $('.js-like-article').on('click', function (e) {
      e.preventDefault()
      var $link = $(e.currentTarget)
      $link.toggle('fa-heart-o').toggle('fa-heart')

      $.ajax({
        method: 'POST',
        url: $link.attr('href')
      }).done(function (data) {
        $('.js-like-article-count').html(data.hearts)
      })
    })
  })
