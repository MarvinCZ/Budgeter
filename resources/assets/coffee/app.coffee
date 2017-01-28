$(document).ready ->
  $('input.datetime').datetimepicker()

  $('.member.selectable').click ->
      $(this).toggleClass('selected')
      checkbox = $(this).find('input[type=checkbox]')
      checkbox.prop('checked', !checkbox.prop('checked'));

  $('.member.selectable').each ->
      checkbox = $(this).find('input[type=checkbox]')
      $(this).toggleClass('selected', checkbox.prop('checked'))

