$(document).ready(function () {

	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------------------------------------------------------------------------------
	//Member GRID ETC. FUNCTIONS
	
	var Member_GenerateRow = function (id) {
		var MemberRow = {};

		var d=new Date();
	
		MemberRow["ID"] = "0";
		MemberRow["JoinDate"] = d;
		MemberRow["FirstName"] = "";
		MemberRow["LastName"] = "";
		MemberRow["FirstName"] = "";
		MemberRow["MemberType"] = "Member";
		MemberRow["Email"] = "";
		MemberRow["Phone"] = "";
		MemberRow["Notes"] = "";
		MemberRow["Active"] = false;
	  
		return MemberRow;
	}

	var Member_source =
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
		url: 'data.php?Get_Member=true',
		cache: false,
		addrow: function (rowid, rowdata, position, commit) {

			// synchronize with the server - send insert command

			if (rowdata.Active==true) {var xActive="1"; } else {var xActive="0"; }

			var updateDataStr = "ID=" + rowdata.ID + "&JoinDate=" + formatDate2( rowdata.JoinDate ) + "&FirstName=" + rowdata.FirstName + "&LastName=" + rowdata.LastName + 
								"&Email=" + rowdata.Email + "&Phone=" + rowdata.Phone + "&Notes=" + rowdata.Notes + "&Active=" + xActive + "&MemberType=" + rowdata.MemberType;
//			console.log("Update String: "+updateDataStr);
			var data = "Insert_Member=true&" + updateDataStr;

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
					alert(trans_AddingError);
					/*		console.log(errorThrown);	console.log(jqXHR);	console.log(textStatus);   */
					}
				});							
		},
		deleterow: function (rowid, commit) {
			// synchronize with the server - send delete command
			selRowId = $("#Member_Grid").jqxGrid('getselectedrowindex');
			//selRowId = $('#Member_Grid').jqxGrid('getselectedcell').rowindex; -- in cell select mode
			celValue = $('#Member_Grid').jqxGrid('getcellvalue', selRowId, "ID");
			//console.log(selRowId+" "+celValue);
			
		   var data = "Delete_Member=true&ID=" + celValue;
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
			if (rowdata.Active==true) {var xActive="1"; } else {var xActive="0"; }

			var updateDataStr = "ID=" + rowdata.ID + "&JoinDate=" + formatDate2(rowdata.JoinDate) + "&FirstName=" + rowdata.FirstName + "&LastName=" + rowdata.LastName + 
								"&Email=" + rowdata.Email + "&Phone=" + rowdata.Phone + "&Notes=" + rowdata.Notes + "&Active=" + xActive + "&MemberType=" + rowdata.MemberType;
			//console.log(updateDataStr);
			var data = "Update_Member=true&" + updateDataStr;
			
			$.ajax({
				dataType: 'html',
				url: 'data.php',
				cache: false,
				data: data,
				success: function (data, status, xhr) { commit(true); },
				error: function(jqXHR, textStatus, errorThrown) { commit(false); alert(trans_UpdateError); }
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
	

	//use text for Member types now later update to relational table
	var list = [ 'Founder', 'Founding Member', 'Member', 'Guest'];
	$("#MemberType").jqxDropDownList({ width: '300px', height: '38px', theme: theme });
	$("#MemberType").jqxDropDownList({ source: list }); 
	
	// selects the first item.
	$("#MemberType").jqxDropDownList('selectedIndex', '0');
		
	var editrow = -1;
	
	var Member_dataAdapter = new $.jqx.dataAdapter(Member_source);
				
	// initialize Grid
	$("#Member_Grid").jqxGrid(
	{
		//editable:true, //usefull for inline edit
		sortable: true,
		filterable: true,
		columnsresize: true,
		
		//selectionmode: 'singlecell', //usefull for inline edit
		//pageable: true, //usefull if have thousands of Member
		//autoheight: true,

		width: 980,
		height: 400,
		source: Member_dataAdapter,
		theme: theme,
		columns: [
//            { text: 'ID', datafield: 'ID', width: 40 }, //don't need to show the ID column
			  { text: trans_Active, datafield: 'Active', columntype: 'checkbox', width: 67 },
			  { text: trans_JoinDate, datafield: 'JoinDate', width: 120, cellsformat: 'yyyy-MM-dd',columntype: 'datetimeinput', cellsalign: 'right'  },
			  { text: trans_FirstName, datafield: 'FirstName', width: 120 },
			  { text: trans_LastName, datafield: 'LastName', width: 120 },
			  { text: trans_MemberType, datafield: 'MemberType', width: 120,  columntype: 'dropdownlist',  
				 createeditor: function (row, column, editor) {
					var list = [ 'Founder', 'Founding Member', 'Member', 'Guest'];
					editor.jqxDropDownList({ source: list });
				},
				cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) {
					if (newvalue == "") return oldvalue; // return the old value, if the new value is empty.
				}
			  },
			  { text: trans_Email, datafield: 'Email', width: 180 },
			  { text: trans_Phone, datafield: 'Phone', width: 140 },
			  
			  { text: trans_Edit, datafield: 'Edit', columntype: 'button', cellsrenderer: function () { return trans_Edit; }, 
				buttonclick: function (row) 
					{
						 // open the popup window when the user clicks a button.
						 editrow = row;
						 var offset = $("#Member_Grid").offset();
						 $("#Member_PopupWindow").jqxWindow({ position: { x: parseInt(offset.left) + 60, y: parseInt(offset.top) + 60} });
						 
						 // get the clicked row's data and initialize the input fields.
						 var dataRecord = $("#Member_Grid").jqxGrid('getrowdata', editrow);
						 
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
						 $("#Member_PopupWindow").jqxWindow('show');
					}
			  }	
		  ]
	});

	// initialize the popup window and buttons.
	$("#Member_PopupWindow").jqxWindow({ width: 430, height:460, resizable: false, theme: theme, isModal: true, autoOpen: false, cancelButton: $("#Member_Cancel"), modalOpacity: 0.4 });
	
	// update the edited row when the user clicks the 'Save' button.
	$("#Member_Save").click(function () {
		if (editrow >= 0) {
			var MemberRow = {};
		
			MemberRow["ID"] = $('#Member_Grid').jqxGrid('getcellvalue', editrow, "ID");
			MemberRow["JoinDate"] = $("#JoinDate").jqxDateTimeInput('getDate'); 
			MemberRow["FirstName"] = $("#FirstName").val();
			MemberRow["LastName"] = $("#LastName").val();
			MemberRow["MemberType"] = $("#MemberType").jqxDropDownList('getSelectedItem').label; 
			MemberRow["Email"] = $("#Email").val();
			MemberRow["Phone"] = $("#Phone").val();
			MemberRow["Notes"] = $("#Notes").val();
			MemberRow["Active"] = $("#ActiveCheck").jqxCheckBox('checked'); 
		
			//console.log(row);
			
			$('#Member_Grid').jqxGrid('updaterow', MemberRow["ID"], MemberRow);
			$("#Member_PopupWindow").jqxWindow('hide');
		}
	});
	

	// create new row button.
	$("#Member_AddRow").bind('click', function () {
		
		var rowscount = $("#Member_Grid").jqxGrid('getdatainformation').rowscount;
		var datarow = Member_GenerateRow(rowscount + 1);
		$("#Member_Grid").jqxGrid('addrow', null, datarow);
		
	});


	// delete row button.
	$("#Member_DeleteRow").bind('click', function () {

		if (confirm(trans_delete_confirm)) {
			var selectedrowindex = $("#Member_Grid").jqxGrid('getselectedrowindex');
			var id = $("#Member_Grid").jqxGrid('getrowid', selectedrowindex);
			$("#Member_Grid").jqxGrid('deleterow', id);
		}

	});
	

	
	
});
