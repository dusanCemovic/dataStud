// charts.js
(function ($) {
    "use strict";

    dts.window.ready(function () {

    });

    dts.window.on('load', function () {
        ChartsAmcharts.init();
    });

    dts.window.resize(function () {

    });

    dts.window.scroll(function () {

    });

    var ChartsAmcharts = {
        init: function () {

            if (typeof AmCharts !== 'undefined') {

                ChartsAmcharts.initChartSample1();
                ChartsAmcharts.initChartSample1x();
                ChartsAmcharts.initChartSample7();

            }

        },
        initChartSample1: function () {
            var chart = AmCharts.makeChart("chart_1", {
                "type": "serial",
                "theme": "light",
                "pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                "autoMargins": false,
                "marginLeft": 30,
                "marginRight": 8,
                "marginTop": 10,
                "marginBottom": 26,

                "fontFamily": 'Open Sans',
                "color": '#888',

                "dataProvider": [{
                    "year": 2013,
                    "salary": 750,
                }, {
                    "year": 2014,
                    "salary": 860,
                }, {
                    "year": 2015,
                    "salary": 830,
                }, {
                    "year": 2016,
                    "salary": 870,
                }, {
                    "year": 2017,
                    "salary": 1000,
                }, {
                    "year": 2018,
                    "salary": 920,
                }, {
                    "year": 2019,
                    "salary": 970,
                    "dashLengthLine": 5
                }, {
                    "year": 2020,
                    "salary": 1020,
                    "dashLengthColumn": 5,
                    "alpha": 0.2,
                    "additional": "(projection)"
                }, {
                    "year": 2021,
                    "salary": 1040,
                    "dashLengthColumn": 5,
                    "alpha": 0.2,
                    "additional": "(projection)"
                }, {
                    "year": 2022,
                    "salary": 1100,
                    "dashLengthColumn": 5,
                    "alpha": 0.2,
                    "additional": "(projection)"
                }, {
                    "year": 2023,
                    "salary": 1150,
                    "dashLengthColumn": 5,
                    "alpha": 0.2,
                    "additional": "(projection)"
                }, {
                    "year": 2024,
                    "salary": 1220,
                    "dashLengthColumn": 5,
                    "alpha": 0.2,
                    "additional": "(projection)"
                }],
                "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
                "startDuration": 1,
                "graphs": [{
                    "alphaField": "alpha",
                    "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>",
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1,
                    "title": "Salary (in EURO)",
                    "type": "column",
                    "valueField": "salary"
                }],
                "categoryField": "year",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "tickLength": 0
                }
            });

            $('#chart_1').closest('.portlet').find('.fullscreen').click(function () {
                    chart.invalidateSize();
                }
            )
        },
        initChartSample1x: function () {
            var chart = AmCharts.makeChart("chart_1x", {
                "type": "serial",
                "theme": "light",
                "pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                "autoMargins": false,
                "marginLeft": 30,
                "marginRight": 8,
                "marginTop": 10,
                "marginBottom": 26,

                "fontFamily": 'Open Sans',
                "color": '#888',

                "dataProvider": [{
                    "year": 2013,
                    "design": 90,
                }, {
                    "year": 2014,
                    "design": 100,
                }, {
                    "year": 2015,
                    "design": 120,
                }, {
                    "year": 2016,
                    "design": 140,
                }, {
                    "year": 2017,
                    "design": 150,
                }, {
                    "year": 2018,
                    "design": 210,
                }, {
                    "year": 2019,
                    "design": 215,
                    "dashLengthLine": 5
                }, {
                    "year": 2020,
                    "design": 240,
                    "dashLengthColumn": 5,
                    "alpha": 0.2,
                    "additional": "(projection)"
                }, {
                    "year": 2021,
                    "design": 245,
                    "dashLengthColumn": 5,
                    "alpha": 0.2,
                    "additional": "(projection)"
                }, {
                    "year": 2022,
                    "design": 260,
                    "dashLengthColumn": 5,
                    "alpha": 0.2,
                    "additional": "(projection)"
                }, {
                    "year": 2023,
                    "design": 270,
                    "dashLengthColumn": 5,
                    "alpha": 0.2,
                    "additional": "(projection)"
                }, {
                    "year": 2024,
                    "design": 280,
                    "dashLengthColumn": 5,
                    "alpha": 0.2,
                    "additional": "(projection)"
                }],
                "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
                "startDuration": 1,
                "graphs": [{
                    "alphaField": "alpha",
                    "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>",
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1,
                    "title": "Design",
                    "type": "column",
                    "valueField": "design"
                }],
                "categoryField": "year",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "tickLength": 0
                }
            });

            $('#chart_1').closest('.portlet').find('.fullscreen').click(function () {
                chart.invalidateSize();
            });
        },

        initChartSample7: function () {
            var chart = AmCharts.makeChart("chart_7", {
                "type": "pie",
                "theme": "light",

                "fontFamily": 'Open Sans',

                "color": '#888',

                "dataProvider": [{
                    "country": "Design",
                    "value": 45
                }, {
                    "country": "Others",
                    "value": 565
                }],
                "valueField": "value",
                "titleField": "country",
                "outlineAlpha": 0.4,
                "depth3D": 15,
                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                "angle": 30,
                "exportConfig": {
                    menuItems: [{
                        icon: '/lib/3/images/export.png',
                        format: 'png'
                    }]
                }
            });

            jQuery('.chart_7_chart_input').off().on('input change', function () {
                var property = jQuery(this).data('property');
                var target = chart;
                var value = Number(this.value);
                chart.startDuration = 0;

                if (property == 'innerRadius') {
                    value += "%";
                }

                target[property] = value;
                chart.validateNow();
            });

            $('#chart_7').closest('.portlet').find('.fullscreen').click(function () {
                chart.invalidateSize();
            });
        }

    };

})(jQuery);