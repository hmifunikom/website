$(document).on('click','.popup_selector',function (event) {
    event.preventDefault();
    var updateID = $(this).attr('data-inputid'); // Btn id clicked
    var elfinderUrl = '/elfinder/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '400px'
    });

});

function resizeColorbox(height) {
    $.colorbox.resize({
        innerHeight:height
    });
}

// function to update the file selected by elfinder
function processSelectedFile(file, requestingField) {
    console.log(file);
    $('#' + requestingField).val(file.url);
}
