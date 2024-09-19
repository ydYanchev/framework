<?php
define( "_VALID_PHP", true);
require_once( "core/autoload.php");

$langs = Api::cache(false)->get()->languages();
$settings = Api::cache(false)->get()->settings_web();



foreach($langs as $lng){
	
		
		$lang->language = $lng['lang'];
		$_SESSION['LANG_'. APP_NAME] =  $lng['lang'];
		
		
		$pages = Api::cache(false)->data(['no_limit'=>1])->get()->pages();
		
		
		foreach($pages['result'] as $page){
			
			if($page['slug']== 'header'){
				
				$new_path = BASEPATH."static/header~~{$lng['lang']}.html";
					if(file_exists($new_path)){
				
							$html = file_get_contents($new_path);
					}
					$page['description'] = $html;
					$page['css'] = $settings['headCss'];
			}
			if($page['slug']== 'footer'){
				
				$new_path = BASEPATH."static/footer~~{$lng['lang']}.html";
					if(file_exists($new_path)){
				
							$html = file_get_contents($new_path);
					}
					$page['description'] = $html;
					$page['css'] = $settings['headCss'];
			}
			
			$path_page = BASEPATH."static/pages";
			$path_css = BASEPATH."static/css";
			
			if (!is_dir($path_page)) {
				mkdir($path_page, 0777, true);
			}
			
			if (!is_dir($path_css)) {
				mkdir($path_css, 0777, true);
			}
			
			$path_page = $path_page."/".$lng['lang'];
			$path_css = $path_css."/".$lng['lang'];

			if (!is_dir($path_page)) {
				mkdir($path_page, 0777, true);
			}
			
			if (!is_dir($path_css)) {
				mkdir($path_css, 0777, true);
			}
			
			$file_page = $path_page."/{$page['slug']}.html";
			$file_css = $path_css."/{$page['slug']}.css";
			
			
			
			file_put_contents($file_page, $page['description']);
			file_put_contents($file_css, $page['css']);
				
			

			
			
			
			
			
		}
		
		
}




