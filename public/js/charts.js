const chart = new Chartisan({
  el: '#chart',
  url: "./api/chart/sample_chart",
  hooks: new ChartisanHooks()
    .tooltip()
    .legend()
    .axis(false)
    .datasets([
      { type: 'pie', radius: ['40%', '60%'] },
      { type: 'pie', radius: ['10%', '30%'] }
    ])
    .custom(({ data }) => {
      console.log(data)
      return {
      ...data,
      series: data.series.map(s => ({
        ...s,
        label: { show: false }
      }))
      }
    })
})