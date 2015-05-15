$(function(){
    if(! $('.js-navbar-small').length && $('.jumbotron').length > 0) {
        var navbar_offset = $('.jumbotron').offset().top + $('.jumbotron').height();
        $(window).scroll(function(){
            if ($(document).scrollTop() > navbar_offset) {
                $('.navbar').removeClass("big");
            } else {
                $('.navbar').addClass("big");
            }
        });
    }

     var jcarousel = $('.jcarousel');

    if(jcarousel.length > 0) {
        $('.jcarousel').on('jcarousel:reload jcarousel:create', function () {
            var width = jcarousel.width();

            if (width >= 768) {
                width = width / 3;
            } else if (width >= 600) {
                width = width / 2;
            } else if (width >= 350) {
                width = width;
            }

            jcarousel.jcarousel('items').css('width', width + 'px');
        }).jcarousel({
            wrap: 'circular'
        });

        $('.jcarousel-pagination').on('jcarouselpagination:active', 'a', function() {
            $(this).addClass('active');
        }).on('jcarouselpagination:inactive', 'a', function() {
            $(this).removeClass('active');
        }).on('click', function(e) {
            e.preventDefault();
        }).jcarouselPagination({
            perPage: 1,
            item: function(page) {
                return '<a href="#' + page + '">' + page + '</a>';
            }
        });
    }

    $('.js-event-toggle-type .btn').on('click', function(){
        var active_class = $(this).find('input').val();
        
        var e_active = $('.event-view').find('.' + active_class);
        e_active.fadeIn();
        e_active.siblings().hide();

    });

    setTimeout(function() {
        var ic_h = $('.info-container').height();
        var dc_h = $('.detail-container').height();

        if(dc_h > ic_h) {
            $('.js-affix').affix({
                offset: {
                    top: function () {
                        return this.top = $('.js-affix-top').offset().top;
                    },
                    bottom: function () {
                        return this.bottom = $("footer").outerHeight(!0) + $(".tagline-hmif").outerHeight(!0) + 100;
                    }
                }
            });
        }
    }, 100);

    $('.confirm-delete').submit(function(e) {
        var data = $(this).data('confirm');
        var message = ($(this).data('confirm-message')) ? $(this).data('confirm-message') : '';
        var conf = confirm('Anda yakin ingin menghapus ' + data + ' ini? ' + message);
        $('<input>').attr('type','hidden').attr("name", "safe-action").val("1").appendTo(this);
        if(conf) {
            return true;
        }
        e.preventDefault();
    }); 
});