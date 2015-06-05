/*   
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 1.7.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v1.7/frontend/
    ----------------------------
        APPS CONTENT TABLE
    ----------------------------
    
    <!-- ======== GLOBAL SCRIPT SETTING ======== -->
    01. Handle Home Content Height
    02. Handle Header Navigation State
    03. Handle Commas to Number
    04. Handle Page Container Show
    05. Handle Pace Page Loading Plugins
    06. Handle Page Scroll Content Animation
    07. Handle Header Scroll To Action
    08. Handle Tooltip Activation
    09. Handle Theme Panel Expand
    10. Handle Theme Page Control
	
    <!-- ======== APPLICATION SETTING ======== -->
    Application Controller
*/



/* 01. Handle Home Content Height
------------------------------------------------ */
var handleHomeContentHeight = function() {
    $('#home').height($(window).height());
};


/* 02. Handle Header Navigation State
------------------------------------------------ */
var handleHeaderNavigationState = function() {
    $(window).on('scroll load', function() {
        if ($('#header').attr('data-state-change') != 'disabled') {
            var totalScroll = $(window).scrollTop();
            var headerHeight = $('#header').height();
            if (totalScroll >= headerHeight) {
                $('#header').addClass('navbar-small');
            } else {
                $('#header').removeClass('navbar-small');
            }
        }
    });
};


/* 03. Handle Commas to Number
------------------------------------------------ */
var handleAddCommasToNumber = function(value) {
    return value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
};


/* 04. Handle Page Container Show
------------------------------------------------ */
var handlePageContainerShow = function() {
    $('#page-container').addClass('in');
};


/* 05. Handle Pace Page Loading Plugins
------------------------------------------------ */
var handlePaceLoadingPlugins = function() {
    Pace.on('hide', function(){
        $('.pace').addClass('hide');
    });
};


/* 06. Handle Page Scroll Content Animation
------------------------------------------------ */
var handlePageScrollContentAnimation = function() {
    $('[data-scrollview="true"]').each(function() {
        var myElement = $(this);

        var elementWatcher = scrollMonitor.create( myElement, 60 );
        
        elementWatcher.enterViewport(function() {
            $(myElement).find('[data-animation=true]').each(function() {
                var targetAnimation = $(this).attr('data-animation-type');
                var targetElement = $(this);
                if (!$(targetElement).hasClass('contentAnimated')) {
                    $(this).addClass(targetAnimation + ' contentAnimated');
                }
            });
        });
    });
};


/* 07. Handle Header Scroll To Action
------------------------------------------------ */
var handleHeaderScrollToAction = function() {
    $('[data-click=scroll-to-target]').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var target = $(this).attr('href');
        var headerHeight = 50;
        $('html, body').animate({
            scrollTop: $(target).offset().top - headerHeight
        }, 500);
        
        if ($(this).attr('data-toggle') == 'dropdown') {
            var targetLi = $(this).closest('li.dropdown');
            if ($(targetLi).hasClass('open')) {
                $(targetLi).removeClass('open');
            } else {
                $(targetLi).addClass('open');
            }
        }
    });
    $(document).click(function(e) {
        if (!e.isPropagationStopped()) {
            $('.dropdown.open').removeClass('open'); 
        }
    });
};


/* 08. Handle Tooltip Activation
------------------------------------------------ */
var handleTooltipActivation = function() {
    if ($('[data-toggle=tooltip]').length !== 0) {
        $('[data-toggle=tooltip]').tooltip('hide');
    }
};

var targetTop;
var typeAjax;
var handleSidebarAjaxClick = function() {
    $('#header [data-toggle=ajax]').click(function() {
        var targetLi = $(this).closest('li');
        var targetParentLi = $(this).parents();
        $('#header li').not(targetLi).not(targetParentLi).removeClass('active');
        $(targetLi).addClass('active');
        $(targetParentLi).addClass('active');
    });

    $.pjax.defaults.timeout = 10000;

    $(document).on('click', '#header [data-toggle=ajax]', function(event) {
        var container = $('#ajax-content');
        $.pjax.click(event, {container: container});

        window.targetTop = container;
        window.typeAjax = 'full';

        var navbar_toggle = $(".navbar-toggle")

        if(navbar_toggle.css('display') != 'none' && ! navbar_toggle.hasClass('collapse')) {
            navbar_toggle.click();
        }
    });

    $(document).on('click', '.pagination a', function(event) {
        var target = $(event.currentTarget);
        var container = $('#ajax-content');
        $.pjax.click(event, {container: container});

        window.targetTop = target.closest('.content');
        window.typeAjax = 'partial';
    });

    $(document).on('submit', '#ajax-content form[data-pjax]', function(event) {
        var target = $(event.currentTarget);

        var method = target.attr('method');

        if(method == 'GET') {
            var url = target.attr('action') + '?' + target.serialize();
            $.pjax({url: url, container: '#ajax-content'});
        } else {
            var options = {
                dataType: 'json',

                beforeSubmit: function () {
                    Pace.restart();
                },

                success: function (data, status, xhr) {
                    if (xhr.status == 200) {
                        if (target.data('pjax-success')) {
                            window[target.data('pjax-success')](data, status, xhr);
                        } else {
                            $.pjax({url: data.url, container: '#ajax-content'})
                        }

                        if (data.msg) {
                            handleParseNotification(data.msg);
                        }
                    }
                },

                error: function (xhr, status, error) {
                    if (xhr.status == 422) {
                        var error_data = jQuery.parseJSON(xhr.responseText)
                        handleFormAjaxError(error_data);
                    }

                    if (xhr.status == 500) {
                        handleErrorNotification('Baru saja sistem gagal melakukan operasi. Silahkan ulangi atau tunggu beberapa saat. Jika masih terjadi kesalahan silahkan hubungi administrator.');
                    }
                }
            };

            handleConfirmation(target, function () {
                target.ajaxSubmit(options);
            });
        }

        event.preventDefault();
    });

    $(document).on('pjax:beforeSend', function() {
        Pace.restart();
        $('.jvectormap-label, .jvector-label, .AutoFill_border ,#gritter-notice-wrapper, .ui-autocomplete, .colorpicker, .FixedHeader_Header, .FixedHeader_Cloned .lightboxOverlay, .lightbox').remove();
    });

    $(document).on('pjax:beforeReplace', function() {
        scrollingTextStop();

        $('html, body').animate({
            scrollTop: window.targetTop.offset().top
        }, 250);
    });

    $(document).on('pjax:success', function() {
        window.targetTop = null;
        window.typeAjax = null;
    });
};

var scrollingTextInt;
var scrollingText = function() {
    var words = document.getElementsByClassName('word');
    var wordArray = [];
    var currentWord = 0;

    words[currentWord].style.opacity = 1;
    for (var i = 0; i < words.length; i++) {
        splitLetters(words[i]);
    }

    function changeWord() {
        var cw = wordArray[currentWord];
        var nw = currentWord == words.length-1 ? wordArray[0] : wordArray[currentWord+1];
        for (var i = 0; i < cw.length; i++) {
            animateLetterOut(cw, i);
        }

        for (var i = 0; i < nw.length; i++) {
            nw[i].className = 'letter behind';
            nw[0].parentElement.style.opacity = 1;
            animateLetterIn(nw, i);
        }

        currentWord = (currentWord == wordArray.length-1) ? 0 : currentWord+1;
    }

    function animateLetterOut(cw, i) {
        setTimeout(function() {
            cw[i].className = 'letter out';
        }, i*80);
    }

    function animateLetterIn(nw, i) {
        setTimeout(function() {
            nw[i].className = 'letter in';
        }, 340+(i*80));
    }

    function splitLetters(word) {
        var content = word.innerHTML;
        word.innerHTML = '';
        var letters = [];
        for (var i = 0; i < content.length; i++) {
            var letter = document.createElement('span');
            letter.className = 'letter';
            letter.innerHTML = content.charAt(i);
            word.appendChild(letter);
            letters.push(letter);
        }

        wordArray.push(letters);
    }

    changeWord();
    scrollingTextInt = setInterval(changeWord, 4000);
}

var scrollingTextStop = function() {
    clearInterval(scrollingTextInt);
}


/* Application Controller
------------------------------------------------ */
var App = function () {
	"use strict";
	
	return {
		//main function
		init: function () {
		    handleHomeContentHeight();
		    handleHeaderNavigationState();
		    handlePageContainerShow();
		    handlePaceLoadingPlugins();
		    handlePageScrollContentAnimation();
		    handleHeaderScrollToAction();
            handleTooltipActivation();
            handleSidebarAjaxClick();
        },
        setPageTitle: function(pageTitle) {
            document.title = pageTitle;
        },
        scrollingText: scrollingText,
        restartGlobalFunction: function() {
            handleHomeContentHeight();
            handleHeaderNavigationState();
            handlePageContainerShow();
            handlePaceLoadingPlugins();
            handlePageScrollContentAnimation();
            handleHeaderScrollToAction();
            handleTooltipActivation();
        }
  };
}();