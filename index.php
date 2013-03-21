<?php 
//session_set_cookie_params ( 0 , '/', '.elooi.com');
session_start(); 
ob_start(); 
header('Content-Type: text/html; charset=UTF-8');

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
	<title><?php echo $Trans_Title; ?></title>
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
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="<?php echo $Trans_Email; ?>" style="width:100px; height:30px">
              <input class="span2" type="password" placeholder="<?php echo $Trans_Password; ?>" style="width:100px; height:30px">
              <button type="submit" class="btn"><?php echo $Trans_Sign_in; ?></button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
	
	<div class="container">

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
        
    </div>
	
</body>
</html>
