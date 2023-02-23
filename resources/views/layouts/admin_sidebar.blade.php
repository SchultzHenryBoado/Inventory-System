<div class="offcanvas offcanvas-start __sidebar" data-bs-scroll="true" tabindex="-1" id="offcanvasAdmin" style="width: 300px;">

  <div class="offcanvas-header bg-success">
    <h5 class="offcanvas-title text-white fw-bold fs-3 text-center" id="offcanvasExampleLabel">Inventory Management
      System</h5>
  </div>

  <div class="offcanvas-body bg-success">
    <ul class="nav flex-column __nav ">

      <li class="nav-item fs-5">
        <div class="mb-3 d-flex flex-row">
          <i class="fa-solid fa-gauge text-white lh-lg mt-2"></i>
          <a class="nav-link text-white ms-2 mt-1" href="/dashboard">Dashboard</a>
        </div>
      </li>

      <div class="accordion accordion-flush" id="myAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed bg-success text-white fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
              Master File
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
            <div class="accordion-body">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a href="/user_profiles" class="nav-link text-dark">User Profile</a>
                </li>
                <li class="nav-item">
                  <a href="/company" class="nav-link text-dark">Company Profile</a>
                </li>
                <li class="nav-item">
                  <a href="/stock" class="nav-link text-dark">Stock Profile</a>
                </li>
                <li class="nav-item">
                  <a href="/warehouse" class="nav-link text-dark">Warehouse Master</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </ul>
  </div>
</div>
