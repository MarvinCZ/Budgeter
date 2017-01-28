$(document).ready ->
  $('input.datetime').datetimepicker()

  $('.member.selectable-many').click ->
      $(this).toggleClass('selected')
      checkbox = $(this).find('input[type=checkbox]')
      checkbox.prop('checked', !checkbox.prop('checked'))

  $('.member.selectable-many').each ->
      checkbox = $(this).find('input[type=checkbox]')
      $(this).toggleClass('selected', checkbox.prop('checked'))

  updateSelect = () ->
      $('.member.selectable-one').each ->
          radio = $(this).find('input[type=radio]')
          $(this).toggleClass('selected', radio.prop('checked'))

  $('.member.selectable-one').click ->
      radio = $(this).find('input[type=radio]')
      radio.prop('checked', true)
      updateSelect()

  updateSelect();
