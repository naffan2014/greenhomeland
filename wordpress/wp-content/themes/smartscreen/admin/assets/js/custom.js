jQuery(document).ready(function ($) {


/**
 * Upload Multiple Image
 * 
 */

 function ht_upload_muliple_image() {

    $('.ht_upload_image').click(function () {

        var fieldID = $(this).attr('id'),
            activeFileUploadContext = $(this).parent(),
            wp_version = parseFloat($(this).data('version'));

        if (wp_version >= 3.5) {

            custom_file_frame = null;
            custom_file_frame = wp.media.frames.customHeader = wp.media({

                title: $(this).data('title'),
                editing: true,
                multiple: true,
                library: {
                    type: 'image'
                },

            });

            custom_file_frame.on("select", function () {

                // Grab the selected attachment.
                var selection = custom_file_frame.state().get('selection').toJSON();
                var thumbnailURLS = [],
                    imageURLS = [],
                    imageWidths = [],                   
                    imageIDS = [];

                selection.map(function (attach) {
                    if(attach.width > 150 ) {
                        thumbnailURLS.push(attach.sizes.thumbnail.url);
                    } else {
                        thumbnailURLS.push(attach.url);
                    }
                    imageURLS.push(attach.url);
                    imageIDS.push(attach.id);
                    imageWidths.push(attach.width);

                });
                if (thumbnailURLS.length > 0) {
                    var html = '';
                    for (var i = 0; i < thumbnailURLS.length; i++) {

                        html = html + '\
                                <li> \
                                    <input type="hidden" name="' + fieldID + '[]" value="' + imageIDS[i] + '" />\
                                    <img width="150" height="150" class="thumbnail" src="' + thumbnailURLS[i] + '" />\
                                    <br/>\
                                    <a href="#" style="text-decoration: none" class="remove-image">[X]</a>\
                                </li> \
                            ';
                    }
                    $('#' + fieldID + '-holder.image-holder').append(html);
                }


            });
            custom_file_frame.open();

        } else {


            var fieldID = $(this).attr('id');
            tb_show('', 'media-upload.php?type=image&TB_iframe=true');
            window.send_to_editor = function (html) {

                var imgurl = $('img', html).attr('src');
                var thumbSize = imgurl.match(/\.(jpg|jpeg|png|gif)$/i);
                var imgSize = imgurl.match(/-(\d+)x(\d+)\.(jpg|jpeg|png|gif)$/i);
                var imgID = html.match(/wp-image-(\d+)/);

                if (imgSize) {
                    imgurl = imgurl.replace(imgSize[0], '.' + imgSize[3]);
                }
                var thumbNail = imgurl.replace(thumbSize[0], '-150x150' + thumbSize[0]);

                if (thumbNail && imgID[1]) {
                    $('#' + fieldID + '-holder.image-holder').append('<li><input type="hidden" name="' + fieldID + '[]" value="' + imgID[1] + '" /><img width="150" height="150" class="thumbnail" src="' + thumbNail + '" /><br/><a href="#" style="text-decoration: none" class="remove-image">[X]</a></li>');
                }

                tb_remove();
            }


        } // end wp version check


    }); // end button click

    // remove the selected image
    $('.image-holder a').live('click', function (event) {
        event.preventDefault();
        $(this).parent().remove();

        return false;
    });


    } // end function




/**
 * Upload Single Image
 * 
 */
    function ht_upload_image() {

        $('.ht_upload_image_single').click(function () {
            var fieldID = $(this).attr('id'),
                activeFileUploadContext = $(this).parent(),
                wp_version = parseFloat($(this).data('version'));

            if (wp_version >= 3.5) {

                custom_file_frame = null;
                custom_file_frame = wp.media.frames.customHeader = wp.media({

                    title: $(this).data('title'),
                    library: {
                        type: 'image'
                    },
      
                });

                custom_file_frame.on("select", function () {
                    var attachment = custom_file_frame.state().get("selection").first();

                    var imgurl    = attachment.attributes.url;

                    var thumbSize = imgurl.match(/\.(jpg|jpeg|png|gif)$/i);

                    var imgSize   = imgurl.match(/-(\d+)x(\d+)\.(jpg|jpeg|png|gif)$/i);

                    var imgID     = attachment.id;

                    if (imgSize) {
                        imgurl = imgurl.replace(imgSize[0], '.' + imgSize[3]);
                    }
                    var thumbNail = imgurl.replace(thumbSize[0], '-150x150' + thumbSize[0]);

                    var img = new Image();
                    img.src = imgurl;
                    if (img.width > 150) {
                    $('.image-holder-single img', activeFileUploadContext).attr('src', thumbNail);

                    } else {
                    $('.image-holder-single img', activeFileUploadContext).attr('src', imgurl);

                    }
                    // Update value of the targetfield input with the attachment url.
                    $('input[type=hidden]#' + fieldID).val(attachment.id);
                    $('.image-holder-single', activeFileUploadContext).show();
                    $('.remove-image', activeFileUploadContext).show();


                });
                custom_file_frame.open();

            } else {

                tb_show('', 'media-upload.php?type=image&TB_iframe=true');

                window.send_to_editor = function (html) {
                    var imgurl = $('img', html).attr('src');
                    var thumbSize = imgurl.match(/\.(jpg|jpeg|png|gif)$/i);
                    var imgSize = imgurl.match(/-(\d+)x(\d+)\.(jpg|jpeg|png|gif)$/i);
                    var imgID = html.match(/wp-image-(\d+)/);

                    if (imgSize) {
                        imgurl = imgurl.replace(imgSize[0], '.' + imgSize[3]);
                    }
                    var thumbNail = imgurl.replace(thumbSize[0], '-150x150' + thumbSize[0]);

                    if (thumbNail && imgID[1]) {
                        $('#' + fieldID + '.image-holder-single img').attr('src', thumbNail);
                    }
                    $('#' + fieldID + '.image-holder-single').show();
                    $('#' + fieldID + '.image-holder-single .remove-image').show();

                    $('input[type=hidden]#' + fieldID + '').val(imgID[1]);

                    tb_remove();
                }

            } // end wp version check

            return false;

        }); // end button click

        // remove the image
        $('.image-holder-single a').live('click', function (event) {

            var activeFileUploadContext = $(this).parents('td');
            var image_holder = $(this).closest('.image-holder-single');

            var relid = $(this).data('relid');

            event.preventDefault();

            $('input[type=hidden]#' + relid).val('');
            $(image_holder).fadeOut('slow');
            $(this).fadeOut('slow');

        });



    } // end function


    ht_upload_image();
    ht_upload_muliple_image();
    
    function portfolio_show_details(value) {
        if (value == 'portfolio' ) {
            $('label[for=_portfolio_category]').parent().parent().show();
            $('label[for=_portfolio_layout]').parent().parent().show();
            $('label[for=_subblog_category]').parent().parent().hide();
            $('label[for=_item_number]').parent().parent().show();
            $('label[for=_disable_lightbox]').parent().parent().show();
     
        } else if (value == 'portfolio-filterable') {
            $('label[for=_portfolio_category]').parent().parent().show();
            $('label[for=_portfolio_layout]').parent().parent().show();
            $('label[for=_subblog_category]').parent().parent().hide();
            $('label[for=_item_number]').parent().parent().hide();
            $('label[for=_disable_lightbox]').parent().parent().show();

        } else if (value == 'subblog') {
            $('label[for=_portfolio_category]').parent().parent().hide();
            $('label[for=_portfolio_layout]').parent().parent().hide();
            $('label[for=_subblog_category]').parent().parent().show();
            $('label[for=_item_number]').parent().parent().show();
            $('label[for=_disable_lightbox]').parent().parent().hide();


        } else {
            $('label[for=_portfolio_category]').parent().parent().hide();
            $('label[for=_portfolio_layout]').parent().parent().hide();
            $('label[for=_subblog_category]').parent().parent().hide();
            $('label[for=_item_number]').parent().parent().hide();
            $('label[for=_disable_lightbox]').parent().parent().hide();


        }
    }


    // hide items
    var portfolio_value = $('#_page_type').val();
    portfolio_show_details(portfolio_value);


    $('#_page_type').change(function () {
        var pvalue = $(this).val();
        portfolio_show_details(pvalue);

    });
    //-------------------------- Slideshow

    function slider_show_details(value) {
        if (value == 'image') {
            $('#ht_slideshow_options_cb label[for=_slider_image_style]').parent().parent().show();
            $('#ht_slideshow_options_cb label[for=_slider_image_caption]').parent().parent().show();
            $('#ht_slideshow_options_cb label[for=_slider_video_link]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_disable_link]').parent().parent().show();
            $('#ht_slideshow_options_cb label[for=_slider_exlink]').parent().parent().show();
            $('#ht_slideshow_options_cb label[for=_slider_image_height]').parent().parent().show();


            $('#ht_slideshow_options_cb label[for=_slider_video_style]').parent().parent().hide();


        } else if (value == 'video') {
            $('#ht_slideshow_options_cb label[for=_slider_image_style]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_image_caption]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_disable_link]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_exlink]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_video_link]').parent().parent().show();
            $('#ht_slideshow_options_cb label[for=_slider_video_style]').parent().parent().show();
            $('#ht_slideshow_options_cb label[for=_slider_image_height]').parent().parent().hide();


        } else {
            $('#ht_slideshow_options_cb label[for=_slider_image_style]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_image_caption]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_video_link]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_disable_link]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_exlink]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_video_style]').parent().parent().hide();
            $('#ht_slideshow_options_cb label[for=_slider_image_height]').parent().parent().hide();


        }
    }

    // hide items
    var slider_value = $('#_slider_type').val();
    slider_show_details(slider_value);


    $('#_slider_type').change(function () {
        var value = $(this).val();
        slider_show_details(value);

    });





});