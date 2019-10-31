<?php 

date_default_timezone_set("Asia/Jakarta"); 

$file = fopen("fastest_route.txt","r");
$file2 = fopen("ggRoad.txt","r");
$file3 = fopen("ggRoad2.txt","r");
$file4 = fopen("ggRoad3.txt","r");
$file5 = fopen("ggRoad4.txt","r");
$result;


if(isset($_POST['submit'])){
    $myfile = fopen("user_input.txt", "w") or die("Unable to open file!");
    $plate = $_POST['plate'];
    fwrite($myfile, $plate);
    $nl = "\n";
    fwrite($myfile, $nl);
    $start = $_POST['start'];
    fwrite($myfile, $start);
    $nl2 = "\n";
    fwrite($myfile, $nl2);
    $end = $_POST['end'];
    fwrite($myfile, $end);
    $nl3 = "\n";
    fwrite($myfile, $nl3);
    fclose($myfile);

    // $command = escapeshellcmd('/Applications/XAMPP/xamppfiles/htdocs/php/subwayMap-master/finalproject.py');
    $command = escapeshellcmd('./finalproject.py');
    $output = shell_exec($command);
    $myfile = "result.txt";
    $result = file($myfile);
}
?>
<?php
$myfile = "fastest_route.txt";
$results = file($myfile);
if($results[0] == 0.0){
	echo '<script language="javascript">';
    echo 'alert("We are sorry there are no alternative routes !")';
    echo '</script>';

}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Map</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="jquery.subwayMap-0.5.2.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style type="text/css">

    .fixed-btn{
    margin-top: 20px;
    position: fixed;
    background: white;

    width: 500px;
    height:  600px;
    line-height: 45px;

    right: 4%;
    text-align: center;

    box-shadow: 0 10px 30px 0 rgba(0,0,0,0.30);
    }
    .fixed-btn:active{
      box-shadow: 0 0;
    }
    body
    {
        font-family: Verdana;
        font-size: 6pt;
    }

    /* The main DIV for the map */
    .subway-map
    {
        margin: 0;
        width: 500px;
        height:410px;
        background-color: white;
    }

    /* Text labels */

    .text
    {
        color: black;
        z-index: -1;
    }

    #legend
    {
        float: left;
        width: 250px;
        height:400px;
    }

    #legend div
    {
        height: 25px;
    }

    #legend span
    {
        margin: 5px 5px 5px 0;
    }
    .subway-map span
    {
        margin: 5px 5px 5px 0;
    }
    
   	/* DOWN BELOW CODE FOR AUTO COMPLETE*/
   	/*the container must be positioned relative:*/
	.autocomplete {
	  position: relative;
	  display: inline-block;
	}

	input {
	  border: 1px solid transparent;
	  background-color: #f1f1f1;
	  padding: 10px;
	  font-size: 16px;
	}

	input[type=text] {
	  background-color: white;
	  border: 1px solid grey;
	  width: 100%;
	}

	

	.autocomplete-items {
	  position: absolute;
	  border: 1px solid #d4d4d4;
	  border-bottom: none;
	  border-top: none;
	  z-index: 99;
	  font-size: 30px !important;
	  /*position the autocomplete items to be the same width as the container:*/
	  top: 100%;
	  left: 0;
	  right: 0;
	}

	.autocomplete-items div {
	  padding: 10px;
	  cursor: pointer;
	  background-color: #fff; 
	  border-bottom: 1px solid #d4d4d4; 
	}

	/*when hovering an item:*/
	.autocomplete-items div:hover {
	  background-color: #e9e9e9; 
	}

	/*when navigating through the items using the arrow keys:*/
	.autocomplete-active {
	  background-color: DodgerBlue !important; 
	  color: #ffffff; 
    </style>
    
</head>
<body>


    
    <div class="fixed-btn">

    	<!--Make sure the form has the autocomplete function switched off:-->
		<form autocomplete="off" method="post" style="padding: 20px 20px">
			<select name="plate" class="browser-default custom-select" style="font-size: 30px;height: 70px">
              <option selected>Select Plate Number</option>
              <option value="1">Odd Plate</option>
              <option value="2">Even Plate</option>
            </select>
		  <div class="autocomplete" style="width:100%;">
		    <input style="font-size: 30px !important;margin-top: 20px" id="myInput" type="text" name="start" placeholder="Start Point">
		  </div>
		  <div class="autocomplete" style="width:100%;">
		    <input style="font-size: 30px !important;margin-top: 30px" id="myInput2" type="text" name="end" placeholder="End Point">
		  </div>
          <input type="submit" id="submit" name="submit" value="Start Navigation" class="btn-primary" style="margin-top: 20px;font-family: Montserrat-SemiBold;height:20%;width: 100%;border-radius: 7px;font-size: 30px"> 
          <div style="text-align: left">
			<table style="font-size: 20px;margin-top: 15px !important">
            <tr style="margin-top: 15px !important">
                <td>Today's Date </td>
                <td>:</td>
                
                <td><?php echo $result[5]?></td>
                
              </tr>
              <tr style="margin-top: 15px !important">
                <td>License Plate </td>
                <td>:</td>
                
                <td><?php echo $result[4]?></td>
                
              </tr>
              <tr style="margin-top: 15px !important">
                <td>Total Distance </td>
                <td>:</td>
                
                <td><?php echo $result[0]?> m</td>
                
              </tr>
				
              <tr>
                <td>Dijkstra's Exc. Time</td>
                <td>:</td>

                <td><?php echo $result[1]?>seconds</td>
              </tr>

              <tr>
                <td>Bellman's Exc. Time</td>
                <td>:</td>

                <td><?php echo $result[2]?>seconds</td>
              </tr>

              <tr>
                <td style="text-decoration: underline;" colspan="3"><?php echo $result[3]?>is faster</td>
                <!--
                <td> is faster</td>

                <td><?php echo $result[1]?>minutes</td>
            -->
              </tr>

            </table>
		</div>
		</form>

    </div>

    <div class="subway-map" data-columns="40" data-rows="90" data-cellSize="20" data-legendId="legend" data-textClass="text" data-gridNumbers="true" data-grid="false" data-lineWidth="5">
      

      <ul data-color="white" >                     
          <li data-coords="2,81"></li>
          <li data-coords="3.5,81"></li>
          <li data-coords="4.65,81"></li>
          <li data-coords="7.41,81"></li>
          <li data-coords="8,81"></li>
          <li data-coords="10.725,81"></li>
        </ul>
 
        <ul data-color="white" >
          <li data-coords="10.725,81"></li>
          <li data-coords="10.725,82"></li>
          <li data-coords="10.725,83.61"></li>
        </ul>

        <ul data-color="white" >
          <li data-coords="10.725,82"></li>
          <li data-coords="7.92,85.94"></li>
          <li data-coords="4.65,85.94"></li>
          <li data-coords="2.35,85.94"></li>
          <li data-coords="2,81"></li>
        </ul>

        <ul data-color="white" >                     
          <li data-coords="3.5,81"></li>
          <li data-coords="3.5,82"></li>
          <li data-coords="4.65,84"></li>
          <li data-coords="4.65,85.94"></li>
        </ul>
        <ul data-color="white" >
          <li data-coords="7.92,85.94"></li>
          <li data-coords="7.7,83.86"></li>
          <li data-coords="7.41,81" data-dir="S"></li>
        </ul>
        <ul data-color="white">
          <li data-coords="10.725,81"></li>
          <li data-coords="10.725,77.82"></li>
          <li data-coords="9.88,76.21"></li>
          <!--<li data-coords="8.725,76.21">a</li>-->
          <li data-coords="7.625,76.21"></li>
          <li data-coords="6.25,76.21">Jl. Pattimura</li>
          <li data-coords="4.8,76.21"></li>
          <li data-coords="2.2,76.21"></li>

        </ul>

        <ul data-color="white">
          <li data-coords="3.8,76.2" ></li>
          <li data-coords="2.2,76.21"></li>
        </ul>

        <ul data-color="white">
          <li data-coords="4.8,76.21"></li>
          <li data-coords="4.8,79"></li>
          <li data-coords="4.65,81"></li>
          <li data-coords="4.65,84"></li>
        </ul>

        <ul data-color="white">
          <li data-coords="6.25,76.21"></li>
          <!--<li data-coords="6.3,77.4">b</li>-->

          <li data-coords="5.7,78.35">Al-Azhar</li>
          <li data-coords="5.5,79.5"></li>
          <li data-coords="6.8,78.7" data-dir="E"></li>
          <!--<li data-coords="6.3,77.4">b</li>-->
          <li data-coords="6.25,76.21"></li>
        </ul>
        <ul  data-color="white">
          <li data-coords="6.8,78.7"></li>
          <li data-coords="7.41,81"></li>
        </ul>
		<!-- DARI DAKOTA KE ATAS -->
        <ul  data-color="white">
          <li data-coords="9.88,76.21"></li>
        	<li data-coords="9.88,75.1"></li>
        	<li data-coords="8.38,74.7"></li>
        	<li data-coords="6.66,74.3"></li>
          <li data-coords="4.8,74.21"></li>
          <li data-coords="4,74.21"></li>
          <li data-coords="2.2,76.21"></li>


        </ul>
        <!-- dari sisingamangaraja ke atas -->

		<ul  data-color="white">
            <li data-coords="4.8,76.21"></li>
            <li data-coords="4.8,74.21">Bund. Senayan</li>
			

        </ul>
        <!-- dari paopao ke pattimura -->
        <ul  data-color="white">
        	<li data-coords="6.66,74.3"></li>
          <li data-coords="6.25,76.21"></li>
			

        </ul>
        <!-- bun senayan ke fx terus belok kiri -->

        <ul  data-color="white">
          <li data-coords="4.8,74.2"></li> 
    			<li data-coords="7.5,72.5"></li>
    			<li data-coords="4.8,71.7"></li>
    			<li data-coords="4.8,70.6"></li>
    			<li data-coords="5.9,70.6"></li>

        </ul>

<!-- bunderan senayan lurus ke atas terus belok kiri -->
      <ul  data-color="white">
        <li data-coords="4.8,74.2"></li>
        <li data-coords="4.8,73.2"></li>
  			<li data-coords="4.8,71.7"></li>
  			<li data-coords="4.8,70.6"></li>
  			<li data-coords="3.3,70.6"></li>
  			<li data-coords="1.9,70.6"></li>
      </ul>

      <ul  data-color="white">
  			<li data-coords="3.3,70.6"></li>
  			<li data-coords="3.3,72.9"></li>
      </ul>
      <!-- DARI PATAL SENAYAN NAIK KE ATAS TERUS BLEOK KIRI -->
      <ul data-color="white">
        <li data-coords="4.8,70.6"></li>
        <li data-coords="4.8,68.3">Hotel Mulia</li>
        <li data-coords="4.8,67"></li>
        <li data-coords="4.5,65.85"></li>
        <li data-coords="4.2,64.85"></li>
        <li data-coords="4.5,64.1"></li>
        <li data-coords="2.9,64.1"></li>
      </ul>
      <!-- SAMBA FUTSAL KE ATAS -->
      <ul data-color="white">
        <li data-coords="2.5,69"></li>
        <li data-coords="3.35,66.925"></li>
        <li data-coords="4.2,64.85"></li>
      </ul>

      <!-- GBK KE ATAS -->
      <ul data-color="white">
        <li data-coords="5.9,70.6"></li>
        <li data-coords="6.4,67.8"></li>
        <li data-coords="4.8,68.3"></li>
      </ul>

      <!-- FX KE SEMANGGI -->
      <ul data-color="white">
        <li data-coords="7.5,72.5"></li>
        <li data-coords="9.17,71.6"></li>
        <li data-coords="10.85,70.75"></li>
        <li data-coords="12.5, 70.1">Sudirman SBD</li>
        <li data-coords="14.2,69.5"></li>
        <li data-coords="11.8,68.8"></li>
        <li data-coords="10.85,70.75"></li>
        <li data-coords="13,71.65"></li>
        <li data-coords="14.2,69.5"></li>

      </ul>
      <!-- TVRI KE KANAN TERUS KE BAWAH-->
      <ul data-color="white">
        <li data-coords="6.4,67.8"></li>
        <li data-coords="9.2,67.2"></li>
        <li data-coords="11.8,68.8"></li>
      </ul>
      <!-- PAOPAO KE SCBD ke PP KE CIMB KE SCBD KE GRAND LUCKY KE FX-->
      <ul data-color="white">
        <li data-coords="8.38,74.7"></li>
        <li data-coords="8.2,73.5"></li>
        <li data-coords="10.5,73.2">SCBD</li>
        <li data-coords="10.85,70.75"></li>
        <li data-coords="9.17,71.6"></li>
        <li data-coords="10.5,73.2"></li>
        <li data-coords="8.2,73.5"></li>
        <li data-coords="7.5,72.5"></li>

      </ul>
      <!-- POLDA KE SULTAN HOTEL-->
      <ul data-color="white">
        <li data-coords="13,71.6"></li>
        <li data-coords="12.5, 70.1">Sudirman SBD</li>
        <li data-coords="11.8,68.8"></li>
      </ul>

      <!-- HOLY WINGS KE GATOT SUBROTO -->
      <ul data-color="white">
        <li data-coords="10.725,81"></li>
        <li data-coords="14.725,81"></li>
        <li data-coords="14,83"></li>
        <li data-coords="14.725,81"></li>
        <li data-coords="17.9,81.5"></li>
        <li data-coords="17.2,83"></li>
        <li data-coords="17.9,81.5"></li>
        <li data-coords="20,81"></li>
        <li data-coords="22,80"></li>
        <li data-coords="20,81"></li>
        <li data-coords="20,83.5"></li>
      </ul>

      <!-- POLDA METRO KE GATSU -->
      <ul data-color="white">
        <li data-coords="13,71.6"></li>
        <li data-coords="14.5,73"></li>
        <li data-coords="16,74.4"></li>
        <li data-coords="17.5,75.8"></li>
        <li data-coords="19,77.2"></li>
        <li data-coords="20.5,78.6"></li>
        <li data-coords="22,80"></li>
      </ul>
      <!-- BALAI KARTINI KEBAWAH TERUS KR KIRI TERUS NAIK KE ANOMALI -->
      <ul data-color="white">
        <li data-coords="20.5,78.6"></li>
        <li data-coords="20,81"></li>
        <li data-coords="17.9,81.5"></li>
        <li data-coords="14.725,81"></li>
        <li data-coords="14.725,79.41"></li>
        <li data-coords="14.725,77"></li>
        <li data-coords="12.725,77.82"></li>
        <li data-coords="10.725,77.82"></li>
        <li data-coords="12.725,77.82"></li>

        <li data-coords="14.725,77"></li>
        <li data-coords="12.30,76,05"></li>
        <li data-coords="9.88,75.1"></li>
        <li data-coords="12.30,76,05"></li>
        <li data-coords="10.5,73.2"></li>
        <li data-coords="11.65,73.2"></li>
        <li data-coords="14.5,73"></li>
        <li data-coords="11.65,73.2"></li>
        <li data-coords="14,75"></li>
        <li data-coords="16,74.4"></li>

      </ul>     

      <!--  DARI menara kompas KE KANAN balik lagi ke jakpost baru ke kanan-->
      <ul data-color="white">
        <li data-coords="4.2,64.85"></li>
        <li data-coords="7,63"></li>
        <li data-coords="4.2,64.85"></li>
        <li data-coords="4.5,64.1"></li>
        <li data-coords="6,61.5"></li>
        <li data-coords="9.8,59"></li>
        <li data-coords="11,57"></li>
        <li data-coords="12.2,54.5"></li>
        <li data-coords="14.8,53.6"></li>
      </ul> 
      <!--  DARI BALAI SIDANG KE BPK TERUS SAMPE KE ATAS -->
      <ul data-color="white">
        <li data-coords="9.2,67.2"></li>
        <li data-coords="8.1,65.1"></li>
        <li data-coords="7,63"></li>
        <li data-coords="6,61.5"></li>
        <li data-coords="5.6,60"></li>
        <li data-coords="3.6,60"></li>
        <li data-coords="5.6,60"></li>
        <li data-coords="5.6,58.8"></li>
      </ul>
      <!--  DARI BPK KE karet bivak-->
      <ul data-color="white">
        <li data-coords="7,63"></li>
        <li data-coords="9.4,63"></li>
        <li data-coords="11,62"></li>
        <li data-coords="12.61,62"></li>
        <li data-coords="14.11,62"></li>
        <li data-coords="15.37,62"></li>
      </ul> 
      <!--  DARI balai sidang KE sudirman park-->
      <ul data-color="white">
        <li data-coords="9.2,67.2"></li>
        <li data-coords="11.5,66.5"></li>
        <li data-coords="11.5,65.5"></li>
        <li data-coords="15.7,65.5"></li>
        <li data-coords="15.695,65"></li>

        <li data-coords="15.69,64.6"></li>
        <li data-coords="15.68,63.73"></li>
        <li data-coords="15.67,62.86"></li>

        <li data-coords="15.37,62"></li>
        <li data-coords="15.67,62.86"></li>
        <li data-coords="16.9,62.86"></li>
        <li data-coords="17.5,64.36"></li>
        <li data-coords="15.695,65"></li>

      </ul> 

      <!--  DARI kantor pos indo KE atas terus ketengah terus ke kanan -->
      <ul data-color="white">
        <li data-coords="11.5,65.5"></li>
        <li data-coords="11.25,63.75"></li>
        <li data-coords="11,62"></li>
        <li data-coords="11.25,63.75"></li>
        <li data-coords="9.4,63"></li>
        <li data-coords="11.25,63.73"></li>
        <li data-coords="13.46,63.73"></li>
        <li data-coords="15.68,63.73"></li>
      </ul> 


      <!--  DARI plaza semanggi  KE kanan terrus ke benhil terus ke atas-->
      <ul data-color="white">
        <li data-coords="14.2,69.5"></li>
        <li data-coords="15.9,68.9"></li>
        <li data-coords="13.7,67.7"></li>
        <li data-coords="11.5,66.5"></li>
      </ul> 

      <!-- GATSU KEBAWAH -->
      <ul data-color="white">
        <li data-coords="22,80"></li>
        <li data-coords="24,81"></li>
        <li data-coords="20,81"></li>
        <li data-coords="24,81"></li>
        <li data-coords="26,82"></li>
        <li data-coords="29,82"></li>
        <li data-coords="30.5,82"></li>
        <li data-coords="29,82"></li>
        <li data-coords="29,79.5"></li>
        <li data-coords="29,76.7"></li>
        <li data-coords="29,79.5"></li>
        <li data-coords="26,79.5"></li>
        <li data-coords="26,82"></li>
        <li data-coords="26,79.5"></li>
        <li data-coords="24.5,78.75"></li>
        <li data-coords="23,78"></li>
        <li data-coords="22,80"></li>
        <li data-coords="23,78"></li>


      </ul>
      <!-- rasuna said naik -->
      <ul data-color="white">
        <li data-coords="24.5,78.75"></li>
        <li data-coords="24.5,76"></li>
        <li data-coords="24.5,78.75"></li>
        <li data-coords="23,78"></li>
        <li data-coords="23,75.4"></li>
        <li data-coords="24.5,76"></li>
        <li data-coords="23,75.4"></li>
        <li data-coords="21,75.4"></li>
        <li data-coords="23,78"></li>
        <li data-coords="21,75.4">Grand Kuningan</li>
        <li data-coords="19,77.2"></li>
      </ul>

      <!-- atmajaya  naik -->
      <ul data-color="white">
        <li data-coords="15.9,68.9"></li>
        <li data-coords="17.5,67.9"></li>
        <li data-coords="18.5,66.4"></li>
        <li data-coords="19.4,64.5"></li>
        <li data-coords="20,62.5"></li>
        <li data-coords="17.69,62.25"></li>
        <li data-coords="15.37,62"></li>


      </ul>

      <ul data-color="white">
        <li data-coords="15.7,65.5"></li>
        <li data-coords="15.7,66.5"></li>
        <li data-coords="18.5,66.4"></li>
        <li data-coords="15.7,66.5"></li>
        <li data-coords="17.5,67.9"></li>
        <li data-coords="18,71.5"></li>
        <li data-coords="18.4,74"></li>
        <li data-coords="19,77.2"></li>        
        <li data-coords="18.4,74"></li>

        <li data-coords="21,74"></li>
        <li data-coords="21,75.4"></li>
        <li data-coords="21,74"></li>
        <li data-coords="21,73"></li>
        <li data-coords="19.5,72.5"></li>
        <li data-coords="18,71.5"></li>
        <li data-coords="22.4,71.5"></li>
        <li data-coords="24,71.5"></li>
        <li data-coords="26,71.5"></li>
        <li data-coords="26,73.9"></li>
        <li data-coords="27.8,73.9"></li>
        <li data-coords="26,73.9"></li>
        <li data-coords="24,73.9"></li>

        <li data-coords="23,75.4"></li>
        <li data-coords="24,73.9"></li>

        <li data-coords="22.4,73.9"></li>
        <li data-coords="21,73"></li>-
      

      </ul>

      <ul data-color="white">
        <li data-coords="24,73.9"></li>
        <li data-coords="24,71.5"></li>
        <li data-coords="26,71.5"></li>
        <li data-coords="26.4,68.1"></li>
        <li data-coords="23.8,67.4"></li>
        <li data-coords="24,69.7"></li>
        <li data-coords="23,69.7"></li>
        <li data-coords="24,69.7"></li>
        <li data-coords="24,71.5"></li>
    
      </ul>

      <ul data-color="white">
        <li data-coords="23.8,67.4"></li>
        <li data-coords="23.3,64.4"></li>
        <li data-coords="22.8,62.9"></li>
        <li data-coords="20,62.5"></li>
        <li data-coords="19.4,64.5"></li>
        <li data-coords="20.4,64.5"></li>
        <li data-coords="23.3,64.4"></li>
        <li data-coords="22.8,62.9"></li>
        <li data-coords="25.6,63.2"></li>

      </ul>
      <ul data-color="white">
        <li data-coords="15.37,62"></li>
        <li data-coords="15,60.4"></li>
        <li data-coords="14,60.4"></li>
        <li data-coords="15,60.4"></li>
        <li data-coords="14.8,59.4"></li>
        <li data-coords="14.8,57.8"></li>
        <li data-coords="17,57.8"></li>
        <li data-coords="17,58.8"></li>
        <li data-coords="17,57.8"></li>

        <li data-coords="18.5,57.8"></li>
        <li data-coords="20,57.8"></li>
        <li data-coords="21,57.8"></li>
        <li data-coords="22.8,57.8"></li>
        <li data-coords="21,57.8"></li>
        <li data-coords="20,57.8"></li>
        <li data-coords="22.8,60.2"></li>
        <li data-coords="20,57.8">Bunderan HI</li>
        <li data-coords="21,57.8"></li>
        <li data-coords="20,59.8"></li>

      </ul>
      <ul data-color="white">
        <li data-coords="20,62.5"></li>
        <li data-coords="20,61.5"></li>
        <li data-coords="20,59.8"></li>
        <li data-coords="20,57.8">Bunderan HI</li>
        <li data-coords="20,59.8"></li>
        <li data-coords="20,61.5"></li>
        <li data-coords="22.8,61.5"></li>

      </ul>
      <ul data-color="white">
        <li data-coords="22.8,62.9"></li>
        <li data-coords="22.8,61.5"></li>
        <li data-coords="22.8,60.2"></li>
        <li data-coords="22.8,57.8"></li>
      </ul>
      <ul data-color="white">
        <li data-coords="25.6,63.2"></li>
        <li data-coords="25.6,61.5"></li>
        <li data-coords="23.8,61.5"></li>
        <li data-coords="22.8,61.5"></li>
        <li data-coords="23.8,61.5"></li>
        <li data-coords="25.6,61.5"></li>
        <li data-coords="25.6,60.2"></li>
        <li data-coords="24.6,60"></li>
        <li data-coords="23.8,61.5"></li>
        <li data-coords="24.6,60"></li>
        <li data-coords="22.8,60.2"></li>
        <li data-coords="24.6,60">gereja menteng</li>

        <li data-coords="25,59"></li>
        <li data-coords="25.6,60.2"></li>
        <li data-coords="25,59"></li>
        <li data-coords="25,57.8"></li>
        <li data-coords="22.8,57.8"></li>

      </ul>

      <ul data-color="white">
        <li data-coords="14.8,57.8"></li>
        <li data-coords="14.8,54.6"></li>
        <li data-coords="14.8,53.6"></li>
        <li data-coords="14.4,52.6"></li>
        <li data-coords="14.8,53.6"></li>
        <li data-coords="16.6,53.6"></li>
        <li data-coords="20,53.6"></li>
        <li data-coords="20,57.8">Bunderan HI</li>
        <li data-coords="20,53.6"></li>
        <li data-coords="21,53.6"></li>
        <li data-coords="21,54.6">Sarinah</li>
        <li data-coords="21,57.8"></li>
        <li data-coords="21,53.6"></li>
        <li data-coords="23.7,53"></li>
        <li data-coords="22.8,54.6"></li>
        <li data-coords="21,54.6">Sarinah</li>
        <li data-coords="22.8,54.6"></li>
        <li data-coords="22.8,55.6"></li>
        <li data-coords="21,54.6">Sarinah</li>
        <li data-coords="22.8,55.6"></li>
        <li data-coords="22.8,57.8"></li>
        

      </ul>

      <ul data-color="white">
        <li data-coords="21,53.6"></li>
        <li data-coords="21,51.6"></li>
        <li data-coords="23.4,51.6"></li>
        <li data-coords="21,51.6"></li>
        <li data-coords="20,51.6"></li>
        <li data-coords="20,53.6"></li>
        <li data-coords="20,51.6"></li>
        <li data-coords="18.1,51.6"></li>
        <li data-coords="20,51.6"></li>
        <li data-coords="20,50">Monas</li>
        <li data-coords="21,50"></li>
        <li data-coords="21,51.6"></li>
        <li data-coords="21,50"></li>
        <li data-coords="23.3,50"></li>

      </ul>

        <ul data-color="#4A89F3">

        <?php  
            while(! feof($file))
              {
              $z = fgets($file);
              ?>
            
            <li data-coords="<?php echo $z ?>"></li>
        <?php
            
            }

            fclose($file);
        ?>
        <!-- COLOR CODE SOFT RED #ff6961 <-->
        </ul>

        <!-- GANJIL GENAP 1 -->
        <ul data-color="yellow">
        <?php  
            while(! feof($file2))
              {
              $z = fgets($file2);
              ?>
            
            <li data-coords="<?php echo $z ?>" data-dir="N"></li>
        <?php
            
            }

            fclose($file2);
        ?>
      </ul>

      <!-- GANJIL GENAP 2 -->
        <ul data-color="yellow">
        <?php  
            while(! feof($file3))
              {
              $z = fgets($file3);
              ?>
            
            <li data-coords="<?php echo $z ?>" data-dir="N"></li>
        <?php
            
            }

            fclose($file3);
        ?>
      </ul>

      <!-- GANJIL GENAP 3 -->
        <ul data-color="yellow">
        <?php  
            while(! feof($file4))
              {
              $z = fgets($file4);
              ?>
            
            <li data-coords="<?php echo $z ?>" data-dir="N"></li>
        <?php
            
            }

            fclose($file4);
        ?>
      </ul>

      <!-- GANJIL GENAP 4 -->
        <ul data-color="yellow">
        <?php  
            while(! feof($file5))
              {
              $z = fgets($file5);
              ?>
            
            <li data-coords="<?php echo $z ?>" data-dir="N"></li>
        <?php
            
            }

            fclose($file5);
        ?>
      </ul>


      <!--
      <ul data-color="#4A89F3">
        <li data-coords="3.8,76.2"></li>
        <li data-coords="4.8,77.2" data-dir="S"></li>
      </ul>
    -->
    </div>

    <canvas id="myCanvas" style="z-index: 0" width="700" height="1400" style="border:1px solid #d3d3d3;">
Your browser does not support the HTML5 canvas tag.</canvas>
    <script>
      var c = document.getElementById("myCanvas");
      var ctx = c.getContext("2d");
      ctx.fillStyle = " #90EE90";
      ctx.fillRect(20, 20, 1000, 2000);


    </script>
    <script>
      var canvas = document.getElementById("myCanvas");
      var ctx = canvas.getContext("2d");
      ctx.font = "8px Arial";
      ctx.fillStyle = "black";
      ctx.fillText("Taman Ayodya", 20, 1320);
      ctx.fillText("Pertamina Hospital", 22, 1202);
      ctx.fillText("SMA 70", 44, 1240);
      ctx.fillText("Blok M Plaza", 100, 1280);
      ctx.fillText("Pasaraya", 120, 1270);
      ctx.fillText("Iskandar Syah", 130, 1320);
      ctx.fillText("Museum Polisi", 110, 1225);
      ctx.fillText("Holy Wings", 175, 1205);
      ctx.fillText("Zen", 195, 1150);
      ctx.fillText("SMKN 6", 200, 1275);
      ctx.fillText("MRT Blok M", 80, 1320);
      ctx.fillText("MRT Asean", 45, 1173);
      ctx.fillText("Rot. Eddy", 100, 1190);
      ctx.fillText("Jl. Sriwijaya", 140, 1170);
      ctx.fillText("Jl. Matraman", 135, 1106);
      ctx.fillText("Sisingamaraja", 70, 1106);
      ctx.fillText("Jl. Daksa 4", 160, 1125);
      ctx.fillText("Tirtayasa", 175, 1230);
      ctx.fillText("Pakubuwono", 30, 1130);
      ctx.fillText("Anomali", 190, 1086);
      ctx.fillText("Office 8", 160, 1080);
      ctx.fillText("Paopao", 135, 1090);
      ctx.fillText("Binus JWC", 25, 1085);
      ctx.fillText("Fairmont", 100, 1020);
      //ctx.fillText("FXSudirman", 150, 1040);
      ctx.fillText("Sen.Resid", 24, 1046);
      ctx.fillText("Senayan City", 45, 1058);
      ctx.fillText("JJ Sport", 20, 1018);
      ctx.fillText("GBK", 123 ,1005);
      ctx.fillText("Patal Senayan", 60, 995);
      ctx.fillText("TVRI", 130, 958 );
      ctx.fillText("Samba Futsal", 20, 975);
      ctx.fillText("Gramed. Palm", 20, 935);
      ctx.fillText("Lapangan Temb. Senay.", 75, 935);
      ctx.fillText("Jakarta Post", 15, 880);
      ctx.fillText("Menara Kompas", 20, 895);
      ctx.fillText("SMA 24", 95, 910);
      ctx.fillText("Palmerah Market", 50, 865);
      ctx.fillText("CIMB Niaga", 140, 1020);
      ctx.fillText("Pacific Place", 165, 1005);
      ctx.fillText("Plaza Semanggi", 282, 990);
      ctx.fillText("Balai Sidang", 155, 952);
      ctx.fillText("Grand Lucky", 130, 1070);
      ctx.fillText("Sultan Hotel", 185, 972);
      ctx.fillText("FX Sudirman", 120, 1045);
      //
      ctx.fillText("Jl. Erlannga", 240, 1155);
      ctx.fillText("Jl. Senopati", 210, 1120);
      ctx.fillText("Jl. Ciregil", 297, 1140);
      ctx.fillText("Blok S", 300, 1180);
      ctx.fillText("Inacraft Plaza", 240, 1220);
      ctx.fillText("Jl. Wijaya", 240, 1250);
      ctx.fillText("Jl. Wijaya 2", 320, 1260);
      ctx.fillText("Mampang Prapatan", 370, 1270);
      ctx.fillText("Gereja Santa", 320, 1210);
      ctx.fillText("Tendean", 370, 1205);
      //ctx.fillText("Gatot Subroto", 430, 1205);
      ctx.fillText("Balai Kartini", 360, 1165);
      ctx.fillText("Telkomsel   Tower", 340, 1138);
      ctx.fillText("Hotel Kartika", 310, 1110);
      ctx.fillText("Komplek Mentari", 250, 1100);
      ctx.fillText("BPJS", 305, 1092);
      ctx.fillText("E. City", 220, 1062);
      ctx.fillText("Polda Metro", 220, 1030);
      ctx.fillText("Samsat  Jakarta", 265, 1062);
      //
      ctx.fillText("Atmajaya", 315, 980);
      ctx.fillText("Benhil", 250, 950);
      ctx.fillText("Pasar Benhil", 205, 935);
      ctx.fillText("Kantor Pos Indo", 180, 905);
      ctx.fillText("DPR / MPR", 170, 895);
      ctx.fillText("Pejompongan", 155, 860);
      ctx.fillText("Penjernihan", 170, 830);
      ctx.fillText("KPP Pratama", 210, 820);
      ctx.fillText("Kemen. Pekerjaan", 230, 840);
      ctx.fillText("Karet Bivak", 290, 820);
      ctx.fillText("KH. Mas Mansyur ", 250, 850);
      ctx.fillText("LSPR", 290, 858);
      ctx.fillText("Istana Sahit", 268, 887);
      ctx.fillText("Sudirman    Park", 275, 910);
      ctx.fillText("GBI Pertambulon", 235, 878);
      ctx.fillText("GBI", 205, 870);
      ctx.fillText("STU Telkom", 330, 845);
      ctx.fillText("Pavvilion", 355, 880);
      ctx.fillText("BPK", 115, 850);
      ctx.fillText("JDC", 100, 825);
      ctx.fillText("S. Parman", 70, 785);
      ctx.fillText("Rawa Belong", 20, 795);
      ctx.fillText("Anggrek Garuda", 50, 765);

      ctx.fillText("Paramadina Univ.", 420, 1220);
      ctx.fillText("Medistra", 500, 1240);
      ctx.fillText("All Fresh", 555, 1240);
      ctx.fillText("Pancoran", 600, 1240);
      ctx.fillText("Yasporti", 585, 1185);
      ctx.fillText("Rasamala", 585, 1130);
      ctx.fillText("Jaya Mandala", 520, 1175);
      ctx.fillText("Rasuna Said", 495, 1160);
      ctx.fillText("Villa Pertamina", 495, 1110);
      ctx.fillText("Gedung Granadi", 460, 1095);
      ctx.fillText("Sing.Embassy", 410, 1155);

      ctx.fillText("Gatot Subroto", 445, 1190);
      ctx.fillText("Gatot Subroto", 445, 1190);
      ctx.fillText("Lotte Kun.", 330, 1075);
      ctx.fillText("Mega Kun.", 380, 1080);
      ctx.fillText("Kun. City", 430, 1080);
      ctx.fillText("Trow. Casa", 470, 1080);
      ctx.fillText("Menteng Duta", 520, 1080);
      ctx.fillText("Kota Casablanca", 550, 1060);
      ctx.fillText("Stasiun Kuningan", 525, 1025);
      ctx.fillText("Pla. Fes.", 485, 1030);
      ctx.fillText("Grand Futsal", 405, 1030);
      ctx.fillText("Menara Baru Mega", 395, 980);
      ctx.fillText("Setiabudi", 485 , 985);
      ctx.fillText("Alluna Tower", 425 , 940);
      ctx.fillText("Kuningan Place", 533 , 955);
      ctx.fillText("House Rooftop", 470 , 880);
      ctx.fillText("Jl. Setiabudi 3", 400 , 890);
      ctx.fillText("Indofood Tower", 330 , 890);
      ctx.fillText("Setiabudi Astra", 375 , 920);
      ctx.fillText("Sampoerna Strategic", 355 , 950);
      ctx.fillText("Hot. Shangrilla", 330, 830);
      ctx.fillText("Jl. M.H. Tham.", 390, 855);
      ctx.fillText("Jl. Galunggung" ,420, 840);
      ctx.fillText("GKI Menteng" ,515, 855);
      ctx.fillText("Tokopedia", 310, 1025);
      ctx.fillText("Hot. Raffles", 390, 1040);
      ctx.fillText("Ambassador", 420, 1047);
      ctx.fillText("City Walk", 275, 925);

      ctx.fillText("Jl. Latuhartory" ,515, 827);
      ctx.fillText("Banyumas" ,515, 800);
      ctx.fillText("Sunda Kelapa" ,505, 770);
      ctx.fillText("Aston Martin Indonesia" ,505, 750);
      ctx.fillText("Dukuh Atas", 355, 820);
      ctx.fillText("N. Korea Embassy", 385, 830);
      ctx.fillText("Jl. Subang", 460, 830);
      ctx.fillText("Imam Bonjol" ,410, 800);
      ctx.fillText("UOB" ,380, 790);
      ctx.fillText("Jl. SultanSyahrir" ,460, 760);
      ctx.fillText("Hotel Pullman" ,415, 740);
      ctx.fillText("GI" ,365, 740);
      ctx.fillText("TamCit" ,325, 740);
      ctx.fillText("Kebon Kacang" ,240, 750);
      ctx.fillText("Thamrin Residence" ,310, 770);
      ctx.fillText("masjid At-Taqwa" ,300, 780);
      ctx.fillText("SMPN 70" ,300, 800);
      ctx.fillText("Komplek PLN" ,230, 800);
      ctx.fillText("MNC" ,275, 685);
      ctx.fillText("Grand City" ,255, 665);
      ctx.fillText("Cideng Barat" ,235, 640);
      ctx.fillText("Jl.Wahid Hasyim" ,315, 675);
      ctx.fillText("BPP RI" ,370, 660);
      ctx.fillText("Baitul Insan" ,315, 625);
      ctx.fillText("Bank Ind." ,365, 635);
      ctx.fillText("Kebon Sirih" ,425, 630);
      ctx.fillText("MNC Tower" ,475, 625);
      ctx.fillText("USA Embassy" ,475, 595);
      ctx.fillText("BUMN" ,415, 585);
      ctx.fillText("Masjid Cut Meutia" ,475, 655);
      ctx.fillText("Jl. Sumatera" ,465, 685);
      ctx.fillText("Gereja Theresia" ,465, 705);
      ctx.fillText("Jakarta XXI" ,425, 670);
      ctx.fillText("Taman Petamburan" ,200, 775);

      ctx.fillText("Jl. Petamburan" ,160, 730);
      ctx.fillText("Jati Bunder" ,200, 675);




    </script>
    <script type="text/javascript">
        $(".subway-map").subwayMap({ debug: true });
    </script>
    <script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = ["Pertamina Hospital","KMO","PLN","Museum Polisi","Jl. Gunawarman","Holy Wings","Tirtayasa","SMKN 6","Iskandar Syah","MRT Blok M","Taman Ayodya","SMA 70","Blok M Plaza","Pasaraya","Zen","Jl. Pattimura","Bunderan Senayan","Sisingamaraja","Al-Azhar","Rotbar Eddy","Jl. Sriwijaya","MRT Asean","Pakubuwono","Jl. Matraman","Jl. Daksa 4","Anomali","Office 8","Paopao","Binus JWC","FX Sudirman","Fairmont","Senayan City","PatalSenayan","GBK","Mag. Indo","Senayan Residence","JJ Sport","Hotel Mulia","Lapangan Temb. Senay.","SMA 24","Menara Kompas","Palmerah Market","Jakarta Post","Samba Futsal","Gramed. Palm","TVRI","SCBD","CIMB Niaga","Pacific Place","Sudirman SBD","Plaza Semanggi","Polda Metro","Balai Sidang","Grand Lucky","Sultan Hotel","Samsat Jakarta","Electronic City","Komplek Mentari","BPJS","Hotel Kartika","Telkomsel Tower","Balai Kartini","Gatot Subroto","Tendean","Mampang Prapatan","Gereja Santa","Jl. Wijaya 2","Inacraft Plaza","Jl. Wijaya","Blok S","Jl. Ciregil","Jl. Erlangga","Jl. Senopati","Anggrek Garuda","Rawa Belong","S. Parman","JDC","A","B","C","BPK","DPR / MPR","Balai Sidang","Pasar Benhil","Kantor Pos Indo","GBIP","Pejompongan","Penjernihan","KPP Pratama","Kemen. Pekerjaan","Karet Bivak","KH. Mas Mansyur","City Walk","LSPR","Gang Kecil","Sudirman Park","Atmajaya","Benhil","STU Telkom","Pavillion","GBI Pertambulon","Paramadina Univ.","Medistra","All Fresh","Pancoran","Yasporti","Rasamala","Jaya Mandala","Rasuna Said","Singapore Embassy","Villa Pertamina","Gedung Granadi","Grand Kuningan","Hotel Shangrilla","Jl.M.H. Thamrin","Jl. Galunggung","GKI Menteng","Indofood Tower","Jl. Setiabudi 3","House Rooftop","Setiabudi Astra","Alluna Tower","Sampoerna Strategic","Tokopedia","Menara Baru Mega","Setia budi","Kuningan Place","Stasiun Kuningan","Plaza Festival","Grand Futsal","Hotel Raffless","Ambassador","Lotte Kuningan","Mega Kuningan","Kuningan City","Menteng Duta","Trowongan Casablanca","Kota Casablanca","Istana Sahit","Jl. Latuhartory","Jl. Subang","North Korea Embassy","Dukuh Atas","Aston Martin Indonesia","Sunda Kelapa","Gereja Menteng","Banyumas","SMPN 70","Komplek PLN","Masjid At-Taqwa","Kebon Kacang","Thamrin Residence","B2","Thamrin City","Grand Indonesia","Bunderan HI","Hotel Pullman","Sultan Syahrir","Imam Bonjol","UOB","MNC","Cideng Barat","Grand City","Jl.Wahid Hasyim","BPP RI","Jakarta XXI","Masijd Cut Meutia","Jl.Sumatera","Sarinah","Kebon Sirih","MNC Tower","Bank Indonesia","Baitul Insan","BUMN","USA Embassy","Taman Petamburan","Jl.Petamburan","Jati Bunder","Monas","Gereja Theresia"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
autocomplete(document.getElementById("myInput2"), countries);
</script>
</body>
</html>
