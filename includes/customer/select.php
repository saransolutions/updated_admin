<?php
function get_main_table($data)
{
    $sql = "select * from customers";
    $part1 = '<table class="table table-bordered" cellspacing="0" width="100%" id="dataTable" cellspacing="0">
    <thead>
        <tr>
            <th class="w-auto p-1">S.No</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Ort</th>
            <th>Company</th>
            <th>Service</th>
            <th>Website</th>
            <th>Domain</th>
            <th>Advance</th>
            <th>Total</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        ';
    $data = '';
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
        $name = $result['first_name'] . ' ' . $result['last_name'];
        $ort = $result["ort"];
        $mobile = $result["mobile"];
        
        $company_name = $result["company_name"];
        $service_type = $result["service_type"];
        $website_name = $result["website_name"];
        $domain_hosting = $result["domain_hosting"];
        $advance_amount = $result["advance_amount"];
        $total_price = $result["total_price"];
        $balance = $result["balance"];
        $data = $data . '<tr>
            <td class="w-auto p-1"><input type="checkbox" class="btn-check" name="edit_id" value="' . $id . '" autocomplete="off"></td>
			<td>' . $name . '</td>
            <td>' . $mobile . '</td>
            <td>' . $ort . '</td>
            <td>' . $company_name . '</td>
            <td>' . $service_type . '</td>
            <td>' . $website_name . '</td>
            <td>' . $domain_hosting . '</td>
            <td>' . $advance_amount . '</td>
            <td>' . $total_price . '</td>
            <td>' . $balance . '</td>
		</tr>';
    }

    $part3 = '
    </tbody>
</table>';
    return $part1 . $data . $part3;
}

function get_edit_form($id)
{
    $sql = "select * from customers where id = ".$id;
    $data = '';
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
        $name = $result['first_name'] . ' ' . $result['last_name'];
        $address = $result["address"];
        $ort = $result["ort"];
        $pin_code = $result["pin_code"];
        $mobile = $result["mobile"];
        $email = $result["email"];

        $company_name = $result["company_name"];
        $service_type = $result["service_type"];
        $product_type = $result["product_type"];
        $website_name = $result["website_name"];
        $supported_language = $result["supported_language"];
        $total_pages = $result["total_pages"];

        $media_support = $result["media_support"];
        $domain_hosting = $result["domain_hosting"];
        $mail_support = $result["mail_support"];
        $mail_advertisement = $result["mail_advertisement"];
        $user_feedback = $result["user_feedback"];
        $seo_support = $result["seo_support"];

        $google_business_support = $result["google_business_support"];
        $cookies_support = $result["cookies_support"];
        $google_check_activation = $result["google_check_activation"];
        $advance_paid = $result["advance_paid"];

        $advance_amount = $result["advance_amount"];
        $total_price = $result["total_price"];
        $balance = $result["balance"];
        $delivery_date = $result["delivery_date"];
        $warranty_period = $result["warranty_period"];
        $data = '
    <!-- add new customer -->
    <div class="row justify-content-center">
    <div class="col-md-8 order-md-1">
        <form method="post" action="customers.php">
            <h4 class="mb-3">Customer Details</h4>
            '.row_with_two_cols("First Name *","Last Name *", $result['first_name'], $result['last_name']).'
            '.row_with_single_col("Address *", $address).'
            '.row_with_two_cols("Ort *","Pin Code *", $ort, $pin_code).'
            '.row_with_two_cols("Mobile *","Email", $mobile, $email).'
            <h4 class="mb-3">Business Details</h4>
            '.row_with_single_col("Company Name *", $company_name).'
            '.row_with_single_col("Service Type *", $service_type).'
            <h4 class="mb-3">Product Details</h4>
            '.row_with_two_cols("Product Type *", "Website Name *", $product_type, $website_name).'
            '.row_with_two_cols("Supported Language *","Total Pages *", $supported_language, $total_pages).'
            '.row_with_two_cols("Media Support *","Domain Hosting *", $media_support, $domain_hosting).'
            '.row_with_two_cols("Mail Support *","Mail Advertisement *", $mail_support, $mail_advertisement).'
            '.row_with_two_cols("User Feedback *","Online Payment support *", $user_feedback, null).'
            '.row_with_two_cols("SEO support *","Google Business support", $seo_support, $google_business_support).'
            '.row_with_two_cols("Cookies support *","Google Check activation", $cookies_support, $google_check_activation).'
            <h4 class="mb-3">Payment Details</h4>
            '.row_with_two_cols("Advance paid *", "Advance amount *", $advance_paid, $advance_amount).'
            '.row_with_two_cols("Total Price *", "Balance *", $total_price, $balance).'
            '.row_with_two_cols("Delivery date *", "Warranty period *", $delivery_date, $warranty_period).'
            <button type="submit" name="add-new-customer-form" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
    <!-- add new customer end -->
    ';
    }
    
    return $data;
}

function export($id)
{
    $sql = "select * from customers where id=" . $id;
    $rows = getFetchArray($sql);
    $data = '';
    if (count($rows) > 0) {
        $result = $rows[0];
        $delivery_date = $result["delivery_date"];
        if ($delivery_date == null){
            return null;
        }
        $part1 = pdf_head() . '
        <body>
        ' . pdf_block($id) . '
        <div style="text-align: right">Date: ' . date('F j, Y', strtotime($delivery_date)) . '</div>
        <br />
        <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">';

        $id = $result['id'];
        $name = $result['first_name'] . ' ' . $result['last_name'];
        $address = $result["address"];
        $ort = $result["ort"];
        $pin_code = $result["pin_code"];
        $mobile = $result["mobile"];
        $email = $result["email"];

        $company_name = $result["company_name"];
        $service_type = $result["service_type"];
        $product_type = $result["product_type"];
        $website_name = $result["website_name"];
        $supported_language = $result["supported_language"];
        $total_pages = $result["total_pages"];

        $media_support = $result["media_support"];
        $domain_hosting = $result["domain_hosting"];
        $mail_support = $result["mail_support"];
        $mail_advertisement = $result["mail_advertisement"];
        $user_feedback = $result["user_feedback"];
        $seo_support = $result["seo_support"];

        $google_business_support = $result["google_business_support"];
        $cookies_support = $result["cookies_support"];
        $google_check_activation = $result["google_check_activation"];
        $advance_paid = $result["advance_paid"];

        $advance_amount = $result["advance_amount"];
        $total_price = $result["total_price"];
        $balance = $result["balance"];

        $warranty_period = $result["warranty_period"];

        $data .= pdf_table_tr_th_td_span("<h3>Personal Details</h3>");
        $data .= pdf_table_tr_th_td("Name", $name);
        $data .= pdf_table_tr_th_td("Address", $address);
        $data .= pdf_table_tr_th_td("Ort", $ort);
        $data .= pdf_table_tr_th_td("Pin Code", $pin_code);
        $data .= pdf_table_tr_th_td("Mobile", $mobile);
        $data .= pdf_table_tr_th_td("E-Mail", $email);

        $data .= pdf_table_tr_th_td_span("<h3>Company Details</h3>");
        $data .= pdf_table_tr_th_td("Company Name", $company_name);
        $data .= pdf_table_tr_th_td("Service Type", $service_type);
        $data .= pdf_table_tr_th_td("Website Name", '<a style="color:black" href="http://www.' . $website_name . '" target="_blank">' . $website_name . '</a>');
        $data .= pdf_table_tr_th_td("Supported Languages", $supported_language);
        $data .= pdf_table_tr_th_td("Total pages", $total_pages);

        $data .= pdf_table_tr_th_td_span("<h3>Product Details</h3>");
        $data .= pdf_table_tr_th_td("Product Type", $product_type);
        $data .= pdf_table_tr_th_td("Domain & Hosting", $domain_hosting);

        $data .= pdf_table_tr_th_td("Media Support", $media_support);
        $data .= pdf_table_tr_th_td("Mail Support", $mail_support);
        $data .= pdf_table_tr_th_td("Mail Advertisement", $mail_advertisement);
        $data .= pdf_table_tr_th_td("User Feedback", $user_feedback);
        $data .= pdf_table_tr_th_td("SEO support", $seo_support);
        $data .= pdf_table_tr_th_td("Cookies support", $cookies_support);
        $data .= pdf_table_tr_th_td_span("<h3>Payment Details</h3>");

        $data .= pdf_table_tr_th_td("Advance paid", $advance_paid);
        $data .= pdf_table_tr_th_td("Advance amount ", $advance_amount);
        $data .= pdf_table_tr_th_td("Total Price", $total_price);
        $data .= pdf_table_tr_th_td("Balance", $balance);
        $data .= pdf_table_tr_th_td("Warranty period", $warranty_period);
        $data .= pdf_table_tr_th_td("Delivery date", $delivery_date);
        $part2 = '</tbody>
        </table>';
        if ($balance == 0){
            $part2 .= '<div style="text-align: center; font-style: italic;">Payment fully paid</div>';
        }else{
            $part2 .= generate_bill($id, $name, $address, $balance);
        }
        $part2 .= '</body></html>';
        $content = $part1 . $data . $part2;

        // Create an instance of the class:
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 48,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);

        $mpdf->SetProtection(array('print'));
        $mpdf->SetAuthor(MAIN_TITLE);
        if ($balance == 0){
            $mpdf->SetWatermarkText("Paid");
        }else{
            $mpdf->SetWatermarkText("Unpaid");
        }
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($content);
        $file_name = 'SS-00'.$id.'_'.str_replace(' ', '_', $name).'.pdf';
        $mpdf->Output($file_name, "I");
    }
}


function generate_bill($id, $name, $address, $balance){
    return 
'   <br>
<div style="text-align: center; font-style: italic;">Pay the due amount in 30 days</div>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8"><tbody>
    <tr>
        <td width="30%">
            <h2>Empfangsschein</h2>
            <br>
            <h4>Konto / Zahlbar an</h4>
            <h5>CH61 0630 0506 2712 5784 0</h5>
            <p>Saran Solutions</p>
            <p>Wannersmattweg 10H</p>
            <p>3250 Lyss</p>
            <br>
            <p>Referencez</p>
            <p>SS-00'.$id.'</p>
            <br>
            Zahlbar durch<br>
            '.$name.'
            <br>
            '.$address.'
            <br>
            <br>
            <h4>CHF '.$balance.'</h4>
        </td>
        <td width="35%" style="border:0">
            <h2>Zahlteil</h2>
            <br>
            <img src="bills/pay_1.png">
            <br>    
            <h4>Währung CHF </h4>
            <h4>Betrag '.$balance.'</h4>
            <br>
        </td>
        <td width="35%" style="border:0">
            <h4>Konto / Zahlbar an</h4>
            <h5>CH61 0630 0506 2712 5784 0</h5>
            <p>Saran Solutions</p>
            <p>Wannersmattweg 10H</p>
            <p>3250 Lyss</p>
            <br>
            Zusätzliche Informationen
            <br>
            Rechnungskonto: SS-00'.$id.' <br>
            Monat: 01.03.24 - 31.03.24 <br>
            Zahlbar bis: 09.05.2024 <br>
            
            <br>
            <p>Referencez</p>
            <p>SS-00'.$id.'</p>
            <br>
            Zahlbar durch<br>
            '.$name.'
            <br>
            '.$address.'
            <br>
        </td>
        </tr>
    </tbody>
</table>';
}
?>