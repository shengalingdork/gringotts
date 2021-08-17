<div class="card border-info">
  <div class="card-header h3">Summary</div>
  <div class="card-body">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="table-responsive">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th scope="row">Total Source:</th>
                  <td>&#8369;{{ $totalSource }}</td>
                </tr>
                <tr>
                  <th scope="row">Total Expenses:</th>
                  <td>&#8369;{{ $totalExpenses }}</td>
                </tr>
                <tr class="table-{{ $balance > 0 ? 'success' : 'warning' }}">
                  <th scope="row">Balance:</th>
                  <td>&#8369;{{ round($balance, 2) }}</td>
                </tr>
                <tr>
                  <th scope="row">Overall Balance:</th>
                  <td class="font-success">&#8369;{{ round($overallBalance, 2) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- <div class="col-md-8 align-middle">
          <div id="chart" style="height: 300px"></div>
        </div> -->
      </div>
    </div>
  </div>
</div>