@extends("admin.layouts.app")
@section('content')
<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="bg-dark">
      <div class="content container-fluid" style="height: 25rem;">
        <!-- Page Header -->
        <div class="page-header page-header-light">
          <div class="row align-items-center">
            <div class="col">
              <h1 class="page-header-title">Dashboard</h1>
            </div>

            <div class="col-auto">
              <!-- Daterangepicker -->
              <button id="js-daterangepicker-predefined" class="btn btn-sm btn-ghost-light dropdown-toggle">
                <i class="tio-date-range"></i>
                <span class="js-daterangepicker-predefined-preview ml-1"></span>
              </button>
              <!-- End Daterangepicker -->
            </div>
          </div>
          <!-- End Row -->

          <!-- Nav Scroller -->
          <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev hs-nav-scroller-arrow-dark-prev" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-left"></i>
              </a>
            </span>

            <span class="hs-nav-scroller-arrow-next hs-nav-scroller-arrow-dark-next" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-right"></i>
              </a>
            </span>

            <!-- Nav -->
            <ul class="nav nav-tabs nav-tabs-light page-header-tabs" id="pageHeaderTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" href="javascript:;">Overview</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="javascript:;">Status</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="javascript:;">
                  Sessions
                  <span class="badge badge-warning badge-pill ml-1">
                    <i class="tio-warning mr-1"></i> Verification required
                  </span>
                </a>
              </li>
            </ul>
            <!-- End Nav -->
          </div>
          <!-- End Nav Scroller -->
        </div>
        <!-- End Page Header -->
      </div>
    </div>
    <!-- End Content -->

    <!-- Content -->
    <div class="content container-fluid" style="margin-top: -17rem;">
      <!-- Card -->
      <div class="card mb-3 mb-lg-5">
        <!-- Header -->
        <div class="card-header">
          <h4 class="card-header-title">Recent projects</h4>

          <!-- Nav -->
          <ul class="nav nav-segment nav-fill" id="projectsTab" role="tablist">
            <li class="nav-item" data-toggle="chart" data-datasets="0" data-trigger="click" data-action="toggle">
              <a class="nav-link active" href="javascript:;" data-toggle="tab">This week</a>
            </li>
            <li class="nav-item" data-toggle="chart" data-datasets="1" data-trigger="click" data-action="toggle">
              <a class="nav-link" href="javascript:;" data-toggle="tab">Last week</a>
            </li>
          </ul>
          <!-- End Nav -->
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="card-body">
          <div class="row align-items-sm-center mb-4">
            <div class="col-sm mb-3 mb-sm-0">
              <div class="d-flex align-items-center">
                <span class="h1 mb-0">$7,431.14 USD</span>

                <span class="text-success ml-2">
                  <i class="tio-trending-up"></i> 25.3%
                </span>
              </div>
            </div>

            <div class="col-sm-auto">
              <!-- Legend Indicators -->
              <div class="row font-size-sm">
                <div class="col-auto">
                  <span class="legend-indicator bg-primary"></span> Income
                </div>
                <div class="col-auto">
                  <span class="legend-indicator bg-info"></span> Expenses
                </div>
              </div>
              <!-- End Legend Indicators -->
            </div>
          </div>
          <!-- End Row -->

          <!-- Bar Chart -->
          <div class="chartjs-custom" style="height: 18rem;">
            <canvas id="updatingData" data-hs-chartjs-options='{
                      "type": "line",
                      "data": {
                         "labels": ["Feb","Jan","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                         "datasets": [{
                          "backgroundColor": ["rgba(55, 125, 255, .5)", "rgba(255, 255, 255, .2)"],
                          "borderColor": "#377dff",
                          "borderWidth": 2,
                          "pointRadius": 0,
                          "hoverBorderColor": "#377dff",
                          "pointBackgroundColor": "#377dff",
                          "pointBorderColor": "#fff",
                          "pointHoverRadius": 0
                        },
                        {
                          "backgroundColor": ["rgba(0, 201, 219, .5)", "rgba(255, 255, 255, .2)"],
                          "borderColor": "#00c9db",
                          "borderWidth": 2,
                          "pointRadius": 0,
                          "hoverBorderColor": "#00c9db",
                          "pointBackgroundColor": "#00c9db",
                          "pointBorderColor": "#fff",
                          "pointHoverRadius": 0
                        }]
                      },
                      "options": {
                        "gradientPosition": {"y1": 200},
                         "scales": {
                            "yAxes": [{
                              "gridLines": {
                                "color": "#e7eaf3",
                                "drawBorder": false,
                                "zeroLineColor": "#e7eaf3"
                              },
                              "ticks": {
                                "min": 0,
                                "max": 100,
                                "stepSize": 20,
                                "fontColor": "#97a4af",
                                "fontFamily": "Open Sans, sans-serif",
                                "padding": 10,
                                "postfix": "k"
                              }
                            }],
                            "xAxes": [{
                              "gridLines": {
                                "display": false,
                                "drawBorder": false
                              },
                              "ticks": {
                                "fontSize": 12,
                                "fontColor": "#97a4af",
                                "fontFamily": "Open Sans, sans-serif",
                                "padding": 5
                              }
                            }]
                        },
                        "tooltips": {
                          "prefix": "$",
                          "postfix": "k",
                          "hasIndicator": true,
                          "mode": "index",
                          "intersect": false,
                          "lineMode": true,
                          "lineWithLineColor": "rgba(19, 33, 68, 0.075)"
                        },
                        "hover": {
                          "mode": "nearest",
                          "intersect": true
                        }
                      }
                    }'>
            </canvas>
          </div>
          <!-- End Bar Chart -->
        </div>
        <!-- End Body -->

        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-borderless table-thead-bordered table-align-middle card-table">
            <thead class="thead-light">
              <tr>
                <th>Project name</th>
                <th>Members</th>
                <th>Spent</th>
                <th>Hours</th>
                <th>Completion</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>
                  <a class="media align-items-center" href="project.html">
                    <img class="avatar avatar-sm mr-3" src="assets\svg\brands\spec.svg" alt="Image Description">
                    <div class="media-body">
                      <span class="d-block h5 text-hover-primary mb-0">Install Front pay</span>
                    </div>
                  </a>
                </td>
                <td>
                  <!-- Avatar Group -->
                  <div class="avatar-group avatar-group-xs avatar-circle">
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Amanda Harvey">
                      <img class="avatar-img" src="assets\img\160x160\img10.jpg" alt="Image Description">
                    </a>
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="David Harrison">
                      <img class="avatar-img" src="assets\img\160x160\img3.jpg" alt="Image Description">
                    </a>
                    <a class="avatar avatar-soft-info" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Lisa Iston">
                      <span class="avatar-initials">L</span>
                    </a>
                    <a class="avatar avatar-light avatar-circle" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Lewis Clarke, Chris Mathew and 3 more">
                      <span class="avatar-initials">+5</span>
                    </a>
                  </div>
                  <!-- End Avatar Group -->
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0">$25,000</span>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0">34</span>
                    <span class="badge badge-soft-danger p-1 ml-2">
                      <i class="tio-trending-down"></i> 1.8
                    </span>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0 mr-2">26%</span>
                    <div class="progress table-progress">
                      <div class="progress-bar" role="progressbar" style="width: 26%" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <a class="media align-items-center" href="project.html">
                    <img class="avatar avatar-sm mr-3" src="assets\svg\brands\mailchimp.svg" alt="Image Description">
                    <div class="media-body">
                      <span class="d-block h5 text-hover-primary mb-0">Update subscription method <i class="tio-verified text-primary" data-toggle="tooltip" data-placement="top" title="Earned extra bonus"></i></span>
                    </div>
                  </a>
                </td>
                <td>
                  <!-- Avatar Group -->
                  <div class="avatar-group avatar-group-xs avatar-circle">
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Costa Quinn">
                      <img class="avatar-img" src="assets\img\160x160\img6.jpg" alt="Image Description">
                    </a>
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Clarice Boone">
                      <img class="avatar-img" src="assets\img\160x160\img7.jpg" alt="Image Description">
                    </a>
                    <a class="avatar avatar-soft-danger" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Adam Keep">
                      <span class="avatar-initials">A</span>
                    </a>
                  </div>
                  <!-- End Avatar Group -->
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0">$5,783</span>
                    <span class="badge badge-soft-success p-1 ml-2">
                      <i class="tio-trending-up"></i> 7.3%
                    </span>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0">73.1</span>
                    <span class="badge badge-soft-success p-1 ml-2">
                      <i class="tio-trending-up"></i> 5.0
                    </span>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0 mr-2">100%</span>
                    <div class="progress table-progress">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <a class="media align-items-center" href="project.html">
                    <div class="avatar avatar-sm avatar-soft-primary avatar-circle mr-3">
                      <span class="avatar-initials">I</span>
                    </div>
                    <div class="media-body">
                      <span class="d-block h5 text-hover-primary mb-0">Increase productivity with reviews</span>
                    </div>
                  </a>
                </td>
                <td>
                  <!-- Avatar Group -->
                  <div class="avatar-group avatar-group-xs avatar-circle">
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Finch Hoot">
                      <img class="avatar-img" src="assets\img\160x160\img5.jpg" alt="Image Description">
                    </a>
                    <a class="avatar avatar-soft-dark" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Bob Bardly">
                      <span class="avatar-initials">B</span>
                    </a>
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Linda Bates">
                      <img class="avatar-img" src="assets\img\160x160\img8.jpg" alt="Image Description">
                    </a>
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Ella Lauda">
                      <img class="avatar-img" src="assets\img\160x160\img9.jpg" alt="Image Description">
                    </a>
                  </div>
                  <!-- End Avatar Group -->
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0">$36,678</span>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0">68.7</span>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0 mr-2">7%</span>
                    <div class="progress table-progress">
                      <div class="progress-bar" role="progressbar" style="width: 7%" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <a class="media align-items-center" href="project.html">
                    <img class="avatar avatar-sm mr-3" src="assets\svg\brands\atlassian.svg" alt="Image Description">
                    <div class="media-body">
                      <span class="d-block h5 text-hover-primary mb-0">Develop our mobile app <i class="tio-verified text-primary" data-toggle="tooltip" data-placement="top" title="Earned extra bonus"></i></span>
                    </div>
                  </a>
                </td>
                <td>
                  <!-- Avatar Group -->
                  <div class="avatar-group avatar-group-xs avatar-circle">
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Costa Quinn">
                      <img class="avatar-img" src="assets\img\160x160\img6.jpg" alt="Image Description">
                    </a>
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Clarice Boone">
                      <img class="avatar-img" src="assets\img\160x160\img7.jpg" alt="Image Description">
                    </a>
                    <a class="avatar avatar-soft-danger" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Adam Keep">
                      <span class="avatar-initials">A</span>
                    </a>
                  </div>
                  <!-- End Avatar Group -->
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0">$2,623</span>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0">62.4</span>
                    <span class="badge badge-soft-success p-1 ml-2">
                      <i class="tio-trending-up"></i> 2.2
                    </span>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0 mr-2">100%</span>
                    <div class="progress table-progress">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <a class="media align-items-center" href="project.html">
                    <img class="avatar avatar-sm mr-3" src="assets\svg\brands\google-webdev.svg" alt="Image Description">
                    <div class="media-body">
                      <span class="d-block h5 text-hover-primary mb-0">Get a complete store audit</span>
                    </div>
                  </a>
                </td>
                <td>
                  <!-- Avatar Group -->
                  <div class="avatar-group avatar-group-xs avatar-circle">
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Amanda Harvey">
                      <img class="avatar-img" src="assets\img\160x160\img10.jpg" alt="Image Description">
                    </a>
                    <a class="avatar" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="David Harrison">
                      <img class="avatar-img" src="assets\img\160x160\img3.jpg" alt="Image Description">
                    </a>
                    <a class="avatar avatar-soft-info" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Lisa Iston">
                      <span class="avatar-initials">L</span>
                    </a>
                    <a class="avatar avatar-light avatar-circle" href="user-profile.html" data-toggle="tooltip" data-placement="top" title="Lewis Clarke, Chris Mathew and 3 more">
                      <span class="avatar-initials">+5</span>
                    </a>
                  </div>
                  <!-- End Avatar Group -->
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0">$9,000</span>
                    <span class="badge badge-soft-danger p-1 ml-2">
                      <i class="tio-trending-down"></i> 0.4
                    </span>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0">7</span>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="mb-0 mr-2">42%</span>
                    <div class="progress table-progress">
                      <div class="progress-bar" role="progressbar" style="width: 42%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- End Table -->

        <!-- Card Footer -->
        <a class="card-footer text-center" href="projects.html">
          View all projects <i class="tio-chevron-right"></i>
        </a>
        <!-- End Card Footer -->
      </div>
      <!-- End Card -->

      <div class="row">
        <div class="col-lg-4 mb-3 mb-lg-5">
          <!-- Card -->
          <div class="card h-100">
            <!-- Header -->
            <div class="card-header">
              <h4 class="card-header-title">Payments</h4>

              <!-- Unfold -->
              <div class="hs-unfold">
                <a class="js-hs-unfold-invoker btn btn-icon btn-sm btn-ghost-secondary rounded-circle" href="javascript:;" data-hs-unfold-options='{
                     "target": "#reportsOverviewDropdown1",
                     "type": "css-animation"
                   }'>
                  <i class="tio-more-vertical"></i>
                </a>

                <div id="reportsOverviewDropdown1" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right mt-1">
                  <span class="dropdown-header">Settings</span>

                  <a class="dropdown-item" href="#">
                    <i class="tio-share dropdown-item-icon"></i> Share reports
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="tio-download-to dropdown-item-icon"></i> Download
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="tio-alt dropdown-item-icon"></i> Connect other apps
                  </a>

                  <div class="dropdown-divider"></div>

                  <span class="dropdown-header">Feedback</span>

                  <a class="dropdown-item" href="#">
                    <i class="tio-chat-outlined dropdown-item-icon"></i> Report
                  </a>
                </div>
              </div>
              <!-- End Unfold -->
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body text-center">
              <!-- Badge -->
              <div class="h3">
                <span class="badge badge-soft-info badge-pill">
                  <i class="tio-checkmark-circle"></i> On track
                </span>
              </div>
              <!-- End Badge -->

              <!-- Chart Half -->
              <div class="chartjs-doughnut-custom" style="height: 12rem;">
                <canvas class="js-chartjs-doughnut-half" data-hs-chartjs-options='{
                        "type": "doughnut",
                        "data": {
                          "labels": ["Current status", "Goal"],
                          "datasets": [{
                            "data": [64, 35],
                            "backgroundColor": ["#377dff", "rgba(55,125,255,.35)"],
                            "borderWidth": 4,
                            "hoverBorderColor": "#ffffff"
                          }]
                        }
                      }'></canvas>

                <div class="chartjs-doughnut-custom-stat">
                  <small class="text-cap">Project balance</small>
                  <span class="h1">$150,238.00</span>
                </div>
              </div>
              <!-- End Chart Half -->

              <hr>

              <div class="row">
                <div class="col text-right">
                  <span class="d-block h4 mb-0">$72.46</span>
                  <span class="d-block">last transaction</span>
                </div>

                <div class="col column-divider text-left">
                  <span class="d-block h4 text-success mb-0">
                    <i class="tio-trending-up"></i> 12%
                  </span>
                  <span class="d-block">since last visit</span>
                </div>
              </div>
              <!-- End Row -->
            </div>
            <!-- End Body -->
          </div>
          <!-- End Card -->
        </div>

        <div class="col-lg-8 mb-3 mb-lg-5">
          <!-- Card -->
          <div class="card h-100">
            <!-- Header -->
            <div class="card-header">
              <h4 class="card-header-title">Latest transactions</h4>

              <!-- Unfold -->
              <div class="hs-unfold">
                <a class="js-hs-unfold-invoker btn btn-icon btn-sm btn-ghost-secondary rounded-circle" href="javascript:;" data-hs-unfold-options='{
                     "target": "#reportsOverviewDropdown3",
                     "type": "css-animation"
                   }'>
                  <i class="tio-more-vertical"></i>
                </a>

                <div id="reportsOverviewDropdown3" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right mt-1">
                  <span class="dropdown-header">Settings</span>

                  <a class="dropdown-item" href="#">
                    <i class="tio-share dropdown-item-icon"></i> Share reports
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="tio-download-to dropdown-item-icon"></i> Download
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="tio-alt dropdown-item-icon"></i> Connect other apps
                  </a>

                  <div class="dropdown-divider"></div>

                  <span class="dropdown-header">Feedback</span>

                  <a class="dropdown-item" href="#">
                    <i class="tio-chat-outlined dropdown-item-icon"></i> Report
                  </a>
                </div>
              </div>
              <!-- End Unfold -->
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body card-body-height">
              <ul class="list-group list-group-flush list-group-no-gutters">
                <!-- List Item -->
                <li class="list-group-item">
                  <div class="media">
                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-soft-dark avatar-circle mr-3">
                      <span class="avatar-initials">B</span>
                    </div>
                    <!-- End Avatar -->

                    <div class="media-body">
                      <div class="row">
                        <div class="col-7 col-md-5 order-md-1">
                          <h5 class="mb-0">Bob Dean</h5>
                          <span class="font-size-sm">Transfer to bank account</span>
                        </div>

                        <div class="col-5 col-md-4 order-md-3 text-right mt-2 mt-md-0">
                          <h5 class="mb-0">-$290.00 USD</h5>
                          <span class="font-size-sm">15 May, 2020</span>
                        </div>

                        <div class="col-auto col-md-3 order-md-2">
                          <span class="badge badge-soft-warning badge-pill">Pending</span>
                        </div>
                      </div>
                      <!-- End Row -->
                    </div>
                  </div>
                </li>
                <!-- End List Item -->

                <!-- List Item -->
                <li class="list-group-item">
                  <div class="media">
                    <!-- Avatar -->
                    <img class="avatar avatar-sm avatar-circle mr-3" src="assets\svg\brands\slack.svg" alt="Image Description">
                    <!-- End Avatar -->

                    <div class="media-body">
                      <div class="row">
                        <div class="col-7 col-md-5 order-md-1">
                          <h5 class="mb-0">Slack</h5>
                          <span class="font-size-sm">Subscription payment</span>
                        </div>

                        <div class="col-5 col-md-4 order-md-3 text-right mt-2 mt-md-0">
                          <h5 class="mb-0">-$11.00 USD</h5>
                          <span class="font-size-sm">12 May, 2020</span>
                        </div>

                        <div class="col-auto col-md-3 order-md-2">
                          <span class="badge badge-soft-success badge-pill">Completed</span>
                        </div>
                      </div>
                      <!-- End Row -->
                    </div>
                  </div>
                </li>
                <!-- End List Item -->

                <!-- List Item -->
                <li class="list-group-item">
                  <div class="media">
                    <!-- Avatar -->
                    <img class="avatar avatar-sm avatar-circle mr-3" src="assets\svg\brands\bank-of-america.svg" alt="Image Description">
                    <!-- End Avatar -->

                    <div class="media-body">
                      <div class="row">
                        <div class="col-7 col-md-5 order-md-1">
                          <h5 class="mb-0">Bank of America</h5>
                          <span class="font-size-sm">Withdrawal to bank account</span>
                        </div>

                        <div class="col-5 col-md-4 order-md-3 text-right mt-2 mt-md-0">
                          <h5 class="text-success mb-0">$3500.00 USD</h5>
                          <span class="font-size-sm">10 May, 2020</span>
                        </div>

                        <div class="col-auto col-md-3 order-md-2">
                          <span class="badge badge-soft-success badge-pill">Completed</span>
                        </div>
                      </div>
                      <!-- End Row -->
                    </div>
                  </div>
                </li>
                <!-- End List Item -->

                <!-- List Item -->
                <li class="list-group-item">
                  <div class="media">
                    <!-- Avatar -->
                    <img class="avatar avatar-sm avatar-circle mr-3" src="assets\svg\brands\spotify.svg" alt="Image Description">
                    <!-- End Avatar -->

                    <div class="media-body">
                      <div class="row">
                        <div class="col-7 col-md-5 order-md-1">
                          <h5 class="mb-0">Spotify</h5>
                          <span class="font-size-sm">Subscription payment</span>
                        </div>

                        <div class="col-5 col-md-4 order-md-3 text-right mt-2 mt-md-0">
                          <h5 class="mb-0">-$10.00 USD</h5>
                          <span class="font-size-sm">12 May, 2020</span>
                        </div>

                        <div class="col-auto col-md-3 order-md-2">
                          <span class="badge badge-soft-danger badge-pill">Failed</span>
                        </div>
                      </div>
                      <!-- End Row -->
                    </div>
                  </div>
                </li>
                <!-- End List Item -->

                <!-- List Item -->
                <li class="list-group-item">
                  <div class="media">
                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-soft-dark avatar-circle mr-3">
                      <span class="avatar-initials">R</span>
                    </div>
                    <!-- End Avatar -->

                    <div class="media-body">
                      <div class="row">
                        <div class="col-7 col-md-5 order-md-1">
                          <h5 class="mb-0">Rachel Doe</h5>
                          <span class="font-size-sm">Transfer to bank account</span>
                        </div>

                        <div class="col-5 col-md-4 order-md-3 text-right mt-2 mt-md-0">
                          <h5 class="text-success mb-0">$290.00 USD</h5>
                          <span class="font-size-sm">28 April, 2020</span>
                        </div>

                        <div class="col-auto col-md-3 order-md-2">
                          <span class="badge badge-soft-success badge-pill">Completed</span>
                        </div>
                      </div>
                      <!-- End Row -->
                    </div>
                  </div>
                </li>
                <!-- End List Item -->

                <!-- List Item -->
                <li class="list-group-item">
                  <div class="media">
                    <!-- Avatar -->
                    <img class="avatar avatar-sm avatar-circle mr-3" src="assets\img\160x160\img9.jpg" alt="Image Description">
                    <!-- End Avatar -->

                    <div class="media-body">
                      <div class="row">
                        <div class="col-7 col-md-5 order-md-1">
                          <h5 class="mb-0">Ella Lauda</h5>
                          <span class="font-size-sm">Transfer to bank account</span>
                        </div>

                        <div class="col-5 col-md-4 order-md-3 text-right mt-2 mt-md-0">
                          <h5 class="mb-0">-$250.00 USD</h5>
                          <span class="font-size-sm">01 May, 2020</span>
                        </div>

                        <div class="col-auto col-md-3 order-md-2">
                          <span class="badge badge-soft-success badge-pill">Completed</span>
                        </div>
                      </div>
                      <!-- End Row -->
                    </div>
                  </div>
                </li>
                <!-- End List Item -->
              </ul>
            </div>
            <!-- End Body -->
          </div>
          <!-- End Card -->
        </div>
      </div>
      <!-- End Row -->

      <!-- Card -->
      <div class="card mb-3 mb-lg-5">
        <!-- Header -->
        <div class="card-header">
          <h4 class="card-header-title">Audience overview <i class="tio-verified text-primary" data-toggle="tooltip" data-placement="top" title="This report is based on 100% of sessions."></i></h4>

          <!-- Unfold -->
          <div class="hs-unfold">
            <a class="js-hs-unfold-invoker btn btn-icon btn-sm btn-ghost-secondary rounded-circle" href="javascript:;" data-hs-unfold-options='{
                 "target": "#reportsOverviewDropdown2",
                 "type": "css-animation"
               }'>
              <i class="tio-more-vertical"></i>
            </a>

            <div id="reportsOverviewDropdown2" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right mt-1">
              <span class="dropdown-header">Settings</span>

              <a class="dropdown-item" href="#">
                <i class="tio-share dropdown-item-icon"></i> Share reports
              </a>
              <a class="dropdown-item" href="#">
                <i class="tio-download-to dropdown-item-icon"></i> Download
              </a>
              <a class="dropdown-item" href="#">
                <i class="tio-alt dropdown-item-icon"></i> Connect other apps
              </a>

              <div class="dropdown-divider"></div>

              <span class="dropdown-header">Feedback</span>

              <a class="dropdown-item" href="#">
                <i class="tio-chat-outlined dropdown-item-icon"></i> Report
              </a>
            </div>
          </div>
          <!-- End Unfold -->
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 col-lg">
              <!-- Stats -->
              <div class="media align-items-center">
                <i class="tio-user-big-outlined tio-xl text-primary mr-3"></i>

                <div class="media-body">
                  <span class="d-block font-size-sm">Users</span>
                  <div class="d-flex align-items-center">
                    <h3 class="mb-0">34,413</h3>
                    <span class="badge badge-soft-success ml-2">
                      <i class="tio-trending-up"></i> 12.5%
                    </span>
                  </div>
                </div>
              </div>
              <!-- End Stats -->

              <div class="d-lg-none">
                <hr>
              </div>
            </div>

            <div class="col-sm-6 col-lg column-divider-lg">
              <!-- Stats -->
              <div class="media align-items-center">
                <i class="tio-time-20-s tio-xl text-primary mr-3"></i>

                <div class="media-body">
                  <span class="d-block font-size-sm">Avg. session duration</span>
                  <div class="d-flex align-items-center">
                    <h3 class="mb-0">1m 3s</h3>
                  </div>
                </div>
              </div>
              <!-- End Stats -->

              <div class="d-lg-none">
                <hr>
              </div>
            </div>

            <div class="col-sm-6 col-lg column-divider-lg">
              <!-- Stats -->
              <div class="media align-items-center">
                <i class="tio-pages-outlined tio-xl text-primary mr-3"></i>

                <div class="media-body">
                  <span class="d-block font-size-sm">Pages/Sessions</span>
                  <div class="d-flex align-items-center">
                    <h3 class="mb-0">1.78</h3>
                  </div>
                </div>
              </div>
              <!-- End Stats -->

              <div class="d-sm-none">
                <hr>
              </div>
            </div>

            <div class="col-sm-6 col-lg column-divider-lg">
              <!-- Stats -->
              <div class="media align-items-center">
                <i class="tio-chart-donut-2 tio-xl text-primary mr-3"></i>

                <div class="media-body">
                  <span class="d-block font-size-sm">Bounce rate</span>
                  <div class="d-flex align-items-center">
                    <h3 class="mb-0">62.9%</h3>
                  </div>
                </div>
              </div>
              <!-- End Stats -->
            </div>
          </div>
          <!-- End Row -->
        </div>
        <!-- End Body -->

        <!-- Vector Map -->
        <div style="height: 30rem;">
          <div class="js-jvectormap jvectormap-custom card-jvectormap" data-hs-jvector-map-options='{
                 "tipCentered": true,
                 "focusOn": {
                   "x": 0.5,
                   "y": 0.5,
                   "scale": 1.5
                 },
                 "regionStyle": {
                  "initial": {
                    "fill": "rgba(55, 125, 255, .3)"
                  },
                  "hover": {
                    "fill": "#377dff"
                  }
                 },
                 "backgroundColor": "#132144",
                 "markerStyle": {
                   "initial": {
                     "stroke-width": 0,
                     "fill": "rgba(255,255,255,.5)",
                     "stroke": "rgba(255,255,255,.5)",
                     "r": 6
                   },
                   "hover": {
                    "stroke-width": 0,
                    "fill": "#fff",
                    "stroke": "#fff"
                   }
                  }
                 }'></div>
        </div>
        <!-- End Vector Map -->
      </div>
      <!-- End Card -->

      <!-- Card -->
      <div class="card">
        <!-- Header -->
        <div class="card-header">
          <h4 class="card-header-title">Recent reviews</h4>

          <!-- Unfold -->
          <div class="hs-unfold">
            <a class="js-hs-unfold-invoker btn btn-icon btn-sm btn-ghost-secondary rounded-circle" href="javascript:;" data-hs-unfold-options='{
                 "target": "#reportsOverviewDropdown4",
                 "type": "css-animation"
               }'>
              <i class="tio-more-vertical"></i>
            </a>

            <div id="reportsOverviewDropdown4" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right mt-1">
              <span class="dropdown-header">Settings</span>

              <a class="dropdown-item" href="#">
                <i class="tio-share dropdown-item-icon"></i> Share reports
              </a>
              <a class="dropdown-item" href="#">
                <i class="tio-download-to dropdown-item-icon"></i> Download
              </a>
              <a class="dropdown-item" href="#">
                <i class="tio-alt dropdown-item-icon"></i> Connect other apps
              </a>

              <div class="dropdown-divider"></div>

              <span class="dropdown-header">Feedback</span>

              <a class="dropdown-item" href="#">
                <i class="tio-chat-outlined dropdown-item-icon"></i> Report
              </a>
            </div>
          </div>
          <!-- End Unfold -->
        </div>
        <!-- End Header -->

        <div class="row">
          <div class="col-lg-4">
            <!-- Body -->
            <div class="card-body bg-light h-100">
              <div class="d-flex align-items-center">
                <span class="display-1 text-dark mr-4">4.84</span>
                <img class="avatar avatar-xl avatar-4by3" src="assets\svg\illustrations\review-5-star.svg" alt="Image Description">
              </div>

              <span class="d-block mb-5">
                &mdash; of 56 reviews <span class="badge badge-soft-dark badge-pill ml-1">+1 this week</span>
              </span>

              <ul class="list-unstyled list-unstyled-py-2">
                <!-- Review Ratings -->
                <li class="d-flex align-items-center font-size-sm">
                  <span class="mr-3">5</span>
                  <div class="progress flex-grow-1">
                    <div class="progress-bar" role="progressbar" style="width: 82%;" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="ml-3">51</span>
                </li>
                <!-- End Review Ratings -->

                <!-- Review Ratings -->
                <li class="d-flex align-items-center font-size-sm">
                  <span class="mr-3">4</span>
                  <div class="progress flex-grow-1">
                    <div class="progress-bar" role="progressbar" style="width: 18%;" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="ml-3">5</span>
                </li>
                <!-- End Review Ratings -->

                <!-- Review Ratings -->
                <li class="d-flex align-items-center font-size-sm">
                  <span class="mr-3">3</span>
                  <div class="progress flex-grow-1">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="ml-3">0</span>
                </li>
                <!-- End Review Ratings -->

                <!-- Review Ratings -->
                <li class="d-flex align-items-center font-size-sm">
                  <span class="mr-3">2</span>
                  <div class="progress flex-grow-1">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="ml-3">0</span>
                </li>
                <!-- End Review Ratings -->

                <!-- Review Ratings -->
                <li class="d-flex align-items-center font-size-sm">
                  <span class="mr-3">1</span>
                  <div class="progress flex-grow-1">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="ml-3">0</span>
                </li>
                <!-- End Review Ratings -->
              </ul>
            </div>
            <!-- End Body -->
          </div>

          <div class="col-lg-8">
            <!-- Body -->
            <div class="card-body card-body-height" style="height: 25rem;">
              <!-- List Comment -->
              <ul class="list-comment">
                <!-- Review -->
                <li class="list-comment-item">
                  <!-- Media -->
                  <div class="media mb-2">
                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-circle mb-2 mr-2">
                      <img class="avatar-img" src="assets\img\160x160\img10.jpg" alt="Image Description">
                    </div>
                    <!-- End Avatar -->

                    <div class="media-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="mb-0">Amanda Harvey</h5>

                          <ul class="list-inline font-size-sm">
                            <li class="list-inline-item">
                              <!-- Rating List -->
                              <div class="d-flex">
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                              </div>
                              <!-- End Rating List -->
                            </li>

                            <li class="list-inline-item">1 day ago</li>
                          </ul>
                        </div>

                        <div class="col-auto">
                          <!-- Unfold -->
                          <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-sm btn-ghost-secondary rounded-circle" href="javascript:;" data-hs-unfold-options='{
                                 "target": "#reviewMoreDropdown1",
                                 "type": "css-animation"
                               }'>
                              <i class="tio-more-vertical"></i>
                            </a>

                            <div id="reviewMoreDropdown1" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right mt-1">
                              <a class="dropdown-item" href="#">
                                <i class="tio-flag-outlined dropdown-item-icon"></i> Flag as inappropriate
                              </a>

                              <a class="dropdown-item" href="#">
                                <i class="tio-unsubscribe dropdown-item-icon"></i> Flag as spam
                              </a>
                            </div>
                          </div>
                          <!-- End Unfold -->
                        </div>
                      </div>
                      <!-- End Row -->
                    </div>
                  </div>
                  <!-- End Media -->

                  <h5 class="mb-1">Great template</h5>
                  <p>Another great template from Htmlstream! Refreshing and Thought provoking design and it changes my view about how I design the websites. Great typography, modern clean white design, nice tones of the color. SVG artifacts are a plus.</p>

                  <a href="#">
                    <i class="tio-reply"></i> Reply
                  </a>
                </li>
                <!-- End Review -->

                <!-- Review -->
                <li class="list-comment-item">
                  <!-- Media -->
                  <div class="media mb-2">
                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-circle mb-2 mr-2">
                      <img class="avatar-img" src="assets\img\160x160\img3.jpg" alt="Image Description">
                    </div>
                    <!-- End Avatar -->

                    <div class="media-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="mb-0">David Harrison</h5>

                          <ul class="list-inline font-size-sm">
                            <li class="list-inline-item">
                              <!-- Rating List -->
                              <div class="d-flex">
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                              </div>
                              <!-- End Rating List -->
                            </li>

                            <li class="list-inline-item">3 weeks ago</li>
                          </ul>
                        </div>

                        <div class="col-auto">
                          <!-- Unfold -->
                          <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-sm btn-ghost-secondary rounded-circle" href="javascript:;" data-hs-unfold-options='{
                                 "target": "#reviewMoreDropdown2",
                                 "type": "css-animation"
                               }'>
                              <i class="tio-more-vertical"></i>
                            </a>

                            <div id="reviewMoreDropdown2" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right mt-1">
                              <a class="dropdown-item" href="#">
                                <i class="tio-flag-outlined dropdown-item-icon"></i> Flag as inappropriate
                              </a>

                              <a class="dropdown-item" href="#">
                                <i class="tio-unsubscribe dropdown-item-icon"></i> Flag as spam
                              </a>
                            </div>
                          </div>
                          <!-- End Unfold -->
                        </div>
                      </div>
                      <!-- End Row -->
                    </div>
                  </div>
                  <!-- End Media -->

                  <h5 class="mb-1">Well documented! Lots of possibilities!</h5>
                  <p>Truly great. Well done. Carefully structured. Happy with the template.</p>

                  <blockquote class="blockquote mt-4">
                    <!-- Media -->
                    <div class="media">
                      <div class="avatar avatar-sm avatar-circle mb-2 mr-2">
                        <img class="avatar-img" src="assets\svg\brands\htmlstream.svg" alt="Image Description">
                      </div>

                      <div class="media-body">
                        <h5 class="mb-0">Htmlstream</h5>

                        <ul class="list-inline font-size-sm">
                          <li class="list-inline-item">Author</li>
                          <li class="list-inline-item">3 weeks ago</li>
                        </ul>
                      </div>
                    </div>
                    <!-- End Media -->

                    Awesome! We are super glad to hear that everything is working great for you!
                  </blockquote>
                </li>
                <!-- End Review -->

                <!-- Review -->
                <li class="list-comment-item">
                  <!-- Media -->
                  <div class="media mb-2">
                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-soft-dark avatar-circle mr-2">
                      <span class="avatar-initials">B</span>
                    </div>
                    <!-- End Avatar -->

                    <div class="media-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="mb-0">Bob Dean</h5>

                          <ul class="list-inline font-size-sm">
                            <li class="list-inline-item">
                              <!-- Rating List -->
                              <div class="d-flex">
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                                <div class="mr-1"><img src="assets\svg\components\star.svg" alt="Review rating" width="12"></div>
                              </div>
                              <!-- End Rating List -->
                            </li>

                            <li class="list-inline-item">2 months ago</li>
                          </ul>
                        </div>

                        <div class="col-auto">
                          <!-- Unfold -->
                          <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-sm btn-ghost-secondary rounded-circle" href="javascript:;" data-hs-unfold-options='{
                                 "target": "#reviewMoreDropdown3",
                                 "type": "css-animation"
                               }'>
                              <i class="tio-more-vertical"></i>
                            </a>

                            <div id="reviewMoreDropdown3" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right mt-1">
                              <a class="dropdown-item" href="#">
                                <i class="tio-flag-outlined dropdown-item-icon"></i> Flag as inappropriate
                              </a>

                              <a class="dropdown-item" href="#">
                                <i class="tio-unsubscribe dropdown-item-icon"></i> Flag as spam
                              </a>
                            </div>
                          </div>
                          <!-- End Unfold -->
                        </div>
                      </div>
                      <!-- End Row -->
                    </div>
                  </div>
                  <!-- End Media -->

                  <h5 class="mb-1">Beautifull template great support</h5>
                  <p>Got a very quick response on my inquiry, very nice! Love the template, beautifull components!</p>

                  <blockquote class="blockquote mt-4">
                    <!-- Media -->
                    <div class="media">
                      <div class="avatar avatar-sm avatar-circle mb-2 mr-2">
                        <img class="avatar-img" src="assets\svg\brands\htmlstream.svg" alt="Image Description">
                      </div>

                      <div class="media-body">
                        <h5 class="mb-0">Htmlstream</h5>

                        <ul class="list-inline font-size-sm">
                          <li class="list-inline-item">Author</li>
                          <li class="list-inline-item">2 months ago</li>
                        </ul>
                      </div>
                    </div>
                    <!-- End Media -->

                    Hey Bob, thanks a lot for sharing your experience - we do much appreciate it! Cheers!
                  </blockquote>
                </li>
                <!-- End Review -->
              </ul>
              <!-- End List Comment -->
            </div>
            <!-- End Body -->
          </div>
        </div>
        <!-- End Row -->

        <!-- Card Footer -->
        <a class="card-footer text-center" href="ecommerce-manage-reviews.html">
          View all reviews <i class="tio-chevron-right"></i>
        </a>
        <!-- End Card Footer -->
      </div>
      <!-- End Card -->
    </div>
    <!-- End Content -->

    <!-- Footer -->
    
      <div class="footer">
        <div class="row justify-content-between align-items-center">
          <div class="col">
            <p class="font-size-sm mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2020 Htmlstream.</span></p>
          </div>
          <div class="col-auto">
            <div class="d-flex justify-content-end">
              <!-- List Dot -->
              <ul class="list-inline list-separator">
                <li class="list-inline-item">
                  <a class="list-separator-link" href="#">FAQ</a>
                </li>

                <li class="list-inline-item">
                  <a class="list-separator-link" href="#">License</a>
                </li>

                <li class="list-inline-item">
                  <!-- Keyboard Shortcuts Toggle -->
                  <div class="hs-unfold">
                    <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle" href="javascript:;" data-hs-unfold-options='{
                            "target": "#keyboardShortcutsSidebar",
                            "type": "css-animation",
                            "animationIn": "fadeInRight",
                            "animationOut": "fadeOutRight",
                            "hasOverlay": true,
                            "smartPositionOff": true
                           }'>
                      <i class="tio-command-key"></i>
                    </a>
                  </div>
                  <!-- End Keyboard Shortcuts Toggle -->
                </li>
              </ul>
              <!-- End List Dot -->
            </div>
          </div>
        </div>
      </div>
    

    
    <!-- End Footer -->
  </main>
@endsection