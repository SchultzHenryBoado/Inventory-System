@include('layouts.header', ['title' => 'TRANSFER OUT'])
@include('layouts.navbar')
@include('layouts.user_sidebar')

<div class="container-fluid mt-5">
  <div class="container">

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

    @if(session()->has('message'))
    <div class="alert alert-success">
      <p>{{session('message')}}</p>
    </div>
    @endif

    @if(session()->has('success'))
    <div class="alert alert-success">
      <p>{{session('success')}}</p>
    </div>
    @endif

    <div class="mb-3 d-inline-block">
      <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#createTransferOutModal">Add Transfer Out</button>

      <form action="/transfer_out/store" method="post">
        @csrf
        <div class="modal fade" id="createTransferOutModal" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create Transfer Out</h5>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" name="transfer_out_no" id="transferOutNo" class="form-control" placeholder="Transfer Out">
                      <label for="transferOutNo">Transfer Out No.</label>
                      @error('transfer_out_no')
                      <span class="text-danger">
                        {{$message}}
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="date" name="date" id="date" class="form-control" placeholder="Date">
                      <label for="date">Date</label>
                      @error('date')
                      <span class="text-danger">
                        {{$message}}
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <select name="warehouse" id="warehouse" class="form-select">
                        <option value="warehouse">Warehouse</option>
                      </select>
                      <label for="warehouse">Warehouse</label>
                      @error('warehouse')
                      <span class="text-danger">
                        {{$message}}
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                      <label for="description">Description</label>
                      @error('description')
                      <span class="text-danger">
                        {{$message}}
                      </span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success fw-bold" name="create_transfer_out">Create</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="mb-3 d-inline-block">
      <a href="/transfer_out/export" class="btn btn-success fw-bold">Download Excel
        <i class="fa-solid fa-file-excel ms-1"></i>
      </a>
    </div>

    <div class="mb-3 d-inline-block">
      <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#importModal">
        Import Data <i class="fa-solid fa-file-import"></i>
      </button>

      <form action="/transfer_out/import" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="importModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Import Receiving</h5>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <input type="file" name="file" id="importReceiving" class="form-control">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success float-end fw-bold">Import</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="mb-3 d-inline-block">
      <form action="/transfer_out/import" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="importModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Import Receiving</h5>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <input type="file" name="file" id="importReceiving" class="form-control">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success float-end fw-bold">Import</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="table-responsive mt-3">
      <table class="table" id="myTable" style="width: 100%;">
        <thead class="table-success">
          <tr>
            <th>Transfer Out No.</th>
            <th>Date</th>
            <th>Warehouse</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transfer_out as $row)
          @can('view', $row)
          <tr>
            <td>{{ $row->transfer_out_no }}</td>
            <td>{{ $row->date }}</td>
            <td>{{ $row->warehouse }}</td>
            <td>{{ $row->description }}</td>
            <td>
              <div class="d-inline-block">
                <!-- Edit Modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{ $row->id }}">
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <form action="/transfer_out/{{ $row->id }}" method="post">
                  @csrf
                  @method('put')
                  <div class="modal fade" id="editModal-{{ $row->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Update Transfer Out</h5>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="update_id" value="">
                          <div class="row">
                            <div class="col-12">
                              <div class="form-floating mb-3">
                                <input type="text" name="transfer_out_no" id="updateTransferOutNo" class="form-control" placeholder="Transfer Out" value="{{ $row->transfer_out_no }}">
                                <label for="updateTransferOut">Transfer Out No.</label>
                                @error('transfer_out_no')
                                <span class="text-danger">
                                  {{$message}}
                                </span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-floating mb-3">
                                <input type="date" name="date" id="updateDate" class="form-control" placeholder="Date" value="{{ $row->date }}">
                                <label for="updateDate">Date</label>
                                @error('date')
                                <span class="text-danger">
                                  {{$message}}
                                </span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-floating mb-3">
                                <select name="warehouse" id="updateWarehouse" class="form-select">
                                  <option value="warehouse">Warehouse</option>
                                </select>
                                <label for="updateWarehouse">Warehouse</label>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-floating mb-3">
                                <input type="description" name="description" id="updateDescription" class="form-control" placeholder="Description" value="{{ $row->description }}">
                                <label for="updateDescription">Description</label>
                                @error('description')
                                <span class="text-danger">
                                  {{$message}}
                                </span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success fw-bold" name="update_transfer_out">Update</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <div class="d-inline-block">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTransferOut-{{ $row->id }}">
                  <i class="fa-solid fa-trash"></i>
                </button>

                <form action="/transfer_out/{{ $row->id }}" method="post">
                  @csrf
                  @method('delete')
                  <div class="modal fade" id="deleteTransferOut-{{ $row->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Are you sure you want to delete?</h5>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-danger" name="delete_transfer_out">Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </td>
          </tr>
          @endcan
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@include('layouts.footer')
