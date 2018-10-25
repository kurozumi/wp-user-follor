jQuery(document).ready(function ($) {
    /*******************************
     follow / unfollow a user
     *******************************/
    $('.follow-links a').on('click', function (e) {
        e.preventDefault();

        var $this = $(this);
        var $div = $(this).closest("div");

        if (wuf_vars.logged_in != 'undefined' && wuf_vars.logged_in != 'true') {
            alert(wuf_vars.login_required);
            return;
        }

        var data = {
            action: $this.hasClass('follow') ? 'wuf-follow' : 'wuf-unfollow',
            user_id: $this.data('user-id'),
            follow_id: $this.data('follow-id'),
            nonce: wuf_vars.nonce
        };

        $('img.wuf-ajax', $div).show();

        $.post(wuf_vars.ajaxurl, data, function (response) {
            if (response.success) {
                $('a', $div).toggle();
            } else {
                alert(wuf_vars.processing_error);
            }
            $('img.wuf-ajax', $div).hide();
        });
    });
});