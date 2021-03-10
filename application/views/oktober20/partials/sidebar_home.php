<div class="sidebar">
<?php
  
$get_setting_sidebar_home    = $this->model_utama->view_where('tbl_oktober20',array('key' => 'setting_sidebar_2'))->row_array(); 

$sidebar_home = array();
if(isset($get_setting_sidebar_home['value'])) {

	if(!empty($get_setting_sidebar_home['value'])){

		$setting_sidebar = json_decode($get_setting_sidebar_home['value'],true); 
		if(!empty($setting_sidebar)) {
			$number = 0;
			foreach($setting_sidebar as $i => $widget_id){ 
				$id = key($widget_id); 
				$sidebar_home[$number]['widget_id'] = $id;
				$sidebar_home[$number]['widget_setting'] = $widget_id[$id];
				$number++; 
			}

		}

	}

} 

foreach($sidebar_home as $i => $item) {
	$file_sidebar = VIEWPATH . template().'/widgets/' . $item['widget_id'] . '.php';
	
	if( file_exists($file_sidebar)) { 
		$widget_setting = $item['widget_setting'];
		include $file_sidebar;
	}
}

?>
</div>