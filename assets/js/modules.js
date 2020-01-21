// JavaScript Document

// main.js
(function ($) {
    "use strict";

    window.dts = {};
    dts.modules = {};
    dts.scroll = 0;
    dts.window = $(window);
    dts.document = $(document);
    dts.windowWidth = $(window).width();
    dts.windowHeight = $(window).height();
    dts.body = $('body');
    dts.html = $('html, body');
    dts.loader = {
        start: function () {
            $('body').addClass('dts-loading');
        },
        stop: function () {
            $('body').removeClass('dts-loading');
        }
    };

    /*predefined values which is used globally start */

    dts.headerHeight = 75;
    dts.footerHeight = 220;

    /*predefined values which is used globally end */

    dts.window.ready(function () {
        dts.window.scrollTop(0);
        dts.scroll = $(window).scrollTop();

    });

    dts.window.resize(function () {
        dts.windowWidth = $(window).width();
        dts.windowHeight = $(window).height();
    });

    dts.window.scroll(function () {
        dts.scroll = dts.window.scrollTop();

    });

})(jQuery);



// common.js
(function ($) {
    "use strict";
    var common = {};
    dts.modules.common = common;

    dts.window.ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
    });

    dts.window.on('load', function () {
        dtsSmoothScroll.init();
    });

    dts.window.resize(function () {

    });

    dts.window.scroll(function () {

    });

    /**
     * Object that represents scroll to anchor
     * @returns {{init: Function}} function that initializes scroll to anchor functionality
     */
    var dtsSmoothScroll = {
        init : function () {

            var $anchor = $('.dts-custom-anchor');


            if ($anchor.length) {
                $anchor.each(function () {
                    dtsSmoothScroll.dtsAnchorScrollEvent($(this));
                });
            }

        },
        dtsAnchorScrollEvent: function ($anchor) {
            $anchor.click(function (e) {

                e.preventDefault();

                var scrollOffset = dts.headerHeight;

                var anchorLocation = $(this).attr('href');
                var target = $(anchorLocation);

                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - scrollOffset
                    }, 500);
                    return false;
                }

            });
        }
    };

    var ComponentsDateTimePickers = {
        //main function to initiate the module
        init: function () {
            ComponentsDateTimePickers.handleDatePickers();
            ComponentsDateTimePickers.handleTimePickers();
        },
        handleDatePickers : function () {

            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    orientation: "left",
                    autoclose: true,
                    defaultTime: false
                });
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            }

            /* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */

            // Workaround to fix datepicker position on window scroll
            $(document).scroll(function () {
                $('#form_modal2 .date-picker').datepicker('place'); //#modal is the id of the modal
            });
        },
        handleTimePickers : function () {

            if (jQuery().timepicker) {
                $('.timepicker-default').timepicker({
                    autoclose: true,
                    showSeconds: true,
                    minuteStep: 1
                });

                $('.timepicker-no-seconds').timepicker({
                    autoclose: true,
                    minuteStep: 5,
                    defaultTime: false
                });

                $('.timepicker-24').timepicker({
                    autoclose: true,
                    minuteStep: 5,
                    showSeconds: false,
                    showMeridian: false,
                    defaultTime: false
                });

                // handle input group button click
                $('.timepicker').parent('.input-group').on('click', '.input-group-btn', function (e) {
                    e.preventDefault();
                    $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
                });

                // Workaround to fix timepicker position on window scroll
                $(document).scroll(function () {
                    $('#form_modal4 .timepicker-default, #form_modal4 .timepicker-no-seconds, #form_modal4 .timepicker-24').timepicker('place'); //#modal is the id of the modal
                });
            }
        }

    };

    var ComponentsSelect2 = {
        //main function to initiate the module
        init: function () {
            ComponentsSelect2.handleDemo();

            dts.body.on('dts_trigger_default_function_select2', function () {
                ComponentsSelect2.handleDemo();
            });
        },
        handleDemo : function () {

            // Set the "bootstrap" theme as the default theme for all Select2
            // widgets.
            //
            // @see https://github.com/select2/select2/issues/2927
            $.fn.select2.defaults.set("theme", "bootstrap");

            var placeholder = "-";

            $(".select2").select2({
                width: null,
            });

            $(".select2-multiple").select2({
                width: null,
                multiple: true,
            });

            $(".select2-allow-clear").select2({
                allowClear: true,
                width: null
            });

            // disable autofocus on searchbar
            $(".select2").on('select2:open', function () {
                $('.select2-search__field').prop('focus', 0);
            });

            // @see https://select2.github.io/examples.html#data-ajax
            function formatRepo(repo) {
                if (repo.loading) return repo.text;

                var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

                if (repo.description) {
                    markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
                }

                markup += "<div class='select2-result-repository__statistics'>" +
                    "<div class='select2-result-repository__forks'><span class='glyphicon glyphicon-flash'></span> " + repo.forks_count + " Forks</div>" +
                    "<div class='select2-result-repository__stargazers'><span class='glyphicon glyphicon-star'></span> " + repo.stargazers_count + " Stars</div>" +
                    "<div class='select2-result-repository__watchers'><span class='glyphicon glyphicon-eye-open'></span> " + repo.watchers_count + " Watchers</div>" +
                    "</div>" +
                    "</div></div>";

                return markup;
            }

            function formatRepoSelection(repo) {
                return repo.full_name || repo.text;
            }

            $(".js-data-example-ajax").select2({
                width: "off",
                ajax: {
                    url: "https://api.github.com/search/repositories",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, page) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        return {
                            results: data.items
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            $("button[data-select2-open]").click(function () {
                $("#" + $(this).data("select2-open")).select2("open");
            });

            $(":checkbox").on("click", function () {
                $(this).parent().nextAll("select").prop("disabled", !this.checked);
            });

            // copy Bootstrap validation states to Select2 dropdown
            //
            // add .has-waring, .has-error, .has-succes to the Select2 dropdown
            // (was #select2-drop in Select2 v3.x, in Select2 v4 can be selected via
            // body > .select2-container) if _any_ of the opened Select2's parents
            // has one of these forementioned classes (YUCK! ;-))
            $(".select2, .select2-multiple, .select2-allow-clear, .js-data-example-ajax").on("select2:open", function () {
                if ($(this).parents("[class*='has-']").length) {
                    var classNames = $(this).parents("[class*='has-']")[0].className.split(/\s+/);

                    for (var i = 0; i < classNames.length; ++i) {
                        if (classNames[i].match("has-")) {
                            $("body > .select2-container").addClass(classNames[i]);
                        }
                    }
                }
            });

            $(".js-btn-set-scaling-classes").on("click", function () {
                $("#select2-multiple-input-sm, #select2-single-input-sm").next(".select2-container--bootstrap").addClass("input-sm");
                $("#select2-multiple-input-lg, #select2-single-input-lg").next(".select2-container--bootstrap").addClass("input-lg");
                $(this).removeClass("btn-primary btn-outline").prop("disabled", true);
            });
        }

    };

})(jQuery);

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