function convertTime(diff) {
    var msec = diff;
    var hh = Math.floor(msec / 1000 / 60 / 60);
    msec -= hh * 1000 * 60 * 60;
    var mm = Math.floor(msec / 1000 / 60);
    msec -= mm * 1000 * 60;
    var ss = Math.floor(msec / 1000);
    msec -= ss * 1000;
    return [hh, mm, ss, msec].join(':');
}
$(document).on('ready', function(){
    var startTime, endTime;
    $('.form-start').on('click', function(){
        var time = new Date();
        startTime = time.getTime();
        console.log(startTime);
    });
    $('.form-confirm').on('click', function(){
        console.log('send');
        var time = new Date();
        endTime = time.getTime();
        console.log(endTime);
        console.log(convertTime(endTime - startTime));
        var url = $(this).data('url');
        $.post(url, {time: endTime - startTime}, function() {
           console.log('success');
            var ok = $('<span>').addClass('glyphicon glyphicon-ok');
            $('h1.well').append(ok.css('color', '#419641'));
        });
    });
});