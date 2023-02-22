@include('layouts.header', ['title' => 'STOCK'])
@include('layouts.navbar')
@include('layouts.admin_sidebar')

<!-- User form -->
<div class="container mt-5">

  @if(session()->has('message'))
  <div class="alert alert-success">
    <p>{{session('message')}}</p>
  </div>
  @endif

  @if(session()->has('message_update'))
  <div class="alert alert-warning">
    <p>{{session('message_update')}}</p>
  </div>
  @endif

  @if(session()->has('message_delete'))
  <div class="alert alert-danger">
    <p>{{session('message_delete')}}</p>
  </div>
  @endif

  <div class="mb-3">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCompany">
      Add Stocks
    </button>
  </div>

  <form action="/stock/store" method="post">
    @csrf
    <div class="modal fade" id="createCompany" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Add a Stocks</h1>
          </div>
          <div class="modal-body">
            <div class="col-12">
              <!-- stock code -->
              <div class="form-floating mb-3">
                <input type="text" name="stock_code" id="stockCode" class="form-control" placeholder="Stock Code">
                <label for="stockCode">Input a stock code</label>
                @error('stock_code')
                <p class="text-danger">
                  {{$message}}
                </p>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <!-- description -->
              <div class="form-floating mb-3">
                <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                <label for="description">Input a description</label>
                @error('description')
                <p class="text-danger">
                  {{$message}}
                </p>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <!-- uom -->
              <div class="form-floating mb-3">
                <input type="text" name="uom" id="uom" class="form-control" placeholder="Uom">
                <label for="uom">Input an UOM</label>
                @error('uom')
                <p class="text-danger">
                  {{$message}}
                </p>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <!-- status -->
              <div class="form-floating mb-3">
                <select name="account_status" id="status" class="form-select">
                  <option value="ACTIVE">ACTIVE</option>
                  <option value="INACTIVE">INACTIVE</option>
                </select>
                <label for="status">Status</label>
                @error('account_status')
                <p class="text-danger">
                  {{$message}}
                </p>
                @enderror
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success fw-bold" name="register_stocks">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-striped table-hover " id="myTable" style="width: 100%;">
      <thead class="table-success">
        <tr>
          <th>Stock Code</th>
          <th>Description</th>
          <th>UOM</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($stocks as $stock)
        <tr>
          <td>{{ $stock->stock_code }}</td>
          <td>{{ $stock->description }}</td>
          <td>{{ $stock->uom }}</td>
          <td>{{ $stock->account_status }}</td>
          <td>
            <div class="d-inline-block">
              <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#editModal-{{ $stock->id }}">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>

              <form action="/stock/{{ $stock->id }}" method="post">
                @method('put')
                @csrf
                <div class="modal fade" id="editModal-{{ $stock->id }}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Update Stocks</h5>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <input type="text" name="stock_code" id="updateStockCode" class="form-control" placeholder="Stock" value="{{ $stock->stock_code }}">
                              <label for="updateStockCode">Stock Code</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <input type="text" name="description" id="updateDescription" class="form-control" placeholder="Description" value="{{ $stock->description }}">
                              <label for="updateDescription">Description</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <input type="text" name="uom" id="updateUom" class="form-control" placeholder="UOM" value="{{ $stock->uom }}">
                              <label for="updateUom">UOM</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <select name="account_status" id="updateAccountStatus" class="form-select">
                                <option value="ACTIVE">ACTIVE</option>
                                <option value="INACTIVE">INACTIVE</option>
                              </select>
                              <label for="updateAccountStatus">Status</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success fw-bold">Update</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="d-inline-block">
              <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $stock->id }}">
                <i class="fa-solid fa-trash"></i>
              </button>

              <form action="/stock/{{ $stock->id }}" method="post">
                @method('delete')
                @csrf
                <div class="modal fade" id="deleteModal-{{ $stock->id }}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Are you sure you want to delete?</h5>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger fw-bold">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
@include('layouts.footer')
