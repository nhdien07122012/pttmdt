<?php if ( ! defined( 'ABSPATH' ) ) exit; 

$act = (isset($_REQUEST["act"])) ? $_REQUEST["act"] : '';
if ($act == "update") {
	$recid = $_REQUEST["id"];
	$result = $wpdb->get_row("SELECT * FROM $data WHERE id=$recid");
	if ($result){
        $id = $result->id;
        $title = $result->title;
		$param = unserialize($result->param);
		$count_i = (!empty($param['menu_1']['item_icon'])) ? count($param['menu_1']['item_icon']) : '0';
		if(empty($param['item_order'])){
			$param['item_order'] = array();;
			for ($i = 0; $i < $count_i; $i++) {
				array_push($param['item_order'], $i);			
			}
		}
		$btn = __("Update", "wow-sbmp-lang");
        $hidval = 2;
    }
}
else if ($act == "duplicate") {
	$recid = $_REQUEST["id"];
	$result = $wpdb->get_row("SELECT * FROM $data WHERE id=$recid");
	if ($result){
        $id = "";
        $title = "";
        $param = unserialize($result->param);
		$count_i = (!empty($param['menu_1']['item_icon'])) ? count($param['menu_1']['item_icon']) : '0';	
		if(empty($param['item_order'])){
			$param['item_order'] = array();;
			for ($i = 0; $i < $count_i; $i++) {
				array_push($param['item_order'], $i);			
			}
		}
		$btn = __("Save", "wow-sbmp-lang");
        $hidval = 1;
    }
}
 else {
    $btn = __("Save", "wow-sbmp-lang");
    $id = "";
    $title = "";
	$param['item_user'] = "1";
	$param["depending_language"] = "";	
	$param['lang'] = "";
	$param['show'] = "";
	$param['screen'] = "480";
	$param['id_post'] = "";
	$count_i = 0;	
	$param['menu'] = 'left';	
	$param['align'] = 'center';
	$param['shape'] = 'square';
	$param['sideSpace'] = 'true';
	$param['buttonSpace'] = 'true';
	$param['labelsOn'] = 'true';
	$param['labelSpace'] = 'true';
	$param['labelConnected'] = 'false';
	$param['labelEffect'] = 'slide';
	$param['labelSpeed'] = '400';
	$param['subPosition'] = 'circular';
	$param['subSpace'] = 'false';
	$param['subEffect'] = 'slide';
	$param['subSpeed'] = '400';
	$param['windowhorizontalPosition'] = 'center';
	$param['windowverticalPosition'] = 'center';
	$param['windowCorners'] = 'match';
	$param['windowColor'] = 'black';
	$param['popupcontent'] = "";
	
    $hidval = 1;
}
$settings = array(
    'textarea_name' => 'param[popupcontent]',
	'textarea_rows' => '10',
	'wpautop' => 0,	
    'media_buttons' => true,	
    'tinymce' => array(
        'theme_advanced_buttons1' => 'formatselect,|,bold,italic,underline,|,' .
        'bullist,blockquote,|,justifyleft,justifycenter' .
        ',justifyright,justifyfull,|,link,unlink,|' .
        ',spellchecker,wp_fullscreen,wp_adv'
    )
);
?>