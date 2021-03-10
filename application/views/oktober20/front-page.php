<?php
  
  $get_setting_sections_1    = $this->model_utama->view_where('tbl_oktober20',array('key' => 'setting_sections_1'))->row_array(); 
  $get_setting_sections_2    = $this->model_utama->view_where('tbl_oktober20',array('key' => 'setting_sections_2'))->row_array(); 
  $get_setting_sections_3    = $this->model_utama->view_where('tbl_oktober20',array('key' => 'setting_sections_3'))->row_array(); 
 
  $sections = array();

  function extract_sections($get_setting_sections) {
    $sections = array();
    if(isset($get_setting_sections['value'])) {
    
        if(!empty($get_setting_sections['value'])){
    
            $setting_sections = json_decode($get_setting_sections['value'],true); 
            if(!empty($setting_sections)) {
                $number = 0;
                foreach($setting_sections as $i => $section_id){ 
                    $id = key($section_id); 
                    $sections[$number]['section_id'] = $id;
                    $sections[$number]['section_setting'] = $section_id[$id];
                    $number++; 
                }
    
            }
    
        }
    
    } 

    return $sections;
}
  
?> 

<div id="section-full-width-top" class="section-full-width "> 
    <?php
    // sections atas
    $sections_atas = extract_sections($get_setting_sections_1);
    foreach($sections_atas as $i => $item) {
        $file_sections = VIEWPATH . template().'/sections/' . $item['section_id'] . '.php';
        
        if( file_exists($file_sections)) { 
            $section_id = $item['section_id'].'_' .$i;
            $section_setting = $item['section_setting'];
            include $file_sections;
        }
    }  
    ?>  
</div> 
<div id="section-with-sidebar" class="py-5 section-with-sidebar"> 
    <div  class="container">
        <div class="row">
            <div class="col-md-8">        
                <?php
                // sections tengah
                $sections_tengah = extract_sections($get_setting_sections_2);
                foreach($sections_tengah as $i => $item) {
                    $file_sections = VIEWPATH . template().'/sections/' . $item['section_id'] . '.php';
                    
                    if( file_exists($file_sections)) { 
                        $section_id = $item['section_id'].'_' .$i;
                        $section_setting = $item['section_setting'];
                        include $file_sections;
                    }
                }  
                ?>
            </div>
            <div class="col-md-4"> 
                <?php include "partials/sidebar_home.php"; ?>
            </div>
        </div>
    </div>
</div>  

<div id="section-full-width-bottom" class="section-full-width "> 
    <?php
    // sections bawah
    $sections_bawah = extract_sections($get_setting_sections_3);
    foreach($sections_bawah as $i => $item) {
        $file_sections = VIEWPATH . template().'/sections/' . $item['section_id'] . '.php';
        
        if( file_exists($file_sections)) { 
            $section_id = $item['section_id'].'_' .$i;
            $section_setting = $item['section_setting'];
            include $file_sections;
        }
    }  
    ?> 
</div>  