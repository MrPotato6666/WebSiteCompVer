//let Question = prompt("How Old Are You")
ChartGenerate();
function ChartGenerate() {
  setInterval(function(){
  var InventArray = [];
  if(GBInventArray.length != 0)
  {
    for(key of Object.values(GBInventArray))
      InventArray.push([key["Product"], key["Quantity"]]);
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
      var data = google.visualization.arrayToDataTable(
      InventArray, true);

      // Optional; add a title and set the width and height of the chart
     var options = {'title':'Average Stock', 'width':350, 'height':300, 'chartArea': {'width': '100%', 'height': '80%'}, pieSliceText:'value-and-percentage'};

     // Display the chart inside the <div> element with id="piechart"
     var chart = new google.visualization.PieChart(document.getElementById('piechart'));
     chart.draw(data, options);
   }
  }
}, 500);
}
