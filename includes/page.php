<?php


function get_scroll_to_top(){
    return '
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    ';
}

function get_logout_modal(){
    return '
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index.php?logoff">Logout</a>
                </div>
            </div>
        </div>
    </div>
    ';
}

function get_footer_js_scripts(){
    return '
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    ';
}

function show_modal($button_name, $page_title, $button_body, $id){
    $result = '
    <!-- '.$button_name.' Modal -->
    <div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog" aria-labelledby="'.$id.'Label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="'.$id.'Label">'.$button_name.' '.$page_title.'</h5>
    ';
    
    $result .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body" id="'.$button_body.'"></div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- End of '.$button_name.' Modal -->';
    return $result;
}

function get_default_modal_targets($profile){
    return show_modal("Add New",$profile["page-title"],$profile["add-new-form"], $profile["add-modal-id"]).
    show_modal("Edit",$profile["page-title"],$profile["edit-modal-body"], $profile["edit-modal-id"]).
    show_modal("Pay",$profile["page-title"],$profile["pay-modal-body"], $profile["pay-modal-id"]).
    show_modal("Remove",$profile["page-title"],$profile["remove-modal-body"], $profile["remove-modal-id"]);
}

function get_meta(){
    return '
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">';
}

function get_links(){
    return '<!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">';
}

function get_head($profile)
{
    return '
    <head>
        '.get_meta().'
        <title>' . MAIN_TITLE . ' - '.$profile['page-title'].'</title>
        '.get_links().'
        '.js_custom().'
    </head>
    ';
}

function js_custom(){
    return '
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#pay_button,#edit_button,#remove_button,#export_button,#invoice_button").click(function(){
                var count = $("input:checkbox:checked").length
                if (count == 0) {
                    alert("select at least \"one\" checkbox")
                    return false
                }else if (count > 1){
                    alert("Not select more than \"one\" checkbox")
                    return false
                }else{
                    var value = $("input:checkbox:checked").val();
                    var button_name = $(this).attr("name")
                    if (button_name == "export"){
                        var win = window.open("customers.php?export_id="+value+"", "_blank");
                        if (win) {
                            win.focus();
                        } else {
                            alert("Please allow popups for this website");
                        }
                    }
                    if (button_name == "invoice"){
                        var win = window.open("customers.php?invoice_id="+value+"", "_blank");
                        if (win) {
                            win.focus();
                        } else {
                            alert("Please allow popups for this website");
                        }
                    }
                    if (button_name == "edit"){
                        $.ajax({
                            type: "GET",
                            url: "customers.php",
                            data: {"edit_id": value},
                            success: function(data){
                                $("#edit_body").html(data);
                            }
                        });
                    }
                    if (button_name == "pay"){
                        $.ajax({
                            type: "GET",
                            url: "customers.php",
                            data: {"pay_id": value},
                            success: function(data){
                                $("#pay_body").html(data);
                            }
                        });
                    }
                    if (button_name == "remove"){
                        $.ajax({
                            type: "GET",
                            url: "customers.php",
                            data: {"remove_id": value},
                            success: function(data){
                                $("#remove_body").html(data);
                            }
                        });
                    }
                }
            });
        });
    </script>
    ';
}

function get_topbar()
{
    return '
    <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <form class="form-inline">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
            </form>

            <!-- Topbar Search -->
            <form
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2">
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
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: Weve noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                    alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                    problem Ive been having.</div>
                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                    alt="...">
                                <div class="status-indicator"></div>
                            </div>
                            <div>
                                <div class="text-truncate">I have the photos that you ordered last month, how
                                    would you like them sent to you?</div>
                                <div class="small text-gray-500">Jae Chun · 1d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                    alt="...">
                                <div class="status-indicator bg-warning"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Last months report looks great, I am very happy with
                                    the progress so far, keep up the good work!</div>
                                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                    alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                    told me that people say this to all dogs, even if they arent good...</div>
                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">' . $_SESSION['user'] . '</span>
                        <img class="img-profile rounded-circle"
                            src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
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
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->';
}

function get_main_content($profile)
{
    $topbar = get_topbar();
    return '
    <!-- Main Content -->
    <div id="content">
        ' . $topbar . '
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">' . $profile['page-title'] . '</h1>
            <!-- Default Action buttons -->
            <div class="d-flex justify-content-between">
                <div>
                    <!--free left space-->
                </div>
                <div>
                    <button type="button" class="btn btn-success btn-sm"
                        name="add_new" data-toggle="modal"
                        data-target="#add_new_modal">
                            Add New
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" name="edit" id="edit_button" data-toggle="modal" data-target="#edit_modal">Edit</button>
                    <button type="button" class="btn btn-dark btn-sm" name="pay" id="pay_button" data-toggle="modal" data-target="#pay_modal">Pay</button>
                    <button type="button"  class="btn btn-danger btn-sm" name="remove" id="remove_button" data-toggle="modal" data-target="#remove_modal">Remove</button>
                    <button type="button" class="btn btn-primary btn-sm" name="export" id="export_button">Export</button>
                    <button type="button" class="btn btn-warning btn-sm" name="invoice" id="invoice_button">Invoice</button>
                    <button type="button" class="btn btn-info btn-sm" name="reports">Reports</button>
                </div>
            </div>
            <!-- End Action buttons -->
            <!-- DataTables Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">' . $profile['page-title'] . '</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        ' . $profile['content'] . '
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    ';
}

function get_wrapper($profile)
{
    $modal_targets = get_default_modal_targets($profile);
    $sidebar = get_sidebar();
    $main_content = get_main_content($profile);
    return '
    <!-- Page Wrapper -->
    <div id="wrapper">
    ' . $sidebar . '
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            ' . $main_content . '
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; ' . MAIN_TITLE . ' 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
            
            '.$modal_targets.'

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    ';
}

function get_body($profile)
{
    $wrapper = get_wrapper($profile);
    $scroll_top = get_scroll_to_top();
    $logout_modal = get_logout_modal();
    $scripts = get_footer_js_scripts();
    return '
    <body id="page-top">
    ' . $wrapper . '
    ' . $scroll_top . '
    ' . $logout_modal . '
    ' . $scripts . '
    </body>';
}

function get_sidebar()
{
    return '
    <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <img src="img/logo.png" alt="test" style="width:200px;background-color:#fff2e6"></img>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
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
                    <span>Charts</span></a>
            </li>
            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
    ';
}

function get_attr_name($display_name){
    $attr = str_replace(' *', '', strtolower($display_name));
    $attr = preg_replace('/\s+/', '_', $attr);
    return $attr;
}

function input_text_single_col($display_name, $class_name, $value, $is_readonly){
    $result = '';
    $attr = get_attr_name($display_name);
    $result .= '
    <div class="'.$class_name.'">';
    $result .= '<label for="'.$attr.'">'.$display_name.'</label>';
    if (strpos($display_name, '*') !== false){
        $result .= '<input type="text" '.$is_readonly.' class="form-control" id="'.$attr.'" name="'.$attr.'" placeholder="" value="'.$value.'" required="">';
    }else{
        $result .= '<input type="text" '.$is_readonly.' class="form-control" id="'.$attr.'" name="'.$attr.'" placeholder="" value="'.$value.'">';
    }
    $result .= '<div class="invalid-feedback">';
    $result .= 'Invalid '.$display_name.'';
    $result .= '</div>';
    $result .= '</div>
    ';
    return $result;
}

function show_single_col($display_name, $class_name, $value){
    $result = '';
    $attr = get_attr_name($display_name);
    $result .= '
    <div class="'.$class_name.'">';
    $result .= '<label for="'.$attr.'">'.$display_name.'</label>';
    $result .= $value;
    $result .= '<div class="invalid-feedback">';
    $result .= 'Invalid '.$display_name.'';
    $result .= '</div>';
    $result .= '</div>
    ';
    return $result;
}

function row_with_two_cols($col1, $col2, $val1, $val2, $ro_col1, $ro_col2){
    
    $result = '
    <!-- add_single_row_with_two_cols --!>';
    $result .= '<div class="row">';
    $result .= input_text_single_col($col1, "col-md-6 mb-3", $val1, $ro_col1);
    $result .= input_text_single_col($col2, "col-md-6 mb-3", $val2, $ro_col2);
    $result .= '</div>';
    $result .= '
    <!-- add_single_row_with_two_cols --!>';
    return $result;
}

function row_with_single_col($display_name, $val1, $ro_col1){
    $result = '
    <!-- add_single_row_with_single_col --!>';
    $result = input_text_single_col($display_name, "mb-3", $val1, $ro_col1);
    $result .= '<!-- add_single_row_with_single_col --!>
    ';
    return $result;
}

function get_doc($profile)
{
    if ($profile["page"] == "login"){
        return login($profile);
    }else{
        $head = get_head($profile);
        $body = get_body($profile);
        return '
            <!DOCTYPE html>
            <html lang="en">
                ' . $head . '
                ' . $body . '
            </html>';
    }
}
?>