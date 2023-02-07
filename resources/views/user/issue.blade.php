<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ISSUE</title>

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
            <a class="dropdown-item" href="/change_password">Change Password</a>
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

    <div class="offcanvas-footer bg-success">
      <p class="text-light ms-3">Logging in as {{ auth()->user()->last_name }}</p>
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
        <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addIssue">Add Issue</button>

        <form action="/issuance/store" method="post">
          @csrf
          <div class="modal fade" id="addIssue" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Create Receiving</h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-3 form-floating">
                        <input type="text" name="issue_no" id="issueNo" class="form-control" placeholder="Issue No">
                        <label for="issueNo">Issue No</label>
                        @error('issue_no')
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
                        <input type="text" name="reference" id="reference" class="form-control" placeholder="Reference">
                        <label for="reference">Reference</label>
                        @error('reference')
                        <span class="text-danger">
                          {{$message}}
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3 form-floating">
                        <input type="text" name="project_id" id="projectId" class="form-control" placeholder="Project ID">
                        <label for="projectId">Project ID</label>
                        @error('reference')
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
        <a href="/issuance/export" class="btn btn-success fw-bold">Download Excel
          <i class="fa-solid fa-file-excel ms-1"></i>
        </a>
      </div>

      <div class="table-responsive mt-3">
        <table class="table" id="myTable" style="width: 100%;">
          <thead class="table-success">
            <tr>
              <th>Issue No.</th>
              <th>Warehouse</th>
              <th>Date</th>
              <th>Reference</th>
              <th>Project ID</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($issue as $row)
            @can('view', $row)
            <tr>
              <td>{{ $row->issue_no }}</td>
              <td>{{ $row->warehouse }}</td>
              <td>{{ $row->date }}</td>
              <td>{{ $row->reference }}</td>
              <td>{{ $row->project_id }}</td>
              <td>{{ $row->description }}</td>
              <td>
                <div class="d-inline-block">
                  <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#editModal-{{ $row->id }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>

                  <form action="/issuance/{{ $row->id }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal fade" id="editModal-{{ $row->id }}" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Update Issues</h5>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-12">
                                <div class="mb-3 form-floating">
                                  <input type="text" name="issue_no" id="updateIssueNo" class="form-control" placeholder="Issue No" value="{{ $row->issue_no }}">
                                  <label for="updateIssueNo">Enter issue no.</label>
                                  @error('issue_no')
                                  <span class="text-danger">
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
                                  <input type="date" name="date" id="updateDate" class="form-control" value="{{ $row->date }}">
                                  <label for="updateDate">Pick a date</label>
                                  @error('date')
                                  <span class="text-danger">
                                    {{$message}}
                                  </span>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="mb-3 form-floating">
                                  <input type="text" name="reference" id="updateReference" class="form-control" placeholder="Reference" value="{{ $row->reference }}">
                                  <label for="updateReference">Enter reference no.</label>
                                  @error('reference')
                                  <span class="text-danger">
                                    {{$message}}
                                  </span>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="mb-3 form-floating">
                                  <input type="text" name="project_id" id="updateProjectId" class="form-control" placeholder="Project ID" value="{{ $row->project_id }}">
                                  <label for="updateProjectId">Enter Project ID No.</label>
                                  @error('project_id')
                                  <span class="text-danger">
                                    {{$message}}
                                  </span>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="mb-3 form-floating">
                                  <input type="text" name="description" id="updateDescription" class="form-control" placeholder="Description" value="{{ $row->description }}">
                                  <label for="updateDescription">Description.</label>
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
                            <button type="submit" class="btn btn-success fw-bold">Update</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="d-inline-block">
                  <button type="button" class="btn btn-danger" data-bs-target="#deleteModal-{{ $row->id }}" data-bs-toggle="modal">
                    <i class="fa-solid fa-trash"></i>
                  </button>

                  <form action="/issuance/{{ $row->id }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="modal fade" id="deleteModal-{{ $row->id }}" tabindex="-1">
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

</body>

</html>