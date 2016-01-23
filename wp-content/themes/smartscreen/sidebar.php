<?php global $data; ?>
<div id="sidebar"><!--[Sidebar]-->
<?php
$sidebar = 'default-sidebar';
if( function_exists('is_cart') && function_exists('is_checkout') ){
    if(is_cart() || is_checkout()){
        $sidebar = 'shop-sidebar';
    }
}
ht_generated_dynamic_sidebar($sidebar);
?>
</div><!--[Sidebar]-->