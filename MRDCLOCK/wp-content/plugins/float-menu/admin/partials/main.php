<?php if ( ! defined( 'ABSPATH' ) ) exit;
	global $wpdb;
	$data = $wpdb->prefix . "wow_".self::PREF;
	$info = (isset($_REQUEST["info"])) ? $_REQUEST["info"] : '';
	if ($info == "saved") {
		echo "<div class='updated' id='message'><p><strong>Record Added</strong>.</p></div>";
	}
	if ($info == "update") {
		echo "<div class='updated' id='message'><p><strong>Record Updated</strong>.</p></div>";
	}
	if ($info == "del") {
		$delid = $_GET["did"];
		$wpdb->query("delete from " . $data . " where id=" . $delid);
		$file_style = $this->plugindir.'asset/css/style-'.$delid.'.css';
		$file_script = $this->plugindir.'asset/js/script-'.$delid.'.js';
		if (file_exists($file_style)) {
			wp_delete_file($file_style);
		}
		if (file_exists($file_script)) {
			wp_delete_file($file_script);
		}	
		echo "<div class='updated' id='message'><p><strong>Record Deleted</strong>.</p></div>";
	}
	$resultat = $wpdb->get_results("SELECT * FROM " . $data . " order by id asc");
	$count = count($resultat);
	$tool = (isset($_REQUEST["tool"])) ? sanitize_text_field($_REQUEST["tool"]) : 'list';		
	$tabs = array(
		'list' => array('List','fa-list'), 
		'add' => array('Add new','fa-plus'),
		'pro' => array('Pro version','fa-external-link'),
		'support' => array('Support','fa-life-ring'),
		'facebook' => array('Join Us ','fa-facebook'),
	); 
?>
<div class="wow">
    <span class="wow-plugin-title"><?php echo $name; ?></span> <span class="wow-plugin-version">(version <?php echo $version; ?>)</span>
	<?php echo '<ul class="wow-admin-menu">';
		foreach( $tabs as $tab => $tab_name ){
			$class = ( $tab == $tool ) ? 'active' : '';
			if($count >= 1 && $tab == 'add')
			continue;
			echo "<li><a class='$class' href='?page=".$pluginname."&tool=$tab'>$tab_name[0] <i class='fa $tab_name[1]'></i></a></li> ";		
		}
		echo '</ul>';
		
		
		include_once ($tool.'.php');
		
	?>
</div>