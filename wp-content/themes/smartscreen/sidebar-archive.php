<?php global $data; ?>
<div id="sidebar"><!--[Sidebar]-->
<?php
if ( is_active_sidebar('archive-sidebar') ) {
    dynamic_sidebar('archive-sidebar');
} else {
    dynamic_sidebar('default-sidebar');
}
?>
</div><!--[Sidebar]-->