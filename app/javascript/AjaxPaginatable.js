(function($) {
    if ($('.pagination').length) {
        $('.paginatable').on('click','.pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax(url)
                .done(function (response) {
                    $('.paginatable').html(response);
                    window.history.pushState(null,'',url);
                    $('#js-required').fadeOut('fast');
                })
                .fail (function (xhr) {
                    alert('Error: ' + xhr.responseText);
                });
        });
    }
})(jQuery);
