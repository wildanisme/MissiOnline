<?php            
// get iklan atas
$get_iklan_header = $this->model_utama->view_where('tbl_oktober20',array('key' => 'iklan_header'))->row_array();
$iklan_header_id = "";
if(isset($get_iklan_header['value'])){
    if(!empty($get_iklan_header['value'])){
        $iklan_header_id = json_decode($get_iklan_header['value'],true);
    }
} 

if( !empty($iklan_header_id) ) {
 
    switch ($iklan_header_id) { 
        case 'semua-acak': 
            $pasang_iklan_atas = $this->db->query("
                SELECT 
                    judul,
                    url,
                    gambar,
                    source
                FROM 
                    iklanatas
                ORDER BY RAND() LIMIT 1
            ")->row_array();

            break;
        default: 

            $pasang_iklan_atas = $this->db->query("
                SELECT 
                    judul,
                    url,
                    gambar,
                    source
                FROM 
                    iklanatas 
                WHERE 
                    id_iklanatas ='". $iklan_header_id."'"
            )->row_array(); 

            break;
    }
		

?>  
        <div class="iklan-atas float-right py-2">
            <?php if( $pasang_iklan_atas['gambar'] !='') { ?>            
                <?php 
                    if(preg_match("/swf\z/i", $pasang_iklan_atas['gambar'] )) { ?>
                    <embed width="100%" 
                        src=" <?php echo base_url()."asset/foto_iklanatas/". $pasang_iklan_atas['gambar'];?>" 
                            quality='high' type='application/x-shockwave-flash'>
                    <?php
                    } else {
                ?>
                        <a href="<?php echo $pasang_iklan_atas['url'];?>" target='_blank'>
                            <img style='width:100%' 
                                    src="<?php echo base_url()."asset/foto_iklanatas/".$pasang_iklan_atas['gambar'];?>" 
                                    alt="<?php echo $pasang_iklan_atas['judul'];?>" 
                            />
                        </a>
                <?php  
                    }
                }

                if (trim($pasang_iklan_atas['source']) != '') { 
                    echo $pasang_iklan_atas['source'];
                }

            ?> 
        </div> 
    <?php 
}
?>