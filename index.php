<!DOCTYPE html>
<html lang="en">
<head>
	<title>Taipei Hackerspace Managment Consol</title>
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
	
    <script type="text/javascript" src="js/main.js"></script>
	
	
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
          <a class="brand" href="#">Taipei Hackerspace</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#about">Events</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Managment <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Members</a></li>
                  <li><a href="#">Events</a></li>
                  <li><a href="#">Inventory</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Financials</a></li>
                  <li><a href="#">Settings</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
	
	<div class="container">

        <div id='jqxTabs'>
            <ul>
                <li style="margin-left: 30px;">Members</li>
                <li>Events</li>
                <li>Inventory</li>
                <li>Financials</li>
                <li>Settings</li>
            </ul>
            <div>
				<div style=" width:660px; display:inline-block; vertical-align:top">
					<div style="margin-top:10px; margin-left:10px;" id="jqxgrid_members"></div>
					<div style="margin-left: 10px; margin-top:10px">
						<div style="display:inline-block"><input class="btn btn-primary" id="addrowbutton_member" type="button" value="  New Member  " /></div>
						<div style="display:inline-block"><input class="btn" id="deleterowbutton_member" type="button" value="  Delete  " /></div>
					</div>
				</div>
				
				<div id="popupWindow">
					<div>Edit Member</div>
					<div style="overflow: hidden; padding:5px">
						<table cellpadding=2 cellspacing=2>
							<tr>
								<td align="right">Join Date:</td>
								<td align="left"><div id="JoinDate"></div></td>
							</tr>
							
							<tr>
								<td align="right">Membership:</td>
								<td align="left"><div type="text" id="MemberType"></div></td>
							</tr>
							
							<tr>
								<td align="right">First Name:</td>
								<td align="left"><input type="text" id="FirstName" /></td>
							</tr>
							
							<tr>
								<td align="right">Last Name:</td>
								<td align="left"><input type="text" id="LastName" /></td>
							</tr>
							
							<tr>
								<td align="right">Email:</td>
								<td align="left"><input type="text" id="Email" /></td>
							</tr>
							
							<tr>
								<td align="right">Phone:</td>
								<td align="left"><input type="text" id="Phone" /></td>
							</tr>

							<tr>
								<td align="right" style="vertical-align:top">Notes:</td>
								<td align="left"><textarea id="Notes" /></textarea></td>
							</tr>

							<tr>
								<td align="right" style="vertical-align:top">Active:</td>
								<td align="left"><div id="ActiveCheck"></div></td>
							</tr>
							
							<tr>
								<td align="right"></td>
								<td style="padding-top: 10px;" align="right">
								<input style="margin-right: 5px;" type="button" class="btn btn-primary" id="Save" value="Save" />
								<input class="btn" id="Cancel" type="button" value="Cancel" /></td>
							</tr>
						</table>
					</div>
			   </div>				
            </div>
            <div>
				<div style=" width:660px; display:inline-block; vertical-align:top">
					<div style="margin-top:10px; margin-left:10px;" id="jqxgrid_events"></div>
					<div style="margin-left: 10px; margin-top:10px">
						<div style="display:inline-block"><input class="btn btn-primary" id="addrowbutton" type="button" value="  New Event  " /></div>
						<div style="display:inline-block"><input class="btn" id="deleterowbutton" type="button" value="  Delete  " /></div>
					</div>
				</div>
            </div>
            <div>
				<div style=" width:660px; display:inline-block; vertical-align:top">
					<div style="margin-top:10px; margin-left:10px;" id="jqxgrid_inventory"></div>
					<div style="margin-left: 10px; margin-top:10px">
						<div style="display:inline-block"><input class="btn btn-primary" id="addrowbutton" type="button" value="  New Item  " /></div>
						<div style="display:inline-block"><input class="btn" id="deleterowbutton" type="button" value="  Delete  " /></div>
					</div>
				</div>
            </div>
            <div>
				<div style=" width:660px; display:inline-block; vertical-align:top">
					<div style="margin-top:10px; margin-left:10px;" id="jqxgrid_financials"></div>
					<div style="margin-left: 10px; margin-top:10px">
						<div style="display:inline-block"><input class="btn btn-primary" id="addrowbutton" type="button" value="  New Row  " /></div>
						<div style="display:inline-block"><input class="btn" id="deleterowbutton" type="button" value="  Delete  " /></div>
					</div>
				</div>
            </div>
            <div>
            </div>       
        </div     
        
    </div>
	
</body>
</html>
