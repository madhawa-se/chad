---------------------------------------------------------------------------------------
<?php
print $site_name . " Update \r\n";
?>
---------------------------------------------------------------------------------------

You can <a href="<?php print '/admin/mailshots/render_mailshot_template_and_content/' . $mailshot_nid . '/0' ?>">view this mailshot on our website</a>


You are receiving this email as you are a subscribed user on <?php print $site_name ?>


You can <a href="/contact">contact us</a> here


---------------------------------------------------------------------------------------
*** Editor's Comments ***

[[mailshot-region-comments]]
---------------------------------------------------------------------------------------
*** Feature Article ***

[[mailshot-region-feature]]
---------------------------------------------------------------------------------------
*** News Round-up ***

[[mailshot-region-roundup]]
---------------------------------------------------------------------------------------
*** Dates & Deadlines ***

<?php
    // embed a view into the template
    // obviously the view output will be dynamic meaning that what you see whilst creating content or preview may be different from what gets dispatched.
    $name = "dates_and_deadlines"; // The internal name of the view
    $display_id = "page_4"; // The display id i.e default, page,, page-2, block etc
    print views_embed_view($name, $display_id);  // any arguments after $name and $display_id will be passed to the view as arguments
?>
---------------------------------------------------------------------------------------
*** Website Highlights ***

[[mailshot-region-highlights]]
---------------------------------------------------------------------------------------


---------------------------------------------------------------------------------------
Your subscription
---------------------------------------------------------------------------------------


You may amend your subscription or email address by updating <a href="/user">your profile</a>.
Subscription options can be found by clicking "edit" and then "mailing lists"


Alternatively you may <a href="<?php print $unsubscribe_url ?>">unsubscribe</a> from all email.


Copyright all rights reserved <?php print date('Y') . ' ' . $site_name ?>


<?php

if ($company_regno) {print "Company Registration No " . $company_regno . "\r\n";}
if ($company_regloc) {print "Registered in " . $company_regloc . "\r\n";}
if ($company_vatno) {print "VAT No " . $company_vatno . "\r\n\r\n\r\n";}

if ($site_name) {print $site_name . "\r\n";}
if ($company_address1) {print $company_address1 . "\r\n";}
if ($company_address2) {print $company_address2 . "\r\n";}
if ($company_address3) {print $company_address3 . "\r\n";}
if ($company_city) {print $company_city . "\r\n";}
if ($company_county) {print $company_county . "\r\n";}
if ($company_postcode) {print $company_postcode . "\r\n";}
if ($company_country) {print $company_country . "\r\n";}

?>

