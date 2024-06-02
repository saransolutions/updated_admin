<?php
define("MAIN_TITLE", "Saran Solutions");
define("MAIN_LOGO_IMG", "logo.png");


define("HEAD_ADDRESS_LINE_1", "Wannersmattweg 10H, ");
define("HEAD_ADDRESS_LINE_2", "3250 Lyss.");
define("HEAD_ADDRESS_LINE_3", "saransolutions.ch");
define("HEAD_PHONE", "076 48 20 006");
define("HEAD_MOBILE", " ");
define("HEAD_WED_ADDRESS", "info@saransolutions.ch");
define("HEAD_LOGO", "");
define("HEAD_LOGO_STYLE", "float:right;");

define("FOOT_MSG", 'Rathusstr, 63,CH – 4410 LIESTAL, Tel: 061 272 23 01 Fax: 061 272 23 04 Mobile: 076 570 50 03
www.kayathri.ch info@kayathri.ch Credit Suisse IBAN: CH85 0483 5172 4580 6100 0');


define("PDF_FOOTER_SARAN_SOLUTIONS", '<div><p style="margin-left:70%;font-size: 8pt;">Developed By <font style="font-style:italic;text-decoration: underline;">www.saransolutions.in</font></p></div>');

#server
define("DB_NAME", "ch295301_saransol");
define("DB_USER", "ch295301_saransol");
define("DB_PASS", 'ch295301_saransol');


function checkUserLoggedIn(){
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    } elseif(isset($_GET['logoff']))
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: login.php');
    }
}



?>