InventoryStock = {
  Coke:8,
  HupSeng:2,
  Tiger:4,
  Oreo:2,
  Pepsi:3
};

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var InventArray = [];
  for(key in InventoryStock)
    InventArray.push([key, InventoryStock[key]]);
  document.getElementById("StockCount").firstChild.firstChild.firstChild.textContent = InventArray.length;
  var data = google.visualization.arrayToDataTable(
  InventArray, true);
  console.log(data);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Average Stock', 'width':350, 'height':300, 'chartArea': {'width': '100%', 'height': '80%'}, pieSliceText:'value-and-percentage'};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
