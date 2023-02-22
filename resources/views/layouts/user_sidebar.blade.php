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
