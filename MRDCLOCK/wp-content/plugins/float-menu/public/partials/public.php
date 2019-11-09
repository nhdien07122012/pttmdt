<?php if ( ! defined( 'ABSPATH' ) ) exit; 		
	$count_i = (!empty($param['menu_1']['item_icon'])) ? count($param['menu_1']['item_icon']) : '-1';
	if($count_i >0){		
		$position = ($param['menu'] == 'right') ? ' fm-right' : '';
		$sideSpace = ($param['sideSpace'] == 'true') ? ' fm-side-space' : '';
		$buttonSpace = ($param['buttonSpace'] == 'true') ? ' fm-button-space' : '';
		$labelConnected = ($param['labelConnected'] == 'true') ? ' fm-connected' : '';
		$labelSpace = ($param['labelSpace'] == 'true') ? ' fm-label-space' : '';
		if($param['labelConnected'] == 'true' && $param['labelSpace'] == 'true'){
			$labelSpace = '';
		}		
		$style = ($param['menu'] == 'right') ? ' style="right:0;"' : '';
		$menu = '<div class="float-menu fm-ready" id="float-menu-'.$val->id.'">';	
		$menu .= '<ul class="fm-bar'.$position.$sideSpace.$buttonSpace.$labelConnected.$labelSpace.'"'.$style.' id="fm-bar-'.$val->id.'">';
		$menu_items = $param['menu_1']['item_icon'];
		foreach ($menu_items as $key => $value) {			
			
			$menu .= '<li class="fm-item-'.$key.'">';
			$class = '<i class="fa '.$param['menu_1']['item_icon'][$key].'"></i>';		
			$name = '<div class="fm-icon">'.$class.'</div><div class="fm-label">'.$param['menu_1']['item_tooltip'][$key].'</div>';
			if (!empty($param['menu_1']['new_tab'][$key])){
				$target = 'target="_blank"';
			}
			else{
				$target = 'target="_self"';
			}
			$menu .= '<a href="'.$param['menu_1']['item_link'][$key].'" '.$target.'>'.$name.'</a>';			
			$menu .= '</li>';
		}			
		$menu .= '</ul></div>';		
		echo $menu;	
	}
		
?>