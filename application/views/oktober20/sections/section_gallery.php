<section id="<?php echo $section_id;?>" class="section gallery py-5">  
	<div class="container">
		<div class="section-container"> 
				<?php 
					$section_gallery_judul = ''; 
					$jumlah_gallery = 0;
					if( isset($section_setting['judul']) ) {
						if( !empty($section_setting['judul']) && 
							trim($section_setting['judul']) !== 'Semua'
						) {
							$section_gallery_judul = $section_setting['judul'];
						}
					} 

					$filter_gallery = array();
					if( isset($section_setting['album']) ) {
						$album =  $section_setting['album'];
						if(!empty($album)) { 
							$filter_gallery = array('gallery.id_album' => (int) $album );
						}
					} 


					if( isset($section_setting['jumlah']) ) {
						$jumlah_gallery = (int) $section_setting['jumlah'];
					}

					$layout = 2;
					if( isset($section_setting['layout']) ) {
						$layout = (int) $section_setting['layout'];
					}
					 
				?> 
			

			<?php if(!empty($section_gallery_judul)) { ?>
				<h5 class="section-title">		
					<?php echo $section_gallery_judul;?>
				</h5>
			<?php } ?>
			<a href="<?php echo base_url("albums");?>" class="read-more">
				Selengkapnya 
			</a>
			<div class="section-body"> 
				<div class="row ">   
					<?php 

						$filter_gallery = array_merge($filter_gallery,array(
							'album.aktif' => 'Y'
						)); 
						$gallery_data = $this->model_utama->view_join_one(
								'gallery',
								'album',
								'id_album', 
								$filter_gallery,
								'gallery.jdl_gallery','ASC',0,$jumlah_gallery)->result_array();  

						foreach ($gallery_data as $gallery) { 
							$img_src= base_url().'asset/img_galeri/no-image.jpg';
							if ($gallery['gbr_gallery'] !==''){
								$img_src =base_url().'asset/img_galeri/'.$gallery['gbr_gallery'];
							}  
							?> 
								<div class="col-md-<?php echo $layout;?> mb-4 space-y-5"> 
									<a href="<?php echo base_url('albums/detail/'.$gallery['album_seo']);?>">
									<div class="section-post card gallery">						 		
										<div class="post-img-container"
											style="
												background:url('<?php echo $img_src;?>');
												background-position:center;
												background-size:cover;
												background-repeat:no-repeat
											">  
										</div>  
										<div class="card-body">
											<div class="post-content">
												<div class="post-title">
													<?php echo $gallery['jdl_gallery'];?> 												
												</div>
												<small>	<?php echo $gallery['jdl_album'];?> </small>
											</div>
										</div>
									</div>
									</a>  
								</div>
							<?php
						}
					?>    
				</div>
			</div>
		</div>     
	</div>   
</section>