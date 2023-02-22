@include('layouts.header', ['title' => 'RECEIVING'])
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

    {{-- @if(isset($errors) && $errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        {{$error}}
    @endforeach
  </div>
  @endif() --}}

  <div class="mb-3 d-inline-block">
    <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addReceiving">Add
      Receiving</button>

    <form action="/receiving/store" method="post">
      @csrf
      <div class="modal fade" id="addReceiving" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Create Receiving</h5>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="mb-3 form-floating">
                    <input type="text" name="receiving_no" id="receivingNo" class="form-control" placeholder="Receiving No">
                    <label for="receivingNo">Receiving No</label>
                    @error('receiving_no')
                    <span class="text-danger">
                      {{$message}}
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-3 form-floating">
                    <select name="warehouse" id="warehouse" class="form-control">
                      <option disabled selected value>-- Choose a warehouse --</option>
                      <option value="warehouse">warehouse</option>
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
                  <div class="mb-3 form-floating">
                    <input type="date" name="date" id="date" class="form-control">
                    <label for="date">Date</label>
                    @error('date')
                    <span class="text-danger">
                      {{$message}}
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-3 form-floating">
                    <input type="text" name="po_number" id="poNum" class="form-control" placeholder="P.O. Number">
                    <label for="poNum">P.O. Number</label>
                    @error('po_number')
                    <span class="text-danger">
                      {{$message}}
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-3 form-floating">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                    <label for="description">Description</label>
                    @error('description')
                    <span class="text-danger">
                      {{$message}}
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success fw-bold" name="create_receiving">Create</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <div class="mb-3 d-inline-block">
    <a href="{{ url('/receiving/export') }}" class="btn btn-success fw-bold">Download Excel
      <i class="fa-solid fa-file-excel ms-1"></i>
    </a>
  </div>

  <div class="mb-3 d-inline-block">
    <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#importModal">
      Import Data <i class="fa-solid fa-file-import"></i>
    </button>

    <form action="/import" method="post" enctype="multipart/form-data">
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
          <th>Receiving No.</th>
          <th>Warehouse</th>
          <th>Date</th>
          <th>P.O. Number</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($receiving as $rowReceive)
        @can('view', $rowReceive)
        <tr>
          <td>{{ $rowReceive->receiving_no }}</td>
          <td>{{ $rowReceive->warehouse }}</td>
          <td>{{ $rowReceive->date }}</td>
          <td>{{ $rowReceive->po_number }}</td>
          <td>{{ $rowReceive->description }}</td>
          <td>
            <div class="d-inline-block">
              <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#editReceiveModal-{{ $rowReceive->id }}">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>

              <form action="/receiving/{{ $rowReceive->id }}" method="post">
                @csrf
                @method('put')
                <div class="modal fade" id="editReceiveModal-{{ $rowReceive->id }}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Update Receiving</h5>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <input type="text" name="receiving_no" id="updateReceiveNo" class="form-control" placeholder="Receive No" value="{{ $rowReceive->receiving_no }}">
                              <label for="updateReceiveNo">Enter receive no.</label>
                              @error('receiving_no')
                              <span class="invalid-feedback">
                                {{$message}}
                              </span>
                              @enderror
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <select name="warehouse" id="updateWarehouse" class="form-select">
                                <option value="Warehouse">Warehouse</option>
                              </select>
                              <label for="updateWarehouse">Choose a warehouse</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <input type="date" name="date" id="updateDate" class="form-control" value="{{ $rowReceive->date }}">
                              <label for="updateDate">Pick a date</label>
                              @error('date')
                              <span class="invalid-feedback">
                                {{$message}}
                              </span>
                              @enderror
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <input type="text" name="po_number" id="updatePoNumber" class="form-control" placeholder="PO Number" value="{{ $rowReceive->po_number }}">
                              <label for="updatePoNumber">Enter po no.</label>
                              @error('po_number')
                              <span class="invalid-feedback">
                                {{$message}}
                              </span>
                              @enderror
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <input type="text" name="description" id="updateDescription" class="form-control" placeholder="Description" value="{{ $rowReceive->description }}">
                              <label for="updateDescription">Description.</label>
                              @error('description')
                              <span class="invalid-feedback">
                                {{$message}}
                              </span>
                              @enderror
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
              <button type="button" class="btn btn-danger" data-bs-target="#deleteModal-{{ $rowReceive->id }}" data-bs-toggle="modal">
                <i class="fa-solid fa-trash"></i>
              </button>

              <form action="/receiving/{{ $rowReceive->id }}" method="post">
                @method('delete')
                @csrf
                <div class="modal fade" id="deleteModal-{{ $rowReceive->id }}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Are you sure you want to delete?</h5>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-danger fw-bold" type="submit" name="delete_btn">Delete</button>
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
