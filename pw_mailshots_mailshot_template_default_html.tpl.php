<!-- header -->
<?php
/*
 *  AVAILABLE VARIABLES
 * 
 *    $site_name,
 *    $company_regno,
 *    $company_regloc,
 *    $company_vatno,
 *    $company_address1,
 *    $company_address2,
 *    $company_address3,
 *    $company_city,
 *    $company_county,
 *    $company_postcode,
 *    $company_country,
 *    $company_phone,
 *    $company_fax,
 *    $company_pager,
 *    $company_mobile,
 *    $company_phone2,
 */

/*  MAILSHOT REGIONS
 *  For guidance on defining mailshot regions, refer to mailshot-templates-readme.html in the pw_mailshots module 
 */

/*
 *  TABLE OF CONTENTS
 *  To enable automatically generated table of contents, add an element with an id of 'table-of-contents'.
 *  This element will be automatically populated
 */


/*
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!! IMPORTANT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * TRACKING TAGS
 *
 * There are several tags and variables in this page that are used for email tracking by strong mail.
 * These must not be removed
 * $open_tracking_tag : tracks number of times the email is opened
 * $unsubscribe_url : this contains a special url that included email tracking
 *     and allows a user to unsubscribe.
 *     It should be used where ever you wish to add an unsubscribe link
 * 
*/
?>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="#EFEFEF">
<?php global $base_root ?>
<div style="display:none"><?php print $open_tracking_tag ?></div>
<div id="email-template-container" style="background-color:#EFEFEF;">
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF">
<tr>
<td valign="top" align="center">
<!-- header -->
<table width="600" cellpadding="0" cellspacing="0">
    <tr class="mailshot-header-view-in-browser">
        <td style="text-align:center;padding:0;margin:0" align="center">
            <div style="font-size:10px;color:#686868;line-height:200%;font-family:Verdana;text-decoration:none;padding:10px 0 10px 0;margin:0">
                Having problems viewing this email? <a style="font-size:10px;line-height:150%;color:blue;" href='<?php print "/admin/mailshots/render_mailshot_template_and_content/$mailshot_nid/0" ?>'>View it in your browser</a>
            </div>
        </td>
    </tr>
    <tr class="mailshot-header-subscribed">
        <td style="text-align:center;padding:0;margin:0" align="center">
            <div style="font-size:10px;color:#686868;line-height:200%;font-family:Verdana;text-decoration:none;padding:0 0 10px 0;margin:0">
                You are receiving this email as you are a subscribed user on 
                <a style="font-size:10px;line-height:150%;color:blue;" href="/"><?php print $site_name ?></a> | 
                <a style="font-size:10px;line-height:150%;color:blue;" href="/contact">Contact us</a>
            </div>
        </td>
    </tr>
    <tr class="mailshot-header-logo">
        <td style="background-color:#FFFFFF;padding:25px 5px" align="center" valign="middle" bgcolor="white">
            <a href="/">
            <?php
            $default_theme = variable_get('theme_default', 'garland');
            $theme_path = drupal_get_path("theme","$default_theme"); 
            print "<img border=\"0\" src=\"$base_root/$theme_path/images/logo_mailshot.gif\" alt='$site_name' />"?>
            </a>
        </td>
    </tr>    
</table>   
<!-- content -->
<table width="600" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<!-- table of contents -->
    <tr>
        <td align="left" width="554" valign="top" style="background-color:#FFFFFF; padding:0 23px 0 23px; margin:0">
            <div style="font-size:12px;font-weight:normal;color:#4e4e4e;font-family:Verdana;line-height:150%;">
                <div style="border-bottom:double 3px #888888;color:#4e4e4e;border-top:double 3px #888888;font-size:13px;line-height:100%;margin:0 0 12px 0;padding:12px 0 12px 0;font-weight:bold;">
                    <?php print $subject_line ?>
                </div>
                <!-- Droppable region feature -->
                <div class='droppable mailshot-region' id='mailshot-region-content' style="margin:0;line-height:150%; min-height: 150px;">
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td align="left" width="554" valign="top" style="background-color:#FFFFFF; padding:0 23px 0 23px; margin:0">    
            <div style="border-bottom:double 3px #888888;font-size:10px;font-family:Verdana;line-height:100%;margin:0 0 5px 0;padding:0 0 12px 0;color:#4e4e4e;font-weight:bold;">
                Your Subscription
            </div>
            <div style="margin:10px 0;font-size:10px;font-weight:normal;color:#686868;font-family:Verdana;line-height:150%;">You may amend your subscription or email address by updating <a style="font-size:10px;line-height:150%;color:blue;" href='/user'>your profile</a>.
            Subscription options can be found by clicking "edit" and then "mailing lists"
            </div>
            <div style="margin:10px 0;font-size:10px;font-weight:normal;color:#686868;font-family:Verdana;line-height:150%;">
            Alternatively you may <a style="font-size:10px;line-height:150%;color:blue;" href="<?php print $unsubscribe_url ?>">unsubscribe</a> from all email.
            </div>

        </td>
    </tr>
    <tr>
        <td align="left" width="600" bgcolor="#FFFFFF" height="20"></td>
    </tr>    
</table>
<!-- footer -->
<table width="550" cellpadding="0" cellspacing="0">    
    <tr>
        <td align="left" width="50%" valign="top" style="font-size:10px;color:#686868;line-height:150%;font-family:Verdana;padding:10px 0">
            <strong>Copyright &copy; <?php print date('Y') . ' ' . $site_name ?></strong><br />
            <strong>All rights reserved.</strong><br />
            <?php if ($company_regno) {print "Company Registration No " . $company_regno . '<br />';} ?>
            <?php if ($company_regloc) {print "Registered in " . $company_regloc . '<br />';} ?>
            <?php if ($company_vatno) {print "VAT No " . $company_vatno;} ?>
        </td>
        <td width="50%" align="right" valign="top" style="font-size:10px;color:#686868;line-height:150%;font-family:Verdana;padding:10px 0">
            <strong><?php print $site_name ?></strong><br />
            <?php if ($company_address1) {print $company_address1 . '<br />';} ?>
            <?php if ($company_address2) {print $company_address2 . '<br />';} ?>
            <?php if ($company_address3) {print $company_address3 . '<br />';} ?>
            <?php if ($company_city) {print $company_city . '<br />';} ?>
            <?php if ($company_county) {print $company_county . '<br />';} ?>
            <?php if ($company_postcode) {print $company_postcode;} ?>
        </td>
    </tr>
</table>

</td>
</tr>
</table>
</div>
</body>
