<!DOCTYPE html>
<html>

<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body style="background-color:#AED6F1;">
    <div class="container mt-5 col-8">
        <div class="container mx-auto">
            <p class="text-center h1">เช็คสภาพอากาศในพื้นที่</p>
            <div class="input-group mb-3 mt-5">
                <span class="input-group-text" >ละติจูด</span>
                <input type="text" class="form-control" placeholder="ละติจูด" aria-label="Latitude"
                    aria-describedby="Latitude" id="Latitude">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">ลองติจูด</span>
                <input type="text" class="form-control" placeholder="ลองจิจูด" aria-label="Longitude"
                    aria-describedby="Longitude" id="Longitude">
            </div>
            <div class="container-fluid mt-5 d-flex justify-content-center">
                <button type="button" class= "btn btn-success btn-md" style="width:200px; height:35px" id= "btnSearch" >ค้นหา</button>

            </div>
        </div>
        <div class="container mt-5 d-flex justify-content-center">
            <div class="card" id="cardWeather" style="width: 18rem;">
            </div>

                </div>
            </div>
      
</body>
<script>
    

    function setDefault(){
        var urlDefualt = "http://api.openweathermap.org/data/2.5/weather?q=lat=7.4142474&lon=100.1389773&appid=1279315f12ca5fb0674f8b9c914a6967";
        $.getJSON(urlDefualt)
            .done((data) => {
                var timeupdate = convertHMS(data.dt);
                var sunrise = convertHMS(data.sys["sunrise"]);
                var sunset = convertHMS(data.sys["sunset"]);
                var place = (data.name);
                var windSpeed = (data.wind["speed"]);
                var temp = ((data.main["temp"] - 273));
                var humid = (data.main["humidity"]+"%");
                $.each(data.weather[0], (key, value) => {
                    for (let i = 0; i < (data.weather[0]).length; i++) {
                        console.log(value);
                        
                    }
                  
                })
                
                var line = "<div id='dataWeather'>";
                    line += "<img src='https://tatapi.tourismthailand.org/tatfs/Image/CustomPOI/Picture/P03001583_1.jpeg' class='card-img-top' ><div class='card-body'>"
                    line += "<h5 class='card-title my-3 '>"+ place +"</h5>";
                    line += "<p class='card-text'>พระอาทิตย์ขึ้น : "+ sunrise +"</p>";
                    line += "<p class='card-text'>พระอาทิตย์ตก : "+ sunset +"</p>";
                    line += "<p class='card-text'>อุณหภูมิ : "+ temp +"</p>";
                    line += "<p class='card-text'>ความชื้นในอากาศ : "+ humid  + "</p>";
                    line += "<p class='card-text'>เวลา : "+timeupdate  +"</p>";
                    line += "</div>"
                $("#cardWeather").append(line);
            }).fail((xhr, status, error) => {})
            
    } 

    function LoadForcast() {
        var x = $("#Latitude").val();
        var y = $("#Longitude").val();
        var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + x + "&lon=" + y + "&appid=d1ffd4a48d1871c9b8d00735829b6d84"
        $.getJSON(url)
            .done((data) => {
                var timeupdate = convertHMS(data.dt);
                var sunrise = convertHMS(data.sys["sunrise"]);
                var sunset = convertHMS(data.sys["sunset"]);
                var place = (data.name);
                var windSpeed = (data.wind["speed"]);
                var temp = ((data.main["temp"] - 273).toFixed(2));
                var humid = (data.main["humidity"]+"%");
                $.each(data.weather[0], (key, value) => {
                    for (let i = 0; i < (data.weather[0]).length; i++) {
                        console.log(value);
                        
                    }
                })
                var line = "<div id='dataWeather'>";
                    line += "<img src='https://tatapi.tourismthailand.org/tatfs/Image/CustomPOI/Picture/P03001583_1.jpeg' class='card-img-top' ><div class='card-body'>"
                    line += "<h5 class='card-title my-3'> "+ place +"</h5>";
                    line += "<p class='card-text'>พระอาทิตย์ขึ้น : "+ sunrise +"</p>";
                    line += "<p class='card-text'>พระอาทิตย์ : "+ sunset +"</p>";
                    line += "<p class='card-text'>อุณหภูมิ : "+ temp +"</p>";
                    line += "<p class='card-text'>ความชื้นในอากาศ : "+ humid  +"</p>";
                    line += "<p class='card-text'>เวลา : "+timeupdate  +"</p>";
                    line += "</div>"
                $("#cardWeather").append(line);
            }).fail((xhr, status, error) => {})
    }

    function convertHMS(value) {
        let time = value;
        var convert = new Date(time * 1000);
        var hours = convert.getHours();
        var minutes = "0" + convert.getMinutes();
        var seconds = "0" + convert.getSeconds();
        return (hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2));
    }
    $(() => {
        setDefault();
        $("#btnSearch").click(() => {
            LoadForcast();
            $("#dataWeather").hide();
        });
    });
</script>
</html>
