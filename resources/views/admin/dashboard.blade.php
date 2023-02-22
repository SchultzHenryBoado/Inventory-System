@include('layouts.header', ['title' => 'DASHBOARD'])
@include('layouts.navbar')
@include('layouts.admin_sidebar')

<!-- Dashboard content -->
<div class="container-fluid">
  <div class="container mt-5">
    <div class="row">
      <!-- Received -->
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card mb-3">
          <div class="card-header bg-warning">
            <p class="fs-5">Received</p>
          </div>
          <div class="card-body">
            <p class="fs-1 text-end"></p>
          </div>
        </div>
      </div>

      <!-- Issued -->
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card mb-3">
          <div class="card-header bg-primary">
            <p class="fs-5 text-white">Issued</p>
          </div>
          <div class="card-body">
            <p class="fs-1 text-end"></p>
          </div>
        </div>
      </div>

      <!-- Transfer out -->
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card mb-3">
          <div class="card-header bg-success">
            <p class="fs-5 text-white">Transfer Out</p>
          </div>
          <div class="card-body">
            <p class="fs-1 text-end"></p>
          </div>
        </div>
      </div>

      <!-- Unposted Receiving -->
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card mb-3">
          <div class="card-header bg-warning">
            <p class="fs-5">Unposted Receiving</p>
          </div>
          <div class="card-body">
            <p class="fs-1 text-end">{{ $dataReceiving }}</p>
          </div>
        </div>
      </div>

      <!-- Unposted Issued -->
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card mb-3">
          <div class="card-header bg-primary">
            <p class="fs-5 text-white">Unposted Issued</p>
          </div>
          <div class="card-body">
            <p class="fs-1 text-end">{{ $dataIssue }}</p>
          </div>
        </div>
      </div>

      <!-- Issued -->
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card mb-3">
          <div class="card-header bg-success">
            <p class="fs-5 text-white">Unposted Transfer Out</p>
          </div>
          <div class="card-body">
            <p class="fs-1 text-end">{{ $dataTransferOut }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Table -->
  <div class="container mt-5">
    <div class="table-responsive">
      <table class="table table-striped table-hover mt-4" style="width:100%" id="dataTable">
        <thead class="table-success">
          <tr>
            <th>Inventory ID</th>
            <th>Description</th>
            <th>UOM</th>
            <th>Qty</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>sample inventory id</td>
            <td>sample description</td>
            <td>sample uom</td>
            <td>sample qty</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>

@include('layouts.footer')
