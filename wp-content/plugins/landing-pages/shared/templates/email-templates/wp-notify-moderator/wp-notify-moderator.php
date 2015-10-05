<?php

$inbound_email_templates['wp-notify-moderator'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8" />
<style type="text/css">
  html {
    background: #EEEDED;
  }
</style>
</head>
<body style="margin: 0px; background-color: #FFFFFF; font-family: Helvetica, Arial, sans-serif; font-size:12px;" text="#444444" bgcolor="#FFFFFF" link="#21759B" alink="#21759B" vlink="#21759B" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">

<table cellpadding="0" width="600" bgcolor="#FFFFFF" cellspacing="0" border="0" align="center" style="width:100%!important;line-height:100%!important;border-collapse:collapse;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
  <tbody><tr>
    <td valign="top" height="20">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">
      <table cellpadding="0" bgcolor="#ffffff" cellspacing="0" border="0" align="center" style="border-collapse:collapse;width:600px;font-size:13px;line-height:20px;color:#545454;font-family:Arial,sans-serif;border-radius:3px;margin-top:0;margin-right:auto;margin-bottom:0;margin-left:auto">
  <tbody><tr>
    <td valign="top">
        <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate;width:100%;border-radius:3px 3px 0 0;font-size:1px;line-height:3px;height:3px;border-top-color:#0298e3;border-right-color:#0298e3;border-bottom-color:#0298e3;border-left-color:#0298e3;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-width:1px;border-right-width:1px;border-bottom-width:1px;border-left-width:1px">
          <tbody><tr>
            <td valign="top" style="font-family:Arial,sans-serif;background-color:#5ab8e7;border-top-width:1px;border-top-color:#8ccae9;border-top-style:solid" bgcolor="#5ab8e7">&nbsp;</td>
          </tr>
        </tbody></table>
      <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:separate;width:600px;border-radius:0 0 3px 3px;border-top-color:#8c8c8c;border-right-color:#8c8c8c;border-bottom-color:#8c8c8c;border-left-color:#8c8c8c;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-width:0;border-right-width:1px;border-bottom-width:1px;border-left-width:1px">
        <tbody><tr>
          <td valign="top" style="font-size:13px;line-height:20px;color:#545454;font-family:Arial,sans-serif;border-radius:0 0 3px 3px;padding-top:3px;padding-right:30px;padding-bottom:15px;padding-left:30px">

			<h1 style="margin-top:20px;margin-right:0;margin-bottom:20px;margin-left:0; font-size:28px; line-height: 28px; color:#000;">'. __( 'New Comment Waiting Moderation' , INBOUNDNOW_TEXT_DOMAIN ) .'</h1>
			<p style="margin-top:20px;margin-right:0;margin-bottom:20px;margin-left:0">'. __( '{{wp-user-displayname}},  There is a new comment for <a href="{{wp-post-url}}">{{wp-post-title}}</a>' , INBOUNDNOW_TEXT_DOMAIN ) .' awaiting your response.</p>

			<!-- NEW TABLE -->
			<table class="heavyTable" style="width: 100%;
				max-width: 600px;
				border-collapse: collapse;
				border: 1px solid #cccccc;
				background: white;
			   margin-bottom: 20px;">
			   <tbody>

				<tr style="border-bottom: 1px solid #cccccc;">
					<td width="600" style="border-right: 1px solid #cccccc; padding: 10px; padding-bottom: 5px;">
						<div style="padding-left:5px; display:inline-block; padding-bottom: 5px; font-size: 16px; color:#555;">
							<strong>{{wp-comment-author}} '. __( 'says:' , INBOUNDNOW_TEXT_DOMAIN ) .'</strong><br>
							{{wp-comment-content}} <br><br>

							<a href="{{wp-comment-url}}">'. __('Click here to reply' , 'leads') .'</a>
						</div>

					</td>
				</tr>



			   </tbody>
			 </table>
			 <!-- END NEW TABLE -->
			 <!-- Start 3 col moderator options -->
			<table style="margin-bottom: 20px; border: 1px solid #cccccc; border-collapse: collapse;" width="100%" border="1" BORDERWIDTH="1" BORDERCOLOR="CCCCCC" cellspacing="0" cellpadding="5" align="left" valign="top" borderspacing="0" >

			<tbody valign="top">
			 <tr valign="top" border="0">
				<td width="120" height="50" align="center" valign="top" border="0">
					<h3 style="color:#2e2e2e;font-size:15px;"><a style="text-decoration: none;" href="{{admin-url}}comment.php?action=approve&c={{wp-comment-id}}">'. __( 'Approve' , INBOUNDNOW_TEXT_DOMAIN ) .'</a></h3>
				</td>

				<td width="120" height="50" align="center" valign="top" border="0">
					<h3 style="color:#2e2e2e;font-size:15px;"><a style="text-decoration: none;" href="{{admin-url}}comment.php?action=trash&c={{wp-comment-id}}">'. __( 'Trash' , INBOUNDNOW_TEXT_DOMAIN ) .'</a></h3>
				</td>

				<td width="120" height="50" align="center" valign="top" border="0">
					<h3 style="color:#2e2e2e;font-size:15px;"><a style="text-decoration: none;" href="{{admin-url}}comment.php?action=delete&c={{wp-comment-id}}">'. __( 'Delete' , INBOUNDNOW_TEXT_DOMAIN ) .'</a></h3>
				</td>

				<td width="120" height="50" align="center" valign="top" border="0">
					<h3 style="color:#2e2e2e;font-size:15px;"><a style="text-decoration: none;" href="{{admin-url}}comment.php?action=spam&c={{wp-comment-id}}">'. __( 'Spam' , INBOUNDNOW_TEXT_DOMAIN ) .'</a></h3>
				</td>
			 </tr>
			</tbody></table>
			<!-- end 3 col -->
          </td>
        </tr>
      </tbody></table>
    </td>
  </tr>
</tbody>
</table>

	<table cellpadding="0" cellspacing="0" border="0" align="center" style="border-collapse:collapse;width:600px;font-size:13px;line-height:20px;color:#545454;font-family:Arial,sans-serif;margin-top:0;margin-right:auto;margin-bottom:0;margin-left:auto">
		<tbody>
		  <tr>
			<td valign="top" width="30" style="color:#272727">&nbsp;</td>
			<td valign="top" height="18" style="height:18px;color:#272727"></td>
			  <td style="color:#272727">&nbsp;</td>
			<td style="color:#545454;text-align:right" align="right">&nbsp;</td>
			<td valign="middle" width="30" style="color:#272727">&nbsp;</td>
		  </tr>
		  <tr>
			<td valign="top" height="6" style="color:#272727;line-height:1px">&nbsp;</td>
			<td style="color:#272727;line-height:1px">&nbsp;</td>
			  <td style="color:#272727;line-height:1px">&nbsp;</td>
			<td style="color:#545454;text-align:right;line-height:1px" align="right">&nbsp;</td>
			<td valign="middle" width="30" style="color:#272727;line-height:1px">&nbsp;</td>
		  </tr>
		</tbody>
	</table>

    <table cellpadding="0" cellspacing="0" border="0" align="center" style="border-collapse:collapse;width:600px">
        <tbody><tr>
          <td valign="top" style="color:#b1b1b1;font-size:11px;line-height:16px;font-family:Arial,sans-serif;text-align:center" align="center">
            <p style="margin-top:1em;margin-right:0;margin-bottom:1em;margin-left:0"></p>
          </td>
        </tr>
      </tbody>
	</table>
    </td>
  </tr>
  <tr>
    <td valign="top" height="20">&nbsp;</td>
  </tr>
</tbody>
</table>
</body>';