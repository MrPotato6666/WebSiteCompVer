var selectedFile;
document
	.getElementById("fileupload")
	.addEventListener("change", function(event) {
		selectedFile = event.target.files[0];
	});
document
	.getElementById("fileconvert")
	.addEventListener("click", function(){
		if(selectedFile)
		{
			var fileReader = new FileReader();
			fileReader.readAsBinaryString(selectedFile);
			fileReader.onload = function(event){
				var data = event.target.result;
				var workbook = XLSX.read(data, {type:"binary"});
				var rowObject;
				workbook.SheetNames.forEach(sheet => {
					rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
				});
				var InventArray = [];
				for(key of Object.values(rowObject))
					InventArray.push([(key["ProductName"]+" ("+key["Created by LibXL trial version. Please buy the LibXL full version for removing this message."]+")"), key["Quantity"]]);
				//for(key in InventoryStock1)
				//	InventArray.push([key, InventoryStock1[key]]);
				console.log(InventArray);
				GBInventArray = InventArray;

				//document.getElementById("IconValue").firstChild.firstChild.firstChild.textContent = InventArray.length;

				google.charts.load('current', {'packages':['corechart']});
				google.charts.setOnLoadCallback(drawChart);

				// Draw the chart and set the chart values
				function drawChart() {
					var data = google.visualization.arrayToDataTable(
					InventArray, false);
					console.log(data);

					 // Optional; add a title and set the width and height of the chart
					var options = {'title':'Average Stock', 'width':350, 'height':300, 'chartArea': {'width': '100%', 'height': '80%'}, pieSliceText:'value-and-percentage'};

					// Display the chart inside the <div> element with id="piechart"
					var chart = new google.visualization.PieChart(document.getElementById('piechart'));
					chart.draw(data, options);
				}
			}
		}

	});
