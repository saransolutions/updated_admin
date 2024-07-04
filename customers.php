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
$profile["page"] = $page;
$profile["view"] = "main";
$profile["add-new-form"] = '
    <!-- add new customer -->
    <div class="row justify-content-center">
    <div class="col-md-8 order-md-1">
        <form method="post" action="customers.php">
            <h4 class="mb-3">Customer Details</h4>
            '.row_with_two_cols("First Name *","Last Name *", null, null, '', '').'
            '.row_with_single_col("Address *", null, '').'
            '.row_with_two_cols("Ort *","Pin Code *", null, null, '', '').'
            '.row_with_two_cols("Mobile *","Email", null, null, '', '').'
            <h4 class="mb-3">Business Details</h4>
            '.row_with_single_col("Company Name *", null, null, '', '').'
            '.row_with_single_col("Service Type *", null, null, '', '').'
            <h4 class="mb-3">Product Details</h4>
            '.row_with_two_cols("Product Type *", "Website Name *", null, null, '', '').'
            '.row_with_two_cols("Supported Language *","Total Pages *", null, null, '', '').'
            '.row_with_two_cols("Media Support ","Domain Hosting *", null, null, '', '').'
            '.row_with_two_cols("Mail Support ","Mail Advertisement", null, null, '', '').'
            '.row_with_single_col("User Feedback ", null, '', '').'
            '.row_with_two_cols("SEO support","Google Business support", null, null, '', '').'
            '.row_with_two_cols("Cookies support","Google Check activation", null, null, '', '').'
            <h4 class="mb-3">Payment Details</h4>
            '.row_with_two_cols("Advance paid *", "Advance amount *", null, null, '', '').'
            '.row_with_two_cols("Total Price *", "Balance *", null, null, '', '').'
            '.row_with_two_cols("Delivery date *", "Warranty period *", null, null, '', '').'
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
$profile["edit-modal-body"] = 'edit_body';
$profile["pay-modal-id"] = 'pay_modal';
$profile["pay-modal-body"] = 'pay_body';
$profile["remove-modal-id"] = 'remove_modal';
$profile["remove-modal-body"] = 'remove_body';
$profile["view-single-buttons"] = '<button type="button" class="btn btn-success btn-sm" name="add_new" data-toggle="modal"
                            data-target="#add_new_modal">
                            Add New
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" name="edit" id="edit_button"
                            data-toggle="modal" data-target="#edit_modal">Edit</button>
                        <button type="button" class="btn btn-dark btn-sm" name="pay" id="pay_button" data-toggle="modal"
                            data-target="#pay_modal">Pay</button>
                        <button type="button" class="btn btn-danger btn-sm" name="remove" id="remove_button"
                            data-toggle="modal" data-target="#remove_modal">Remove</button>
                        <button type="button" class="btn btn-primary btn-sm" name="export"
                            id="export_button">Export</button>
                        <button type="button" class="btn btn-warning btn-sm" name="invoice"
                            id="invoice_button">Invoice</button>
                        <button type="button" class="btn btn-info btn-sm" name="reports">Reports</button>';
if (isset($_POST["add-new-customer-form"])){
    insert_customer($_POST);
    header('Location: '.$page.'.php');
}elseif (isset($_GET["export_id"])){
    require_once __DIR__ . '/vendor/autoload.php';
    export($_GET["export_id"]);
}elseif (isset($_GET["invoice_id"])){
    require_once __DIR__ . '/vendor/autoload.php';
    invoice($_GET["invoice_id"]);
}elseif (isset($_GET["edit_id"])){
    echo get_edit_form($_GET["edit_id"]);
}elseif (isset($_GET["pay_id"])){
    echo get_pay_form($_GET["pay_id"]);
}elseif (isset($_GET["remove_id"])){
    echo get_remove_form($_GET["remove_id"]);
}
elseif (isset($_POST["update-customer-form"])){
    update_customer($_POST);
    header('Location: '.$page.'.php');
}
elseif (isset($_POST["pay-customer-form"])){
    pay_customer($_POST);
    header('Location: '.$page.'.php');
}
elseif (isset($_POST["remove-customer-form"])){
    remove_customer($_POST);
    header('Location: '.$page.'.php');
}elseif (isset($_GET["cid"])){
    $profile["content"] = get_single_customer($_GET["cid"]);
    $profile["view"] = "single";
    echo get_doc($profile);
}
else{
    $profile["content"] = get_main_table(null);
    echo get_doc($profile);
}
?>