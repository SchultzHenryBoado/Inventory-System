@include('layouts.header', ['title' => 'ISSUE'])
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
      <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addIssue">Add
        Issue</button>

      <form action="/issuance/store" method="post">
        @csrf
        <div class="modal fade" id="addIssue" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Create </h5>
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
                        @foreach($warehouse as $rowWarehouse)
                        <option value="{{ $rowWarehouse->warehouse_name }}">{{ $rowWarehouse->warehouse_name }}</option>
                        @endforeach
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

    <div class="mb-3 d-inline-block">
      <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#importModal">
        Import Data <i class="fa-solid fa-file-import"></i>
      </button>

      <form action="/issue/import" method="post" enctype="multipart/form-data">
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
@include('layouts.footer')
