function nonOpenDays(date){
    var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
    var closedDates = [[11, 1], [12, 25], [5, 1]];
    var closedDays = [[Sunday], [Tuesday]];
    for (var i = 0; i < closedDays.length; i++) {
        if (day === closedDays[i][0]) {
            return [false];
        }

    }

    for (i = 0; i < closedDates.length; i++) {
        if (date.getMonth() === closedDates[i][0] - 1 &&
            date.getDate() === closedDates[i][1])
        {
            return [false];
        }
    }

    return [true];
}

$(function () {
    $( "input.datepicker_js" ).datepicker({
        dateFormat: 'dd-mm-yy',
        beforeShowDay: nonOpenDays});
});
