<?php
function get_title() {
	global $Sp;
	
	return $Sp->Title;
}

function get_title_head(){
	global $Sp;
	
	return $Sp->HeadTitle;
}

function get_template_url() {
	global $Sp;
	
	return $Sp->GetTemplateDirectoryUrl();
}

function get_header() {
	global $Sp;
	
	$Sp->LoadTemplate("header.php");
}

function get_footer() {
	global $Sp;
	
	$Sp->LoadTemplate("footer.php");
}

function get_content() {
	global $Sp;

	include_once($Sp->ContentFile);
}

function get_home_image() {
	global $Sp;
	
	return $Sp->HomeImage; 
}

/** Menu functions *** */
function get_menu() {
	global $Sp;
	
	$Sp->LoadTemplate("menu.php");
}

function get_menu_link_by_index ($index) {
	global $Sp;
	
	$ar = array_values($Sp->MenuData);
	
	return $ar[$index]['url'];
}

function have_menu() {
	global $Sp;
	
	$Sp->GetNextMenuItem();
	return $Sp->GetCurrentMenuItem();
}

function get_menu_link() {
	global $Sp;
	
	$menu = $Sp->GetCurrentMenuItem();
	
	return $menu['url'];
}

function get_menu_name() {
	global $Sp;
	
	$menu = $Sp->GetCurrentMenuItem();
	
	return $menu['name'];
}

/** gallery functions **/
function have_gallery() {
	global $Sp;
	
	$Sp->GetNextGalleryItem();
	return $Sp->GetCurrentGalleryItem();
}

function get_gallery_item_link() {
	global $Sp;
	
	$item = $Sp->GetCurrentGalleryItem();
	
	return $item['url'];
}

function get_gallery_item_file() {
	global $Sp;
	
	$item = $Sp->GetCurrentGalleryItem();
	
	return $item['file_url'];
}

function get_gallery_item_alt() {
	global $Sp;
	
	$item = $Sp->GetCurrentGalleryItem();
	
	return $item['alt'];
}

function get_gallery_next_item_link() {
	global $Sp;
	
	$item = $Sp->GetCurrentGalleryItem();
	
	$url = $item['gallery_url'];
	
	if(!empty($Sp->GalleryNextFile)) {
		$url= $Sp->GalleryNextFile['url'];
	}
			
	return $url;
}

function get_gallery_next_previous_link() {
	
}

?>