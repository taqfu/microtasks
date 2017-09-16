$(document.body).ready(function () {
    $(document).on("click", ".status", function (event) {
        $("form#change-status" + event.target.id.substr(6)).submit();
    });
    window.setInterval(changeTime, 1000);
});
    function changeTime(){
       hour = $("#hour").html();
       min = $("#min").html();
       sec = $("#sec").html();
       console.log(hour + ":" + min + ":" + sec);
       sec++;
       if (sec>59){
            min++;
            sec-=60;
       }
       if (min>59){
            hour++;
            min-=60;
       }
       if (hour>23){
            hour-=24;
       }
        sec = formatTime(sec);
        min = formatTime(min);
        hour = formatTime(hour);

        $("#hour").html(hour);
        $("#min").html(min);
        $("#sec").html(sec);

    }
    function formatTime(number){
        number = String(number);
        if (number<10 && number.length == 1){
            number = "0" + number;
        }
        return number;
    }
