<?php
require_once 'includes/cons.php';
require_once 'includes/db.php';
require_once 'includes/page.php';
require_once 'includes/pdf_page.php';
require_once 'includes/customer/select.php';
require_once 'includes/customer/insert.php';
session_start();
checkUserLoggedIn();

$page = "customers";
$page_title = "Customer";
$profile = array();
$profile["page-title"] = $page_title;
$profile["add-new-form"] = '
    <!-- add new customer -->
    <div class="row justify-content-center">
    <div class="col-md-8 order-md-1">
        <form method="post" action="customers.php">
            <h4 class="mb-3">Customer Details</h4>
            '.row_with_two_cols("First Name *","Last Name *").'
            '.row_with_single_col("Address *").'
            '.row_with_two_cols("Ort *","Pin Code *").'
            '.row_with_two_cols("Mobile *","Email").'
            <h4 class="mb-3">Business Details</h4>
            '.row_with_single_col("Company Name *").'
            '.row_with_single_col("Service Type *").'
            <h4 class="mb-3">Product Details</h4>
            '.row_with_two_cols("Product Type *", "Website Name *").'
            '.row_with_two_cols("Supported Language *","Total Pages *").'
            '.row_with_two_cols("Media Support *","Domain Hosting *").'
            '.row_with_two_cols("Mail Support *","Mail Advertisement *").'
            '.row_with_two_cols("User Feedback *","Online Payment support *").'
            '.row_with_two_cols("SEO support *","Google Business support").'
            '.row_with_two_cols("Cookies support *","Google Check activation").'
            <h4 class="mb-3">Payment Details</h4>
            '.row_with_two_cols("Advance paid *", "Advance amount *").'
            '.row_with_two_cols("Total Price *", "Balance *").'
            '.row_with_two_cols("Delivery date *", "Warranty period *").'
            <button type="submit" name="add-new-customer-form" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
    <!-- add new customer end -->
    ';
$profile["edit-form"] = 'edit box';
$profile["remove-form"] = 'Remove box';
$profile["add-modal-id"] = 'add_new_modal';
$profile["edit-modal-id"] = 'edit_modal';
$profile["remove-modal-id"] = 'remove_modal';

if (isset($_POST["add-new-customer-form"])){
    insert_customer($_POST);
    header('Location: '.$page.'.php');
}elseif (isset($_GET["export_id"])){
    require_once __DIR__ . '/vendor/autoload.php';
    export($_GET["export_id"]);
    
    
}else{
    $profile["content"] = get_main_table(null);
    echo get_doc($profile);
}
?>