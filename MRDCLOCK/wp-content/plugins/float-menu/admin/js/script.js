jQuery(document).ready(function($) {
	//* Vertical table
	$('.tab-nav li:first').addClass('select'); 
	$('.tab-panels>div').hide().filter(':first').show();    
	$('.tab-nav a').click(function(){
		$('.tab-panels>div').hide().filter(this.hash).show(); 
		$('.tab-nav li').removeClass('select');
		$(this).parent().addClass('select');
		return (false); 
	})
	$('.menu_1').sortable({items: '> div:not(.menu_1-items-1)'});
	jQuery('.handlediv').live('click', function() {
		$(this).closest('.itembox').remove();
	});
	//* Include colorpicker
	$('.wp-color-picker-field').wpColorPicker();
	$('.icons').fontIconPicker({
		theme: 'fip-darkgrey',
		emptyIcon: false,
		allCategoryText: 'Show all'
	});
	var i_menu_1 = jQuery('.menu_1-icount:last').html();
	var i = 0;
	while (i < i_menu_1) {
		var icons = jQuery("#icons").clone().attr("name","param[menu_1][item_icon]["+i+"]");		
		$("#menu_1_icons_"+i).html(icons);
		var menu_item_icon = $('#menu_1_item_icon_'+i).val(); 
		$("#menu_1_icons_"+i+" [value='"+menu_item_icon+"']").attr("selected", "selected");
		jQuery('.icons').fontIconPicker({
			theme: 'fip-darkgrey',
			emptyIcon: false,
			allCategoryText: 'Show all'
		});
		i++;	
	}
	screen();
});
function itemadd(menu){   	
	var menu = 'menu_'+menu;
	var icount = jQuery('.'+menu+'-icount:last').html();
	if (isNaN(icount) ){
		var icount = 0;
	}
	var nexticount = icount*1+1;
	var icons = jQuery("#icons").clone().attr("name","param["+menu+"][item_icon]["+icount+"]");	
	if (nexticount > 1){
		var sub = '<div class="wow-admin-col-4"> Sub item <input type="checkbox" disabled="disabled" value="1" > <span class="dashicons dashicons-lock" style="color:#37c781;" title="Only Pro version"></span> </div>';
		var del = '<div class="handlediv"></div>';
	}
	else {
		var sub = '';
		var del = '';
	}
	var item = '<div class="'+menu+'-items-'+nexticount+' itembox"><div class="item-title"><h3>Item <span class="'+menu+'-icount">'+nexticount+'</span></h3><input type="hidden" name="param[item_order][]" value="'+icount+'">'+del+'<div class="toggle togglehide" title="Hide" onclick="toogle(this);"></div></div><div class="inside" style="display: block;"> <div class="wow-admin-col"> <div class="wow-admin-col-4">Icon: custom <input type="checkbox" value="1" disabled="disabled"><span class="dashicons dashicons-lock" style="color:#37c781;" title="Only Pro version"></span><br/><div id="iconstandart_'+icount+'"><span id="'+menu+'_icons_'+icount+'"></span></div> </div> <div class="wow-admin-col-4"> Label:<br/> <input type="text" name="param['+menu+'][item_tooltip]['+icount+']" value=""> </div> '+sub+' </div><div class="wow-admin-col"><div class="wow-admin-col-4">Item type <span class="dashicons dashicons-lock" style="color:#37c781;" title="Only Pro version"></span><br/><select disabled="disabled"> <option value="link">Link</option> </select> </div> <div class="wow-admin-col-4 '+menu+'_item_link_'+icount+'"><span id="'+menu+'_item_link_'+icount+'">Link</span>:<span class="'+menu+'_item_link_'+icount+'"> open new window <input type="checkbox" name="param['+menu+'][new_tab]['+icount+']" value="1"> </span><br/> <input type="text" name="param['+menu+'][item_link]['+icount+']" value=""> </div>  </div><div class="wow-admin-col"><div class="wow-admin-col-4"> Сolor:<br/><input type="text" placeholder="#ffffff" class="wp-color-picker-field" data-alpha="true" name="param['+menu+'][color]['+icount+']" value="#ffffff" /></div> <div class="wow-admin-col-4"> Background:<br/><input type="text" placeholder="#ffffff" class="wp-color-picker-field" data-alpha="true" name="param['+menu+'][bcolor]['+icount+']" value="#1f9ef8" /></div> </div>  </div>';	
	jQuery(item).appendTo("."+menu);	
	jQuery("#"+menu+"_icons_"+icount).html(icons);	
	jQuery('.'+menu+'_item_tooltip_'+icount).css('display', 'none');	
	jQuery('.icons').fontIconPicker({
		theme: 'fip-darkgrey',
		emptyIcon: false,
		allCategoryText: 'Show all'
	});
	jQuery('.wp-color-picker-field').wpColorPicker();
}
function itemremove(menu){   	
	var menu = 'menu_'+menu;	
	var icount = jQuery('.'+menu+'-icount:last').html(); 	
	jQuery("."+menu+"-items-"+icount).remove();
}
function toogle(item){	
	var par = jQuery(item).closest('.itembox');
	jQuery(par).children(".inside").toggle();
	if(jQuery(item).hasClass('togglehide')){
		jQuery(item).removeClass('togglehide');
		jQuery(item).addClass( "toggleshow" );
		jQuery(item).attr('title', 'Show');
	}
	else {
		jQuery(item).removeClass('toggleshow');
		jQuery(item).addClass( "togglehide" );
		jQuery(item).attr('title', 'Hide');
	}
}
//* Show screen
function screen(){
	if (jQuery('[name="param[include_mobile]"]').is(':checked')){
		jQuery('#screen').css('display', '');
	}
	else {
		jQuery('#screen').css('display', 'none');
	}
}