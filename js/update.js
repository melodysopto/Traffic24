/*$(document).ready(function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation);
    } else { 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});
*/
$(document).ready(function showLocation(position) {
    var x = new Date();
    x = x.getHours();
    console.log(x);
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    
$.ajax({
        type:'POST',
        url:'../php/new_a.php',
        data:'latitude='+latitude+'&longitude='+longitude+'&date='+x,
        success:function(msg){
            if(msg){
               $("#location").html(msg);
            }else{
                $("#location").html('Not Available');
            }
        }
    });
    
}
});
