$(document).ready(function() {
    $(window).load(function() {
        if($('#fullpage').length) {
            $(".preloader").fadeOut();
            $('#fullpage').fullpage({
                resize: false,
                verticalCentered: false,
                anchors: ['Main', 'DebatIT', 'ITContest', 'LKTI', 'TheColorRun', 'Contact'],
                slidesColor: ['#fff', '#333', '#fff', '#008cd6', '#333', '#fff'],
                autoScrolling: true,
                paddingTop: '50px',
                css3:true,
                scrollingSpeed:100,

                afterLoad: function(anchorLink, index){
                    $('.cakrawala-logo.green').toggleClass('active', (anchorLink == 'ITContest'));
                    $('.cakrawala-logo.red').toggleClass('active', (anchorLink == 'DebatIT'));
                    $('.cakrawala-logo.blue').toggleClass('active', (anchorLink == 'TheColorRun' ));
                    $('.cakrawala-logo.black').toggleClass('active', (anchorLink == 'LKTI'));

                    $('.nav .debat').toggleClass('active', (anchorLink == 'DebatIT'));
                    $('.nav .itcontest').toggleClass('active', (anchorLink == 'ITContest'));
                    $('.nav .lkti').toggleClass('active', (anchorLink == 'LKTI'));
                    $('.nav .thecolorrun').toggleClass('active', (anchorLink == 'TheColorRun'));
                    $('.nav .contact').toggleClass('active', (anchorLink == 'Contact'));
                },

                onLeave: function(index, nextIndex, direction){
                    
                },

                afterSlideLoad: function( anchorLink, index, slideAnchor, slideIndex) {

                    if(anchorLink == 'DebatIT') {
                        switch(slideIndex) {
                            case 0:
                                if(! $('#persyaratan').hasClass('in')) {
                                    $('.coll-persyaratan').click();
                                }
                            break;

                            case 1:
                                if(! $('#teknis').hasClass('in')) {
                                    $('.coll-teknis').click();
                                }
                            break;

                            case 2:
                                if(! $('#tanggal').hasClass('in')) {
                                    $('.coll-tanggal').click();
                                }
                            break;

                            case 3:
                                if(! $('#hadiah').hasClass('in')) {
                                    $('.coll-hadiah').click();
                                }
                            break;
                        }
                    }

                    if(anchorLink == 'ITContest') {
                        $('.info-title.persyaratan').toggleClass('active', (slideAnchor == 'persyaratan'));
                        $('.info-title.tanggal').toggleClass('active', (slideAnchor == 'tanggal'));
                        $('.info-title.teknis').toggleClass('active', (slideAnchor == 'teknis'));
                        $('.info-title.hadiah').toggleClass('active', (slideAnchor == 'hadiah'));
                    }

                    if(anchorLink == 'LKTI') {
                        switch(slideIndex) {
                            case 0:
                                $('.panel-v.persyaratan .panel-title a').click();
                            break;

                            case 1:
                                $('.panel-v.teknis .panel-title a').click();
                            break;

                            case 2:
                                $('.panel-v.waktu .panel-title a').click();
                            break;

                            case 3:
                                $('.panel-v.hadiah .panel-title a').click();
                            break;
                        }
                    }

                    if(anchorLink == 'TheColorRun') {
                        switch(slideIndex) {
                            case 0:
                                if(! $('#pendaftaran').hasClass('in')) {
                                    $('.coll-pendaftaran').click();
                                }
                            break;

                            case 1:
                                if(! $('#racepack').hasClass('in')) {
                                    $('.coll-racepack').click();
                                }
                            break;

                            case 2:
                                if(! $('#raceday').hasClass('in')) {
                                    $('.coll-raceday').click();
                                }
                            break;
                        }
                    }
                },

                onSlideLeave: function( anchorLink, index, slideIndex, direction){

                }

            });

            activePanel = $("#accordion2 div.panel-v:first");
            $(activePanel).addClass('active');

            $('.panel-v .panel-title a').on('click', function(e){
                var target = $(this).data('anchor');
                target =  $('.panel-v.' + target);

                if( ! target.is('.active') ){
                    $(activePanel).animate({width: "40px"}, 300);
                    target.animate({width: "852px"}, 300);
                    $('#accordion2 .panel-v').removeClass('active');
                    target.addClass('active');
                    activePanel = target;
                }
            });

            $('.arrow').on('click', function() {
                if ($(this).hasClass('arrowLeft')) {
                    $.fn.fullpage.moveSlideLeft();
                } else {
                    $.fn.fullpage.moveSlideRight();
                }
            });

            $('.scroll').slimScroll({
                size: '10px',
                railVisible: true,
                alwaysVisible: true
            });
        }
    });

    $('.datepick').datepicker();
});

function createSlimScrolling(element){
    //needed to make `scrollHeight` work under Opera 12
    element.css('overflow', 'hidden');
    
    //in case element is a slide
    var section = element.closest('.section');
    var scrollable = element.find('.scrollable');

    var contentHeight;
    //if there was scroll, the contentHeight will be the one in the scrollable section
    if(scrollable.length){
        contentHeight = element.find('.scrollable').get(0).scrollHeight;
    }else{
        contentHeight = element.get(0).scrollHeight;
        if(true){
            contentHeight = element.find('.tableCell').get(0).scrollHeight;
        }
    }

    var scrollHeight = windowsHeight - parseInt(section.css('padding-bottom')) - parseInt(section.css('padding-top'));

    //needs scroll?
    if (contentHeight > scrollHeight) {
        //was there already an scroll ? Updating it
        if(scrollable.length){
            scrollable.css('height', scrollHeight + 'px').parent().css('height', scrollHeight + 'px');
        }
        //creating the scrolling
        else{
            if(true){
                element.find('.tableCell').wrapInner('<div class="scrollable" />');
            }else{
                element.wrapInner('<div class="scrollable" />');
            }
            

            element.find('.scrollable').slimScroll({
                height: scrollHeight + 'px',
                size: '10px',
                alwaysVisible: true
            });
        }
    }
    
    //removing the scrolling when it is not necessary anymore
    else{
        element.find('.scrollable').children().first().unwrap().unwrap();
        element.find('.slimScrollBar').remove();
        element.find('.slimScrollRail').remove();
    }
    
    //undo 
    element.css('overflow', '');
}