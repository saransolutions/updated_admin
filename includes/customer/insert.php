<?php 

function insert_customer($data){
    $first_name = $data["first_name"];
    $last_name = $data["last_name"];
    $address = $data["address"];
    $ort = $data["ort"];
    $pin_code = $data["pin_code"];
    $mobile = $data["mobile"];
    $email = $data["email"];

    $company_name = $data["company_name"];
    $service_type = $data["service_type"];
    $product_type = $data["product_type"];
    $website_name = $data["website_name"];
    $supported_language = $data["supported_language"];
    $total_pages = $data["total_pages"];

    $media_support = $data["media_support"];
    $domain_hosting = $data["domain_hosting"];
    $mail_support = $data["mail_support"];
    $mail_advertisement = $data["mail_advertisement"];
    $user_feedback = $data["user_feedback"];
    $seo_support = $data["seo_support"];

    $google_business_support = $data["google_business_support"];
    $cookies_support = $data["cookies_support"];
    $google_check_activation = $data["google_check_activation"];
    $advance_paid = $data["advance_paid"];

    $advance_amount = $data["advance_amount"];
    $total_price = $data["total_price"];
    $balance = $data["balance"];
    $delivery_date = $data["delivery_date"];
    $warranty_period = $data["warranty_period"];
    

    $sql="INSERT INTO customers(id, first_name, last_name, address, ort, pin_code, mobile, email, company_name, service_type, product_type, website_name, supported_language, total_pages, 
    media_support, domain_hosting, mail_support, mail_advertisement, user_feedback, seo_support,
    google_business_support, cookies_support, google_check_activation, advance_paid, advance_amount, total_price, balance, delivery_date, warranty_period, logo)
    VALUES (
        null,
        '".$first_name."',
        '".$last_name."',
        '".$address."',
        '".$ort."',
        '".$pin_code."',
        '".$mobile."',
        '".$email."',
        '".$company_name."',
        '".$service_type."',
        '".$product_type."',
        '".$website_name."',
        '".$supported_language."',
        '".$total_pages."',
        '".$media_support."',
        '".$domain_hosting."',
        '".$mail_support."',
        '".$mail_advertisement."',
        '".$user_feedback."','".$seo_support."',
        '".$google_business_support."','".$cookies_support."','".$google_check_activation."',
        '".$advance_paid."','".$advance_amount."','".$total_price."',
        '".$balance."','".$delivery_date."','".$warranty_period."', null)";
        executeSQL($sql);
        return getSingleValue("select max(id) from customers");
}

?>