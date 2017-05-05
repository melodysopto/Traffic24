<?php
if(!empty($_POST['latitude']) && !empty($_POST['longitude']) && !empty($_POST['date'])){
    //Send request and receive json data by latitude and longitude
    
    //Print address 
    $location = $_POST['latitude'];
    echo $location;
    echo "\n";
    $date = $_POST['date'];
    echo $date;
}
?>

<p>Your Location: <span id="location"></span></p>

<script src="../js/jquery-3.2.1.min.js"></script>
<script>

$(document).ready(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation);
    } else { 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});

function showLocation(position) {
    var x = new Date();
    
    x = x.getHours();
    console.log(x);
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    
$.ajax({
        type:'POST',
        url:'location.php',
        data:'latitude='+latitude+'&longitude='+longitude+'&date='+x,
        success:function(msg){//may be er jonno multiple time load hocche
            if(msg){
               $("#location").html(msg);
            }else{
                $("#location").html('Not Available');
            }
        }
    });
    
}
</script>
