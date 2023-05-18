<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <?php include('header-1.php'); ?>
    <link
      href="<?php echo base_url().'assets/admin_assets/vendor/fontawesome-free/css/all.min.css'?>"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />
    <link href=<?php echo base_url().'assets/admin_assets/css/sb-admin-2.min.css'?> rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    #userId{
        display:none;
    }
    </style>
</head>
<body>
    <?php  $user=$this->session->userdata('auth_admin');
        $name=$user['name'];
        $id=$user['id'];
        ?>
        <p id="userId"><?php echo $id?></p>

        <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!-- Sidebar - Brand -->
        <a
          class="sidebar-brand d-flex align-items-center"
          href="#"
        >
          <div class="sidebar-brand-text mx-3">Quiz App</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>User Dashboard</span></a
          >
        </li>

        <!-- Divider -->

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <div
            id="collapseTwo"
            class="collapse"
            aria-labelledby="headingTwo"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <a class="collapse-item" href="buttons.html">Buttons</a>
              <a class="collapse-item" href="cards.html">Cards</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <div
            id="collapseUtilities"
            class="collapse"
            aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Utilities:</h6>
              <a class="collapse-item" href="utilities-color.html">Colors</a>
              <a class="collapse-item" href="utilities-border.html">Borders</a>
              <a class="collapse-item" href="utilities-animation.html"
                >Animations</a
              >
              <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <div
            id="collapsePages"
            class="collapse"
            aria-labelledby="headingPages"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Login Screens:</h6>
              <a class="collapse-item" href="login.html">Login</a>
              <a class="collapse-item" href="register.html">Register</a>
              <a class="collapse-item" href="forgot-password.html"
                >Forgot Password</a
              >
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Other Pages:</h6>
              <a class="collapse-item" href="404.html">404 Page</a>
              <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
          </div>
        </li>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a
          >
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <!-- Sidebar Message -->
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav
            class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
          >
            <!-- Sidebar Toggle (Topbar) -->
            <button
              id="sidebarToggleTop"
              class="btn btn-link d-md-none rounded-circle mr-3"
            >
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form
              class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
            >
              <div class="input-group">
                <input
                  type="text"
                  class="form-control bg-light border-0 small"
                  placeholder="Search for..."
                  aria-label="Search"
                  aria-describedby="basic-addon2"
                />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="searchDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div
                  class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                  aria-labelledby="searchDropdown"
                >
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input
                        type="text"
                        class="form-control bg-light border-0 small"
                        placeholder="Search for..."
                        aria-label="Search"
                        aria-describedby="basic-addon2"
                      />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="userDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase"
                    ><?php echo $name?></span
                  >
                  <img
                    class="img-profile rounded-circle"
                    src="<?php echo base_url().'assets/admin_assets/img/undraw_profile.svg'?>"
                  />
                </a>
                <!-- Dropdown - User Information -->
                <div
                  class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="userDropdown"
                >
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                  </a>
                  <div class="dropdown-divider"></div>
                  <a
                    class="dropdown-item"
                    href="<?php echo base_url().'index.php/Admin/logout'?>"
                    data-toggle="modal"
                    data-target="#logoutModal"
                  >
                    <i
                      class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                    ></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
              <a
                href="#"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                ><i class="fas fa-download fa-sm text-white-50"></i> Generate
                Report</a
              >
            </div>

            <!-- Content Row -->
            <div class="row">
              <!--Total Time Taken Card-->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                        >
                          Total Time Taken
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <span id="total-time"></span><span> secs</span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Total Qns Card-->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-success text-uppercase mb-1"
                        >
                          Total Questions
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800 total-questions">
                          $215,000
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fa fa-question-circle fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Corrected/Attempted Card -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-info text-uppercase mb-1"
                        >
                          Correct / Attempted 
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col">
                          <span id="correct-questions"></span><span>/</span><span id="attempted-questions"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i
                          class="fas fa-clipboard-list fa-2x text-gray-300"
                        ></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!--  Total Percentage Card-->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                        >
                         Total Percentage
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <span class="total-percentage"></span><span> %</span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-percent fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Content Row -->

            <div class="row">
              <!-- Area Chart -->
              <div class="col-12">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      User Quiz Table
                    </h6>
                    <div class="dropdown no-arrow">
                      <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i
                          class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                        ></i>
                      </a>
                      <div
                        class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink"
                      >
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body table-responsive">
                    <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Questions</th>
                        <th scope="col">Selected Answers</th>
                        <th scope="col">Correct Answers</th>
                        <th scope="col">Time Taken</th>
                      </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- End of Main Content -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Select "Logout" below if you are ready to end your current session.
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
              Cancel
            </button>
            <a class="btn btn-primary" href="<?php echo base_url().'index.php/Admin/Logout'?>">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url().'assets/admin_assets/vendor/jquery/jquery.min.js'?>"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url().'assets/admin_assets/vendor/jquery-easing/jquery.easing.min.js'?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url().'assets/admin_assets/js/sb-admin-2.min.js'?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url().'assets/admin_assets/vendor/chart.js/Chart.min.js'?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url().'assets/admin_assets/js/demo/chart-area-demo.js'?>"></script>
    <script src="<?php echo base_url().'assets/admin_assets/js/demo/chart-pie-demo.js'?>"></script>

        <script>
            var id=$('#userId').text();
            // console.log(typeof(uid));
      
        $.ajax({
            url:'<?php echo base_url().'index.php/Admin/showUserResult/'?>'+id,
            type:'json',
            data:{},
            dataType: 'json',
            success: function(response) {
            var tableBody = $('#table-body');
            if(response){
            var data=response[0];
            $('#total-time').html(data.total_time_taken);
            const correctQuestions=data.correct_questions;
            const attemptedQuestions=data.attempted_questions;

            $('.total-questions').html(data.total_questions);
            $('#correct-questions').html(correctQuestions);
            $('#attempted-questions').html(attemptedQuestions);
            const c=parseInt(correctQuestions);
            const a=parseInt(attemptedQuestions);
            const percentage=(c/a)*100;
            console.log(percentage);

            $('.total-percentage').html(percentage);

            var optionsSelected = JSON.parse(data.options_selected);
            var correctAnswers = JSON.parse(data.correct_answers);
            var timeStorage = JSON.parse(data.time_storage);
            var questionsText = JSON.parse(data.questions_text);

            for (let i = 0; i < data.total_questions; i++) {
              var optionsSelected = JSON.parse(response[0].options_selected);
              var correctAnswers = JSON.parse(response[0].correct_answers);
              var timeStorage = JSON.parse(response[0].time_storage);
              var questionsText = JSON.parse(response[0].questions_text);
              console.log(correctAnswers, questionsText);

              var row = $('<tr>');
              var question = questionsText[i];
              var option = optionsSelected[i];
              var corrAns = correctAnswers[i];
              var time = timeStorage[i];

              var timeString = time + ' secs';

              if (option == corrAns && option != 0) {
                row.addClass('bg-success text-white');
              } else if (option != corrAns) {
                row.addClass('text-danger');
              } else {
                row.addClass('text-success');
              }
              if(question!=0){
              row.append($('<td>').text(i+1));
              row.append($('<td>').text(question));
              row.append($('<td>').text(option));
              row.append($('<td>').text(corrAns));
              row.append($('<td>').text(timeString));
              // tableBody.DataTable();
              tableBody.append(row);
              }
            }
            }
            },

            error:function(error){
                console.log(error);
            },

            complete:function(){
                console.log("request completed");
            }
        });
       
        </script>
</body>
</html>