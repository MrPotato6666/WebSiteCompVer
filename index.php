<!doctype html>
<html>
  <head>
    <title>Ecommerce Virtual Inventory System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="applicable-device" content="pc,mobile">
    <meta name="keywords" content="Eproject">
    <meta name="description" content="Best Website to makes your eccommerce more handy">
  	<meta http-equiv="refresh" content="300">
  	<link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.5/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    var GBInventArray = [];
    </script>
  </head>
   <body>
    ﻿<div class="top">
	   <div class="center">
      <div class="logo"><a href="file:///C:/Users/peezflay/Desktop/WebSite/EcommerceWeb/index.html" title="Ecormmerce"></a></div>
	    <div class="search">
	     <form id="ffsearch" name="ffsearch" method="post">
	       <input class="in1" type="text" name="wd" id="wd" value="" placeholder="Search"/>
	       <input class="in2" type="submit" value="Submit" />
	     </form>
	    </div>
	   </div>
	  </div>
    <div class="nav">
      <ul style="font-size:15px">
        <li><b>Lazada Order</b></li>
        <li><b>Shopee Order</b></li>
        <li><b>Qoo10 Order</b></li>
        <li><b>Zalora Order</b></li>
      </ul>
    </div>
    <div class="file">
      <input type="file" id="fileupload" accept=".xls,.xlsx"/>
      <input type="button" id="fileconvert" value="Upload"/>
      <script type="text/javascript" src="Chart.js"></script>
    </div>
    <div class="InventoryImage">
      <div id="CategoryIcon"><img src="./images/square-rounded-green.ico">
        <div id="IconTitle"><p style="font-size:17px"><b>Total Product:
          <script>
          TotalProductUpdate();
            function TotalProductUpdate() {setInterval(function(){
              document.getElementById("IconValue").firstChild.firstChild.firstChild.textContent = GBInventArray.length;
            }, 1000);}
          </script>
          </b></p></div>
        <div id="IconValue"><p style="font-size:60px"><b>0</b></p></div>
      </div>
      <div id="CategoryIcon"><img src="./images/square-rounded-pink.ico">
        <div id="IconTitle"><p style="font-size:17px"><b>Gross Sales:</b></p></div>
        <div id="IconValue"><p style="font-size:60px"><b>0</b></p></div>
      </div>
      <div id="CategoryIcon"><img src="./images/square-rounded-purple.ico">
        <div id="IconTitle"><p style="font-size:17px"><b>Product Not Sold:</b></p></div>
        <div id="IconValue"><p style="font-size:60px"><b>0</b></p></div>
      </div>
   </div>
   <div class ="Diagram">
     <?php include './php/TotalProductDBQuery.php';
     $results = dataQuery("SELECT * FROM `testtable`", "testingdb");
     ?>
     <script>GBInventArray = <?php echo json_encode($results);?>;</script>
     <script type="text/javacsript" src="Chart.js"></script>
     <div id="piechart"></div>
     <div id="DBQuery">
      <table id = "DBShow">
        <?php echo html_table($results);?>
      </table>
     </div>
   </div>
   <!-- <div id="ProductTable">
     <table id = "TableContent">
       <script>
         function TableFunction() {setInterval(function(){
           if(GBInventArray.length != 0)
           {
             var HtmlString;
             HtmlString = "<tr>";
             for(var i = 0; i < GBInventArray[0].length; i++)
             {
               HtmlString += "<th>" + GBInventArray[0][i] + "</th>";
             }
             HtmlString += "</tr>";
             for(var i = 1; i < GBInventArray.length; i++)
             {
               HtmlString += "<tr>";
               HtmlString += "<td>" + GBInventArray[i][0] + "</td>";
               HtmlString += "<td>" + GBInventArray[i][1] + "</td>";
               HtmlString += "</tr>";
             }
             document.getElementById("TableContent").innerHTML = HtmlString;
            }
          }, 2000);}
          TableFunction();
       </script>
     </table>
   </div> -->
   </body>
</html>
