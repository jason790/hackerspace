<?php 
//session_set_cookie_params ( 0 , '/', '.elooi.com');
session_start(); 
ob_start(); 
header('Content-Type: text/html; charset=UTF-8');

//--------- LOGIN
$site_url = "hackspace.tw";
$site_url = "localhost/hackspace";

if (empty($_SESSION['login_backoffice'])) { $_SESSION['login_backoffice'] = "no"; }

$user_name              = $_POST["login_user_name"];
$password               = $_POST["login_password"];

if (($user_name=="admin") && ($password=="admin")) { $_SESSION['login_backoffice'] = "ok"; }





if (empty($_SESSION['Lang'])) { $_SESSION['Lang']="chinese"; }

if (($_GET["lang"]=="chinese") || ($_SESSION['Lang']=="chinese"))
{
	$_SESSION['Lang']="chinese";
	require_once("lang-tw.php"); 
}

if (($_GET["lang"]=="english") || ($_SESSION['Lang']=="english")) 
{	
	$_SESSION['Lang']="english";
	require_once("lang-en.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $Trans_Title."---".$_SESSION['login_backoffice']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Ekim Emre Yardımlı">

	 <link href="assets/css/bootstrap.min.css" rel="stylesheet"> 
	
	<link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="scripts/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="jqwidgets/globalization/jquery.global.js"></script> 

    <script type="text/javascript" src="jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdata.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxgrid.sort.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxgrid.pager.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxgrid.edit.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxgrid.filter.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxgrid.columnsresize.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqxgrid.columnsreorder.js"></script> 

    <script type="text/javascript" src="jqwidgets/jqxnumberinput.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxwindow.js"></script>
	
    <script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdropdownlist.js"></script>
	
	<script type="text/javascript" src="jqwidgets/jqxdatetimeinput.js"></script> 
	<script type="text/javascript" src="jqwidgets/jqxcalendar.js"></script> 

    <script type="text/javascript" src="jqwidgets/jqxtabs.js"></script>


    <script type="text/javascript" src="scripts/gettheme.js"></script>
	
    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript" src="js/members.js"></script>
    <script type="text/javascript" src="js/events.js"></script>
    <script type="text/javascript" src="js/inventory.js"></script>
    <script type="text/javascript" src="js/financial.js"></script>
	
	
    <style type="text/css">
		body {
				padding-top: 60px;
				padding-bottom: 40px;
		  font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;
		  font-size: 12px;

		  background: #EEE url("bg_main_dark.jpg");
		  
/* login */

.login { background: #4f4f4f; margin: 0; padding: 0; font: normal 0.75em/1.3em arial, sans-serif}
.login .pos { border: 0 solid #222; width: 700px; height: 340px; position: absolute; left: 50%; top: 50%; margin-left:-350px; margin-top:-200px}
.login .pos { background: url(back.png) no-repeat}
.login .in { padding: 140px 40px 20px 0; color: #000}
.login img { margin-top: 15px} 
.login.new .left, .login.ref .left, .login .header { display: none} 

/* --- user/pass login block */

.login .exist { margin-top: 60px; text-align: left !important; height: 100px; position: relative; left: 170px; width: 500px}
.login .exist div { position: absolute; color: #666}
.login .exist .userlbl { top: 0; left: 0; color: #999}
.login .exist .passlbl { top: 0; left: 140px; color: #999}
.login .exist .userbox { top: 22px; left: 0}
.login .exist .passbox { top: 22px; left: 140px}
.submit_btn { top: 12px; left: 275px; _top: 8px}
.login .exist .userbox input { width: 120px; padding: 3px; border: 1px solid #ccc; color: #777; line-height: 1; font-size: 1.1em}
.login .exist .passbox input { width: 120px; padding: 3px; border: 1px solid #ccc; color: #b00; line-height: 1; font-size: 10pt}
.submit_btn { color: #fff; background: url(button.gif) top left repeat-x; padding: 2px 6px 3px; border: 1px solid #666; margin-top: 14px; _padding-top: 1px; _border: 0; font-weight: bold; font-size: 10pt}
.login .exist .remchk { top: 66px; left: 0; _top: 58px; _left: -3px}
.login .exist .remlbl { top: 68px; left: 21px;  _top: 60px; _left: 20px}
.login .exist .trouble { top: 68px; left: 141px; _top: 58px}

.login .footer { margin-top: 22px; _margin-top: 28px; margin-left: 270px; text-align: left !important; width: 340px} 
.login .error { font-weight: bold; background: #d03a00; color: #fff; padding: 18px; font-size: 22px; width: 100%} 
		  
		}
	</style>


    <script type="text/javascript">
    </script>
</head>
<body class='default'>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#"><?php echo $Trans_Title2; ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#"><?php echo $Trans_Home; ?></a></li>
              <li><a href="#about"><?php echo $Trans_About; ?></a></li>
              <li><a href="#about"><?php echo $Trans_Events; ?></a></li>
              <!--<li><a href="#contact"><?php echo $Trans_Contact; ?></a></li>-->
			  
			  <li><a href="?lang=chinese">中文</a></li>
			  <li><a href="?lang=english">English</a></li>
            </ul>
            <form class="navbar-form pull-right" method="post">
              <input id="login_user_name" name="login_user_name" class="span2" type="text" placeholder="<?php echo $Trans_Email; ?>" style="width:100px; height:30px">
              <input id="login_password" name="login_password" class="span2" type="password" placeholder="<?php echo $Trans_Password; ?>" style="width:100px; height:30px">
              <button type="submit" class="btn"><?php echo $Trans_Sign_in; ?></button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
	
	<div class="container">
<?php
if ($_SESSION['login_backoffice'] == "ok") 
{
?>
        <div id='jqxTabs'>
            <ul>
                <li style="margin-left: 30px;"><?php echo $Trans_Member; ?></li>
                <li><?php echo $Trans_Events; ?></li>
                <li><?php echo $Trans_Inventory; ?></li>
                <li><?php echo $Trans_Financials; ?></li>
                <li><?php echo $Trans_Settings; ?></li>
            </ul>
			<!-- 
			------------------------------------------ Member
			-->
            <div>
				<div style=" width:660px; display:inline-block; vertical-align:top">
					<div style="margin-top:10px; margin-left:10px;" id="Member_Grid"></div>
					<div style="margin-left: 10px; margin-top:10px">
						<div style="display:inline-block"><input class="btn btn-primary" id="Member_AddRow" type="button" value="  <?php echo $Trans_NewMember; ?>  " /></div>
						<div style="display:inline-block"><input class="btn" id="Member_DeleteRow" type="button" value="  <?php echo $Trans_Delete; ?>  " /></div>
					</div>
				</div>
				
				<div id="Member_PopupWindow">
					<div><?php echo $Trans_EditMember; ?></div>
					<div style="overflow: hidden; padding:5px">
						<table cellpadding=2 cellspacing=2>
							<tr>
								<td align="right"><?php echo $Trans_JoinDate; ?>:</td>
								<td align="left"><div id="JoinDate"></div></td>
							</tr>
							
							<tr>
								<td align="right"><?php echo $Trans_Memberhip; ?>:</td>
								<td align="left"><div type="text" id="MemberType"></div></td>
							</tr>
							
							<tr>
								<td align="right"><?php echo $Trans_FirstName; ?>:</td>
								<td align="left"><input type="text" id="FirstName" /></td>
							</tr>
							
							<tr>
								<td align="right"><?php echo $Trans_LastName; ?>:</td>
								<td align="left"><input type="text" id="LastName" /></td>
							</tr>
							
							<tr>
								<td align="right"><?php echo $Trans_Email; ?>:</td>
								<td align="left"><input type="text" id="Email" /></td>
							</tr>
							
							<tr>
								<td align="right"><?php echo $Trans_Phone; ?>:</td>
								<td align="left"><input type="text" id="Phone" /></td>
							</tr>

							<tr>
								<td align="right" style="vertical-align:top"><?php echo $Trans_Notes; ?>:</td>
								<td align="left"><textarea id="Notes" /></textarea></td>
							</tr>

							<tr>
								<td align="right" style="vertical-align:top"><?php echo $Trans_Active; ?>:</td>
								<td align="left"><div id="ActiveCheck"></div></td>
							</tr>
							
							<tr>
								<td align="right"></td>
								<td style="padding-top: 10px;" align="right">
								<input style="margin-right: 5px;" type="button" class="btn btn-primary" id="Member_Save" value="<?php echo $Trans_Save; ?>" />
								<input class="btn" id="Member_Cancel" type="button" value="<?php echo $Trans_Cancel; ?>" /></td>
							</tr>
						</table>
					</div>
			   </div>				
            </div>
			<!-- 
			------------------------------------------ EVENTS
			-->
            <div>
				<div style=" width:660px; display:inline-block; vertical-align:top">
					<div style="margin-top:10px; margin-left:10px;" id="Event_Grid"></div>
					<div style="margin-left: 10px; margin-top:10px">
						<div style="display:inline-block"><input class="btn btn-primary" id="Event_AddRow" type="button" value="  <?php echo $Trans_NewEvent; ?>  " /></div>
						<div style="display:inline-block"><input class="btn" id="Event_DeleteRow" type="button" value="  <?php echo $Trans_Delete; ?>  " /></div>
					</div>
				</div>
				
				<div id="Event_PopupWindow">
					<div><?php echo $Trans_EditEvent; ?></div>
					<div style="overflow: hidden; padding:5px">
						<table cellpadding=2 cellspacing=2>
							<tr>
								<td align="right"><?php echo $Trans_EventDate; ?>:</td>
								<td align="left"><div id="EventDate"></div></td>
							</tr>

							<tr>
								<td align="right"><?php echo $Trans_Organizer; ?>:</td>
								<td align="left"><input type="text" id="EventOrganizer" /></td>
							</tr>
							
							<tr>
								<td align="right"><?php echo $Trans_EventType; ?>:</td>
								<td align="left"><div type="text" id="EventType"></div></td>
							</tr>
							
							<tr>
								<td align="right"><?php echo $Trans_EventName; ?>:</td>
								<td align="left"><input type="text" id="EventName" /></td>
							</tr>
							
							<tr>
								<td align="right" style="vertical-align:top"><?php echo $Trans_Notes; ?>:</td>
								<td align="left"><textarea id="EventNotes" /></textarea></td>
							</tr>

							<tr>
								<td align="right" style="vertical-align:top"><?php echo $Trans_Active; ?>:</td>
								<td align="left"><div id="EventActiveCheck"></div></td>
							</tr>
							
							<tr>
								<td align="right"></td>
								<td style="padding-top: 10px;" align="right">
								<input style="margin-right: 5px;" type="button" class="btn btn-primary" id="Event_Save" value="<?php echo $Trans_Save; ?>" />
								<input class="btn" id="Event_Cancel" type="button" value="<?php echo $Trans_Cancel; ?>" /></td>
							</tr>
						</table>
					</div>
			   </div>				
            </div>
			<!-- 
			------------------------------------------ INVENTORY
			-->
            <div>
				<div style=" width:660px; display:inline-block; vertical-align:top">
					<div style="margin-top:10px; margin-left:10px;" id="jqxgrid_events"></div>
					<div style="margin-left: 10px; margin-top:10px">
						<div style="display:inline-block"><input class="btn btn-primary" id="addrowbutton_event" type="button" value="  <?php echo $Trans_NewItem; ?>  " /></div>
						<div style="display:inline-block"><input class="btn" id="deleterowbutton_event" type="button" value="  <?php echo $Trans_Delete; ?>  " /></div>
					</div>
				</div>
				
				<div id="popupWindow_events">
					<div>Edit Event</div>
					<div style="overflow: hidden; padding:5px">
						<table cellpadding=2 cellspacing=2>
							<tr>
								<td align="right">Event Date:</td>
								<td align="left"><div id="EventDate"></div></td>
							</tr>

							<tr>
								<td align="right">Organizer:</td>
								<td align="left"><div type="text" id="EventOrganizer"></div></td>
							</tr>
							
							<tr>
								<td align="right">Event Type:</td>
								<td align="left"><div type="text" id="EventType"></div></td>
							</tr>
							
							<tr>
								<td align="right">Event Name:</td>
								<td align="left"><input type="text" id="EventName" /></td>
							</tr>
							
							<tr>
								<td align="right" style="vertical-align:top">Notes:</td>
								<td align="left"><textarea id="EventNotes" /></textarea></td>
							</tr>

							<tr>
								<td align="right" style="vertical-align:top">Active:</td>
								<td align="left"><div id="EventActiveCheck"></div></td>
							</tr>
							
							<tr>
								<td align="right"></td>
								<td style="padding-top: 10px;" align="right">
								<input style="margin-right: 5px;" type="button" class="btn btn-primary" id="EventSave" value="Save" />
								<input class="btn" id="EventCancel" type="button" value="Cancel" /></td>
							</tr>
						</table>
					</div>
			   </div>				
            </div>
			<!-- 
			------------------------------------------ FINANCIALS
			-->
            <div>
				<div style=" width:660px; display:inline-block; vertical-align:top">
					<div style="margin-top:10px; margin-left:10px;" id="jqxgrid_events"></div>
					<div style="margin-left: 10px; margin-top:10px">
						<div style="display:inline-block"><input class="btn btn-primary" id="addrowbutton_event" type="button" value="  New Record  " /></div>
						<div style="display:inline-block"><input class="btn" id="deleterowbutton_event" type="button" value="  Delete  " /></div>
					</div>
				</div>
				
				<div id="popupWindow_events">
					<div>Edit Event</div>
					<div style="overflow: hidden; padding:5px">
						<table cellpadding=2 cellspacing=2>
							<tr>
								<td align="right">Event Date:</td>
								<td align="left"><div id="EventDate"></div></td>
							</tr>

							<tr>
								<td align="right">Organizer:</td>
								<td align="left"><div type="text" id="EventOrganizer"></div></td>
							</tr>
							
							<tr>
								<td align="right">Event Type:</td>
								<td align="left"><div type="text" id="EventType"></div></td>
							</tr>
							
							<tr>
								<td align="right">Event Name:</td>
								<td align="left"><input type="text" id="EventName" /></td>
							</tr>
							
							<tr>
								<td align="right" style="vertical-align:top">Notes:</td>
								<td align="left"><textarea id="EventNotes" /></textarea></td>
							</tr>

							<tr>
								<td align="right" style="vertical-align:top">Active:</td>
								<td align="left"><div id="EventActiveCheck"></div></td>
							</tr>
							
							<tr>
								<td align="right"></td>
								<td style="padding-top: 10px;" align="right">
								<input style="margin-right: 5px;" type="button" class="btn btn-primary" id="EventSave" value="Save" />
								<input class="btn" id="EventCancel" type="button" value="Cancel" /></td>
							</tr>
						</table>
					</div>
			   </div>				
			
            </div>
			<!-- 
			------------------------------------------ SETTINGS
			-->
            <div>
				<?php echo $Trans_SettingsText; ?>
            </div>       
        </div     

<?php
}
?>
        
    </div>
	
</body>
</html>
