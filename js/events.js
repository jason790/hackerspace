$(document).ready(function () {

	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//Event GRID ETC. FUNCTIONS
	
	var Event_GenerateRow = function (id) {
		var EventRow = {};

		var d=new Date();
		var t=new Time();
	
		EventRow["ID"] = "0";
		EventRow["EventDate"] = d;
		EventRow["EventTime"] = t;
		EventRow["EventName"] = "";
		EventRow["EventOrganizer"] = "";
		EventRow["EventType"] = "Event";
		EventRow["EventNotes"] = "";
		EventRow["EventActive"] = false;
	  
		return EventRow;
	}

	var Event_source =
	{
		 datatype: "json",
		 cache: false,
		 datafields: [
			 { name: 'ID', type:'int'},
			 { name: 'EventDate', type:'date', format:"yyyy-MM-dd"},
			 { name: 'EventName', type:'string'},
			 { name: 'EventOrganizer', type:'string'},
			 { name: 'EventNotes', type:'string'},
			 { name: 'EventActive', type:'bool'},
			 { name: 'EventType', type:'string'}
		],
		id: 'ID',
		url: 'data.php?Get_Event=true',
		cache: false,
		addrow: function (rowid, rowdata, position, commit) {

			// synchronize with the server - send insert command

			if (rowdata.EventActive==true) {var xEventActive="1"; } else {var xEventActive="0"; }

			var updateDataStr = "ID=" + rowdata.ID + "&EventDate=" + formatDate2( rowdata.EventDate ) + "&EventName=" + rowdata.EventName + "&EventOrganizer=" + rowdata.EventOrganizer + 
								"&Email=" + rowdata.Email + "&Phone=" + rowdata.Phone + "&EventNotes=" + rowdata.EventNotes + "&EventActive=" + xEventActive + "&EventType=" + rowdata.EventType;
//			console.log("Update String: "+updateDataStr);
			var data = "Insert_Event=true&" + updateDataStr;

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
					/*		console.log(errorThrown);	console.log(jqXHR);	console.log(textStatus);   */
					}
				});							
		},
		deleterow: function (rowid, commit) {
			// synchronize with the server - send delete command
			selRowId = $("#Event_Grid").jqxGrid('getselectedrowindex');
			//selRowId = $('#Event_Grid').jqxGrid('getselectedcell').rowindex; -- in cell select mode
			celValue = $('#Event_Grid').jqxGrid('getcellvalue', selRowId, "ID");
			//console.log(selRowId+" "+celValue);
			
		   var data = "Delete_Event=true&ID=" + celValue;
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
			//console.log(rowid);

			//make true/false 0/1 for sql
			if (rowdata.EventActive==true) {var xEventActive="1"; } else {var xEventActive="0"; }

			var updateDataStr = "ID=" + rowdata.ID + "&EventDate=" + formatDate2(rowdata.EventDate) + "&EventName=" + rowdata.EventName + "&EventOrganizer=" + rowdata.EventOrganizer + 
								"&Email=" + rowdata.Email + "&Phone=" + rowdata.Phone + "&EventNotes=" + rowdata.EventNotes + "&EventActive=" + xEventActive + "&EventType=" + rowdata.EventType;
			//console.log(updateDataStr);
			var data = "Update_Event=true&" + updateDataStr;
			
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
	$("#EventName").jqxInput({height:30,width:300,theme:theme});
	$("#EventName").css({padding:"4px"});
	$("#EventOrganizer").jqxInput({height:30,width:300,theme:theme});
	$("#EventOrganizer").css({padding:"4px"});
	$("#EventNotes").jqxInput({height:60,width:300,theme:theme});
	$("#EventNotes").css({padding:"4px"});
	
	$("#EventActiveCheck").jqxCheckBox({width: 120, height: 25, checked: false, theme:theme });
	
	$("#EventDate").jqxDateTimeInput({ formatString: 'yyyy-MM-dd', width:'150px', height:'30px',theme:theme });
	

	//use text for Event types now later update to relational table
	var list = [ 'Funding Event', 'Make Event', 'Teaching Event', 'Party'];
	$("#EventType").jqxDropDownList({ width: '308px', height: '38px', theme: theme });
	$("#EventType").jqxDropDownList({ source: list }); 
	
	// selects the first item.
	$("#EventType").jqxDropDownList('selectedIndex', '0');
		
	var editrow = -1;
	
	var Event_dataAdapter = new $.jqx.dataAdapter(Event_source);
				
				
	// initialize Grid
	$("#Event_Grid").jqxGrid(
	{
		//editable:true, //usefull for inline edit
		sortable: true,
		filterable: true,
		columnsresize: true,
		
		//selectionmode: 'singlecell', //usefull for inline edit
		//pageable: true, //usefull if have thousands of Event
		//autoheight: true,

		width: 980,
		height: 400,
		source: Event_dataAdapter,
		theme: theme,
		columns: [
//            { text: 'ID', datafield: 'ID', width: 40 }, //don't need to show the ID column
			  { text: 'Active', datafield: 'EventActive', columntype: 'checkbox', width: 67 },
			  { text: 'Event Date', datafield: 'EventDate', width: 120, cellsformat: 'yyyy-MM-dd',columntype: 'datetimeinput', cellsalign: 'right'  },
			  { text: 'Event Name', datafield: 'EventName', width: 120 },
			  { text: 'Organizer', datafield: 'EventOrganizer', width: 120 },
			  { text: 'Event Type', datafield: 'EventType', width: 120,  columntype: 'dropdownlist',  
				 createeditor: function (row, column, editor) {
					var list = [ 'Funding Event', 'Make Event', 'Teaching Event', 'Party'];
					editor.jqxDropDownList({ source: list });
				},
				cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) {
					if (newvalue == "") return oldvalue; // return the old value, if the new value is empty.
				}
			  },
			  
			  { text: 'Edit', datafield: 'Edit', columntype: 'button', cellsrenderer: function () { return "Edit"; }, 
				buttonclick: function (row) 
					{
						 // open the popup window when the user clicks a button.
						 editrow = row;
						 var offset = $("#Event_Grid").offset();
						 $("#Event_PopupWindow").jqxWindow({ position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60} });
						 
						 // get the clicked row's data and initialize the input fields.
						 var dataRecord = $("#Event_Grid").jqxGrid('getrowdata', editrow);
						 
						 $("#EventActiveCheck").jqxCheckBox({"checked":dataRecord.EventActive}); 
						 $("#EventName").val(dataRecord.EventName);
						 $("#EventOrganizer").val(dataRecord.EventOrganizer);
						 $("#EventNotes").val(dataRecord.EventNotes);
						 
						 $("#EventDate").jqxDateTimeInput('setDate',  dataRecord.EventDate ); 
						 
						 var xIndex=2; //default to Guest
						 if (dataRecord.EventType == "Founder") { var xIndex=0; }
						 if (dataRecord.EventType == "Founding Event") { var xIndex=1; }
						 if (dataRecord.EventType == "Event") { var xIndex=2; }
						 if (dataRecord.EventType == "Guest") { var xIndex=3; }
						 $("#EventType").jqxDropDownList('selectedIndex', xIndex);
						 
						 // show the popup window.
						 $("#Event_PopupWindow").jqxWindow('show');
					}
			  }	
		  ]
	});

	// initialize the popup window and buttons.
	$("#Event_PopupWindow").jqxWindow({ width: 420, height:460, resizable: false, theme: theme, isModal: true, autoOpen: false, cancelButton: $("#Event_Cancel"), modalOpacity: 0.4 });
	
	// update the edited row when the user clicks the 'Save' button.
	$("#Event_Save").click(function () {
		if (editrow >= 0) {
			var EventRow = {};
		
			EventRow["ID"] = $('#Event_Grid').jqxGrid('getcellvalue', editrow, "ID");
			EventRow["EventDate"] = $("#EventDate").jqxDateTimeInput('getDate'); 
			EventRow["EventName"] = $("#EventName").val();
			EventRow["EventOrganizer"] = $("#EventOrganizer").val();
			EventRow["EventType"] = $("#EventType").jqxDropDownList('getSelectedItem').label; 
			EventRow["EventNotes"] = $("#EventNotes").val();
			EventRow["EventActive"] = $("#EventActiveCheck").jqxCheckBox('checked'); 
		
			//console.log(row);
			
			$('#Event_Grid').jqxGrid('updaterow', EventRow["ID"], EventRow);
			$("#Event_PopupWindow").jqxWindow('hide');
		}
	});
	

	// create new row button.
	$("#Event_AddRow").bind('click', function () {
		
		var rowscount = $("#Event_Grid").jqxGrid('getdatainformation').rowscount;
		var datarow = Event_GenerateRow(rowscount + 1);
		$("#Event_Grid").jqxGrid('addrow', null, datarow);
		
	});


	// delete row button.
	$("#Event_DeleteRow").bind('click', function () {

		if (confirm('Deleting records are final, confirm?')) {
			var selectedrowindex = $("#Event_Grid").jqxGrid('getselectedrowindex');
			var id = $("#Event_Grid").jqxGrid('getrowid', selectedrowindex);
			$("#Event_Grid").jqxGrid('deleterow', id);
		}

	});
	

	
	
});
