function clearModalFields(modal) {
  const recordedAtField = modal.find('.recorded-at')
  const categoriesField = modal.find('.categories')
  const schemesField = modal.find('.schemes')
  const itemField = modal.find('.item')
  const costField = modal.find('.cost')

  recordedAtField.val('')
  categoriesField.empty()
  schemesField.empty()
  itemField.val('')
  costField.val('')

  clearSchemesFields(modal)
  clearCategoriesFields(modal)
  clearLoansFields(modal)
}

function clearCategoriesFields(modal) {
  const categoriesField = modal.find('.categories')
  categoriesField.removeAttr('disabled')
  categoriesField[0].setAttribute('required', '')

  const itemField = modal.find('.item')
  itemField.removeAttr('disabled')
  itemField[0].setAttribute('required', '')
}

function clearSchemesFields(modal) {
  const schemesField = modal.find('.schemes')
  schemesField.removeAttr('disabled')
  schemesField[0].setAttribute('required', '')
}

function clearLoansFields(modal) {
  const loansField = modal.find('.loans')
  loansField.empty()

  const loanRow = loansField.parents('.row')
  loanRow[0].setAttribute('style', 'display:none')

  const itemField = modal.find('.item')
  itemField.val('')
  itemField.removeAttr('disabled')
}

function formForScheme(modal, id) {
  const categoriesField = modal.find('.categories')
  categoriesField.removeAttr('required')
  categoriesField[0].setAttribute('disabled', '')

  const itemField = modal.find('.item')
  itemField.val('')
  itemField.removeAttr('required')
  itemField[0].setAttribute('disabled', '')

  const costField = modal.find('.cost')
  $.ajax({
    url: `/api/schemes/completion/${id}`,
    method: 'GET',
    dataType: 'json',
    success: scheme => {
      const { monthlyCost, balance } = scheme
      // if theres no cost yet
      if (costField[0].value === '') {
        costField.val(monthlyCost > balance ? balance : monthlyCost)
      }
      costField[0].setAttribute('max', balance)
    }
  })
}

function formForCategory(modal) {
  const schemesField = modal.find('.schemes')
  schemesField.removeAttr('required')
  schemesField[0].setAttribute('disabled', '')
}

function formForLoan(modal) {
  const loanRow = modal.find('.loans').parents('.row')
  loanRow.removeAttr('style')

  const itemField = modal.find('.item')
  itemField.val('')
  itemField[0].setAttribute('disabled', '')
}

$('.recordDates').on('change', function (e) {
  window.location.replace(`/records/${this.value}`)
})

$(document).on('click', '.add-record-btn', e => {
  const modal = $('#add-record-modal')
  const pathname = window.location.pathname
  const dateIndex = pathname.split('/').pop()

  if (dateIndex) {
    $.ajax({
      url: `/api/records/${dateIndex}/date`,
      method: 'GET',
      dataType: 'json',
      success: date => {
        const recordedAtField = modal.find('.recorded-at')
        recordedAtField.val(date.split(' ')[0])
      },
      error: () => {
        console.log('failed fetching date by index')
      }
    })
  }

  clearModalFields(modal)
  setCategories(modal)
  setSchemes(modal)
  setLoans(modal)
})

$(document).on('click', '.edit-record-btn', e => {
  const id = e.currentTarget.id.split('-').pop()
  const name = $(`#record-${id}`).find('.record-name')[0].innerText
  const modal = $('#edit-record-modal')

  modal.find('form')[0].setAttribute('action', `/records/${id}`)
  modal.find('.modal-title').text(`Edit record ${name}?`)

  clearModalFields(modal)
  setCategories(modal)

  $.ajax({
    url: `/api/records/${id}`,
    method: 'GET',
    dataType: 'json',
    success: record => {
      const { category_id, scheme_id, item, cost, recorded_at } = record
      const recordedAtField = modal.find('.recorded-at')
      recordedAtField.val(recorded_at.split(' ')[0])

      const costField = modal.find('.cost')
      costField.val(cost)

      if (scheme_id) {
        setSchemes(modal, scheme_id)
        const schemesField = modal.find('.schemes')
        schemesField
          .find(`option[value='${scheme_id}']`)
          .attr('selected', 'selected')

        formForScheme(modal, scheme_id)
      }

      if (category_id) {
        setSchemes(modal)
        const categoriesField = modal.find('.categories')
        const itemField = modal.find('.item')

        itemField.val(item)
        categoriesField
          .find(`option[value='${category_id}']`)
          .attr('selected', 'selected')

        formForCategory(modal)
      }

      if (category_id === 2) {
        const { id: loan_id } = record.relation
        setLoans(modal, loan_id)
        const loansField = modal.find('.loans')
        loansField
          .find(`option[value='${loan_id}']`)
          .attr('selected', 'selected')

        formForLoan(modal)
      }
    },
    error: () => {
      console.log('failed fetching record')
    }
  })
})

$('.categories').on('change', e => {
  const id = parseInt(e.currentTarget.value)
  const modal = $(e.currentTarget).parents('.modal')

  if (id === 2) {
    formForCategory(modal)
    formForLoan(modal)
  } else if (id) {
    formForCategory(modal)
    clearLoansFields(modal)
  } else {
    clearSchemesFields(modal)
    clearLoansFields(modal)
  }
})

$('.schemes').on('change', e => {
  const id = parseInt(e.currentTarget.value)
  const modal = $(e.currentTarget).parents('.modal')

  if (id) formForScheme(modal, id)
  else clearCategoriesFields(modal)
})

$('.loans').on('change', e => {
  const id = parseInt(e.currentTarget.value)
  const modal = $(e.currentTarget).parents('.modal')
  const costField = modal.find('.cost')

  if (id) {
    $.ajax({
      url: `/api/loans/${id}`,
      method: 'GET',
      dataType: 'json',
      success: loan => {
        const { cost, paid } = loan
        costField.val(cost - paid)
        costField[0].setAttribute('max', cost - paid)
      }
    })
  } else {
    costField.val('')
  }
})

$(document).on('click', '.delete-record-btn', e => {
  const id = e.currentTarget.id.split('-').pop()
  const name = $(`#record-${id}`).find('.record-name')[0].innerText

  $('#delete-record-modal').find('.modal-title')
    .text(`Are you sure you want to delete record ${name}?`)
  $('#delete-record-modal').find('form').attr('action', `/records/${id}`)
})
