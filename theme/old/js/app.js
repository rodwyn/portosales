/*
 * VARIABLES
 * Description: All Global Vars
 */
// Impacts the responce rate of some of the responsive elements (lower value affects CPU but improves speed)
$.throttle_delay = 350;

// The rate at which the menu expands revealing child elements on click
$.menu_speed = 235;

// Note: You will also need to change this variable in the "variable.less" file.
$.navbar_height = 49;

/*
 * APP DOM REFERENCES
 * Description: Obj DOM reference, please try to avoid changing these
 */
$.root_ = $('body');
$.left_panel = $('#left-panel');
$.shortcut_dropdown = $('#shortcut');

/*
 * APP CONFIGURATION
 * Description: Enable / disable certain theme features here
 */
$.navAsAjax = true; // Your left nav in your app will no longer fire ajax calls

// Please make sure you have included "jarvis.widget.js" for this below feature to work
$.enableJarvisWidgets = true;
// $.enableJarvisWidgets needs to be true it to work (could potentially 
// crash your webApp if you have too many widgets running on mobile view)	
$.enableMobileWidgets = false;

// Plugin dependency "smartclick.js"
$.enableFastClick = false; // remove the 300 ms delay in iDevices

/* Configuracion del dopzone */
Dropzone.autoDiscover = false;

/*
 * DETECT MOBILE DEVICES
 * Description: Detects mobile device - if any of the listed device is detected
 * a class is inserted to $.root_ and the variable $.device is decleard. 
 */

/* so far this is covering most hand held devices */
var ismobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));

if (!ismobile) {
    // Desktop
    $.root_.addClass("desktop-detected");
    $.device = "desktop";
} else {
    // Mobile
    $.root_.addClass("mobile-detected");
    $.device = "mobile";

    // remove 300ms delay from apple touch devices
    // dependency: plugin/smartclick/smartclick.js
    if ($.enableFastClick) {
        $('nav ul a').noClickDelay();
        $('#hide-menu a').noClickDelay();
    }
}

/* ~ END: CHECK MOBILE DEVICE */

/*
 * DOCUMENT LOADED EVENT
 * Description: Fire when DOM is ready
 */

$(document).ready(function() {

    $.root_.addClass("fixed-header");
    $('input[type="checkbox"]#smart-fixed-nav')
            .prop('checked', true);

    $.root_.addClass("fixed-header");
    $.root_.addClass("fixed-ribbon");

    $('input[type="checkbox"]#smart-fixed-container')
            .prop('checked', false);
    $.root_.removeClass("container");

    $('input[type="checkbox"]#smart-fixed-nav')
            .prop('checked', true);
    $('input[type="checkbox"]#smart-fixed-ribbon')
            .prop('checked', true);

    //apply
    $.root_.addClass("fixed-header");
    $.root_.addClass("fixed-ribbon");
    $.root_.addClass("fixed-navigation");

    $('input[type="checkbox"]#smart-fixed-container')
            .prop('checked', false);
    $.root_.removeClass("container");

    /*
     * Fire tooltips
     */
    if ($("[rel=tooltip]").length) {
        $("[rel=tooltip]").tooltip();
    }

    //TODO: was moved from window.load due to IE not firing consist
    nav_page_height()

    // INITIALIZE LEFT NAV
    if (!null) {
        $('nav ul').jarvismenu({
            accordion: true,
            speed: $.menu_speed,
            closedSign: '<em class="fa fa-expand-o"></em>',
            openedSign: '<em class="fa fa-collapse-o"></em>'
        });
    } else {
        alert("Error - menu anchor does not exist");
    }

    // COLLAPSE LEFT NAV
    $('.minifyme').click(function(e) {
        $('body').toggleClass("minified");
        $(this).effect("highlight", {}, 500);
        e.preventDefault();
    });

    // HIDE MENU
    $('#hide-menu >:first-child > a').click(function(e) {
        $('body').toggleClass("hidden-menu");
        e.preventDefault();
    });

    $('#show-shortcut').click(function(e) {
        if ($.shortcut_dropdown.is(":visible")) {
            shortcut_buttons_hide();
        } else {
            shortcut_buttons_show();
        }
        e.preventDefault();
    });

    // SHOW & HIDE MOBILE SEARCH FIELD
    $('#search-mobile').click(function() {
        $.root_.addClass('search-mobile');
    });

    $('#cancel-search-js').click(function() {
        $.root_.removeClass('search-mobile');
    });

    // ACTIVITY
    // ajax drop
    $('#activity').click(function(e) {
        $this = $(this);

        if ($this.find('.badge').hasClass('bg-color-red')) {
            $this.find('.badge').removeClassPrefix('bg-color-');
            $this.find('.badge').text("0");
            // console.log("Ajax call for activity")
        }

        if (!$this.next('.ajax-dropdown').is(':visible')) {
            $this.next('.ajax-dropdown').fadeIn(150);
            $this.addClass('active');
        } else {
            $this.next('.ajax-dropdown').fadeOut(150);
            $this.removeClass('active')
        }

        var mytest = $this.next('.ajax-dropdown').find('.btn-group > .active > input').attr('id');
        //console.log(mytest)

        e.preventDefault();
    });

    $('input[name="activity"]').change(function() {
        //alert($(this).val())
        $this = $(this);

        url = $this.attr('id');
        container = $('.ajax-notifications');

        loadURL(url, container);

    });

    $(document).mouseup(function(e) {
        if (!$('.ajax-dropdown').is(e.target)// if the target of the click isn't the container...
                && $('.ajax-dropdown').has(e.target).length === 0) {
            $('.ajax-dropdown').fadeOut(150);
            $('.ajax-dropdown').prev().removeClass("active")
        }
    });

    $('button[data-loading-text]').on('click', function() {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function() {
            btn.button('reset')
        }, 3000)
    });

    // NOTIFICATION IS PRESENT

    function notification_check() {
        $this = $('#activity > .badge');

        if (parseInt($this.text()) > 0) {
            $this.addClass("bg-color-red bounceIn animated")
        }
    }

    notification_check();

    // RESET WIDGETS
    $('#refresh').click(function(e) {
        $.SmartMessageBox({
            title: "<i class='fa fa-refresh' style='color:green'></i> Actualizar datos",
            content: "Confirma actualizar todos los datos?",
            buttons: '[No][Si]'
        }, function(ButtonPressed) {
            if (ButtonPressed == "Si" && localStorage) {
                localStorage.clear();
                location.reload();
            }

        });
        e.preventDefault();
    });

    // LOGOUT BUTTON
    $('#logout a').click(function(e) {
        //get the link
        $.loginURL = $(this).attr('href');

        // ask verification
        $.SmartMessageBox({
            title: "<i class='fa fa-sign-out txt-color-orangeDark'></i> Cerrar Sesión <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span> ?",
            content: "Esta seguro de cerrar la sesión",
            buttons: '[No][Si]'

        }, function(ButtonPressed) {
            if (ButtonPressed == "Si") {
                $.root_.addClass('animated fadeOutUp');
                setTimeout(logout, 1000)
            }

        });
        e.preventDefault();
    });

    /*
     * LOGOUT ACTION
     */

    function logout() {
        window.location = $.loginURL;
    }

    /*
     * SHORTCUTS
     */

    // SHORT CUT (buttons that appear when clicked on user name)
    $.shortcut_dropdown.find('a').click(function(e) {

        e.preventDefault();

        window.location = $(this).attr('href');
        setTimeout(shortcut_buttons_hide, 300);

    });

    // SHORTCUT buttons goes away if mouse is clicked outside of the area
    $(document).mouseup(function(e) {
        if (!$.shortcut_dropdown.is(e.target)// if the target of the click isn't the container...
                && $.shortcut_dropdown.has(e.target).length === 0) {
            shortcut_buttons_hide()
        }
    });

    // SHORTCUT ANIMATE HIDE
    function shortcut_buttons_hide() {
        $.shortcut_dropdown.animate({
            height: "hide"
        }, 300, "easeOutCirc");
        $.root_.removeClass('shortcut-on');

    }

    // SHORTCUT ANIMATE SHOW
    function shortcut_buttons_show() {
        $.shortcut_dropdown.animate({
            height: "show"
        }, 200, "easeOutCirc")
        $.root_.addClass('shortcut-on');
    }

});

/*
 * RESIZER WITH THROTTLE
 * Source: http://benalman.com/code/projects/jquery-resize/examples/resize/
 */

(function($, window, undefined) {

    var elems = $([]), jq_resize = $.resize = $.extend($.resize, {}), timeout_id, str_setTimeout = 'setTimeout', str_resize = 'resize', str_data = str_resize + '-special-event', str_delay = 'delay', str_throttle = 'throttleWindow';

    jq_resize[str_delay] = $.throttle_delay;

    jq_resize[str_throttle] = true;

    $.event.special[str_resize] = {
        setup: function() {
            if (!jq_resize[str_throttle] && this[str_setTimeout]) {
                return false;
            }

            var elem = $(this);
            elems = elems.add(elem);
            $.data(this, str_data, {
                w: elem.width(),
                h: elem.height()
            });
            if (elems.length === 1) {
                loopy();
            }
        },
        teardown: function() {
            if (!jq_resize[str_throttle] && this[str_setTimeout]) {
                return false;
            }

            var elem = $(this);
            elems = elems.not(elem);
            elem.removeData(str_data);
            if (!elems.length) {
                clearTimeout(timeout_id);
            }
        },
        add: function(handleObj) {
            if (!jq_resize[str_throttle] && this[str_setTimeout]) {
                return false;
            }
            var old_handler;

            function new_handler(e, w, h) {
                var elem = $(this), data = $.data(this, str_data);
                data.w = w !== undefined ? w : elem.width();
                data.h = h !== undefined ? h : elem.height();

                old_handler.apply(this, arguments);
            }
            ;
            if ($.isFunction(handleObj)) {
                old_handler = handleObj;
                return new_handler;
            } else {
                old_handler = handleObj.handler;
                handleObj.handler = new_handler;
            }
        }
    };

    function loopy() {
        timeout_id = window[str_setTimeout](function() {
            elems.each(function() {
                var elem = $(this), width = elem.width(), height = elem.height(), data = $.data(this, str_data);
                if (width !== data.w || height !== data.h) {
                    elem.trigger(str_resize, [data.w = width, data.h = height]);
                }

            });
            loopy();

        }, jq_resize[str_delay]);

    }
    ;

})(jQuery, this);

/*
 * NAV OR #LEFT-BAR RESIZE DETECT
 * Description: changes the page min-width of #CONTENT and NAV when navigation is resized.
 * This is to counter bugs for min page width on many desktop and mobile devices.
 * Note: This script uses JSthrottle technique so don't worry about memory/CPU usage
 */

// Fix page and nav height
function nav_page_height() {
    setHeight = $('#main').height();
    menuHeight = $.left_panel.height();
    windowHeight = $(window).height() - $.navbar_height;
    //set height

    if (setHeight > windowHeight) {// if content height exceedes actual window height and menuHeight
        $.left_panel.css('min-height', setHeight + 'px');
        $.root_.css('min-height', setHeight + $.navbar_height + 'px');

    } else {
        $.left_panel.css('min-height', windowHeight + 'px');
        $.root_.css('min-height', windowHeight + 'px');
    }
}

$('#main').resize(function() {
    nav_page_height();
    check_if_mobile_width();
})

$('nav').resize(function() {
    nav_page_height();

})

function check_if_mobile_width() {
    if ($(window).width() < 979) {
        $.root_.addClass('mobile-view-activated')
    } else if ($.root_.hasClass('mobile-view-activated')) {
        $.root_.removeClass('mobile-view-activated');
    }
}

/* ~ END: NAV OR #LEFT-BAR RESIZE DETECT */

/*
 * DETECT IE VERSION
 * Description: A short snippet for detecting versions of IE in JavaScript
 * without resorting to user-agent sniffing
 * RETURNS:
 * If you're not in IE (or IE version is less than 5) then:
 * //ie === undefined
 *
 * If you're in IE (>=5) then you can determine which version:
 * // ie === 7; // IE7
 *
 * Thus, to detect IE:
 * // if (ie) {}
 *
 * And to detect the version:
 * ie === 6 // IE6
 * ie > 7 // IE8, IE9 ...
 * ie < 9 // Anything less than IE9
 */

// TODO: delete this function later on - no longer needed (?)
var ie = (function() {

    var undef, v = 3, div = document.createElement('div'), all = div.getElementsByTagName('i');

    while (div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->', all[0])
        ;

    return v > 4 ? v : undef;

}()); // do we need this? 

/* ~ END: DETECT IE VERSION */

/*
 * CUSTOM MENU PLUGIN
 */

$.fn.extend({
    //pass the options variable to the function
    jarvismenu: function(options) {

        var defaults = {
            accordion: 'true',
            speed: 200,
            closedSign: '[+]',
            openedSign: '[-]'
        };

        // Extend our default options with those provided.
        var opts = $.extend(defaults, options);
        //Assign current element to variable, in this case is UL element
        var $this = $(this);

        //add a mark [+] to a multilevel menu
        $this.find("li").each(function() {
            if ($(this).find("ul").size() != 0) {
                //add the multilevel sign next to the link
                $(this).find("a:first").append("<b class='collapse-sign'>" + opts.closedSign + "</b>");

                //avoid jumping to the top of the page when the href is an #
                if ($(this).find("a:first").attr('href') == "#") {
                    $(this).find("a:first").click(function() {
                        return false;
                    });
                }
            }
        });

        //open active level
        $this.find("li.active").each(function() {
            $(this).parents("ul").slideDown(opts.speed);
            $(this).parents("ul").parent("li").find("b:first").html(opts.openedSign);
            $(this).parents("ul").parent("li").addClass("open")
        });

        $this.find("li a").click(function() {

            if ($(this).parent().find("ul").size() != 0) {

                if (opts.accordion) {
                    //Do nothing when the list is open
                    if (!$(this).parent().find("ul").is(':visible')) {
                        parents = $(this).parent().parents("ul");
                        visible = $this.find("ul:visible");
                        visible.each(function(visibleIndex) {
                            var close = true;
                            parents.each(function(parentIndex) {
                                if (parents[parentIndex] == visible[visibleIndex]) {
                                    close = false;
                                    return false;
                                }
                            });
                            if (close) {
                                if ($(this).parent().find("ul") != visible[visibleIndex]) {
                                    $(visible[visibleIndex]).slideUp(opts.speed, function() {
                                        $(this).parent("li").find("b:first").html(opts.closedSign);
                                        $(this).parent("li").removeClass("open");
                                    });

                                }
                            }
                        });
                    }
                }// end if
                if ($(this).parent().find("ul:first").is(":visible") && !$(this).parent().find("ul:first").hasClass("active")) {
                    $(this).parent().find("ul:first").slideUp(opts.speed, function() {
                        $(this).parent("li").removeClass("open");
                        $(this).parent("li").find("b:first").delay(opts.speed).html(opts.closedSign);
                    });

                } else {
                    $(this).parent().find("ul:first").slideDown(opts.speed, function() {
                        /*$(this).effect("highlight", {color : '#616161'}, 500); - disabled due to CPU clocking on phones*/
                        $(this).parent("li").addClass("open");
                        $(this).parent("li").find("b:first").delay(opts.speed).html(opts.openedSign);
                    });
                } // end else
            } // end if
        });
    } // end function
});

/* ~ END: CUSTOM MENU PLUGIN */

/*
 * ELEMENT EXIST OR NOT
 * Description: returns true or false
 * Usage: $('#myDiv').doesExist();
 */

jQuery.fn.doesExist = function() {
    return jQuery(this).length > 0;
};

/* ~ END: ELEMENT EXIST OR NOT */

/*
 * INITIALIZE FORMS
 * Description: Select2, Masking, Datepicker, Autocomplete
 */

function runAllForms() {

    /*
     * BOOTSTRAP SLIDER PLUGIN
     * Usage:
     * Dependency: js/plugin/bootstrap-slider
     */
    if ($.fn.slider) {
        $('.slider').slider();
    }

    /*
     * SELECT2 PLUGIN
     * Usage:
     * Dependency: js/plugin/select2/
     */
    if ($.fn.select2) {
        $('.select2').each(function() {
            $this = $(this);
            var width = $this.attr('data-select-width') || '100%';
            //, _showSearchInput = $this.attr('data-select-search') === 'true';
            $this.select2({
                //showSearchInput : _showSearchInput,
                allowClear: true,
                width: width
            })
        })
    }

    /*
     * MASKING
     * Dependency: js/plugin/masked-input/
     */
    if ($.fn.mask) {
        $('[data-mask]').each(function() {

            $this = $(this);
            var mask = $this.attr('data-mask') || 'error...', mask_placeholder = $this.attr('data-mask-placeholder') || 'X';

            $this.mask(mask, {
                placeholder: mask_placeholder
            });
        })
    }

    /*
     * Autocomplete
     * Dependency: js/jqui
     */
    if ($.fn.autocomplete) {
        $('[data-autocomplete]').each(function() {

            $this = $(this);
            var availableTags = $this.data('autocomplete') || ["The", "Quick", "Brown", "Fox", "Jumps", "Over", "Three", "Lazy", "Dogs"];

            $this.autocomplete({
                source: availableTags
            });
        })
    }

    /*
     * JQUERY UI DATE
     * Dependency: js/libs/jquery-ui-1.10.3.min.js
     * Usage:
     */
    if ($.fn.datepicker) {
        $('.datepicker').each(function() {

            $this = $(this);
            var dataDateFormat = $this.attr('data-dateformat') || 'dd.mm.yy';

            $this.datepicker({
                dateFormat: dataDateFormat,
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
            });
        })
    }

    /*
     * AJAX BUTTON LOADING TEXT
     * Usage: <button type="button" data-loading-text="Loading..." class="btn btn-xs btn-default ajax-refresh"> .. </button>
     */
    $('button[data-loading-text]').on('click', function() {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function() {
            btn.button('reset')
        }, 3000)
    });

}

/* ~ END: INITIALIZE FORMS */

/*
 * INITIALIZE CHARTS
 * Description: Sparklines, PieCharts
 */

function runAllCharts() {
    /*
     * SPARKLINES
     * DEPENDENCY: js/plugins/sparkline/jquery.sparkline.min.js
     * See usage example below...
     */

    /* Usage:
     * 		<div class="sparkline-line txt-color-blue" data-fill-color="transparent" data-sparkline-height="26px">
     *			5,6,7,9,9,5,9,6,5,6,6,7,7,6,7,8,9,7
     *		</div>
     */

    if ($.fn.sparkline) {

        $('.sparkline').each(function() {
            $this = $(this);
            var sparklineType = $this.data('sparkline-type') || 'bar';

            // BAR CHART
            if (sparklineType == 'bar') {

                var barColor = $this.data('sparkline-bar-color') || $this.css('color') || '#0000f0', sparklineHeight = $this.data('sparkline-height') || '26px', sparklineBarWidth = $this.data('sparkline-barwidth') || 5, sparklineBarSpacing = $this.data('sparkline-barspacing') || 2, sparklineNegBarColor = $this.data('sparkline-negbar-color') || '#A90329', sparklineStackedColor = $this.data('sparkline-barstacked-color') || ["#A90329", "#0099c6", "#98AA56", "#da532c", "#4490B1", "#6E9461", "#990099", "#B4CAD3"];

                $this.sparkline('html', {
                    type: 'bar',
                    barColor: barColor,
                    type : sparklineType,
                            height: sparklineHeight,
                    barWidth: sparklineBarWidth,
                    barSpacing: sparklineBarSpacing,
                    stackedBarColor: sparklineStackedColor,
                    negBarColor: sparklineNegBarColor,
                    zeroAxis: 'false'
                });

            }

            //LINE CHART
            if (sparklineType == 'line') {

                var sparklineHeight = $this.data('sparkline-height') || '20px', sparklineWidth = $this.data('sparkline-width') || '90px', thisLineColor = $this.data('sparkline-line-color') || $this.css('color') || '#0000f0', thisLineWidth = $this.data('sparkline-line-width') || 1, thisFill = $this.data('fill-color') || '#c0d0f0', thisSpotColor = $this.data('sparkline-spot-color') || '#f08000', thisMinSpotColor = $this.data('sparkline-minspot-color') || '#ed1c24', thisMaxSpotColor = $this.data('sparkline-maxspot-color') || '#f08000', thishighlightSpotColor = $this.data('sparkline-highlightspot-color') || '#50f050', thisHighlightLineColor = $this.data('sparkline-highlightline-color') || 'f02020', thisSpotRadius = $this.data('sparkline-spotradius') || 1.5;
                thisChartMinYRange = $this.data('sparkline-min-y') || 'undefined', thisChartMaxYRange = $this.data('sparkline-max-y') || 'undefined', thisChartMinXRange = $this.data('sparkline-min-x') || 'undefined', thisChartMaxXRange = $this.data('sparkline-max-x') || 'undefined', thisMinNormValue = $this.data('min-val') || 'undefined', thisMaxNormValue = $this.data('max-val') || 'undefined', thisNormColor = $this.data('norm-color') || '#c0c0c0', thisDrawNormalOnTop = $this.data('draw-normal') || false;

                $this.sparkline('html', {
                    type: 'line',
                    width: sparklineWidth,
                    height: sparklineHeight,
                    lineWidth: thisLineWidth,
                    lineColor: thisLineColor,
                    fillColor: thisFill,
                    spotColor: thisSpotColor,
                    minSpotColor: thisMinSpotColor,
                    maxSpotColor: thisMaxSpotColor,
                    highlightSpotColor: thishighlightSpotColor,
                    highlightLineColor: thisHighlightLineColor,
                    spotRadius: thisSpotRadius,
                    chartRangeMin: thisChartMinYRange,
                    chartRangeMax: thisChartMaxYRange,
                    chartRangeMinX: thisChartMinXRange,
                    chartRangeMaxX: thisChartMaxXRange,
                    normalRangeMin: thisMinNormValue,
                    normalRangeMax: thisMaxNormValue,
                    normalRangeColor: thisNormColor,
                    drawNormalOnTop: thisDrawNormalOnTop

                });

            }

            //PIE CHART
            if (sparklineType == 'pie') {

                var pieColors = $this.data('sparkline-piecolor') || ["#B4CAD3", "#4490B1", "#98AA56", "#da532c", "#6E9461", "#0099c6", "#990099", "#717D8A"], pieWidthHeight = $this.data('sparkline-piesize') || 90, pieBorderColor = $this.data('border-color') || '#45494C', pieOffset = $this.data('sparkline-offset') || 0;

                $this.sparkline('html', {
                    type: 'pie',
                    width: pieWidthHeight,
                    height: pieWidthHeight,
                    tooltipFormat: '<span style="color: {{color}}">&#9679;</span> ({{percent.1}}%)',
                    sliceColors: pieColors,
                    offset: 0,
                    borderWidth: 1,
                    offset : pieOffset,
                            borderColor: pieBorderColor
                });

            }

            //BOX PLOT
            if (sparklineType == 'box') {

                var thisBoxWidth = $this.data('sparkline-width') || 'auto', thisBoxHeight = $this.data('sparkline-height') || 'auto', thisBoxRaw = $this.data('sparkline-boxraw') || false, thisBoxTarget = $this.data('sparkline-targetval') || 'undefined', thisBoxMin = $this.data('sparkline-min') || 'undefined', thisBoxMax = $this.data('sparkline-max') || 'undefined', thisShowOutlier = $this.data('sparkline-showoutlier') || true, thisIQR = $this.data('sparkline-outlier-iqr') || 1.5, thisBoxSpotRadius = $this.data('sparkline-spotradius') || 1.5, thisBoxLineColor = $this.css('color') || '#000000', thisBoxFillColor = $this.data('fill-color') || '#c0d0f0', thisBoxWhisColor = $this.data('sparkline-whis-color') || '#000000', thisBoxOutlineColor = $this.data('sparkline-outline-color') || '#303030', thisBoxOutlineFill = $this.data('sparkline-outlinefill-color') || '#f0f0f0', thisBoxMedianColor = $this.data('sparkline-outlinemedian-color') || '#f00000', thisBoxTargetColor = $this.data('sparkline-outlinetarget-color') || '#40a020';

                $this.sparkline('html', {
                    type: 'box',
                    width: thisBoxWidth,
                    height: thisBoxHeight,
                    raw: thisBoxRaw,
                    target: thisBoxTarget,
                    minValue: thisBoxMin,
                    maxValue: thisBoxMax,
                    showOutliers: thisShowOutlier,
                    outlierIQR: thisIQR,
                    spotRadius: thisBoxSpotRadius,
                    boxLineColor: thisBoxLineColor,
                    boxFillColor: thisBoxFillColor,
                    whiskerColor: thisBoxWhisColor,
                    outlierLineColor: thisBoxOutlineColor,
                    outlierFillColor: thisBoxOutlineFill,
                    medianColor: thisBoxMedianColor,
                    targetColor: thisBoxTargetColor

                })

            }

            //BULLET
            if (sparklineType == 'bullet') {

                var thisBulletHeight = $this.data('sparkline-height') || 'auto', thisBulletWidth = $this.data('sparkline-width') || 2, thisBulletColor = $this.data('sparkline-bullet-color') || '#ed1c24', thisBulletPerformanceColor = $this.data('sparkline-performance-color') || '#3030f0', thisBulletRangeColors = $this.data('sparkline-bulletrange-color') || ["#d3dafe", "#a8b6ff", "#7f94ff"]

                $this.sparkline('html', {
                    type: 'bullet',
                    height: thisBulletHeight,
                    targetWidth: thisBulletWidth,
                    targetColor: thisBulletColor,
                    performanceColor: thisBulletPerformanceColor,
                    rangeColors: thisBulletRangeColors

                })

            }

            //DISCRETE
            if (sparklineType == 'discrete') {

                var thisDiscreteHeight = $this.data('sparkline-height') || 26, thisDiscreteWidth = $this.data('sparkline-width') || 50, thisDiscreteLineColor = $this.css('color'), thisDiscreteLineHeight = $this.data('sparkline-line-height') || 5, thisDiscreteThrushold = $this.data('sparkline-threshold') || 'undefined', thisDiscreteThrusholdColor = $this.data('sparkline-threshold-color') || '#ed1c24';

                $this.sparkline('html', {
                    type: 'discrete',
                    width: thisDiscreteWidth,
                    height: thisDiscreteHeight,
                    lineColor: thisDiscreteLineColor,
                    lineHeight: thisDiscreteLineHeight,
                    thresholdValue: thisDiscreteThrushold,
                    thresholdColor: thisDiscreteThrusholdColor

                })

            }

            //TRISTATE
            if (sparklineType == 'tristate') {

                var thisTristateHeight = $this.data('sparkline-height') || 26, thisTristatePosBarColor = $this.data('sparkline-posbar-color') || '#60f060', thisTristateNegBarColor = $this.data('sparkline-negbar-color') || '#f04040', thisTristateZeroBarColor = $this.data('sparkline-zerobar-color') || '#909090', thisTristateBarWidth = $this.data('sparkline-barwidth') || 5, thisTristateBarSpacing = $this.data('sparkline-barspacing') || 2, thisZeroAxis = $this.data('sparkline-zeroaxis') || false;

                $this.sparkline('html', {
                    type: 'tristate',
                    height: thisTristateHeight,
                    posBarColor: thisBarColor,
                    negBarColor: thisTristateNegBarColor,
                    zeroBarColor: thisTristateZeroBarColor,
                    barWidth: thisTristateBarWidth,
                    barSpacing: thisTristateBarSpacing,
                    zeroAxis: thisZeroAxis

                })

            }

            //COMPOSITE: BAR
            if (sparklineType == 'compositebar') {

                var sparklineHeight = $this.data('sparkline-height') || '20px', sparklineWidth = $this.data('sparkline-width') || '100%', sparklineBarWidth = $this.data('sparkline-barwidth') || 3, thisLineWidth = $this.data('sparkline-line-width') || 1, thisLineColor = $this.data('sparkline-color-top') || '#ed1c24', thisBarColor = $this.data('sparkline-color-bottom') || '#333333'

                $this.sparkline($this.data('sparkline-bar-val'), {
                    type: 'bar',
                    width: sparklineWidth,
                    height: sparklineHeight,
                    barColor: thisBarColor,
                    barWidth: sparklineBarWidth
                            //barSpacing: 5

                })

                $this.sparkline($this.data('sparkline-line-val'), {
                    width: sparklineWidth,
                    height: sparklineHeight,
                    lineColor: thisLineColor,
                    lineWidth: thisLineWidth,
                    composite: true,
                    fillColor: false

                })

            }

            //COMPOSITE: LINE
            if (sparklineType == 'compositeline') {

                var sparklineHeight = $this.data('sparkline-height') || '20px', sparklineWidth = $this.data('sparkline-width') || '90px', sparklineValue = $this.data('sparkline-bar-val'), sparklineValueSpots1 = $this.data('sparkline-bar-val-spots-top') || null, sparklineValueSpots2 = $this.data('sparkline-bar-val-spots-bottom') || null, thisLineWidth1 = $this.data('sparkline-line-width-top') || 1, thisLineWidth2 = $this.data('sparkline-line-width-bottom') || 1, thisLineColor1 = $this.data('sparkline-color-top') || '#333333', thisLineColor2 = $this.data('sparkline-color-bottom') || '#ed1c24', thisSpotRadius1 = $this.data('sparkline-spotradius-top') || 1.5, thisSpotRadius2 = $this.data('sparkline-spotradius-bottom') || thisSpotRadius1, thisSpotColor = $this.data('sparkline-spot-color') || '#f08000', thisMinSpotColor1 = $this.data('sparkline-minspot-color-top') || '#ed1c24', thisMaxSpotColor1 = $this.data('sparkline-maxspot-color-top') || '#f08000', thisMinSpotColor2 = $this.data('sparkline-minspot-color-bottom') || thisMinSpotColor1, thisMaxSpotColor2 = $this.data('sparkline-maxspot-color-bottom') || thisMaxSpotColor1, thishighlightSpotColor1 = $this.data('sparkline-highlightspot-color-top') || '#50f050', thisHighlightLineColor1 = $this.data('sparkline-highlightline-color-top') || '#f02020', thishighlightSpotColor2 = $this.data('sparkline-highlightspot-color-bottom') || thishighlightSpotColor1, thisHighlightLineColor2 = $this.data('sparkline-highlightline-color-bottom') || thisHighlightLineColor1, thisFillColor1 = $this.data('sparkline-fillcolor-top') || 'transparent', thisFillColor2 = $this.data('sparkline-fillcolor-bottom') || 'transparent';

                $this.sparkline(sparklineValue, {
                    type: 'line',
                    spotRadius: thisSpotRadius1,
                    spotColor: thisSpotColor,
                    minSpotColor: thisMinSpotColor1,
                    maxSpotColor: thisMaxSpotColor1,
                    highlightSpotColor: thishighlightSpotColor1,
                    highlightLineColor: thisHighlightLineColor1,
                    valueSpots: sparklineValueSpots1,
                    lineWidth: thisLineWidth1,
                    width: sparklineWidth,
                    height: sparklineHeight,
                    lineColor: thisLineColor1,
                    fillColor: thisFillColor1

                })

                $this.sparkline($this.data('sparkline-line-val'), {
                    type: 'line',
                    spotRadius: thisSpotRadius2,
                    spotColor: thisSpotColor,
                    minSpotColor: thisMinSpotColor2,
                    maxSpotColor: thisMaxSpotColor2,
                    highlightSpotColor: thishighlightSpotColor2,
                    highlightLineColor: thisHighlightLineColor2,
                    valueSpots: sparklineValueSpots2,
                    lineWidth: thisLineWidth2,
                    width: sparklineWidth,
                    height: sparklineHeight,
                    lineColor: thisLineColor2,
                    composite: true,
                    fillColor: thisFillColor2

                })

            }

        });

    }// end if

    /*
     * EASY PIE CHARTS
     * DEPENDENCY: js/plugins/easy-pie-chart/jquery.easy-pie-chart.min.js
     * Usage: <div class="easy-pie-chart txt-color-orangeDark" data-pie-percent="33" data-pie-size="72" data-size="72">
     *			<span class="percent percent-sign">35</span>
     * 	  	  </div>
     */

    if ($.fn.easyPieChart) {

        $('.easy-pie-chart').each(function() {
            $this = $(this);
            var barColor = $this.css('color') || $this.data('pie-color'), trackColor = $this.data('pie-track-color') || '#eeeeee', size = parseInt($this.data('pie-size')) || 25;
            $this.easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size / 8.5),
                animate: 1500,
                rotate: -90,
                size: size,
                onStep: function(value) {
                    this.$el.find('span').text(~~value);
                }
            });
        });

    } // end if

}

/* ~ END: INITIALIZE CHARTS */

/*
 * INITIALIZE JARVIS WIDGETS
 */

// Setup Desktop Widgets
function setup_widgets_desktop() {

    if ($.fn.jarvisWidgets && $.enableJarvisWidgets) {

        $('#widget-grid').jarvisWidgets({
            grid: 'article',
            widgets: '.jarviswidget',
            localStorage: true,
            deleteSettingsKey: '#deletesettingskey-options',
            settingsKeyLabel: 'Reset settings?',
            deletePositionKey: '#deletepositionkey-options',
            positionKeyLabel: 'Reset position?',
            sortable: true,
            buttonsHidden: false,
            // toggle button
            toggleButton: true,
            toggleClass: 'fa fa-minus | fa fa-plus',
            toggleSpeed: 200,
            onToggle: function() {
            },
            // delete btn
            deleteButton: true,
            deleteClass: 'fa fa-times',
            deleteSpeed: 200,
            onDelete: function() {
            },
            // edit btn
            editButton: true,
            editPlaceholder: '.jarviswidget-editbox',
            editClass: 'fa fa-cog | fa fa-save',
            editSpeed: 200,
            onEdit: function() {
            },
            // color button
            colorButton: true,
            // full screen
            fullscreenButton: true,
            fullscreenClass: 'fa fa-resize-full | fa fa-resize-small',
            fullscreenDiff: 3,
            onFullscreen: function() {
            },
            // custom btn
            customButton: false,
            customClass: 'folder-10 | next-10',
            customStart: function() {
                alert('Hello you, this is a custom button...')
            },
            customEnd: function() {
                alert('bye, till next time...')
            },
            // order
            buttonOrder: '%refresh% %custom% %edit% %toggle% %fullscreen% %delete%',
            opacity: 1.0,
            dragHandle: '> header',
            placeholderClass: 'jarviswidget-placeholder',
            indicator: true,
            indicatorTime: 600,
            ajax: true,
            timestampPlaceholder: '.jarviswidget-timestamp',
            timestampFormat: 'Last update: %m%/%d%/%y% %h%:%i%:%s%',
            refreshButton: true,
            refreshButtonClass: 'fa fa-refresh',
            labelError: 'Sorry but there was a error:',
            labelUpdated: 'Last Update:',
            labelRefresh: 'Refresh',
            labelDelete: 'Delete widget:',
            afterLoad: function() {
            },
            rtl: false, // best not to toggle this!
            onChange: function() {

            },
            onSave: function() {

            },
            ajaxnav: $.navAsAjax // declears how the localstorage should be saved

        });

    }

}


//Inicia el fileUpload

function runFileUpload() {

    Dropzone.options.dictDefaultMessage = 'Arrastre sus archivos aqui (o de click)';
    $(".dropzone").dropzone({
        addRemoveLinks: false,
        maxFilesize: 200,
        dictResponseError: 'Error uploading file!'
    });
}



// Setup Desktop Widgets
function setup_widgets_mobile() {

    if ($.enableMobileWidgets && $.enableJarvisWidgets) {
        setup_widgets_desktop();
    }

}

/* ~ END: INITIALIZE JARVIS WIDGETS */

/*
 * GOOGLE MAPS
 * description: Append google maps to head dynamically
 */

var gMapsLoaded = false;
window.gMapsCallback = function() {
    gMapsLoaded = true;
    $(window).trigger('gMapsLoaded');
}
window.loadGoogleMaps = function() {
    if (gMapsLoaded)
        return window.gMapsCallback();
    var script_tag = document.createElement('script');
    script_tag.setAttribute("type", "text/javascript");
    script_tag.setAttribute("src", "http://maps.google.com/maps/api/js?sensor=false&callback=gMapsCallback");
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
}
/* ~ END: GOOGLE MAPS */

/*
 * LOAD SCRIPTS
 * Usage:
 * Define function = myPrettyCode ()...
 * loadScript("js/my_lovely_script.js", myPrettyCode);
 */

var jsArray = {};

function loadScript(scriptName, callback) {

    if (!jsArray[scriptName]) {
        jsArray[scriptName] = true;

        // adding the script tag to the head as suggested before
        var body = document.getElementsByTagName('body')[0];
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = scriptName;

        // then bind the event to the callback function
        // there are several events for cross browser compatibility
        //script.onreadystatechange = callback;
        script.onload = callback;

        // fire the loading
        body.appendChild(script);

    } else if (callback) {// changed else to else if(callback)
        //console.log("JS file already added!");
        //execute function
        callback();
    }

}

/* ~ END: LOAD SCRIPTS */

/*
 * APP AJAX REQUEST SETUP
 * Description: Executes and fetches all ajax requests also
 * updates naivgation elements to active
 */
if ($.navAsAjax)
{
    // fire this on page load if nav exists
    if ($('nav').length) {
        checkURL();
    }
    ;

    $(document).on('click', 'nav a[href!="#"]', function(e) {
        e.preventDefault();
        $this = $(e.currentTarget);

        // if parent is not active then get hash, or else page is assumed to be loaded
        if (!$this.parent().hasClass("active") && !$this.attr('target')) {

            // update window with hash
            // you could also do here:  $.device === "mobile" - and save a little more memory

            if ($.root_.hasClass('mobile-view-activated')) {
                $.root_.removeClass('hidden-menu');
                window.setTimeout(function() {
                    window.location.hash = $this.attr('href')
                }, 150);
                // it may not need this delay...
            } else {
                window.location.hash = $this.attr('href');
            }
        }

    });

    // fire links with targets on different window
    $(document).on('click', 'nav a[target="_blank"]', function(e) {
        e.preventDefault();
        $this = $(e.currentTarget);

        window.open($this.attr('href'));
    });

    // fire links with targets on same window
    $(document).on('click', 'nav a[target="_top"]', function(e) {
        e.preventDefault();
        $this = $(e.currentTarget);

        window.location = ($this.attr('href'));
    });

    // all links with hash tags are ignored
    $(document).on('click', 'nav a[href="#"]', function(e) {
        e.preventDefault();
    });

    // DO on hash change
    $(window).on('hashchange', function() {
        checkURL();
    });
}

// CHECK TO SEE IF URL EXISTS
function checkURL() {

    //get the url by removing the hash
    url = location.hash.replace(/^#/, '');

    container = $('#content');
    // Do this if url exists (for page refresh, etc...)
    if (url) {
        // remove all active class
        $('nav li.active').removeClass("active");
        // match the url and add the active class
        $('nav li:has(a[href="' + url + '"])').addClass("active");
        title = ($('nav a[href="' + url + '"]').attr('title'))

        // change page title from global var
        document.title = (title || document.title);
        //console.log("page title: " + document.title);

        // parse url to jquery
        loadURL(url, container);
    } else {

        // grab the first URL from nav
        $this = $('nav > ul > li:first-child > a[href!="#"]');

        //update hash
        window.location.hash = $this.attr('href');

    }

}

// LOAD AJAX PAGES

function loadURL(url, container) {
    //console.log(container)

    $.ajax({
        type: "GET",
        url: url,
        dataType: 'html',
        cache: true, // (warning: this will cause a timestamp and will call the request twice)
        beforeSend: function() {
            // cog placed
            container.html('<h1><i class="fa fa-cog fa-spin"></i> Loading...</h1>');

            // Only draw breadcrumb if it is main content material
            // TODO: see the framerate for the animation in touch devices

            if (container[0] == $("#content")[0]) {
                drawBreadCrumb();
                // update title with breadcrumb...
                document.title = $(".breadcrumb li:last-child").text();
                // scroll up
                $("html, body").animate({
                    scrollTop: 0
                }, "fast");
            } else {
                container.animate({
                    scrollTop: 0
                }, "fast");
            }
        },
        /*complete: function(){
         // Handle the complete event
         // alert("complete")
         },*/
        success: function(data) {
            // cog replaced here...
            // alert("success")

            container.css({
                opacity: '0.0'
            }).html(data).delay(50).animate({
                opacity: '1.0'
            }, 300);


        },
        error: function(xhr, ajaxOptions, thrownError) {
            container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4>');
        },
        async: false
    });

    //console.log("ajax request sent");
}

// UPDATE BREADCRUMB
function drawBreadCrumb() {

    //console.log("breadcrumb")
    $("#ribbon ol.breadcrumb").empty();
    $("#ribbon ol.breadcrumb").append($("<li>Home</li>"));
    $('nav li.active > a').each(function() {
        $("#ribbon ol.breadcrumb").append($("<li></li>").html($.trim($(this).clone().children(".badge").remove().end().text())));
    });

}

/* ~ END: APP AJAX REQUEST SETUP */

/*
 * PAGE SETUP
 * Description: fire certain scripts that run through the page
 * to check for form elements, tooltip activation, popovers, etc...
 */
function pageSetUp() {
    flag_dbclick_edit = 0;
    flag_enter_edit = " ";

    if ($.device === "desktop") {
        // is desktop

        // activate tooltips
        $("[rel=tooltip]").tooltip();

        // activate popovers
        $("[rel=popover]").popover();

        // activate popovers with hover states
        $("[rel=popover-hover]").popover({
            trigger: "hover"
        });

        // activate inline charts
        runAllCharts();

        // setup widgets
        setup_widgets_desktop();

        //setup nav height (dynamic)
        nav_page_height();

        // run form elements
        runAllForms();

        //Inicia el plugin para subir los archivos

        //runFileUpload();

    } else {

        // is mobile

        // activate popovers
        $("[rel=popover]").popover();

        // activate popovers with hover states
        $("[rel=popover-hover]").popover({
            trigger: "hover"
        });

        // activate inline charts
        runAllCharts();

        // setup widgets
        setup_widgets_mobile();

        //setup nav height (dynamic)
        nav_page_height();

        // run form elements
        runAllForms();

    }

    //////-----------------------------------LIMPIAR FORMULARIO DE NUEVO REGISTRO----------------------------
    $("#cancel_new").click(function() {
        $(".smart-form").find('input').each(function() {
            var elemento = this;
            var div = elemento.id.split('_');
            if (div[0] == 'NT') {
                $("#" + elemento.id).val("");
            }

        });
        $(".smart-form").find('.error').remove();
        $(".smart-form").find('select').each(function() {
            var elemento = this;

            if (elemento.name == "new_select") {
                var tdid = $("#" + elemento.id).closest('td').attr('id');

                $("#" + elemento.id).val(["0"]).trigger("change");

            }
        });

    });


    $(".btn btn-success").click(function() {
        $(".smart-form").find('.error').remove();
        $(".smart-form").find('select').each(function() {
            var elemento = this;

            if (elemento.name == "new_select") {
                var tdid = $("#" + elemento.id).closest('td').attr('id');

                $("#" + elemento.id).val(["0"]).trigger("change");

            }
        });

    });

    // Agrega el icono para indicar que el campo es editable
    $('[data-url]').hover(function() {
        if ($(this).find('span.glyphicon').length > 0 || $(this).find('input').length > 0) {
            return false
        } else {
            $(this).html('<span class="glyphicon glyphicon-pencil">&nbsp;</span>' + $(this).html());
        }
    }, function() {
        $(this).find('span.glyphicon').remove();
    });

}

// Keep only 1 active popover per trigger - also check and hide active popover if user clicks on document
$('body').on('click', function(e) {

    $('[rel="popover"]').each(function() {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });


});


/*----------------------FUNCIONES PARA EDICION DE CAMPOS DIRECTAMENTE EN TABLA Y REALIZAR UPDATE -------------*/
// Es importante que en la vista venga la funcion  jq_edit_t en los td que son editables, debe ser un evento ondblclick
// tiene que incluirse en el id del td el siguiente formato "[pk del registro a modificar]_[nombre del campo a modificar]_[tipo de campo]"
// los tipos de de los campo son tres: 
// "ema": para validar email 
// "dsc": para nombres o descripciones 
// "enu": para campos numericos 
// los tipos de campo son para evaluar bajo expresiones regulares los campos ingresados
// tiene que contar con el atributo data-url con la url donde se encuentra el accion de update
// este sera el formato del action que debe incluirse en el controler del modulo en cuestion 
// public function actionUpdate[nombre a eleccion]()
//	{	
//		$this->layout = false;
//		
//	         $tab = $this->loadModel($_POST['id']);
//                 $tab->$_POST['camp']= $_POST['nue'];
//                 echo $tab->update();
//               
//	}

var flag_dbclick_edit = 0;//bandera para validar estado de la modificacion 
var flag_enter_edit = " ";
function jq_edit_t(d) {//funcion para activar cambio en celda
    if (flag_dbclick_edit == 0) {  //validacion para tener solo una modificacion por vez
        var id = d;// obtengo el id del td
        var iden = "'" + id + "'"; //opcional
        var table = $("#" + id).closest("table").attr("id"); //obtengo el id de la tabla pintada, esta incluye la tabla de base de datos de la que hablamos
        var contenido = $("#" + table).find("#" + id).text().trim(); //obtengo el contenido del td en cuestion 
        var urlpost = "'" + $("#" + id).attr('data-url') + "'";
        $("#" + table).find("#" + id).html('<input type="text" id="jq_temp_cel" class="jq_temp_cel" value="' + contenido + '" onkeyup="update_cel(' + iden + ',' + urlpost + ',event)"  />'); //onfocusout="update_celf('+iden+','+urlpost+')"
        $("#jq_temp_cel").select();
        flag_dbclick_edit = 1; //bandera comprobar modificacion activa o no
    } else {
        alert("No se puede modificar el dato, se esta modificando otro campo actualmente, pulse Enter y vuelva a intentarlo");
        $("#jq_temp_cel").select();
NT_receptiondate_daty
    }
}

function update_cel(id, urlpost, e) { //realizar la accion de update
    var tecla = (document.all) ? e.keyCode : e.which;
    var loc_enter_edit = $("#jq_temp_cel").val();
    if (tecla == 13 && loc_enter_edit != flag_enter_edit) { //Validar tecla Enter

        var nuevo_dato = $("#jq_temp_cel").val(); //obtenemos el nuevo dato ingresado
        var valid = 0; //bandera para validar que el campo tenga el formato adecuado
        var ident = id.split('_'); //identificador id del dato que se esta modificando (incluye que tipo de campo se esta tratando de modificar)

        switch (ident[2]) {
            case "dsc":
                if (!$("#jq_temp_cel").val().match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ&\.\,\'_\s]+$/)) { //uso de expresiones regulares para validar campo ingresado
                    alert("Este campo solo permite letras y vocales con acentos");
                    $("#jq_temp_cel").select();
                    valid = 1;
                    flag_enter_edit = $("#jq_temp_cel").val();
                    //$("#jq_temp_cel").blur();
                }
                break;
            case "enu":
                if (!$("#jq_temp_cel").val().match(/^[0-9]+$/)) { //uso de expresiones regulares para validar campo ingresado
                    alert("Este campo solo permite ingresar numeros");
                    $("#jq_temp_cel").select();
                    valid = 1;
                    flag_enter_edit = $("#jq_temp_cel").val();
                    //$("#jq_temp_cel").blur();
                }
                break;
            case "ema":
                if (!$("#jq_temp_cel").val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) { //uso de expresiones regulares para validar campo ingresado
                    alert("La direccion de correo que esta intentando ingresar no tiene el formato adecuado");
                    $("#jq_temp_cel").select();
                    valid = 1;
                    flag_enter_edit = $("#jq_temp_cel").val();
                    // $("#jq_temp_cel").blur();
                }NT_receptiondate_daty
                break;
            case "rfc":
                if (!$("#jq_temp_cel").val().match(/^[a-zA-Z]{3,4}(\d{6})((\D|\d){3})?$/)) { //uso de expresiones regulares para validar campo ingresado
                    alert("Este campo es exclusivo para RFC favor valide la información");
                    $("#jq_temp_cel").select();
                    valid = 1;
                    flag_enter_edit = $("#jq_temp_cel").val();
                    // $("#jq_temp_cel").blur();
                }
                break;
            case "hrs":
                if (!$("#jq_temp_cel").val().match(/^(0[1-9]|1\d|2[0-3]):([0-5]\d):([0-5]\d)$ /)) { //uso de expresiones regulares para validar campo ingresado
                    alert("Este campo es solo valida horas");
                    $("#jq_temp_cel").select();
                    valid = 1;
                    flag_enter_edit = $("#jq_temp_cel").val();
                    //$("#jq_temp_cel").blur();
                }
                break;

        }



        if (valid == 0) {  //valida bandera para ver si se puede realizar el update

            var tab = "s";
            //update_validado(ident[1],tab,nuevo_dato,ident[0], urlpost);
            $.post(urlpost, {nue: nuevo_dato, id: ident[0], camp: ident[1]}, function(response) {

                if (response == 1) {
                    alert("Modificacion realizada correctamente");
                    location.reload();
                } else {
                    alert("No se a podido realizar la modificacion, consulte con el Administrador");
                    location.reload();
                }
            });


        }
    } else {
        if (tecla == 27) {
            var viejo_dato = $("#jq_temp_cel").attr("value");
            $("#" + id).html(viejo_dato);

            flag_dbclick_edit = 0;
        }
    }

}
//-----------------------------------------------VALIDACION EXCLUSIVA PARA FORMULARIOS, INCLUYE EXPRESIONES REGULARES--------------------------------//    
//Para validar los campos de un formulario, este debe contener en cada una de los id de las cajas de texto la siguiente estructura
//   id="NT_[nombre del campo de la tabla]_[tipo]"
// esta estructura nos servira para validar los campos tipo NT, 
// es importante que la caja de texto lleve el nombre del campo de la tabla de base de datos en la que se va a insertar
// si no se cuenta con el nombre el procedimiento fallara, el siguiente dato son para someter el valor que se ingreso
// a validaciones de escritura ya que suele darse el caso que se introducen caracteres erroneos, 
// estos estan siendo validados por expresiones regulares
// existe varios tipos de validacion abajo estan las validaciones existentes.


function valid_expresion_form(nip) {

    var valid = 0;
    var div = nip.split("_");
    var id = div[1];
    var tipos = div[2];
    $("#" + div[0] + '_' + id + "td").find(".error").remove();
 
    switch (tipos) {
        case "area":
            if ($("#" + nip).val().length === 0) {
                $('<label class="error" generated="true">El campo no puede estar vacío</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
            }
            if ($("#" + nip).val().length > div[3]) {
                $('<label class="error" generated="true">El campo no puede contener mas de '+div[3]+' caracteres</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
            }
            return valid;
        break;
        case "sel":
            if ($("#" + nip).val().length === 0 ||$("#" + nip).val() <= 0  ) {
                $('<label class="error" generated="true">Debe seleccionar una opción</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
                return valid;
            }
            break;
        case "txt":
            if ($("#" + nip).val().length === 0) {
                $('<label class="error" generated="true">El campo no puede estar vacío</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
                return valid;
            }
            break;
        case "date":
            if (!$("#" + nip).val().match(/^([0]\d|[1][0-2])\/([0-2]\d|[3][0-1])\/([2][01]|[1][6-9])\d{2}(\s([0-1]\d|[2][0-3])(\:[0-5]\d){1,2})?$/)) {
                $('<label class="error" generated="true">El campo solo permite ingresar fecha en formato dd/mm/yyyy</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
                return valid;
            }

            break;
             case "daty":
            if ($("#" + nip).val().length === 0) {
                $('<label class="error" generated="true">El campo solo permite ingresar fecha en formato yyyy-mm-dd</label>').appendTo("#" + div[0] + '_' + id + "td");
              //  $("#" + nip).select();
                valid = 1;
                return valid;
            }

            break;
        case "dsc":
            if (!$("#" + nip).val().match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ&\.\,\'_\s]+$/)) { //uso de expresiones regulares para validar campo ingresado
                $('<label class="error" generated="true">El campo solo permite ingresar caracteres alfabeticos</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
                return valid;
            }
            break;
        case "enu":
            if (!$("#" + nip).val().match(/^[0-9]+$/)) { //uso de expresiones regulares para validar campo ingresado
                $('<label class="error" generated="true">El campo solo admite valores numericos</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
            }
            else{
                valid = 0;
            }
            return valid;
            break;
        case "ema":
            if (!$("#" + nip).val().match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/)) { //uso de expresiones regulares para validar campo ingresado
                $('<label class="error" generated="true">La direccion de correo que esta intentando ingresar no tiene el formato adecuado</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
                return valid;
            }
            break;
        case "rfc":
            if (!$("#" + nip).val().match(/^[a-zA-Z]{3,4}(\d{6})((\D|\d){3})?$/)) { //uso de expresiones regulares para validar campo ingresado
                $('<label class="error" generated="true">Este campo es exclusivo para RFC favor valide la informacion</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
                return valid;
            }
            break;
        case "pric":
            if (!$("#" + nip).val().match(/^[0-9]+\.*[0-9]*$/)) { //uso de expresiones regulares para validar campo ingresado
                $('<label class="error" generated="true">Este campo es exclusivo para precios</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
            }
            else{
                valid = 0;
            }
            return valid;
            break;
        case "passwo":
            if (!$("#" + nip).val().match(/^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i)) { //uso de expresiones regulares para validar campo ingresado
                $('<label class="error" generated="true">El campo password solo contiene numeros o letras</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
                return valid;
            }
            break;
        case "use":
            if (!$("#" + nip).val().match(/^[a-z0-9_-]{3,16}$/)) { //uso de expresiones regulares para validar campo ingresado
                $('<label class="error" generated="true">El Nickname solo permite usar letras, numeros y guines</label>').appendTo("#" + div[0] + '_' + id + "td");
                $("#" + nip).select();
                valid = 1;
                return valid;
            }
            break;    
    }
}

/**
 * Move the timeline a given percentage to left or right
 * @param {Number} percentage   For example 0.1 (left) or -0.1 (right)
 */
function move(percentage, id) {
    var range = id.getWindow();
    var interval = range.end - range.start;

    id.setWindow({
        start: range.start.valueOf() - interval * percentage,
        end: range.end.valueOf() - interval * percentage
    });
}

/**
 * Zoom the timeline a given percentage in or out
 * @param {Number} percentage   For example 0.1 (zoom out) or -0.1 (zoom in)
 */
function zoom(percentage, id) {
    var range = id.getWindow();
    var interval = range.end - range.start;

    id.setWindow({
        start: range.start.valueOf() - interval * percentage,
        end: range.end.valueOf() + interval * percentage
    });
}
