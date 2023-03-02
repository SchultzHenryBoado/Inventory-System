@include('layouts.header', ['title' => 'WAREHOUSE MASTER'])
@include('layouts.navbar')
@include('layouts.admin_sidebar')

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
    <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#createCompany">
      Add Warehouse
    </button>
  </div>

  <form action="/warehouse/store" method="post">
    @csrf
    <div class="modal fade" id="createCompany">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Add a Warehouse</h1>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <!-- last name -->
                <div class="form-floating mb-3">
                  <input type="text" name="warehouse_code" id="warehouseCode" class="form-control" placeholder="Company Code">
                  <label for="warehouseCode">Input a warehouse code</label>
                  @error('warehouse_code')
                  <p class="text-danger">
                    {{$message}}
                  </p>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <!-- first name -->
                <div class="form-floating mb-3">
                  <input type="text" name="warehouse_name" id="warehouseName" class="form-control" placeholder="Company Name">
                  <label for="warehouseName">Input a warehouse name</label>
                  @error('warehouse_name')
                  <p class="text-danger">
                    {{$message}}
                  </p>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success fw-bold" name="company_submit">Create</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-striped table-hover " id="myTable" style="width: 100%;">
      <thead class="table-success">
        <tr>
          <th>Warehouse Code</th>
          <th>Warehouse Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($warehouse as $rowWarehouse)
        <tr>
          <td>{{ $rowWarehouse->warehouse_code }}</td>
          <td>{{ $rowWarehouse->warehouse_name }}</td>
          <td>
            <div class="d-inline-block">
              <button class="btn btn-warning fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $rowWarehouse->id }}">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>

              <form action="/warehouse/{{ $rowWarehouse->id }}" method="post">
                @csrf
                @method('put')
                <div class="modal fade" id="updateModal-{{ $rowWarehouse->id }}">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title fs-5">Update Warehouse</h5>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <!-- last name -->
                            <div class="form-floating mb-3">
                              <input type="text" name="warehouse_code" id="warehouseCode" class="form-control" placeholder="Company Code" value="{{ $rowWarehouse->warehouse_code }}">
                              <label for="warehouseCode">Input a warehouse code</label>
                              @error('warehouse_code')
                              <p class="text-danger">
                                {{$message}}
                              </p>
                              @enderror
                            </div>
                          </div>
                          <div class="col-12">
                            <!-- first name -->
                            <div class="form-floating mb-3">
                              <input type="text" name="warehouse_name" id="warehouseName" class="form-control" placeholder="Company Name" value="{{ $rowWarehouse->warehouse_name }}">
                              <label for="warehouseName">Input a warehouse name</label>
                              @error('warehouse_name')
                              <p class="text-danger">
                                {{$message}}
                              </p>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-success fw-bold" type="submit">Update</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="d-inline-block">
              <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $rowWarehouse->id }}">
                <i class="fa-solid fa-trash"></i>
              </button>

              <form action="/warehouse/{{ $rowWarehouse->id }}" method="post">
                @csrf
                @method('delete')
                <div class="modal fade" id="deleteModal-{{ $rowWarehouse->id }}">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title fs-5">Are you sure you want to delete?</h5>
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
