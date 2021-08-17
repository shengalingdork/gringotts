$('#category-form').submit( (e) => {
  e.preventDefault()
  $.ajax({
    url: '/api/categories',
    method: 'POST',
    data: $('#category-form').serialize(),
    dataType: 'json',
    success: response => {
      const { id, name, icon_name, kind } = response
      const newCategory = `
        <li id="category-${id}" class="list-group-item">
          <div class="row">
            <div class="col-2">
              <h2 class="text-center">
                <i class="fas fa-${icon_name}"></i>
              </h2>
            </div>
            <div class="col">
              <h6>${name}</h6>
            </div>
            <div class="col-1">
              <div class="float-right">
                <span
                  class="badge badge-pill badge-${ kind === 'source' ? 'success' : 'warning' }"
                  style="font-size:90%;"
                >
                  ${kind}
                </span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="float-right">
                <button
                  id="edit-category-${id}"
                  class="btn btn-outline-success btn-sm edit-category-btn"
                >
                  <span class="oi oi-pencil"></span>
                </button>
                <button
                  id="delete-category-${id}"
                  class="btn btn-outline-danger btn-sm delete-category-btn"
                  data-target="#delete-category-modal"
                  data-toggle="modal"
                >
                  <span class="oi oi-trash"></span>
                </button>
              </div>
            </div>
          </div>
        </li>`;

      $('#category-form')[0].reset();

      if ($('#category-list li:last').prev().length==0) {
        $('#category-list li:last').before(newCategory);
      } else {
        $('#category-list li:last').prev().after(newCategory);
      }
    },
    error: response => {
      console.log(`error adding category ${response.name}`);
    }
  })
})

$(document).on('click', '.edit-category-btn', e => {
  const id = e.currentTarget.id.split('-').pop()

  $.ajax({
    url: `/api/categories/${id}`,
    type: 'GET',
    dataType: 'json',
    success: response => {
      const { name, icon_name, kind } = response
      $(`#category-${id}`).html($('#category-form').prop('outerHTML'))
      $(`#category-${id}`).find('#category-form').append('<input name="_method" type="hidden" value="PUT">')
      $(`#category-${id}`).find('#category-form').attr('id', 'edit-category-form');
      $(`#category-${id}`).find('#category-name').val(name)
      $(`#category-${id}`).find('#category-icon-name').val(icon_name)
      $(`#category-${id}`).find('#category-kind').val(kind)
      $(`#category-${id}`).find('button').addClass(`save-category-btn category-${id}`)
      $(`#category-${id}`).find('span').attr('class', 'oi oi-check')
    },
    error: () => {
      console.log('failed fetching category')
    }
  })
})

$(document).on('click', '.save-category-btn', function(e) {
  e.preventDefault();
  const id = e.currentTarget.classList[4].split('-').pop()

  $.ajax({
    url: `/api/categories/${id}`,
    method: 'PUT',
    data: $(`#category-${id}`).find('#edit-category-form').serialize(),
    dataType: 'json',
    success: response => {
      const { id, name, icon_name, kind } = response
      const editedCategory = `
        <div class="row">
          <div class="col-2">
            <h2 class="text-center">
              <i class="fas fa-${icon_name}"></i>
            </h2>
          </div>
          <div class="col">
            <h6>${name}</h6>
          </div>
          <div class="col-1">
            <div class="float-right">
              <span
                class="badge badge-pill badge-${ kind === 'source' ? 'success' : 'warning' }"
                style="font-size:90%;"
              >
                ${kind}
              </span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="float-right">
              <button
                id="edit-category-${id}"
                class="btn btn-outline-success btn-sm edit-category-btn"
              >
                <span class="oi oi-pencil"></span>
              </button>
              <button
                id="delete-category-${id}"
                class="btn btn-outline-danger btn-sm delete-category-btn"
                data-target="#delete-category-modal"
                data-toggle="modal"
              >
                <span class="oi oi-trash"></span>
              </button>
            </div>
          </div>
        </div>`

      $(`#category-${id}`).html(editedCategory)
    },
    error: () => {
      console.log('error adding category')
    }
  })
})

$(document).on('click', '.delete-category-btn', e => {
  const id = e.currentTarget.id.split('-').pop()
  const name = $(`#category-${id}`).find('h6')[0].innerText
  $('#delete-category-modal').find('.modal-title').text(`Are you sure you want to delete category ${name}?`)
  $('#delete-category-modal').find('form').attr('action', `/categories/${id}`)
})

$('#scheme-group-form').submit( (e) => {
  e.preventDefault()

  $.ajax({
    url: '/api/scheme_groups',
    method: 'POST',
    data: $('#scheme-group-form').serialize(),
    dataType: 'json',
    success: response => {
      const { id, name, icon_name } = response
      const newSchemeGroup = `
        <li id="scheme-group-${id}" class="list-group-item">
          <div class="row">
            <div class="col-2">
              <h2 class="text-center">
                <i class="fas fa-${icon_name}"></i>
              </h2>
            </div>
            <div class="col">
              <h6>${name}</h6>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="float-right">
                <button
                  id="edit-scheme-group-${id}"
                  class="btn btn-outline-success btn-sm edit-scheme-group-btn"
                >
                  <span class="oi oi-pencil"></span>
                </button>
                <button
                  id="delete-scheme-group-${id}"
                  class="btn btn-outline-danger btn-sm delete-scheme-group-btn"
                  data-target="#delete-scheme-group-modal"
                  data-toggle="modal"
                >
                  <span class="oi oi-trash"></span>
                </button>
              </div>
            </div>
          </div>
        </li>`;

      $('#scheme-group-form')[0].reset();

      if ($('#scheme-group-list li:last').prev().length==0) {
        $('#scheme-group-list li:last').before(newSchemeGroup);
      } else {
        $('#scheme-group-list li:last').prev().after(newSchemeGroup);
      }
    },
    error: function(response){
      console.log(`error adding scheme group ${response.name}`);
    }
  })
})

$(document).on('click', '.edit-scheme-group-btn', e => {
  const id = e.currentTarget.id.split('-').pop()

  $.ajax({
    url: `/api/scheme_groups/${id}`,
    type: 'GET',
    dataType: 'json',
    success: response => {
      const { name, icon_name } = response
      $(`#scheme-group-${id}`).html($('#scheme-group-form').prop('outerHTML'))
      $(`#scheme-group-${id}`).find('#scheme-group-form').append('<input name="_method" type="hidden" value="PUT">')
      $(`#scheme-group-${id}`).find('#scheme-group-form').attr('id', 'edit-scheme-group-form');
      $(`#scheme-group-${id}`).find('#scheme-group-name').val(name)
      $(`#scheme-group-${id}`).find('#scheme-group-icon-name').val(icon_name)
      $(`#scheme-group-${id}`).find('button').addClass(`save-scheme-group-btn scheme-group-${id}`)
      $(`#scheme-group-${id}`).find('span').attr('class', 'oi oi-check')
    },
    error: () => {
      console.log('failed fetching scheme group')
    }
  })
})

$(document).on('click', '.save-scheme-group-btn', function(e) {
  e.preventDefault();
  const id = e.currentTarget.classList[4].split('-').pop()

  $.ajax({
    url: `/api/scheme_groups/${id}`,
    method: 'PUT',
    data: $(`#scheme-group-${id}`).find('#edit-scheme-group-form').serialize(),
    dataType: 'json',
    success: response => {
      const { id, name, icon_name } = response
      const editedSchemeGroup = `
        <div class="row">
          <div class="col-2">
            <h2 class="text-center">
              <i class="fas fa-${icon_name}"></i>
            </h2>
          </div>
          <div class="col">
            <h6>${name}</h6>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="float-right">
              <button
                id="edit-scheme-group-${id}"
                class="btn btn-outline-success btn-sm edit-scheme-group-btn"
              >
                <span class="oi oi-pencil"></span>
              </button>
              <button
                id="delete-scheme-group-${id}"
                class="btn btn-outline-danger btn-sm delete-scheme-group-btn"
                data-target="#delete-scheme-group-modal"
                data-toggle="modal"
              >
                <span class="oi oi-trash"></span>
              </button>
            </div>
          </div>
        </div>`

      $(`#scheme-group-${id}`).html(editedSchemeGroup)
    },
    error: () => {
      console.log('error adding scheme group')
    }
  })
})

$(document).on('click', '.delete-scheme-group-btn', e => {
  const id = e.currentTarget.id.split('-').pop()
  const name = $(`#scheme-group-${id}`).find('h6')[0].innerText

  $('#delete-scheme-group-modal').find('.modal-title').text(`Are you sure you want to delete scheme group ${name}?`)
  $('#delete-scheme-group-modal').find('form').attr('action', `/scheme_groups/${id}`)
})
