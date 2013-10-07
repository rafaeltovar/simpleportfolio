<?php

/**
 * TODO LIST & IDEAS
 * 
 * [] Preparado para urls enteras documento/subdocumento
 */
class SP extends SPView {
	
	public function __construct() {}
	
	/** CONFIG **/
	public function SetTitle($title) {
		$this->Title = $title;
	}
	
	public function SetHeaderTitle($title) {
		$this->HeadTitle = $title;
	}
	
	public function SetTemplate($name) {
		$this->Template = $name;
	}
	
	public function SetHomeImage($image) {
		$this->HomeImage = ROOT_URL."/".$image;
	}
	
	public function AddContent($url, $name, $file=''){
		$url = strtolower($url);
		$this->ContentData[$url] = array('url' => ROOT_URL."/".$url,
									 'file' => $file 
								);
								
		$this->AddMenuElement($url, $name, 'content');
	}
	
	public function AddGallery($url, $name, $directory = '') {
		$url = strtolower($url);
		$this->GalleryData[$url] = array('url' => $url,
									 'directory' => $directory
								);
								
		$this->AddMenuElement($url, $name, 'gallery');
	}
	
	public function AddMenuElement($url, $name, $type='link'){
		$this->MenuData[$url] = array(
			'url' => ROOT_URL."/".$url, // TODO poner la url entera
			'name' => $name,
			'type' => $type
		);
	}
	
	public function Start() {
	
		$aurl = $this->GetActualUrl();
		$durl = parse_url($aurl);
		
		$data = explode('/', substr($durl['path'],1));
		
		$this->View($data);
	}
	
	//public function SetTemplateDirectory($directory) {}
	//public function GetContentDirectory(){}
	//public function SetContentDirectory($directory){}
	
	private function GetGoodUrl($url) {}
	private function GetActualUrl() {
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		
		$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
		
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
		return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
	}
}

class SPView {

	var $Config;
	
	var $Template;
	var $HomeImage;
	
	var $MenuData;
	var $MenuCurrentData;
	
	var $ContentData;
	var $GalleryData;
	
	var $ContentFile;
	var $GalleryFiles;
	var $GalleryCurrentFile;
	var $GalleryNextFile;
	
	var $HeaderTitle;
	var $Title;
	
	public function View($url) {
		$error = false;
		
		if(isset($this->MenuData[$url[0]])) {
		
			// Home
			if(empty($url[0])) $this->_Home();
		
		 	switch(strtolower($this->MenuData[$url[0]]['type'])) {
			case 'content':		
				// Modificar el head title
				$this->HeadTitle = $this->MenuData[$url[0]]['name']." | ".$this->HeadTitle;
				
				// obtener el contenido
				$this->ContentFile = $this->_GetContent($this->ContentData[$url[0]]['file']);
				
				$this->LoadTemplate("content.php");
				break;
			case 'gallery':	
				$Sg = new SPGallery();
				
				$this->GalleryFiles = $Sg->GetGallery($this->GalleryData[$url[0]]['directory'], $url[0]);
				
				if(!empty($url[1]) && (int)$url[1]>0) {
				
					if(array_key_exists($url[1], $this->GalleryFiles)) {
						$this->GalleryCurrentFile = $this->GalleryFiles[$url[1]];
						
						$this->GalleryNextFile = array();
						if(!empty($this->GalleryFiles[$url[1]+1])) {
							$this->GalleryNextFile = $this->GalleryFiles[$url[1]+1];
						}
	
						$this->LoadTemplate("gallery-single.php");
					} else $this->_Error404();
				} else
					$this->LoadTemplate("gallery.php");
				
				break;
			default:
				$this->_Error404();
		 	}
		 	
		 } else $error = true;

		if($error)
			$this->_Error404();
		
	}
	
	public function LoadTemplate($file) {
		$file = $this->_GetTemplate($file);
		include_once($file);
		//exit();
	}
	
	private function _Error404() {
		$this->LoadTemplate("404.php");
		exit();
	}
	
	private function _Home() {
		$this->LoadTemplate("home.php");
		exit();
	}
	
	public function GetTemplateDirectory() {
		return ROOT_DIR.TEMPLATE_DIR."/".$this->Template;
	}
	
	public function GetTemplateDirectoryUrl() {
		return ROOT_URL."/".TEMPLATE_DIR."/".$this->Template;
	}
	
	private function _GetTemplate($name) {
		$file = $this->GetTemplateDirectory()."/".strtolower($name);
		$file_default = TEMPLATE_DIR."/".TEMPLATE_DEFAULT."/".strtolower($name);
		
		if(!file_exists($file)) {
			$file = $file_default;
			if(!file_exists($file))
				echo "No se ha encontrado el template";
				$this->_Error404();
				exit();
		}
		
		return $file;
	}
	
	private function _GetContent($file) {
		$fcontent = ROOT_DIR.CONTENT_DIR."/".$file;

		if(!file_exists($fcontent))
			$this->_Error404();
			
		return $fcontent;
	}
	
	public function GetCurrentMenuItem() {
		return $this->MenuCurrentData;
	}
	
	public function GetNextMenuItem() {
		$this->MenuCurrentData = current($this->MenuData);
		return next($this->MenuData);
	}
	
	
	public function GetCurrentGalleryItem() {
		return $this->GalleryCurrentFile;
	}
	
	public function GetNextGalleryItem() {
		$this->GalleryCurrentFile = current($this->GalleryFiles);
		return next($this->GalleryFiles);
	}
}

class SPGallery {

	var $GalleryData;
	
	public function GetGallery($dir, $url) {
	
		$files = $this->_GetImagesFromDirectory($dir);
		$texts = $this->_GetImagesDescription($dir);
		
		$this->GalleryData = array();
		$i = 1;
		foreach($files as $file) {
			$this->GalleryData[$i] = array('file_url' => ROOT_URL."/".$file,
										 'alt' => (array_key_exists(basename($file), $texts)? $texts[basename($file)]:''),
										 'url' => ROOT_URL."/".$url."/".$i,
										 'gallery_url' =>  ROOT_URL."/".$url); // TODO susio susio, pero rapido
			$i++;
		}
		
		return $this->GalleryData;
	}
	
	private function _GetImagesFromDirectory($dir) {
		$files;
		foreach(glob($dir."/"."{*.gif,*.jpg,*.png}", GLOB_BRACE) as $img) {
			$files[] = $img;
		}
		
		return $files;
	}
	
	private function _GetImagesDescription($dir) {
		$desc = array();
		$file = $dir."/alt.txt";
		
		if(file_exists($file)) {
			$texts = file($file);
			
			foreach($texts as $text) {
				$a = explode("->", $text);
				$desc[$a[0]] = $a[1];
			}
		}
		
		return $desc;
	}
}

/**
 * Functions
 */

function strleft($s1, $s2) {
	return substr($s1, 0, strpos($s1, $s2));
}

?>