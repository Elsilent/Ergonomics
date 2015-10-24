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
    $('#fio').on('focus', function(){
        var time = new Date();
        startTime = time.getTime();
        console.log(startTime);
    });
    $('.form1-send').on('click', function(){
        var time = new Date();
        endTime = time.getTime();
        console.log(endTime);
        console.log(convertTime(endTime - startTime));
        var url = $(this).data('url');
        $.post(url, {time: convertTime(endTime - startTime)}, function() {
           console.log('success');
        });
    });
});