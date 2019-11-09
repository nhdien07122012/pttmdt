/* ========= INFORMATION ============================
	- document:  Float Menu - easily create floating menus of varying complexity!
	- url:       https://wow-estore.com/item/float-menu-pro/
	- author:    Wow-Company & Dmytro Lobov 
	- profile:   https://wow-estore.com/
	- version:   2.1
	- email:     support@wow-company.com
==================================================== */
<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php 
	$count_i = count($param['menu_1']['item_icon']);
	
	for ($i=0; $i<$count_i; $i++){
		$item = '.fm-item-'.$i.' .fm-icon, .fm-item-'.$i.' a:hover .fm-icon, .fm-item-'.$i.' .fm-label {';
		$item .= 'color:'.$param['menu_1']['color'][$i].';';
		$item .= 'background-color:'.$param['menu_1']['bcolor'][$i].';';
		$item .= '}';		
		echo $item;
	}
	if(!empty($param['include_mobile'])){ ?>
	@media only screen and (max-width: <?php if(empty($param['screen'])){echo "1024";} else {echo $param['screen'];} ?>px){
		#float-menu-<?php echo $idd; ?>{
			display:none;
		}
	}	
	<?php }	
