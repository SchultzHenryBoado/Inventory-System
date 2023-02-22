@include('layouts.header', ['title' => 'TRANSFER IN'])
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
      <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addModal">
        Add Transfer In
      </button>

      <form action="/transfer_in/store" method="post">
        @csrf
        <div class="modal fade" id="addModal" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create Transfer In</h5>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <div class="mb-3 form-floating">
                      <input type="text" name="transfer_in_no" id="transferInNo" class="form-control" placeholder="Transfer No">
                      <label for="transferInNo">Transfer In No</label>
                      @error('transfer_in_no')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3 form-floating">
                      <input type="text" name="reference_no" id="referenceNo" class="form-control" placeholder="Reference No">
                      <label for="referenceNo">Reference No</label>
                      @error('reference_no')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3 form-floating">
                      <input type="date" name="date" id="date" class="form-control" placeholder="Date">
                      <label for="date">Date</label>
                      @error('date')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                      @enderror
                    </div>
                    <div class="col-12">
                      <div class="mb-3 form-floating">
                        <select name="warehouse" id="warehouse" class="form-select" placeholder="Warehouse">
                          <option value="Warehouse">Warehouse</option>
                        </select>
                        <label for="warehouse">Warehouse</label>
                        @error('warehouse')
                        <span class="text-danger">
                          {{ $message }}
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
                          {{ $message }}
                        </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success fw-bold" name="create_transfer_in">Create</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="mb-3 d-inline-block">
      <a href="/transfer_in/export" class="btn btn-success fw-bold">Download Excel
        <i class="fa-solid fa-file-excel ms-1"></i>
      </a>
    </div>

    <div class="mb-3 d-inline-block">
      <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#importModal">
        Import Data <i class="fa-solid fa-file-import"></i>
      </button>

      <form action="/transfer_in/import" method="post" enctype="multipart/form-data">
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
            <th>Transfer In No.</th>
            <th>Reference No</th>
            <th>Date</th>
            <th>Warehouse</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          @foreach($transfer_in as $transfer_ins)
          @can('view', $transfer_ins)
          <tr>
            <td>{{ $transfer_ins->transfer_in_no }}</td>
            <td>{{ $transfer_ins->reference_no }}</td>
            <td>{{ $transfer_ins->date }}</td>
            <td>{{ $transfer_ins->warehouse }}</td>
            <td>{{ $transfer_ins->description }}</td>
            <td>
              <div class="d-inline-block">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-$transfer_ins->id">
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <form action="/transfer_in/{{ $transfer_ins->id }}" method="post">
                  @csrf
                  @method('put')
                  <!-- Modal -->
                  <div class="modal fade" id="editModal-$transfer_ins->id" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title fs-5">Update Transfer In</h5>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="mb-3 form-floating">
                                <input type="text" name="transfer_in_no" id="transferNo" class="form-control" placeholder="Transfer No" value="{{ $transfer_ins->transfer_in_no }}">
                                <label for="transferNo">Transfer In No</label>
                                @error('transfer_in_no')
                                <span class="text-danger">
                                  {{ $message }}
                                </span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3 form-floating">
                                <input type="text" name="reference_no" id="referenceNo" class="form-control" placeholder="Reference No" value="{{ $transfer_ins->reference_no }}">
                                <label for="referenceNo">Reference No</label>
                                @error('reference_no')
                                <span class="text-danger">
                                  {{ $message }}
                                </span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="mb-3 form-floating">
                                <input type="date" name="date" id="date" class="form-control" placeholder="Date" value="{{ $transfer_ins->date }}">
                                <label for="date">Date</label>
                                @error('date')
                                <span class="text-danger">
                                  {{ $message }}
                                </span>
                                @enderror
                              </div>
                              <div class="col-12">
                                <div class="mb-3 form-floating">
                                  <select name="warehouse" id="warehouse" class="form-select" placeholder="Warehouse" value="{{ $transfer_ins->warehouse }}">
                                    <option value="Warehouse">Warehouse</option>
                                  </select>
                                  <label for="warehouse">Warehouse</label>
                                  @error('warehouse')
                                  <span class="text-danger">
                                    {{ $message }}
                                  </span>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="mb-3 form-floating">
                                  <input type="text" name="description" id="description" class="form-control" placeholder="Description" value="{{ $transfer_ins->description }}">
                                  <label for="description">Description</label>
                                  @error('description')
                                  <span class="text-danger">
                                    {{ $message }}
                                  </span>
                                  @enderror
                                </div>
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
                <button type="button" class="btn btn-danger" data-bs-target="#deleteModal-{{ $transfer_ins->id }}" data-bs-toggle="modal">
                  <i class="fa-solid fa-trash"></i>
                </button>

                <form action="/transfer_in/{{ $transfer_ins->id }}" method="post">
                  @method('delete')
                  @csrf
                  <div class="modal fade" id="deleteModal-{{ $transfer_ins->id }}" tabindex="-1">
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
