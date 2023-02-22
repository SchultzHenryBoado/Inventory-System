@include('layouts.header', ['title' => 'COMPANY'])
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
      Add Company
    </button>
  </div>

  <form action="/company/store" method="post">
    @csrf
    <div class="modal fade" id="createCompany">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Add a Company</h1>
          </div>
          <div class="modal-body">
            <div class="col-12">
              <!-- last name -->
              <div class="form-floating mb-3">
                <input type="text" name="company_code" id="companyCode" class="form-control" placeholder="Company Code">
                <label for="companyCode">Input a company code</label>
                @error('company_code')
                <p class="text-danger">
                  {{$message}}
                </p>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <!-- first name -->
              <div class="form-floating mb-3">
                <input type="text" name="company_name" id="companyName" class="form-control" placeholder="Company Name">
                <label for="companyName">Input a company name</label>
                @error('company_name')
                <p class="text-danger">
                  {{$message}}
                </p>
                @enderror
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success fw-bold" name="company_submit">Register</button>
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
          <th>Company Code</th>
          <th>Company Name</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($company as $companies)
        <tr>
          <td>{{ strtoupper($companies->company_code) }}</td>
          <td>{{ $companies->company_name }}</td>
          <td>
            <div class="d-inline-block">
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateCompanyModal-{{ $companies->id }}">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>

              <form action="/company/{{ $companies->id }}" method="post">
                @method('put')
                @csrf
                <div class="modal fade" id="updateCompanyModal-{{ $companies->id }}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Update Companies</h5>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <input type="text" name="company_code" id="companyCode" class="form-control" placeholder="Company Code" value="{{ $companies->company_code }}">
                              <label for="companyCode">Company Code</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="mb-3 form-floating">
                              <input type="text" name="company_name" id="companyName" class="form-control" placeholder="Company Name" value="{{ $companies->company_name }}">
                              <label for="companyName">Company Name</label>
                              @error ('company_name')
                              <p class="text-red">{{$message}}</p>
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
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCompanyModal-{{ $companies->id }}">
                <i class="fa-solid fa-trash"></i>
              </button>

              <form action="/company/{{ $companies->id }}" method="post">
                @method('delete')
                @csrf
                <div class="modal fade" id="deleteCompanyModal-{{ $companies->id }}" tabindex="-1">
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
