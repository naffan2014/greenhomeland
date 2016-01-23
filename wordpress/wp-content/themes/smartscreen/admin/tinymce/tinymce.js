function InsertShortcodes() {

    var tagtext;
    var current_tab = jQuery('.tab-titles').find('.current').data("id");

    var style = document.getElementById('shortcodes_panel');
    var button = document.getElementById('button_panel');
    var list = document.getElementById('list_panel');
    var sbox = document.getElementById('sbox_panel');
    var tbox = document.getElementById('tbox_panel');
    var infobox = document.getElementById('box_panel');
    var linkpanel = document.getElementById('link_panel');

    /*************** Button Generator ****************/
    if (current_tab =='button') {

        var button_title = document.getElementById('button_title').value;
        var button_color = document.getElementById('button_color').value;
        var button_link = document.getElementById('button_link').value;
        var button_size = document.getElementById('button_size').value;
        var button_type = document.getElementById('button_type').value;
        var button_target = document.getElementById('button_target').checked;

        if(button_target == true) { button_target = '_blank'; } else { button_target = ''; }
        tagtext = '[button link="' + button_link + '" target="' + button_target + '" size="' + button_size + '" color="' + button_color + '" type="' + button_type + '"]'+ button_title + '[/button]';

    }
    /*
     ************** Links ****************/
    if (current_tab =='links') {

        var link_title = document.getElementById('link_title').value;
        var link_icon = document.getElementById('link_icon').value;
        var link_url = document.getElementById('link_url').value;
        var link_target = document.getElementById('link_target').value;

        tagtext = '[icon_link target="'+link_target+'" link="' + link_url + '"  icon="' + link_icon + '"]'+ link_title + '[/icon_link]';

    }	/*************** List Generator ****************/
    if (current_tab =='list') {

        var list_type = document.getElementById('list_type').value;
        tagtext = '[list type="' + list_type + '"]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/list]';

    }

    /*************** Simple Box Generator ****************/
    if (current_tab =='simple_box') {

        var sbox_border = document.getElementById('sbox_border').value;
        var sbox_border_color = document.getElementById('sbox_border_color').value;

        tagtext = '[simple_box border_size="' + sbox_border + '" border_color="' + sbox_border_color + '"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.[/simple_box]';

    }

    /*************** Titled Box Generator ****************/
    if (current_tab =='titled_box') {

        var tbox_color = document.getElementById('tbox_color').value;
        var tbox_title = document.getElementById('tbox_title').value;

        tagtext = '[titled_box title="' + tbox_title + '" color="' + tbox_color + '"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.[/titled_box]';

    }

    /*************** Info Box Generator ****************/
    if (current_tab =='info_box') {

        var info_type = document.getElementById('info_type').value;
        var info_color = document.getElementById('info_color').value;
        var info_title = document.getElementById('info_title').value;
        var info_icon = document.getElementById('info_icon').value;
        var info_title_link = document.getElementById('info_title_link').value;

        if(info_type == 'titled'){

            tagtext = '[info_box  title="' + info_title + '" link="' + info_title_link + '" color="' + info_color + '" type="' + info_type + '" icon="' + info_icon + '"] [/info_box]';

        } else {

            tagtext = '[info_box title="' + info_title + '" color="' + info_color + '" type="' + info_type + '" icon="' + info_icon + '"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.[/info_box]';

        }



    }

    /*************** General Style Shortcodes ****************/

    if (current_tab =='general') {

        var styleid = document.getElementById('style_shortcode').value;


        if (styleid != 0 ){
            tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "]";
        }
        if (styleid != 0 && styleid=='hr' || styleid=='hr_2dot' || styleid=='hr_3dot' || styleid=='hr_top' ){
            tagtext = "["+ styleid + "]";
        }

        if ( styleid != 0 && styleid=='pricing_3col' ){

            tagtext = '[pricing_table cols="3"] \
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="true" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[/pricing_table]\
';
        }

        if ( styleid != 0 && styleid=='pricing_4col' ){

            tagtext = '[pricing_table cols="4"] \
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="true" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[/pricing_table]	\
';
        }

        if ( styleid != 0 && styleid=='pricing_5col' ){

            tagtext = '[pricing_table cols="5"] \
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="true" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
\[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[/pricing_table]\
';
        }

        if ( styleid != 0 && styleid=='pricing_4col' ){

            tagtext = '[pricing_table cols="4"] \
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="true" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[col title="Title" color="green" price="99.99" sign="$" special="false" special_color="orange" button_title="Buy Now" button_link="#"]\
<ul class="linelist">\
    <li>24/7 Lorem Ipsum</li>\
    <li class="odd">Advanced Lorem</li>\
    <li>100GB Dolor</li>\
    <li class="odd">1GB sit</li>\
    <li>Something amet</li>\
    <li class="odd">25 Email Address</li>\
</ul>\
[/col]\
<br />\
[/pricing_table]\
';
        }

        if (styleid != 0 && styleid == 'tooltip'){
            tagtext = '\
[tooltip trigger="Tooltip Text Goes Here..." ]Lorem Ipsum dolor sit[/tooltip]\
';
        }
        if (styleid != 0 && styleid == 'testimonial' ){
            tagtext = '\
[testimonials]\
<br />\
[testimonial name="John Smith" website_url="http://www.johnsmith.com"]\
<br />\
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \
Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, \
posuere a, pede.\
<br />\
[/testimonial]\
<br />\
[testimonial name="Lorem Ipsum" website_url="http://www.lorem.com"]\
<br />\
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \
Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, \
posuere a, pede.\
<br />\
[/testimonial]\
<br />\
[testimonial name="" website_url=""]\
<br />\
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. \
Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, \
posuere a, pede.\
<br />\
[/testimonial]\
<br />\
[/testimonials]\
			';
        }


        if (styleid != 0 && styleid == 'slideshow'){
            tagtext = '\
[slideshow width="500"]\
<br />\
[slide width="500" height="150" ]PATH-TO-IMAGE[/slide]\
<br />\
[slide width="500" height="150" link="http://highthemes.com"]PATH-TO-IMAGE[/slide]\
<br />\
[slide width="500" height="150" link=""]PATH-TO-IMAGE[/slide]\
<br />\
[/slideshow]\
';
        }

        if (styleid != 0 && styleid == 'cta_box'){
            tagtext = "["+ styleid + " button_title=\"sample title\" button_color=\"black\" button_url=\"full url\" title=\"Sample call to action title\"]Insert the call to action description.[/" + styleid + "]";
        }

        if (styleid != 0 && styleid == 'googlemap' ){
            tagtext = '\
[ht_google_map zoom="1-19" height="230" values="-33.890542|151.274856|FIRST TEXT,-33.923036|151.259052|SECOND TEXT,-34.028249|151.157507|THIRD TEXT" ] [/ht_google_map]\
';
        }

        if (styleid != 0 && styleid == 'progress' ){
            tagtext = '\
[progress type="simple,round" value="1-100" color="color name" width="1-100"][/progress]\
';
        }

        if (styleid != 0 && styleid == 'toggle'){
            tagtext = '\
[toggle title="Toggle Title"]Insert your text here[/toggle]\
';
        }

        if (styleid != 0 && styleid == 'h_red' ){
            tagtext = '\
[highlight color="red"]Lorem ipsum[/highlight]\
';
        }
        if (styleid != 0 && styleid == 'h_yellow' ){
            tagtext = '\
[highlight color="yellow"]Lorem ipsum[/highlight]\
';
        }
        if (styleid != 0 && styleid == 'h_black' ){
            tagtext = '\
[highlight color="black"]Lorem ipsum[/highlight]\
';
        }

        if (styleid != 0 && styleid == 'image_left' || styleid == 'image_right' || styleid == 'image_center' ){
            tagtext = "["+ styleid + " link=\"link address here (optional)\"]Insert the Full URL of the image.[/" + styleid + "]";
        }
        if (styleid != 0 && styleid == 'lightbox'){
            tagtext = "["+ styleid + " title=\"lightbox title\" big_image_url=\"Insert Bigger Image's URL here\" video_url=\"Insert Video URL here\" type=\"image\" align=\"left\"]Insert the Full URL of the thumbnail image.[/" + styleid + "]";
        }
        if (styleid != 0 && styleid == 'dropcap1' ){
            tagtext = '\
[dropcap type="dropcap1"]A[/dropcap]\
';
        }
        if (styleid != 0 && styleid == 'dropcap2' ){
            tagtext = '\
[dropcap type="dropcap2"]A[/dropcap]\
';
        }
        if (styleid != 0 && styleid == 'dropcap3' ){
            tagtext = '\
[dropcap type="dropcap3"]A[/dropcap]\
';
        }

        if (styleid != 0 && styleid == 'tabs' ){
            tagtext = "["+ styleid + " tab1=\"Tab 1\" tab2=\"Tab 2\" tab3=\"Tab 3\"]<br /><br />[tab]Tab content 1[/tab]<br />[tab]Tab content 2[/tab]<br />[tab]Tab content 3[/tab]<br /><br />[/" + styleid + "]";
        }
        if (styleid != 0 && styleid == 'accordions' ){
            tagtext = "["+ styleid + "]<br /><br />[accordion title=\"Title 1\"]content 1[/accordion]<br />[accordion title=\"Title 2\"]content 2[/accordion]<br />[accordion title=\"Title 3\"]content 3[/accordion]<br /><br />[/" + styleid + "]";
        }
        if (styleid != 0 && styleid == 'pullquote' ){
            tagtext = "["+ styleid + " cite=\"Insert the cite here\"]Insert the quote here.[/" + styleid + "]";
        }


        if ( styleid == 0 ){
            tinyMCEPopup.close();
        }
    }

    if(window.tinyMCE) {
        tinyMCE.activeEditor.selection.setContent(tagtext);
        tb_remove();
    }
    return;

   
}