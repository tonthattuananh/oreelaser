let stcAdminScripts = {
    frame           : null,

    init            : function () {
        this.frame = wp.media({
            title   : 'Chọn hình ảnh',
            button  : {
                text: 'Sử dụng hình ảnh này'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });
        this.bindEvents();
    },

    bindEvents : function() {
        let _this = this;
        jQuery(document).on('click', '[data-trigger-toggle-feature]', function (e) {
            e.preventDefault();
            _this.disableTheGrid();
            let thisButton = jQuery(this);
            jQuery.post('/wp-admin/admin-ajax.php', {
                action : 'toggle_is_feature',
                post_id: jQuery(this).data('post-id'),
            }, function (response) {
                if (response.success === true) {
                    if (thisButton.hasClass('dashicons-yes')) {
                        thisButton.removeClass('dashicons-yes').addClass('dashicons-no');
                    } else {
                        thisButton.removeClass('dashicons-no').addClass('dashicons-yes');
                    }
                }
                _this.enableTheGrid();
            });
        });

        jQuery(document).on('click', '[data-trigger-change-thumbnail-id]', function () {

            let postId = jQuery(this).data('post-id');
            let thisButton = jQuery(this);
            let frame = wp.media({
                title   : 'Chọn hình ảnh',
                button  : {
                    text: 'Sử dụng hình ảnh này'
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });
            frame.on('select', function () {
                let attachment = frame.state().get('selection').first().toJSON();
                console.log(attachment);
                let attachmentId = attachment.id;
                _this.disableTheGrid();
                jQuery.post('/wp-admin/admin-ajax.php', {
                    action       : 'update_post_thumbnail_id',
                    post_id      : postId,
                    attachment_id: attachmentId
                }, function (response) {
                    if (response.success === true) {
                        thisButton.find('img').attr('src', attachment.sizes.thumbnail.url);
                    }
                    _this.enableTheGrid();
                });
            });
            frame.open();
        });
    },

    openMediaGallery: function () {
        if (this.frame) {
            this.frame.open();
        }
    },

    disableTheGrid  : function () {
        jQuery('form#posts-filter').append(`<div class="gm-loader" style="position:absolute;z-index:99999999;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;background-color:rgba(192,192,192,0.51);color:#000000">Đang cập nhật</div>`);
    },

    enableTheGrid   : function () {
        jQuery('form#posts-filter').find('.gm-loader').remove();
    },

    initSocialLogin  : function () {
        $('.gm-social-login__item').click(function (e) {
            e.preventDefault();
            let url = $(this).data('url');
            let title = $(this).data('title');
            let w = 800;
            let h = 400;
            let left = (screen.width / 2) - (w / 2);
            let top = (screen.height / 2) - (h / 2);
            window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        });
    },

    socialLoginReturn: function (result) {
        if (result.success === true) {
            window.location.href = result.redirect;
        }
    },
}

jQuery(function () {
    stcAdminScripts.init();
});
