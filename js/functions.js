var theme = 'classic';
var data = {};

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

	// Create jqxTabs.
	$('#jqxTabs').jqxTabs({ width: '1000', height: 600, position: 'top', theme: theme, animationType: 'fade',selectionTracker: true });

	
	
	
});
