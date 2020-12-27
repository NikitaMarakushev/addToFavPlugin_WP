jQuery(document).ready(function($) {

    $('.fr_favorites_link a').click(function(e){
        $.ajax({
            type: 'POST',
            url: frFavorites.url,
            data: {
                security: frFavorites.nonce,
                action: 'fr_test',
                postId: frFavorites.postId,
            },
            beforeSend: function() {
                $('.fr_favorites_link a').fadeOut(300, function() {
                    $('.fr_favorites_hidden').fadeIn();
                });
            },
            success: function(res){
                $('.fr_favorites_hidden').fadeOut(300, function() {
                    $('.fr_favorites_link').html(res);
                });
            },
            error: function() {
                alert('Ошибка запроса');
            }
        });
        e.preventDefault();
    });

});

