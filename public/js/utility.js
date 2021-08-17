async function setCategories(modal) {
  $.ajax({
    url: '/api/categories',
    method: 'GET',
    dataType: 'json',
    async: false,
    success: categories => {
      const input = modal.find('.categories')

      input.append(`<option value="" selected></option>`)
      categories.forEach(c => {
        input.append(`<option value="${c.id}">${c.name} (${c.kind})</option>`)
      })
    },
    error: () => {
      console.log('failed fetching categories')
    }
  })
}

function setSchemes(modal, id = null) {
  $.ajax({
    url: '/api/schemes',
    method: 'GET',
    dataType: 'json',
    async: false,
    success: schemes => {
      const input = modal.find('.schemes')

      input.append(`<option value="" selected></option>`)
      schemes
        .filter(s => s.balance > 0 || s.id === id)
        .forEach(s => {
          const label = `${s.item} (${s.scheme_group.name})`
          input.append(`<option value="${s.id}">${label}</option>`)
        })
    },
    error: () => {
      console.log('failed fetching schemes')
    }
  })
}

function setLoans(modal, id = null) {
  $.ajax({
    url: '/api/loans',
    method: 'GET',
    dataType: 'json',
    async: false,
    success: loans => {
      const input = modal.find('.loans')

      input.append(`<option value="" selected></option>`)
      loans
        .filter(l => l.relations.length === 0 || l.cost > l.paid || l.id === id)
        .forEach(l => {
          input.append(`<option value="${l.id}">${l.item}</option>`)
        })
    },
    error: () => {
      console.log('failed fetching loans')
    }
  })
}