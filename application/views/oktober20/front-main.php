<div class="container pt-5">
		<div class="row">
            <div class="col-lg-8"> 
                    <?php
                    if ($this->uri->segment(1)=='main' OR $this->uri->segment(1)==''){
                        $iklanatas = $this->model_utama->view('iklanatas');
                        ?>
                         <div class="text-center mb-4">
                        <?php
                        foreach ($iklanatas->result_array() as $b) {
                            $string = $b['gambar'];
                            if ($b['gambar'] != ''){
                                if(preg_match("/swf\z/i", $string)) {
                                    echo "<embed width='100%' src='".base_url()."asset/foto_iklanatas/$b[gambar]' quality='high' type='application/x-shockwave-flash'>";
                                } else {
                                    echo "<a href='$b[url]' target='_blank'><img style='margin-bottom:5px' width='100%' src='".base_url()."asset/foto_iklanatas/$b[gambar]' alt='$b[judul]' /></a>";
                                }
                            }
                            if (trim($b['source']) != ''){ echo "$b[source]"; }
                        }
                        ?>
                        </div>
                        <?php
                    }
                    ?>
                <?php echo $contents; ?> 
            </div>
            <div class="col-lg-4"> 
                <?php include "partials/sidebar.php"; ?>
            </div>
    </div>
</div>