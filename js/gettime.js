function saveData(){
            var x = new Date();
            var day = x.getDay();
            var hour = x.getHours();
            //alert(day+" "+hour);

            $(document).ready(function(){
                $.ajax({
                    type:"POST",
                    url:"../php/send_time.php",
                    data:{"day": day, "hour": hour},
                    success:function(msg){
                      alert("data sent");
                    }
                });
    });
}
