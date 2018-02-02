$(window).scroll(function() {
    if($(this).scrollTop() > 720)
    {
        $('.author-custom > h5').text('Authors');
    } else {
        $('.author-custom > h5').text('Author #1');
    }
});