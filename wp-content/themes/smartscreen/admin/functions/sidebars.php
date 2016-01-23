<?php
/**
 *
 * HighThemes Options Framework
 * twitter : http://twitter.com/theHighthemes
 *
 */

function ht_sidebars_page(){
	global $sidehook, $sidebar_options, $wpdb;
	
	if(isset($_POST['Submit'])){

        // getting the list of custom sidebars
		$get_sidebar_options = ht_sidebar_generator::get_sidebars();
		$sidebar_name = str_replace(array("\n","\r","\t"),'',$_POST['ht_sidebar_name']);
		$sidebar_id = sanitize_title($sidebar_name);
		if($sidebar_id == '' ){
			$options_sidebar = $get_sidebar_options;
		}else{
			if(isset($get_sidebar_options[$sidebar_id])){
				header("Location: admin.php?page=sidebars&error=true$hidden_anchor");	
				die;
			}
			if ( is_array($get_sidebar_options) ) {
				$new_sidebar_gen[$sidebar_id] = $sidebar_name;
				$options_sidebar = array_merge($get_sidebar_options, (array) $new_sidebar_gen);	
			}else{
				$options_sidebar[$sidebar_id] = $sidebar_name;
			}		
		 }
		update_option( 'ht_sidebar_generator', $options_sidebar);
		header("Location: admin.php?page=sidebars$send&saved=true$hidden_anchor");
		die;	
	}
	
	if(isset($_GET['sn'])){
		$sidebar_id = $_GET['sn'];
		$get_sidebar_options = ht_sidebar_generator::get_sidebars();


		if(array_key_exists($sidebar_id, $get_sidebar_options)){
			
			unset($get_sidebar_options[$sidebar_id]);
			update_option('ht_sidebar_generator', $get_sidebar_options);
			
			
			//
		$get_widgets = wp_get_sidebars_widgets();
		unset( $get_widgets['array_version'] );


         foreach($get_widgets as $key=>$value) {
            if($key == 'ht_'.$sidebar_id) {
                unset($get_widgets['ht_'.$sidebar_id]);
            }
         }

            wp_set_sidebars_widgets($get_widgets);

		$sidebar_meta = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$sidebar_id'", ARRAY_A);
		if($sidebar_meta){
		if ( is_array($sidebar_meta) ){
			foreach ($sidebar_meta as $key => $value) {
				delete_post_meta($value['post_id'], '_selected_sidebar');
			}
		}
		}
		else
		{
			header("Location: admin.php?page=sidebars");	
		}
		
		
		}
		
	}
	
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	add_meta_box('ht_add_sidebars', 'Add New Sidebars', 'ht_add_sidebars', $sidehook, 'normal', 'high');
}

function ht_add_sidebars()
{
    $hight_options['sidebar'][] = array(	"name" => __("Sidebar Name:",'highthemes'),
        "desc" => __("Enter a name for the new sidebar.",'highthemes'),
        "id" => "ht_sidebar_name",
        "std" => "",
        "type" => "text");

    $output = '<table class="form-table">
<tbody>';

	foreach($hight_options['sidebar'] as $index=>$field)
	{
        switch ( $field['type'] ) {
            case 'text':
                $val = stripslashes($field['std']);
                if ( get_option( $field['id'] ) != "") { $val = stripslashes(htmlspecialchars(get_option($field['id']))); }

                if(isset($field['options'])){
                    $t_options = $field['options'];
                    $output .= '
					<tr valign="top">
					<th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>
					<td>
					<input class="'.$t_options['class'].'" name="'. $field['id'] .'" id="'. $field['id'] .
                        '" type="'. $field['type'] .'" value="'. $val .'" />

					<span class="description">'.$field['desc'].'</span>
					</td>
					</tr>
							';
                }
                else
                {
                    $output .= '
					<tr valign="top">
					<th scope="row">
					<label for="'.$field['id'].'">'.$field['name'].'</label></th>

					<td><input class="regular-text" name="'. $field['id'] .'" id="'. $field['id'] .
                        '" type="'. $field['type'] .'" value="'. $val .'" />

					<br />
					<span class="description">'.$field['desc'].'</span>
					</td>
					</tr>
						';
                }
                break;
        }
    }
    $output .= '</tbody></table>';

    echo $output;
	?>
<table class="form-table">
<tbody>
<tr valign="top" style="">
					<th scope="row">&nbsp;
			</th>
			
			<td>
			<span >&nbsp;</span>
			</td>
			</tr>

<tr valign="top" style="background:#eee;border-bottom:1px solid #999">
					<th scope="row"><strong>
			Custom Sidebars</strong></th>
			<td>
			<span class="description"><?php _e("Here's the list of available sidebars","highthemes");?></span>
			</td>
			</tr>   
            
<?php 
$get_sidebar_options = ht_sidebar_generator::get_sidebars();
$i=0;
if(count($get_sidebar_options)>0 && is_array($get_sidebar_options)){
foreach ($get_sidebar_options as $id=>$sidebar_gen) { ?>
			<tr valign="top">
			<th scope="row"><?php echo $sidebar_gen; ?></th>
			<td>
			<span class="description"><input type="button" onClick="window.location='admin.php?page=sidebars&sn=<?php echo $id; ?>';"  class="button" value="<?php _e("Delete", "highthemes");?>" /></span>
			</td>
			</tr>                 
            
 <?php $i++;
 } }?>              
</tbody>
</table>
    <?php
}function hight_sidebars() {
    global $screen_layout_columns, $sidehook, $theme_name;
    ?>
<div class="wrap">
    <h2>HighThemes <?php echo $theme_name;?> Sidebars</h2>
    <?php if(isset($_REQUEST['saved']) && $_REQUEST['saved']=='true'){ ?>
    <div class="updated fade" id="message"
         style="background-color: rgb(255, 251, 204);">
        <p><strong>Settings saved.</strong></p>
    </div>
    <?php }?>
    <form method="post" action=""><?php
        ?> <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
        <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
        <input type="hidden" name="action" value="ht_save_options" />
        <div id="poststuff"	class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
            <div id="side-info-column" class="inner-sidebar"><?php do_meta_boxes($sidehook, 'side', NULL); ?>
            </div>
            <div id="post-body" class="has-sidebar">
                <div id="post-body-content" class="has-sidebar-content">
                    <?php do_meta_boxes($sidehook, 'normal', NULL); ?>
                    <p><input type="submit" value="Add New Sidebar" class="button-primary" name="Submit" /></p>
                </div>
            </div>
            <br class="clear" />
        </div>
    </form>
</div>
<script type="text/javascript">
    //<![CDATA[
    jQuery(document).ready( function($) {
        // close postboxes that should be closed
        $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
        // postboxes setup
        postboxes.add_postbox_toggles('<?php echo $sidehook; ?>');
    });
    //]]>
</script>
<?php
}

?>