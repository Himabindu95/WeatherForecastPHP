<?php 
    if(isset($_GET['time'])){
        $forecast_api = "ed9ed5bf8bb45f8f8a780fb55f6eea63";
        $detailforecastsapi = "https://api.darksky.net/forecast/".$forecast_api."/".$_GET['time']."?exclude=minutely";
        $detailforecastresp = file_get_contents($detailforecastsapi);
        $detailforecastjson = json_decode($detailforecastresp);
        $jsonobj = json_encode($detailforecastjson, JSON_PRETTY_PRINT);
        echo $jsonobj;
        exit();
    }
?>
<html>
    <head>
        <title>HW6 571</title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            var req = new XMLHttpRequest();
            req.open("POST", "http://ip-api.com/json", false);
            req.send();
            jsonDoc = JSON.parse(req.responseText);
            var latlongvalues = jsonDoc.lat+","+jsonDoc.lon+","+jsonDoc.city;
            
            function weathercontainervalidation(){
                if(document.getElementById('curloc').checked == false){
                    if(document.getElementById('streetid').value == ''){
                            document.getElementById('streetid').style.border= "1px solid red";
                    }
                    else{
                        document.getElementById('streetid').style.border= "";
                    }
                    
                    if(document.getElementById('cityid').value == ''){
                            document.getElementById('cityid').style.border= "1px solid red";
                    }
                    else{
                        document.getElementById('cityid').style.border= "";
                    }
                    
                    if(document.getElementById('stateid').options[document.getElementById('stateid').selectedIndex].value == 0){
                            document.getElementById('stateid').style.border= "1px solid red";
                    }
                    else{
                        document.getElementById('stateid').style.border= "";
                    }
                    
                    if(document.getElementById('streetid').value == '' || document.getElementById('cityid').value == '' || document.getElementById('stateid').options[document.getElementById('stateid').selectedIndex].value == 0){
                        document.getElementById('mainresults').innerHTML = "<div id='error'>Please check the input address.</div>"
                        return false;
                    }
                }
                else{
                        document.getElementById('curloc').value = latlongvalues;
                        return true;
                }
            }
            
        </script>
        
        <style>
            .weather-container{
                background-color: #32AB38;
                margin: 0 auto;
                width: 820px;
                color: white;
                border-radius: 10px;
                height: 250px;
            }
            .weather-container p{
                text-align: center;
                font-weight: 500;
                font-size: 40px;
                padding: 10px;
                margin: 40px 0 0;
            }
            .main-row{
                    padding: 0 60px;
            }
            .main-row:after{
                content: "";
                display: table;
                clear: both;
            }
            .cols label{
                float:left;
                font-size: 20px;
                font-weight: bold;
                width: 60px;
            }
            #vert-line{
                border-left: 5px solid white;
                height: 130px;
                text-align: center;
                float:left; 
                border-radius: 10px;
            }
             .btns{
                margin-top: 1%;
                padding-bottom: 20px;
                padding-bottom: 20px;
                padding-left: 310px;
                border-width: 2px;
                border-radius: 2px;
            }
            #mainresults{
                margin-top: 30px;
            }
            #error, #zeroresults{
                padding: 5px;
                background-color: #F0F0F0;
                border: 4px solid #AAAAAA;
                margin: 0 auto;
                width: 30%;
                text-align: center;
                font-size: 25px;
                color: black;
            }
            .summarycard{
                background-color: #5EC4F4;
                border-radius: 10px;
                border: 0;
                margin: 0 auto;
                width: 30%;
                color: white;
                padding: 20px;
            }
            .summarycard ul{
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: space-between;
            }
            .summarycard ul li{
                display: inline-block;
                text-align: center; 
            }
            .searchresults{
                margin: 30px auto 0;
                width: 60%;
                background-color: #9fc9ef;
                text-align: center;
                border-collapse:collapse;
                color: white;
                font-weight: bold;
                font-size: 17px;
            }
            .searchresults tr, .searchresults th, .searchresults td{
                border: 2px solid #509DC4;
               
            }
            .searchresults th{
                padding: 10px;
                font-size: 15px;
            }
            .summary{
                text-decoration: none;
                color: white;
            }
            .detailscard{
                margin: 0 auto;
                width: 400px;
                background-color: #a8d0d8;
                color: white;
                padding: 20px 0 0 20px;
                border-radius: 10px;
                height: 360px;
                position: relative;
            }
            input[type=button], input[type=submit]{
                    border-width: 0;
                    border-radius: 5px;
                    background-color: white;
                    padding: 1px;
                    width: 50px;
                    /* font-weight: 600; */
                    font-family: Times New Roman;
                    font-size: 15px;
                    letter-spacing: 0px;
            }
           
        </style>
        
    </head>
    
    <body>
        <?php 
//            $dropdownStateName = array();
//            $dropdownAbbreviation = array();
//            $states_file = file_get_contents('http://csci571.com/hw/hw6/States.txt');
//            $states = json_decode($states_file,true);
//            for($i=0; $i<=50; $i++){
//                foreach($states as $obj){
//                    array_push($dropdownStateName, $obj[$i]['State']);
//                    array_push($dropdownAbbreviation, $obj[$i]['Abbreviation']);
//                }
//            }          
        ?>
        
        <div class="weather-container">
            <p><i>Weather Search</i></p>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" id="weather-form" name="weatherforform"> <!--Loads the same script on submit-->
                <div class="main-row">
                    <div class="cols" style="float:left; width: 55%;">
                        <div style="margin-bottom: 30px;">
                            <label>Street</label>
                            <input style="float:left;padding: 3px;" type="text" name="street" id="streetid">
                        </div>
                        <div style="margin-bottom: 60px;">
                            <label>City</label>
                            <input style="float:left;padding: 3px;" type="text" name="city" id="cityid">
                        </div>
                        <div>
                            <label>State</label>
                            <select style="float:left;padding: 3px; width: 225px;" type="text" name="states" id="stateid">
                                <option value="0" selected>State</option>
                                <option disabled>----------------------------------------------------</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                    </div>
                    <div class="cols" id="vert-line"></div>
                    <div class="cols" style="float:right; width: 30%;">
                        <input type="checkbox" id="curloc" name="currentloc" <?php if(isset($_POST['currentloc'])) echo "checked";?> onchange="document.getElementById('streetid').value = ''; document.getElementById('cityid').value = ''; document.getElementById('stateid').value = '0'; document.getElementById('streetid').disabled = this.checked; document.getElementById('cityid').disabled = this.checked; document.getElementById('stateid').disabled = this.checked; document.getElementById('streetid').style.border= ''; document.getElementById('cityid').style.border = ''; document.getElementById('stateid').style.border='';"  />
                        <span style="font-size: 20px;font-weight: bold;">Current Location</span> 
                    </div>
                </div>
                <div class="btns">
                    <input type="submit" name="submit" value="search" onclick = 'return weathercontainervalidation();'>
                    <input type="button" value="clear" onclick="document.getElementById('weather-form').reset(); document.getElementById('streetid').disabled = false; document.getElementById('cityid').disabled = false; 
                        document.getElementById('stateid').disabled = false; document.getElementById('mainresults').innerHTML = ''; document.getElementById('stateid').style.border='';  document.getElementById('cityid').style.border=''; document.getElementById('streetid').style.border=''; document.getElementById('curloc').checked = false;">
                </div>
            </form>
        </div>
        
        <div id="mainresults">
            <?php
                if(isset($_POST['submit'])){
                    $google_api = "AIzaSyDM_OAxmPyyZmuMuvqjmx5yZfu5irlziQk";
                    $forecast_api = "ed9ed5bf8bb45f8f8a780fb55f6eea63";
                    $params = array();
                    
                    function weatherforecast($api){
                        $forecast = array();
                        $gresp = file_get_contents($api);
                        $gxml = simplexml_load_string($gresp);
                        $status = $gxml->status;
                        if($status == "ZERO_RESULTS"){ 
                            array_push($forecast, $status); 
                            return $forecast;
                        }
                        else{
                        $geo_lat = $gxml->result->geometry->location->lat;
                        $geo_lng = $gxml->result->geometry->location->lng;
                        array_push($forecast, $status, $geo_lat, $geo_lng);
                        return $forecast;
                        }
                    }
                    
                    if(isset($_POST['currentloc'])){
                        $poststring = $_POST['currentloc'];
                        $postarray = explode(",", $poststring);
                        $gapicall = "https://maps.googleapis.com/maps/api/geocode/xml?address=".urlencode($postarray[0].",".$postarray[1].",".$postarray[2])."&key=".$google_api."";
                        $params = weatherforecast($gapicall);
                        if($params[0] == "ZERO_RESULTS"){
                           $_POST['zeroresults'] = "No results";
                        }
                        else{
                            array_push($params, $postarray[2]);
                        }
                    }
                    
                    if((isset($_POST['street'])) and (isset($_POST['city'])) and (isset($_POST['states']))){
                        $given_street = $_POST['street'];
                        $given_city = $_POST['city'];
                        $given_state = $_POST['states'];  // Storing Selected Value In Variable
                        $add = $given_street.",".$given_city.",".$given_state."";
                        $gapicall = "https://maps.googleapis.com/maps/api/geocode/xml?address=".urlencode($add)."&key=".$google_api."";
                        $params = weatherforecast($gapicall);
                        if($params[0] == "ZERO_RESULTS"){
                            $_POST['zeroresults'] = "No results";
                        }
                        else{
                            array_push($params, $given_city);
                        }
                    }
                    if($params[0] == "ZERO_RESULTS"){ ?>
                        <div id='zeroresults'>Weather Forecast is not available for this address</div>
            <?php 
                    }
                    else{
                    $forecastapicall = "https://api.forecast.io/forecast/".$forecast_api."/".$params[1].",".$params[2]."?exclude=minutely,hourly,alerts,flags";
                    $forecastresp = file_get_contents($forecastapicall);
                    $forecastjson = json_decode($forecastresp);
            ?>
                    <div class="summarycard">
                        <h1 style="margin:0;"><?php echo ucwords(strtolower($params[3])); ?></h1>
                        <h5 style="margin:0;"><?php echo $forecastjson->timezone;?></h5>
                        <h1 style="font-size: 6em; margin: 0;"><?php echo round($forecastjson->currently->temperature);?><img src="https://cdn3.iconfinder.com/data/icons/virtual-notebook/16/button_shape_oval-512.png" alt="tempsymbol" width="15" height="15" style="vertical-align: 60px;"><span style="font-size: 50px;">F</span></h1>
                        <h2 style="margin: 0 0 20px; font-size: 2em;"><?php echo $forecastjson->currently->summary;?></h2>
                        <ul>
            <?php
                            if($forecastjson->currently->humidity != "" or $forecastjson->currently->humidity != NULL){ 
            ?>
                            <li>
                                <div><img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-16-512.png" alt="humidity" title="Humidity" height="25" width="25"></div>
                                <div style="font-weight: bold; font-size: 20px;"><?php echo $forecastjson->currently->humidity;?></div>
                            </li>
            <?php
                            }
                            if($forecastjson->currently->pressure != "" or $forecastjson->currently->pressure != NULL){ 
                ?>
                                <li>
                                    <div><img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-25-512.png" alt="pressure" title="Pressure" height="25" width="25"></div>
                                    <div style="font-weight: bold; font-size: 20px;"><?php echo $forecastjson->currently->pressure;?></div>
                                </li>
                <?php
                            }
                            if($forecastjson->currently->windSpeed != "" or $forecastjson->currently->windSpeed != NULL){ 
                ?>
                                <li>
                                    <div><img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-27-512.png" alt="windSpeed" title="WindSpeed" height="25" width="25"></div>
                                    <div style="font-weight: bold; font-size: 20px;"><?php echo $forecastjson->currently->windSpeed;?></div>
                                </li>
                <?php
                            }
                            if($forecastjson->currently->visibility != "" or $forecastjson->currently->visibility != NULL){ 
                ?>
                                <li>
                                    <div><img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-30-512.png" alt="visibility" title="Visibility" height="25" width="25"></div>
                                    <div style="font-weight: bold; font-size: 20px;"><?php echo $forecastjson->currently->visibility;?></div>
                                </li>
                 <?php
                            }
                    if($forecastjson->currently->cloudCover != "" or $forecastjson->currently->cloudCover != NULL){ 
                ?>
                                <li>
                                    <div><img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-28-512.png" alt="cloudCover" title="CloudCover" height="25" width="25"></div>
                                    <div style="font-weight: bold; font-size: 20px;"><?php echo $forecastjson->currently->cloudCover;?></div>
                                </li>
                <?php
                    }
                            if($forecastjson->currently->ozone != "" or $forecastjson->currently->ozone != NULL){ 
                ?>
                                <li>
                                    <div><img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-24-512.png" alt="ozone" title="Ozone" height="25" width="25"></div>
                                    <div style="font-weight: bold; font-size: 20px;"><?php echo $forecastjson->currently->ozone;?></div>
                                </li>
                        <?php
                            }
                    ?>
                    </ul>
            </div>
            
            <table class="searchresults">
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Summary</th>
                    <th>TemperatureHigh</th>
                    <th>TemperatureLow</th>
                    <th>Wind Speed</th>
                </tr>
                <?php 
                    foreach($forecastjson->daily->data as $obj){ 
                ?>
                        <tr>
                            <td><?php echo date("Y-m-d", $obj->time);?></td>
                            <td>
                                <?php 
                                    if($obj->icon == "clear-day" || $obj->icon == "clear-night"){
                                ?>
                                    <img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-12-512.png" alt="clear-day" height="45" width="45"/>
                                <?php
                                    }
                                    if($obj->icon == "rain"){ 
                                ?>
                                    <img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-04-512.png" alt="rain" height="45" width="45"/>
                                <?php
                                    }
                                    if($obj->icon == "snow"){ 
                                ?>
                                    <img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-19-512.png" alt="snow" height="45" width="45"/>
                                <?php
                                    }
                                    if($obj->icon == "sleet"){
                                ?>
                                    <img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-07-512.png" alt="sleet" height="45" width="45"/>

                                <?php
                                    }
                                    if($obj->icon == "wind"){ 
                                ?>
                                    <img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-27-512.png" alt="wind" height="45" width="45"/>
                                <?php  
                                    }
                                    if($obj->icon == "fog"){ 
                                ?>
                                    <img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-28-512.png" alt="fog" height="45" width="45"/>
                                <?php 
                                    }
                                    if($obj->icon == "cloudy"){ 
                                 ?>
                                    <img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-01-512.png" alt="cloudy" height="45" width="45"/>
                                <?php   
                                    }
                                    if($obj->icon == "partly-cloudy-day" || $obj->icon == "partly-cloudy-night"){ 
                                 ?>
                                    <img src="https://cdn2.iconfinder.com/data/icons/weather-74/24/weather-02-512.png" alt="partly-cloudy-day or partly-cloudy-night" height="45" width="45"/>
                                <?php   
                                    }
                                 ?>
                            </td>
                            <td>
                                <?php global $params; ?>
                                <a class="summary" href="#" name="anchor" id="anc" onclick="dailydetails(<?php echo $params[1]; ?>,<?php echo $params[2]; ?>,<?php echo $obj->time; ?>)"><?php echo $obj->summary; ?></a>
                            </td>
                            <td><?php echo $obj->temperatureHigh; ?></td>
                            <td><?php echo $obj->temperatureLow; ?></td>
                            <td><?php echo $obj->windSpeed; ?></td>
                        </tr>
                <?php } ?>
            </table>
                    
            
        <?php
                }
            }
        ?>
        </div>
        <script type="text/javascript">
            function dailydetails(latitude, longitude, time){
                var xmlhttp = new XMLHttpRequest(); 
                xmlhttp.onreadystatechange = function() { 
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) { 
                        jsonDoc = JSON.parse(xmlhttp.responseText); 
                        
                        document.getElementById('mainresults').innerHTML = generateHTML(jsonDoc)

                    } 
                }; 
                var parameters = latitude+","+longitude+","+time;
                xmlhttp.open("GET", "<?php echo $_SERVER['PHP_SELF'];?>?time="+parameters , false); 
                xmlhttp.send(parameters);
                
                var hourlydata = jsonDoc.hourly.data;
                var hourly = [];
                for(var i=0; i<hourlydata.length; i++){
                    h = hourlydata[i];
                    hourly.push(h.temperature);
                }
             
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {
                    var data1=[];
                    var Header= ['Time', 'T'];
                    data1.push(Header);
                    var array = JSON.parse("["+hourly+"]")
                    for (var j = 0; j < array.length; j++) {
                        var temp=[];
                        temp.push(j,array[j]);
                        data1.push(temp);
                    }
                    var data = new google.visualization.arrayToDataTable(data1);
                      var options = {
                        vAxis: { 
                            textPosition: 'none',
                            title: 'Temperature',
                        },
                        hAxis: {
                            title: 'Time',
                        },
                        width: 700,
                        height: 200,
                        curveType: 'function',
                        legend: { position: 'right' },
                        colors: ['#9CCED7']
                    };
                    var chart = new google.visualization.LineChart(document.getElementById('google-chart'));
                    chart.draw(data, options);
                  }
                }
            
            function generateHTML(jsonDoc){
                summary = jsonDoc.currently.summary;
                temperature = Math.round(jsonDoc.currently.temperature);
                icon = jsonDoc.currently.icon;
                precipitation = jsonDoc.currently.precipIntensity;
                chanceofrain = Math.round(jsonDoc.currently.precipProbability*100);
                windspeed = jsonDoc.currently.windSpeed;
                humidity = Math.round(jsonDoc.currently.humidity*100);
                visibility = jsonDoc.currently.visibility;
                timezone = jsonDoc.timezone;
                sunrisesunset = jsonDoc.daily.data
                sunriseUTC = sunrisesunset[0]['sunriseTime']
                var sunriseTime = new Date(sunriseUTC*1000).toLocaleString("en-US", {timeZone: timezone});
                sunriseTime = new Date(sunriseTime);
                sunrise = sunriseTime.getHours();
                sunsetUTC =  sunrisesunset[0]['sunsetTime']
                var sunsetTime = new Date(sunsetUTC*1000).toLocaleString("en-US", {timeZone: timezone});
                sunsetTime = new Date(sunsetTime);
                sunset = ((sunsetTime.getHours())%12);
                var html="<h1 style='margin: 0 auto;width: 290px;margin-bottom: 20px;'>Daily Weather Detail</h1><div class='detailscard'>"
                        html += "<div style='height: 180px;'><div style='float: left; width: 50%;'><h3 style='font-size: 30px;margin: 0;margin-top: 40px;word-break: break-word;'>"+summary+"</h3><h1 style='font-size: 5em;margin: 0 !important;'>"+temperature+"<img src='https://cdn3.iconfinder.com/data/icons/virtual-notebook/16/button_shape_oval-512.png' alt='tempsymbol' width='12' height='12' style='vertical-align: 50px;'><span style='font-size: 60px;'>F</span></h1></div><div style='float: right; width: 50%;'>"
                        if(icon == "clear-night" || icon == "clear-day"){
                            html += "<img style='margin-top: -20px;' src='https://cdn3.iconfinder.com/data/icons/weather-344/142/sun-512.png' alt='clear-day or clear-night' height='170' width='170'/>"
                        }
                        if(icon == "rain"){
                           html += "<img style='margin-top: -20px;' src='https://cdn3.iconfinder.com/data/icons/weather-344/142/rain-512.png' alt='clear-day or clear-night' height='170' width='170'/>"
                        }
                        if(icon == "snow"){
                            html += "<img style='margin-top: -20px;'  src='https://cdn3.iconfinder.com/data/icons/weather-344/142/snow-512.png' alt='clear-day or clear-night' height='170' width='170'/>"
                        }
                        if(icon == "sleet"){
                            html += "<img style='margin-top: -20px;'  src='https://cdn3.iconfinder.com/data/icons/weather-344/142/lightning-512.png' alt='clear-day or clear-night' height='170' width='170'/>"
                        }
                        if(icon == "wind"){
                            html += "<img style='margin-top: -20px;'  src='https://cdn4.iconfinder.com/data/icons/the-weather-is-nice-today/64/weather_10-512.png' alt='clear-day or clear-night' height='170' width='170'/>"
                        }
                        if(icon == "fog"){
                            html += "<img style='margin-top: -20px;'  src='https://cdn3.iconfinder.com/data/icons/weather-344/142/cloudy-512.png' alt='clear-day or clear-night' height='170' width='170'/>"
                        }
                        if(icon == "cloudy"){
                            html += "<img style='margin-top: -20px;'  src='https://cdn3.iconfinder.com/data/icons/weather-344/142/cloud-512.png' alt='cloudy' height='170' width='170'/>"
                        }
                        if(icon == "partly-cloudy-day" || icon == "partly-cloudy-night"){
                            html += "<img style='margin-top: -20px;'  src='https://cdn3.iconfinder.com/data/icons/weather-344/142/sunny-512.png' alt='clear-day or clear-night' height='170' width='170'/>"
                        }
                        html += "</div></div>"

                        html+= "<dl style='clear:both;float: right;width: 300px;font-weight: 600;position: absolute;top: 180px;margin-left: 120px;'><dt style='float: left; width: 140px; text-align: right; font-weight: bold; line-height: 25px; padding-right: 5px; font-size: 17px; clear: both;'>Precipitation: </dt><dd style='font-size: 23px; line-height: 27px;'>"
                        if(precipitation<=0.001){
                            html+= "N/A"
                        }
                        if(precipitation>0.001 && precipitation<=0.015){
                            html+= "Very Light"
                        }
                        if(precipitation>0.015 && precipitation<=0.05){
                            html+= "Light"
                        }
                        if(precipitation>0.05 && precipitation<=0.1){
                            html+= "Moderate"
                        }
                        if(precipitation>0.1){
                            html+= "Heavy"
                        }
                        html += "</dd>"
                        html+= "<dt style='float: left; width: 140px; text-align: right; font-weight: bold; line-height: 25px; padding-right: 5px; font-size: 17px; clear: both;'>Chance of Rain: </dt><dd style='font-size: 23px; line-height: 27px;'>"+chanceofrain+"<span style='font-size: 15px'> %</span></dd>"
                        html+= "<dt style='float: left; width: 140px; text-align: right; font-weight: bold; line-height: 25px; padding-right: 5px; font-size: 17px; clear: both;'>Wind Speed: </dt><dd style='font-size: 23px; line-height: 27px;'>"+windspeed+"<span style='font-size: 15px'> mph</span></dd>";
                        html+= "<dt style='float: left; width: 140px; text-align: right; font-weight: bold; line-height: 25px; padding-right: 5px; font-size: 17px; clear: both;'>Humidity: </dt><dd style='font-size: 23px; line-height: 27px;'>"+humidity+"<span style='font-size: 15px'> %</span></dd>";
                        html+= "<dt style='float: left; width: 140px; text-align: right; font-weight: bold; line-height: 25px; padding-right: 5px; font-size: 17px; clear: both;'>Visibility: </dt><dd style='font-size: 23px; line-height: 27px;'>"+visibility+"<span style='font-size: 15px'> mi</span></dd>";
                        html+= "<dt style='float: left; width: 140px; text-align: right; font-weight: bold; line-height: 25px; padding-right: 5px; font-size: 17px; clear: both;'>Sunrise / Sunset: </dt><dd style='font-size: 23px; line-height: 27px;'>"+sunrise+"<span style='font-size: 15px'> AM/ </span>"+sunset+"<span style='font-size: 15px'> PM</span></dd>";
                        html+= "</dl>"
                        html += "</div><div><h1 style='text-align: center; margin-bottom: 0;'>Day's hourly weather </h1> <a href='#' id='hourly' onclick='googlechart();' style='text-decoration: none; color: black;'><img id='arrows' src='https://cdn4.iconfinder.com/data/icons/geosm-e-commerce/18/point-down-512.png' alt='down arrow' height='50' width='50' style='position: relative;left: 49%;'/></a></div><div style='display:none;' id='google-chart'></div>";
                        return html;
                    }
            
                function googlechart(){
                    var curvechat = document.getElementById("google-chart");
                    if (curvechat.style.display == "none") {
                        curvechat.style.display = "block";
                        curvechat.style.marginLeft = "27%";
                        document.getElementById('arrows').src="https://cdn0.iconfinder.com/data/icons/navigation-set-arrows-part-one/32/ExpandLess-512.png"
                    } 
                    else {
                        curvechat.style.display = "none";
                        document.getElementById('arrows').src="https://cdn4.iconfinder.com/data/icons/geosm-e-commerce/18/point-down-512.png"
                    }
                }
            <?php 
                if(isset($_POST['submit']) or isset($_POST['currentloc']) ){
                    if(isset($_POST['currentloc'])){
            ?>    
                        document.getElementById('curloc').checked = true; 
                        document.getElementById('streetid').disabled = true;
                        document.getElementById('cityid').disabled = true; 
                        document.getElementById('stateid').disabled = true;
                        document.getElementById('streetid').value = ''; 
                        document.getElementById('cityid').value = ''; 
                        document.getElementById('stateid').value = '0';
            <?php
                    }
                    if((isset($_POST['street'])) and (isset($_POST['city'])) and (isset($_POST['states']))){
            ?>
                        document.getElementById('streetid').value = "<?php if(isset($_POST['street'])){echo $_POST['street']; } else{ echo '';} ?>";
                        document.getElementById('cityid').value = "<?php if(isset($_POST['city'])){echo $_POST['city']; } else{ echo '';} ?>";
                        document.getElementById('stateid').value = "<?php if(isset($_POST['states'])){echo $_POST['states']; } else{ echo '';} ?>";
            <?php
                    }
                }
            ?>
        </script>
    </body>
</html>