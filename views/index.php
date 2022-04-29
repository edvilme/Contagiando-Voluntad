<?php
$page_title = "CRM-Contagiando voluntad";
require_once  '../partials/header.php';
?>

<!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">

    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Dashboard</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
            <li class="breadcrumb-item"><a href="javascript:;">
                <ion-icon name="home-outline"></ion-icon>
              </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Analyticas</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <button type="button" class="btn btn-outline-primary">Settings</button>
          <button type="button" class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
          </button>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
            <a class="dropdown-item" href="javascript:;">Another action</a>
            <a class="dropdown-item" href="javascript:;">Something else here</a>
            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
          </div>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->



    <div class="row">
      <div class="col-12 col-lg-4 col-xl-4">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <p class="mb-2">Total de sesiones</p>
                <h4 class="mb-0">15,690 <span class="ms-1 font-13 text-success">+36%</span></h4>
              </div>
              <div class="fs-5">
                <ion-icon name="ellipsis-vertical-sharp"></ion-icon>
              </div>
            </div>
            <div class="mt-3" id="chart1"></div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4 col-xl-4">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <p class="mb-2">Paginas vistas</p>
                <h4 class="mb-0">28,963 <span class="ms-1 font-13 text-danger">-4.5%</span></h4>
              </div>
              <div class="fs-5">
                <ion-icon name="ellipsis-vertical-sharp"></ion-icon>
              </div>
            </div>
            <div class="mt-3" id="chart2"></div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4 col-xl-4">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <p class="mb-2">Total de usuarios</p>
                <h4 class="mb-0">86,279 <span class="ms-1 font-13 text-success">+5.6%</span></h4>
              </div>
              <div class="fs-5">
                <ion-icon name="ellipsis-vertical-sharp"></ion-icon>
              </div>
            </div>
            <div class="mt-3" id="chart3"></div>
          </div>
        </div>
      </div>
    </div>
    <!--end row-->


    <div class="row">
      <div class="col-12 col-lg-8 col-xl-8 d-flex">
        <div class="card radius-10 w-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <h6 class="mb-0">Metricas de Audiencia</h6>
              <div class="dropdown options ms-auto">
                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                  <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                </div>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-3 g-3 justify-content-start align-items-center mb-3">
              <div class="col">
                <h5 class="mb-0">974 <span class="text-success font-13">56% <ion-icon name="arrow-up-outline"></ion-icon></span></h5>
                <p class="mb-0">Avg. Session</p>
              </div>
              <div class="col">
                <h5 class="mb-0">1,218 <span class="text-success font-13">34% <ion-icon name="arrow-up-outline"></ion-icon></span></h5>
                <p class="mb-0">Conversion. Rate</p>
              </div>
              <div class="col">
                <h5 class="mb-0">10,317 <span class="text-success font-13">22% <ion-icon name="arrow-up-outline"></ion-icon></span></h5>
                <p class="mb-0">Avg. Session Duration</p>
              </div>
            </div>
            <!--end row-->

            <div class="chart-container7">
              <canvas id="chart4"></canvas>
            </div>

          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4 col-xl-4 d-flex">
        <div class="card radius-10 overflow-hidden w-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <h6 class="mb-0">Sessions By Device</h6>
              <div class="dropdown options ms-auto">
                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                  <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                </div>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="chart-container6">
              <div class="piechart-legend">
                <h2 class="mb-1">8,452</h2>
                <h6 class="mb-0">Total de sesiones</h6>
              </div>
              <canvas id="chart5"></canvas>
            </div>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center border-top">
              Desktop
              <span class="badge bg-tiffany rounded-pill">558</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Mobile
              <span class="badge bg-success rounded-pill">204</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Tablet
              <span class="badge bg-danger rounded-pill">108</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!--end row-->


    <div class="row">
      <div class="col-12 col-lg-12 col-xl-6 d-flex">
        <div class="card radius-10 w-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <h6 class="mb-0">Sesiones por ciudad</h6>
              <div class="dropdown options ms-auto">
                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                  <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                </div>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-borderless align-middle mb-0">
                <tbody>
                  <tr>
                    <td>
                      <div class="country-icon">
                        <img src="../images/icons/india.png" alt="" width="32">
                      </div>
                    </td>
                    <td>
                      <div class="country-name h6 mb-0">India</div>
                    </td>
                    <td class="w-100">
                      <div class="progress flex-grow-1" style="height: 6px;">
                        <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 68%;"></div>
                      </div>
                    </td>
                    <td>
                      <div class="percent-data">68%</div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="country-icon">
                        <img src="../images/icons/usa.png" alt="" width="32">
                      </div>
                    </td>
                    <td>
                      <div class="country-name h6 mb-0">USA</div>
                    </td>
                    <td class="w-100">
                      <div class="progress flex-grow-1" style="height: 6px;">
                        <div class="progress-bar bg-gradient-purple" role="progressbar" style="width: 52%;"></div>
                      </div>
                    </td>
                    <td>
                      <div class="percent-data">52%</div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="country-icon">
                        <img src="../images/icons/china.png" alt="" width="32">
                      </div>
                    </td>
                    <td>
                      <div class="country-name h6 mb-0">China</div>
                    </td>
                    <td class="w-100">
                      <div class="progress flex-grow-1" style="height: 6px;">
                        <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 35%;"></div>
                      </div>
                    </td>
                    <td>
                      <div class="percent-data">35%</div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="country-icon">
                        <img src="../images/icons/russia.png" alt="" width="32">
                      </div>
                    </td>
                    <td>
                      <div class="country-name h6 mb-0">Russia</div>
                    </td>
                    <td class="w-100">
                      <div class="progress flex-grow-1" style="height: 6px;">
                        <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 24%;"></div>
                      </div>
                    </td>
                    <td>
                      <div class="percent-data">24%</div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-12 col-xl-6 d-flex">
        <div class="card radius-10 w-100">
          <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-2 row-cols-xxl-2 g-3">
              <div class="col">
                <div class="card radius-10 shadow-none mb-0 bg-light-primary">
                  <div class="card-body text-primary p-4">
                    <div class="d-flex align-items-center gap-3">
                      <div class="fs-6">
                        <ion-icon name="logo-facebook"></ion-icon>
                      </div>
                      <h6 class="mb-0">Facebook</h6>
                      <div class="ms-auto">96K</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card radius-10 shadow-none mb-0 bg-light-success">
                  <div class="card-body text-success p-4">
                    <div class="d-flex align-items-center gap-3">
                      <div class="fs-6">
                        <ion-icon name="logo-linkedin"></ion-icon>
                      </div>
                      <h6 class="mb-0">Linkedin</h6>
                      <div class="ms-auto">856</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card radius-10 shadow-none mb-0 bg-light-danger">
                  <div class="card-body text-danger p-4">
                    <div class="d-flex align-items-center gap-3">
                      <div class="fs-6">
                        <ion-icon name="logo-youtube"></ion-icon>
                      </div>
                      <h6 class="mb-0">Youtube</h6>
                      <div class="ms-auto">45K</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card radius-10 shadow-none mb-0 bg-light-info">
                  <div class="card-body text-info p-4">
                    <div class="d-flex align-items-center gap-3">
                      <div class="fs-6">
                        <ion-icon name="logo-twitter"></ion-icon>
                      </div>
                      <h6 class="mb-0">Twitter</h6>
                      <div class="ms-auto">789</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card radius-10 shadow-none mb-0 bg-light-tiffany">
                  <div class="card-body text-tiffany p-4">
                    <div class="d-flex align-items-center gap-3">
                      <div class="fs-6">
                        <ion-icon name="logo-dribbble"></ion-icon>
                      </div>
                      <h6 class="mb-0">Dribbble</h6>
                      <div class="ms-auto">86GB</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card radius-10 shadow-none mb-0 bg-light-warning">
                  <div class="card-body text-warning p-4">
                    <div class="d-flex align-items-center gap-3">
                      <div class="fs-6">
                        <ion-icon name="logo-github"></ion-icon>
                      </div>
                      <h6 class="mb-0">Github</h6>
                      <div class="ms-auto">98K</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end row-->

    <div class="row row-cols-1 row-cols-xl-3">
      <div class="col d-flex">
        <div class="card radius-10 w-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <h6 class="mb-0">Browser Usage</h6>
              <div class="dropdown options ms-auto">
                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                  <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                </div>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="chart-container4">
              <canvas id="chart6"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col d-flex">
        <div class="card radius-10 w-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <h6 class="mb-0">Weekly Views</h6>
              <div class="dropdown options ms-auto">
                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                  <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                </div>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="chart-container4">
              <canvas id="chart7"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col d-flex">
        <div class="card radius-10 overflow-hidden w-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-3">
              <h6 class="mb-0">Visitors Status</h6>
              <div class="dropdown options ms-auto">
                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                  <ion-icon name="ellipsis-horizontal-sharp"></ion-icon>
                </div>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="chart-container4">
              <canvas id="chart8"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end row-->

  </div>
  <!-- end page content-->
</div>
<!--end page content wrapper-->


<!--/contenido de la pagina-->
<?php
include_once '../partials/footer.php';
include_once '../partials/analy.php';
?>