$(function () {
    // общее
    var logs = [];
    $.getJSON($('#container').data('url'), function(data) {
        $.each(data, function(key, value) {
            logs.push({
                name: key,
                data: value
            });
        });
    }).done(function() {
        $('#container').highcharts({
            title: {
                text: 'Среднее время ввода данных',
                x: -20 //center
            },
            subtitle: {
                x: -20
            },
            tooltip: {
                formatter: function () {
                    return '' +
                        "" +
                        'Время: ' + Highcharts.dateFormat('%M:%S', this.y);
                }
            },
            // Важно
            // выставляем весовой коэффициент в 1
            wgaOptions: {
                'name': 'Среднее значение',
                'visibleAtFirst': true,
                'averageFactor': 1
            },

            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            if (this.y === 0) {
                                return 0;
                            }
                            else {
                                var hours = (((this.y / 1000) / 60) / 60).toFixed(2);
                                var hourPortion = hours.toString().split(".")[0];
                                var minPortion = hours.toString().split(".")[1];
                                var minPortionUsed = (parseInt(hours.toString().split(".")[1]) * 0.6).toFixed(0);
                                if (minPortionUsed < 10) {
                                    minPortionUsed = '0' + minPortionUsed.toString();
                                }
                                return hourPortion + ':' + minPortionUsed;
                            }
                        }
                    }
                }
            },
            xAxis: {
                categories: ['Form1', 'Form2', 'Form3', 'Form4']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Время M:S',
                    align: 'middle'
                },
                labels: {
                    overflow: 'justify',
                    formatter: function () {
                        var seconds = (this.value / 1000) | 0;
                        this.value -= seconds * 1000;

                        var minutes = (seconds / 60) | 0;
                        seconds -= minutes * 60;

                        var hours = (minutes / 60) | 0;
                        minutes -= hours * 60;
                        return minutes + ':' + seconds;
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: logs
        });
        $('.average').on('click', function() {
            $('#container').highcharts().DynamicWeightedAverage();
            //$('#container').highcharts();//.DynamicWeightedAverage();
        });
    });

    // по форме
    $('.getDataByForm').on('click', function() {
        var logs = [];
        var usernames = [];
        $.getJSON($(this).data('url'), function (data) {
            //$.each(data, function (key, value) {
                logs.push({
                    name: 'form',
                    data: data.data
                });
            usernames = data.username;
            //});
        }).done(function () {
            $('#container').highcharts({
                /*chart: {
                    // histogram
                    //type: 'column'
                    type: 'chart'
                },*/
                title: {
                    text: 'Среднее время ввода данных',
                    x: -20 //center
                },
                subtitle: {
                    x: -20
                },
                tooltip: {
                    formatter: function () {
                        return '' +
                            "" +
                            'Время: ' + Highcharts.dateFormat('%M:%S', this.y);
                    }
                },
                plotOptions: {
                     bar: {
                        dataLabels: {
                            enabled: true,
                            formatter: function () {
                                if (this.y === 0) {
                                    return 0;
                                }
                                else {
                                    var hours = (((this.y / 1000) / 60) / 60).toFixed(2);
                                    var hourPortion = hours.toString().split(".")[0];
                                    var minPortion = hours.toString().split(".")[1];
                                    var minPortionUsed = (parseInt(hours.toString().split(".")[1]) * 0.6).toFixed(0);
                                    if (minPortionUsed < 10) {
                                        minPortionUsed = '0' + minPortionUsed.toString();
                                    }
                                    return hourPortion + ':' + minPortionUsed;
                                }
                            }
                        }
                    }
                    // histogram
                    /*column: {
                        pointPadding: 0.05,
                        borderWidth: 0,
                        groupPadding: 0,
                        shadow: false
                    }*/
                },
                xAxis: {
                    categories: usernames
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Время M:S',
                        align: 'middle'
                    },
                    labels: {
                        overflow: 'justify',
                        formatter: function () {
                            var seconds = (this.value / 1000) | 0;
                            this.value -= seconds * 1000;

                            var minutes = (seconds / 60) | 0;
                            seconds -= minutes * 60;

                            var hours = (minutes / 60) | 0;
                            minutes -= hours * 60;
                            return minutes + ':' + seconds;
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: logs
            });
            //$('.average').hide();
            $('.average').on('click', function () {
                $('#container').highcharts().DynamicWeightedAverage();
                //$('#container').highcharts();//.DynamicWeightedAverage();
            });
        });
    });

    // по форме
    $('.getAverage').on('click', function() {
        var logs = [];
        var usernames = [];
        $.getJSON($(this).data('url'), function (data) {
            //$.each(data, function (key, value) {
            logs.push({
                name: 'Average',
                data: data
            });
            //});
        }).done(function () {
            $('#container').highcharts({
                /*chart: {
                 // histogram
                 //type: 'column'
                 type: 'chart'
                 },*/
                title: {
                    text: 'Среднее время ввода данных',
                    x: -20 //center
                },
                subtitle: {
                    x: -20
                },
                tooltip: {
                    formatter: function () {
                        return '' +
                            "" +
                            'Время: ' + Highcharts.dateFormat('%M:%S', this.y);
                    }
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true,
                            formatter: function () {
                                if (this.y === 0) {
                                    return 0;
                                }
                                else {
                                    var hours = (((this.y / 1000) / 60) / 60).toFixed(2);
                                    var hourPortion = hours.toString().split(".")[0];
                                    var minPortion = hours.toString().split(".")[1];
                                    var minPortionUsed = (parseInt(hours.toString().split(".")[1]) * 0.6).toFixed(0);
                                    if (minPortionUsed < 10) {
                                        minPortionUsed = '0' + minPortionUsed.toString();
                                    }
                                    return hourPortion + ':' + minPortionUsed;
                                }
                            }
                        }
                    }
                    // histogram
                    /*column: {
                     pointPadding: 0.05,
                     borderWidth: 0,
                     groupPadding: 0,
                     shadow: false
                     }*/
                },
                xAxis: {
                    categories: ['Form1', 'Form2', 'Form3', 'Form4']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Время M:S',
                        align: 'middle'
                    },
                    labels: {
                        overflow: 'justify',
                        formatter: function () {
                            var seconds = (this.value / 1000) | 0;
                            this.value -= seconds * 1000;

                            var minutes = (seconds / 60) | 0;
                            seconds -= minutes * 60;

                            var hours = (minutes / 60) | 0;
                            minutes -= hours * 60;
                            return minutes + ':' + seconds;
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: logs
            });
         });
    });
});