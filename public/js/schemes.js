$(document).on('click', '.add-scheme-btn', e => {
  const id = e.currentTarget.id.split('-').pop()
  const name = $(`#scheme-group-${id}`).find('span')[0].innerText
  const modal = $('#add-scheme-modal')

  modal.find('.modal-title').text(`Add a scheme for ${name}`)
  modal.find('#scheme-group-id').val(id)

  if (modal.find('.categories')[0].length === 0) {
    setCategories(modal)
  }
})

$(document).on('click', '.edit-scheme-btn', e => {
  const id = e.currentTarget.id.split('-').pop()
  const name = $(`#scheme-${id}`).find('.scheme-name')[0].innerText
  const modal = $('#edit-scheme-modal')

  if (modal.find('.categories')[0].length === 0) {
    setCategories(modal)
  }

  modal.find('form')[0].setAttribute('action', `/schemes/${id}`)
  modal.find('.modal-title').text(`Edit scheme ${name}?`)
  $.ajax({
    url: `/api/schemes/${id}`,
    method: 'GET',
    dataType: 'json',
    success: scheme => {
      const { item, cost, category_id, start_at, end_at, scheme_group_id } = scheme
      modal.find('#name').val(item)
      modal.find('#cost').val(cost)
      modal.find('#start-at').val(start_at.split(' ')[0])
      modal.find('#end-at').val(end_at.split(' ')[0])
      modal.find('#scheme-group-id').val(scheme_group_id)

      const options = modal.find('.categories')
      options.find(`option[value='${category_id}']`).attr('selected', 'selected')
      updateMonthDuration(modal)
    },
    error: () => {
      console.log('failed fetching scheme')
    }
  })
})

$(document).on('change', '.duration', e => {
  if (e.currentTarget.id === 'start-at') {
    $('#end-at')[0].setAttribute('min', e.currentTarget.value)
  }

  if (e.currentTarget.id === 'end-at') {
    $('#start-at')[0].setAttribute('max', e.currentTarget.value)
  }

  const modal = $(e.currentTarget).parents('.modal')
  updateMonthDuration(modal)
})

$(document).on('click', '.delete-scheme-btn', e => {
  const id = e.currentTarget.id.split('-').pop()
  const name = $(`#scheme-${id}`).find('.scheme-name')[0].innerText
  const modal = $('#delete-scheme-modal')

  modal.find('.modal-title')
    .text(`Are you sure you want to delete scheme ${name}?`)
  modal.find('form').attr('action', `/schemes/${id}`)
})

function updateMonthDuration(modal) {
  const startAt = modal.find('#start-at')[0].value
  const endAt = modal.find('#end-at')[0].value
  if (startAt && endAt) {
    const months = computeMonthDiff(new Date(startAt), new Date(endAt)) + 1
    modal.find('#month-duration').val(months)
  }
}

function computeMonthDiff(dateFrom, dateTo) {
  return (
    dateTo.getMonth() -
    dateFrom.getMonth() +
    (12 * (dateTo.getFullYear() - dateFrom.getFullYear()))
  )
 }