$(function () {
    setInterval(function(){
        $('span#current_time').html(moment().tz("Africa/Cairo").format("DD/MM/YYYY hh:mm:ss A"));
    }, 1000);
});

function reload()
{
    $("#iframe-container").html($("#iframe-container").html());
}