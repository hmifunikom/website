$(function(){
    $('.datepick').datepicker();
    
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

    $('.confirm-action').click(function(e) {
        var data = $(this).data('confirm');
        var link = $(this).data('href');
        var message = ($(this).data('confirm-message')) ? $(this).data('confirm-message') : '';
        var conf = confirm('Anda yakin ingin ' + data + ' ? ' + message);
        if(conf) {
            return window.location.href = link;
        }
        e.preventDefault();
    });
    
    $('.js-tooltip').tooltip();
});