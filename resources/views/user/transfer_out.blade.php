<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TRANSFER OUT</title>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <script src="{{ url('js/dataTable.js') }}" defer></script>
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
  <script src="https://kit.fontawesome.com/8cbc2e0f0e.js" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-success">
    <div class="container-fluid">

      <button class="h-25 ms-5 btn btn-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAdmin">
        <i class="fa-solid fa-bars fa-xl"></i>
      </button>

      <div class="btn-group me-3">
        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
          <i class="fa-solid fa-user"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-sm-end">
          <li class="nav-item text-center">
            <a class="dropdown-item" href="#">Change Password</a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="nav-item text-center">
            <a class="dropdown-item" href="/logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="offcanvas offcanvas-start __sidebar" data-bs-scroll="true" tabindex="-1" id="offcanvasAdmin" style="width: 300px;">

    <div class="offcanvas-header bg-success">
      <h5 class="offcanvas-title text-white fw-bold fs-3 text-center" id="offcanvasExampleLabel">Inventory Management
        System</h5>
    </div>

    <div class="offcanvas-body bg-success">
      <ul class="nav flex-column __nav ">

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-boxes-stacked text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="/receiving">Receiving</a>
          </div>
        </li>

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-box-open text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="/issuance">Issuance</a>
          </div>
        </li>

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-arrow-right text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="/transfer_in">Transfer In</a>
          </div>
        </li>

        <li class="nav-item fs-5">
          <div class="mb-3 d-flex flex-row">
            <i class="fa-solid fa-arrow-left-long text-white lh-lg mt-2"></i>
            <a class="nav-link text-white ms-2 mt-1" href="/transfer_out">Transfer Out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>

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
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>

</html>