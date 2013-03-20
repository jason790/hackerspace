
//workaround to make the date string mysql compliant
function formatDate2(date) {
   var year = date.getFullYear(),
	   month = date.getMonth() + 1,
	   day = date.getDate();
   if (month.toString().length === 1) {
	  month = '0' + month;
   }
   if (day.toString().length === 1) {
	  day = '0' + day;
   }
   return year + '-' + month + '-' + day;
}

//simple function placeholder to update screen via ajax 
function updateBoxes()
{
	   var data_members = "update_views=true";
	   $.ajax({
			dataType: 'html',
			url: 'data.php',
			data: data_members,
			cache: false,
			success: function (data, status, xhr) {
				var dataParts = data.split(";");

				$("#in1").html(dataParts[0]+" NT");
				$("#in2").html(dataParts[1]+" NT");
			}
		});							
}



$(document).ready(function () {

	var theme = 'classic';

	// Create jqxTabs.
	$('#jqxTabs').jqxTabs({ width: '1000', height: 600, position: 'top', theme: theme, animationType: 'fade',selectionTracker: true });

	
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//MEMBERS GRID ETC. FUNCTIONS
	
	var data = {};
	var generaterow_member = function (id) {
		var row = {};

		var d=new Date();
	
		row["ID"] = "0";
		row["JoinDate"] = d;
		row["FirstName"] = "";
		row["LastName"] = "";
		row["FirstName"] = "";
		row["MemberType"] = "Member";
		row["Email"] = "";
		row["Phone"] = "";
		row["Notes"] = "";
		row["Active"] = false;
	  
		return row;
	}

	var member_source =
	{
		 datatype: "json",
		 cache: false,
		 datafields: [
			 { name: 'ID', type:'int'},
			 { name: 'JoinDate', type:'date', format:"yyyy-MM-dd"},
			 { name: 'FirstName', type:'string'},
			 { name: 'LastName', type:'string'},
			 { name: 'Email', type:'string'},
			 { name: 'Phone', type:'string'},
			 { name: 'Notes', type:'string'},
			 { name: 'Active', type:'bool'},
			 { name: 'MemberType', type:'string'}
		],
		id: 'ID',
		url: 'data.php?get_members=true',
		cache: false,
		addrow: function (rowid, rowdata, position, commit) {

			// synchronize with the server - send insert command

			if (rowdata.Active==true) {var xActive="1"; } else {var xActive="0"; }

			var updateDataStr = "ID=" + rowdata.ID + "&JoinDate=" + formatDate2( rowdata.JoinDate ) + "&FirstName=" + rowdata.FirstName + "&LastName=" + rowdata.LastName + 
								"&Email=" + rowdata.Email + "&Phone=" + rowdata.Phone + "&Notes=" + rowdata.Notes + "&Active=" + xActive + "&MemberType=" + rowdata.MemberType;
//			console.log("Update String: "+updateDataStr);
			var data = "insert_members=true&" + updateDataStr;

			   $.ajax({
					dataType: 'html',
					url: 'data.php',
					data: data,
					cache: false,
					success: function (data, status, xhr) {
					   // insert command is executed.
						commit(true);
						location.reload(true); //refresh screen just to be sure for now
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
					commit(false);
					alert("adding error");
					/*
					console.log(errorThrown);
					console.log(jqXHR);
					console.log(textStatus);
					*/

					}
				});							
		},
		deleterow: function (rowid, commit) {
			// synchronize with the server - send delete command
			selRowId = $("#jqxgrid_members").jqxGrid('getselectedrowindex');
			//selRowId = $('#jqxgrid_members').jqxGrid('getselectedcell').rowindex; -- in cell select mode
			celValue = $('#jqxgrid_members').jqxGrid('getcellvalue', selRowId, "ID");
			//console.log(selRowId+" "+celValue);
			
		   var data = "delete_members=true&ID=" + celValue;
		   $.ajax({
				dataType: 'html',
				url: 'data.php',
				cache: false,
				data: data,
				success: function (data, status, xhr) {
					commit(true);
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					console.log(errorThrown);
					console.log(jqXHR);
					console.log(textStatus);
					commit(false);
				}
			});							
			
	   },
		updaterow: function (rowid, rowdata, commit) {
			// synchronize with the server - send update command
			console.log(rowid);

			//make true/false 0/1 for sql
			if (rowdata.Active==true) {var xActive="1"; } else {var xActive="0"; }

			var updateDataStr = "ID=" + rowdata.ID + "&JoinDate=" + formatDate2(rowdata.JoinDate) + "&FirstName=" + rowdata.FirstName + "&LastName=" + rowdata.LastName + 
								"&Email=" + rowdata.Email + "&Phone=" + rowdata.Phone + "&Notes=" + rowdata.Notes + "&Active=" + xActive + "&MemberType=" + rowdata.MemberType;
			//console.log(updateDataStr);
			var data = "update_members=true&" + updateDataStr;
			
			$.ajax({
				dataType: 'html',
				url: 'data.php',
				cache: false,
				data: data,
				success: function (data, status, xhr) { commit(true); },
				error: function(jqXHR, textStatus, errorThrown) { commit(false); alert("update error"); }							
			});		
		}
	};
	
	// initialize the input fields. (for the edit popup)
	$("#FirstName").jqxInput({height:30,width:300,theme:theme});
	$("#FirstName").css({padding:"4px"});
	$("#LastName").jqxInput({height:30,width:300,theme:theme});
	$("#LastName").css({padding:"4px"});
	$("#Phone").jqxInput({height:30,width:300,theme:theme});
	$("#Phone").css({padding:"4px"});
	$("#Email").jqxInput({height:30,width:300,theme:theme});
	$("#Email").css({padding:"4px"});
	$("#Notes").jqxInput({height:60,width:300,theme:theme});
	$("#Notes").css({padding:"4px"});
	
	$("#ActiveCheck").jqxCheckBox({width: 120, height: 25, checked: false, theme:theme });
	
	$("#JoinDate").jqxDateTimeInput({ formatString: 'yyyy-MM-dd', width:'150px', height:'30px',theme:theme });
	

	//use text for member types now later update to relational table
	var list = [ 'Founder', 'Founding Member', 'Member', 'Guest'];
	$("#MemberType").jqxDropDownList({ width: '308px', height: '38px', theme: theme });
	$("#MemberType").jqxDropDownList({ source: list }); 
	
	// selects the first item.
	$("#MemberType").jqxDropDownList('selectedIndex', '0');
		
	var editrow = -1;
	
	var dataAdapter = new $.jqx.dataAdapter(member_source);
				
	// initialize Grid
	$("#jqxgrid_members").jqxGrid(
	{
		//editable:true, //usefull for inline edit
		sortable: true,
		filterable: true,
		columnsresize: true,
		
		//selectionmode: 'singlecell', //usefull for inline edit
		//pageable: true, //usefull if have thousands of members
		//autoheight: true,

		width: 980,
		height: 400,
		source: dataAdapter,
		theme: theme,
		columns: [
//            { text: 'ID', datafield: 'ID', width: 40 }, //don't need to show the ID column
			  { text: 'Active', datafield: 'Active', columntype: 'checkbox', width: 67 },
			  { text: 'Join Date', datafield: 'JoinDate', width: 120, cellsformat: 'yyyy-MM-dd',columntype: 'datetimeinput', cellsalign: 'right'  },
			  { text: 'First Name', datafield: 'FirstName', width: 120 },
			  { text: 'Last Name', datafield: 'LastName', width: 120 },
			  { text: 'Member Type', datafield: 'MemberType', width: 120,  columntype: 'dropdownlist',  
				 createeditor: function (row, column, editor) {
					var list = [ 'Founder', 'Founding Member', 'Member', 'Guest'];
					editor.jqxDropDownList({ source: list });
				},
				cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) {
					if (newvalue == "") return oldvalue; // return the old value, if the new value is empty.
				}
			  },
			  { text: 'Email', datafield: 'Email', width: 180 },
			  { text: 'Phone', datafield: 'Phone', width: 140 },
			  
			  { text: 'Edit', datafield: 'Edit', columntype: 'button', cellsrenderer: function () { return "Edit"; }, 
				buttonclick: function (row) 
					{
						 // open the popup window when the user clicks a button.
						 editrow = row;
						 var offset = $("#jqxgrid_members").offset();
						 $("#popupWindow").jqxWindow({ position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60} });
						 
						 // get the clicked row's data and initialize the input fields.
						 var dataRecord = $("#jqxgrid_members").jqxGrid('getrowdata', editrow);
						 
						 $("#ActiveCheck").jqxCheckBox({"checked":dataRecord.Active}); 
						 $("#FirstName").val(dataRecord.FirstName);
						 $("#LastName").val(dataRecord.LastName);
						 $("#Phone").val(dataRecord.Phone);
						 $("#Email").val(dataRecord.Email);
						 $("#Notes").val(dataRecord.Notes);
						 
						 $("#JoinDate").jqxDateTimeInput('setDate',  dataRecord.JoinDate ); 
						 
						 var xIndex=2; //default to Guest
						 if (dataRecord.MemberType == "Founder") { var xIndex=0; }
						 if (dataRecord.MemberType == "Founding Member") { var xIndex=1; }
						 if (dataRecord.MemberType == "Member") { var xIndex=2; }
						 if (dataRecord.MemberType == "Guest") { var xIndex=3; }
						 $("#MemberType").jqxDropDownList('selectedIndex', xIndex);
						 
						 // show the popup window.
						 $("#popupWindow").jqxWindow('show');
					}
			  }	
		  ]
	});

	// initialize the popup window and buttons.
	$("#popupWindow").jqxWindow({ width: 420, height:460, resizable: false, theme: theme, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.4 });
	
	// update the edited row when the user clicks the 'Save' button.
	$("#Save").click(function () {
		if (editrow >= 0) {
			var row = {};
		
			row["ID"] = $('#jqxgrid_members').jqxGrid('getcellvalue', editrow, "ID");
			row["JoinDate"] = $("#JoinDate").jqxDateTimeInput('getDate'); 
			row["FirstName"] = $("#FirstName").val();
			row["LastName"] = $("#LastName").val();
			row["MemberType"] = $("#MemberType").jqxDropDownList('getSelectedItem').label; 
			row["Email"] = $("#Email").val();
			row["Phone"] = $("#Phone").val();
			row["Notes"] = $("#Notes").val();
			row["Active"] = $("#ActiveCheck").jqxCheckBox('checked'); 
		
			//console.log(row);
			
			$('#jqxgrid_members').jqxGrid('updaterow', row["ID"], row);
			$("#popupWindow").jqxWindow('hide');
		}
	});
	

	// create new row button.
	$("#addrowbutton_member").bind('click', function () {
		
		var rowscount = $("#jqxgrid_members").jqxGrid('getdatainformation').rowscount;
		var datarow = generaterow_member(rowscount + 1);
		$("#jqxgrid_members").jqxGrid('addrow', null, datarow);
		
	});


	// delete row button.
	$("#deleterowbutton_member").bind('click', function () {

		if (confirm('Deleting records are final, confirm?')) {
			var selectedrowindex = $("#jqxgrid_members").jqxGrid('getselectedrowindex');
			var id = $("#jqxgrid_members").jqxGrid('getrowid', selectedrowindex);
			$("#jqxgrid_members").jqxGrid('deleterow', id);
		}

	});
	

	
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//TEMP GRIDS FOR THE OTHER TABS 
	
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	
	$("#jqxgrid_events").jqxGrid(
	{
		//editable:true,
		sortable: true,
		filterable: true,
		columnsresize: true,
		//columnsreorder: true,
		//selectionmode: 'singlecell',
		//pageable: true,
		//autoheight: true,

		width: 980,
		height: 400,
//                source: dataAdapter,
		theme: theme,
		columns: [
//                      { text: 'ID', datafield: 'ID', width: 40 },
			  { text: 'Active', datafield: 'available', columntype: 'checkbox', width: 67 },
			  { text: 'Join Date', datafield: 'JoinDate', width: 120, cellsformat: 'yyyy-MM-dd',columntype: 'datetimeinput', cellsalign: 'right'  },
			  { text: 'First Name', datafield: 'FirstName', width: 120 },
			  { text: 'Last Name', datafield: 'FirstName', width: 120 },
			  { text: 'Member Type', datafield: 'MemberType', width: 120,  columntype: 'dropdownlist', 
				 createeditor: function (row, column, editor) {
					var list = [ 'Founder', 'Founding Member', 'Member' , 'Guest'];
					editor.jqxDropDownList({ source: list });
				},
				// update the editor's value before saving it.
				cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) {
					// return the old value, if the new value is empty.
					if (newvalue == "") return oldvalue;
				}
			  },
			  { text: 'Email', datafield: 'FirstName', width: 180 },
			  { text: 'Phone', datafield: 'FirstName', width: 140 },
//                      { text: 'Balance', datafield: 'Balance', width: 90,cellsalign: 'right',cellsformat: 'F2'},
			  
			  { text: 'Edit', datafield: 'Edit', columntype: 'button', 
				cellsrenderer: 
					function () 
					{
						return "Edit";
					}, 
				buttonclick: 
					function (row) 
					{
						 // open the popup window when the user clicks a button.
						 editrow = row;
						 var offset = $("#jqxgrid_members").offset();
						 $("#popupWindow").jqxWindow({ position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60} });
						 // get the clicked row's data and initialize the input fields.
						 var dataRecord = $("#jqxgrid_members").jqxGrid('getrowdata', editrow);
						 $("#FirstName").val(dataRecord.FirstName);
						 $("#LastName").val(dataRecord.LastName);
						 $("#product").val(dataRecord.productname);
						 $("#quantity").jqxNumberInput({ decimal: dataRecord.quantity });
						 $("#price").jqxNumberInput({ decimal: dataRecord.price });
						 // show the popup window.
						 $("#popupWindow").jqxWindow('show');
					}
			  }	
		  ]
	});
	



	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------

	$("#jqxgrid_inventory").jqxGrid(
	{
		//editable:true,
		sortable: true,
		filterable: true,
		columnsresize: true,
		//columnsreorder: true,
		//selectionmode: 'singlecell',
		//pageable: true,
		//autoheight: true,

		width: 980,
		height: 400,
//                source: dataAdapter,
		theme: theme,
		columns: [
//                      { text: 'ID', datafield: 'ID', width: 40 },
			  { text: 'Active', datafield: 'available', columntype: 'checkbox', width: 67 },
			  { text: 'Join Date', datafield: 'JoinDate', width: 120, cellsformat: 'dd-MM-yyyy',columntype: 'datetimeinput', cellsalign: 'right'  },
			  { text: 'First Name', datafield: 'FirstName', width: 120 },
			  { text: 'Last Name', datafield: 'FirstName', width: 120 },
			  { text: 'Member Type', datafield: 'MemberType', width: 120,  columntype: 'dropdownlist', 
				 createeditor: function (row, column, editor) {
					var list = [ 'Founder', 'Founding Member', 'Member' , 'Guest'];
					editor.jqxDropDownList({ source: list });
				},
				// update the editor's value before saving it.
				cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) {
					// return the old value, if the new value is empty.
					if (newvalue == "") return oldvalue;
				}
			  },
			  { text: 'Email', datafield: 'FirstName', width: 180 },
			  { text: 'Phone', datafield: 'FirstName', width: 140 },
//                      { text: 'Balance', datafield: 'Balance', width: 90,cellsalign: 'right',cellsformat: 'F2'},
			  
			  { text: 'Edit', datafield: 'Edit', columntype: 'button', 
				cellsrenderer: 
					function () 
					{
						return "Edit";
					}, 
				buttonclick: 
					function (row) 
					{
						 // open the popup window when the user clicks a button.
						 editrow = row;
						 var offset = $("#jqxgrid_members").offset();
						 $("#popupWindow").jqxWindow({ position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60} });
						 // get the clicked row's data and initialize the input fields.
						 var dataRecord = $("#jqxgrid_members").jqxGrid('getrowdata', editrow);
						 $("#FirstName").val(dataRecord.FirstName);
						 $("#LastName").val(dataRecord.LastName);
						 $("#product").val(dataRecord.productname);
						 $("#quantity").jqxNumberInput({ decimal: dataRecord.quantity });
						 $("#price").jqxNumberInput({ decimal: dataRecord.price });
						 // show the popup window.
						 $("#popupWindow").jqxWindow('show');
					}
			  }	
		  ]
	});
	
	
	
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------

	$("#jqxgrid_financials").jqxGrid(
	{
		//editable:true,
		sortable: true,
		filterable: true,
		columnsresize: true,
		//columnsreorder: true,
		selectionmode: 'singlecell',
		//pageable: true,
		//autoheight: true,
		width: 980,
		height: 400,
//              source: dataAdapter,
		theme: theme,
		columns: [
//                    { text: 'ID', datafield: 'ID', width: 40 },
			  { text: 'Active', datafield: 'Active', columntype: 'checkbox', width: 67 },
			  { text: 'Join Date', datafield: 'JoinDate', width: 120, cellsformat: 'dd-MM-yyyy',columntype: 'datetimeinput', cellsalign: 'right'  },
			  { text: 'First Name', datafield: 'FirstName', width: 120 },
			  { text: 'Last Name', datafield: 'FirstName', width: 120 },
			  { text: 'Member Type', datafield: 'MemberType', width: 120,  columntype: 'dropdownlist', 
				 createeditor: function (row, column, editor) {
					var list = [ 'Founder', 'Founding Member', 'Member' , 'Guest'];
					editor.jqxDropDownList({ source: list });
				},
				// update the editor's value before saving it.
				cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) {
					// return the old value, if the new value is empty.
					if (newvalue == "") return oldvalue;
				}
			  },
			  { text: 'Email', datafield: 'FirstName', width: 180 },
			  { text: 'Phone', datafield: 'FirstName', width: 140 },
			  { text: 'Balance', datafield: 'Balance', width: 90,cellsalign: 'right',cellsformat: 'F2'}
			  
		  ]
	});
	
	
});
