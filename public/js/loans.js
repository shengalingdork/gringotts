$('.loanDates').on('change', function (e) {
  window.location.replace(`/loans/${this.value}`)
})
