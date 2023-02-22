@include('layouts.header', ['title' => 'USER PROFILES'])
@include('layouts.navbar')
@include('layouts.admin_sidebar')

<!-- User form -->
<div class="container mt-5">

  @if(session()->has('success'))
  <div class="alert alert-success">
    <p>{{session('success')}}</p>
  </div>
  @endif

  @if(session()->has('updated'))
  <div class="alert alert-warning">
    <p>{{session('updated')}}</p>
  </div>
  @endif

  <div class="mb-3">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUsers">
      Add Users
    </button>

    <form action="/user_profiles/store" method="post">
      @csrf
      <div class="modal fade" id="createUsers" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5">Register a Users</h1>
            </div>
            <div class="modal-body">
              <div class="col-12">
                <!-- last name -->
                <div class="form-floating mb-3">
                  <input type="text" name="last_name" id="lastName" class="form-control" placeholder="Lastname">
                  <label for="lastName">Enter a lastname</label>
                  @error('last_name')
                  <span class="text-danger">
                    {{$message}}
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <!-- first name -->
                <div class="form-floating mb-3">
                  <input type="text" name="first_name" id="firstName" class="form-control" placeholder="Firstname">
                  <label for="firstName">Enter a firstname</label>
                  @error('first_name')
                  <span class="text-danger">
                    {{$message}}
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <!-- email -->
                <div class="form-floating mb-3">
                  <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                  <label for="email">Enter an email</label>
                  @error('email')
                  <span class="text-danger">
                    {{$message}}
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <!-- Password -->
                <div class="form-floating mb-3">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                  <label for="password">Password</label>
                  @error('password')
                  <span class="text-danger">
                    {{$message}}
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <!-- Password -->
                <div class="form-floating mb-3">
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password">
                  <label for="password_confirmation">Confirm password</label>
                  @error('password_confirmation')
                  <span class="text-danger">
                    {{$message}}
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <!-- role -->
                <div class="form-floating mb-3">
                  <select name="role" id="role" class="form-select">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                  </select>
                  <label for="role">Select a role</label>
                </div>
              </div>
              <div class="col-12">
                <!-- status -->
                <div class="form-floating mb-3">
                  <select name="account_status" id="usersStatus" class="form-select">
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="INACTIVE">INACTIVE</option>
                  </select>
                  <label for="usersStatus">Select a status</label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success fw-bold" name="register">Register</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- TABLE -->
  <div class="table-responsive">
    <table class="table table-striped table-hover " id="myTable" style="width: 100%;">
      <thead class="table-success">
        <tr>
          <th>Last name</th>
          <th>First name</th>
          <th>Email</th>
          <th>Password</th>
          <th>Role</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      <tbody>
        @foreach ($user as $users)
        <tr>
          <td>{{ $users->last_name }}</td>
          <td>{{ $users->first_name }}</td>
          <td>{{ $users->email }}</td>
          <td>{{ $users->password }}</td>
          <td>{{ $users->role }}</td>
          <td>{{ $users->account_status }}</td>
          <td>
            <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#updateUserModal-{{ $users->id }}">
              <i class="fa-solid fa-pen-to-square"></i>
            </button>

            <form action="/user_profiles/{{ $users->id }}" method="post">
              @csrf
              @method('put')
              <div class="modal fade" id="updateUserModal-{{ $users->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update a User</h5>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-12">
                          <div class="mb-3 form-floating">
                            <input type="text" name="last_name" id="updateLastName" class="form-control" placeholder="Lastname" value="{{ $users->last_name }}">
                            <label for="updateLastName">Enter your lastname</label>
                            @error('last_name')
                            <span class="text-danger">
                              {{$message}}
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3 form-floating">
                            <input type="text" name="first_name" id="updateFirstName" class="form-control" placeholder="Firstname" value="{{ $users->first_name }}">
                            <label for="updateFirstName">Enter your firstname</label>
                            @error('first_name')
                            <span class="text-danger">
                              {{$message}}
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3 form-floating">
                            <input type="email" name="email" id="updateEmail" class="form-control" placeholder="Email" value="{{ $users->email }}">
                            <label for="updateEmail">Enter your email</label>
                            @error('email')
                            <span class="text-danger">
                              {{$message}}
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3 form-floating">
                            <input type="password" name="password" id="updatePassword" class="form-control" placeholder="Password" value="{{ $users->password }}">
                            <label for="updatePassword">Enter your password</label>
                            @error('password')
                            <span class="text-danger">
                              {{$message}}
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-12">
                          <!-- role -->
                          <div class="form-floating mb-3">
                            <select name="role" id="role" class="form-select">
                              <option value="user">User</option>
                              <option value="admin">Admin</option>
                            </select>
                            <label for="role">Select a role</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3 form-floating">
                            <select name="account_status" id="updateStatus" class="form-select">
                              <option value="ACTIVE">Active</option>
                              <option value="INACTIVE">Inactive</option>
                            </select>
                            <label for="updateStatus">Account Status</label>
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
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
@include('layouts.footer')
