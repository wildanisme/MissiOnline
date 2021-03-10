<section id="<?php echo $section_id;?>" class="section agenda py-5"> 
	<div class="container">
		<div class="section-container">
			<h5 class="section-title">	 
				<?php 
					$section_agenda_judul = 'Agenda'; 
					$jumlah_agenda = 0;
					if( isset($section_setting['judul']) ) {
						if( !empty($section_setting['judul'])) {
							$section_agenda_judul = trim($section_setting['judul']);
						}
					} 

					if( isset($section_setting['jumlah']) ) {
						$jumlah_agenda = (int) $section_setting['jumlah'];
					}

					$layout = 2;
					if( isset($section_setting['layout']) ) {
						$layout = (int) $section_setting['layout'];
					}

					echo $section_agenda_judul;
				?> 
			</h5>
			<a href="<?php echo base_url("agenda");?>" class="read-more">
				Selengkapnya 
			</a>
			<div class="section-body"> 
				<div class="row">   
					<?php 
						$agenda_data =  $this->db->query("
							SELECT
								* 
							FROM
								agenda
							WHERE
								tgl_mulai >= curdate()
							ORDER BY
								tgl_mulai asc
							LIMIT 0,".$jumlah_agenda
						)->result_array();    
						if(!empty($agenda_data)) {
							foreach ($agenda_data as $agenda) { 
								$img_src= base_url().'asset/foto_agenda/no-image.jpg';
								if ($agenda['gambar'] !==''){
									$img_src =base_url().'asset/foto_agenda/'.$agenda['gambar'];
								}  
								?> 
									<div class="col-md-<?php echo $layout;?> mb-4 space-y-5" >
										<div class="section-post card">										
											<a href="<?php echo base_url('agenda/detail/'.$agenda['tema_seo']);?>">
											<div class="post-img-container"
												style="
													background:url('<?php echo $img_src;?>');
													background-position:center;
													background-size:cover;
													background-repeat:no-repeat
												"> 
											</div>
											</a>
											<a href="<?php echo base_url('agenda/detail/'.$agenda['tema_seo']);?>">
											<div class="card-body">
												<div class="post-content">										
													<h5 class="post-title">
														<?php echo $agenda['tema'];?> 
													</h5>
													<h5 class="post-date">
														<i class="fa fa-calendar-o"></i> <?php echo tgl_indo($agenda['tgl_mulai']);?> 
													</h5>
												</div>
											</div>										
											</a> 
										</div>
									</div>
								<?php
							}
						} else {
							?>
							<div class="col-md-12 text-center py-5">
								Belum Ada <?php echo $section_agenda_judul;?> Terdekat
							</div>
							<?php
						}
					?>    
				</div>
			</div>
		</div>     
	</div>   
</section>