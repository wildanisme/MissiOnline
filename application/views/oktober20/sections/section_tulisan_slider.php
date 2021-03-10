<section id="<?php echo $section_id; ?>" class="section py-5">
	<div class="container">
		<div class="section-container">
			<?php
			$jumlah_tulisan = 0;
			if (isset($section_setting['judul'])) {
				if (!empty($section_setting['judul'])) {
					$section_tulisan_slider_judul = trim($section_setting['judul']);
				}
			}

			$filter_tulisan = array();
			if (isset($section_setting['group'])) {
				$group_tulisan =  $section_setting['group'];
				if (!empty($group_tulisan)) {
					switch ($group_tulisan) {
						case 'headline':
							$filter_tulisan = array('tulisan.headline' => 'Y');
							break;
						case 'pilihan':
							$filter_tulisan = array('tulisan.aktif' => 'Y');
							break;
						case 'utama':
							$filter_tulisan = array('tulisan.utama' => 'Y');
							break;
					}
				}
			}

			if (isset($section_setting['jumlah'])) {
				$jumlah_tulisan = (int) $section_setting['jumlah'];
			}
			?>
			<div class="section-body m-0">
				<?php

				$filter_tulisan = array_merge($filter_tulisan, array(
					'tulisan.status' => 'Y'
				));

				$tulisan_slider = $this->model_utama->view_join_two(
					'tulisan',
					'users',
					'kategori',
					'username',
					'id_kategori',
					$filter_tulisan,
					'tanggal',
					'DESC',
					0,
					$jumlah_tulisan
				)->result_array();
				?>


				<?php if (!empty($tulisan_slider)) {
					$this->load->helper('text');
					$label_color = array('purple', 'green', 'red', 'pink', 'tosca', 'orange', 'blue', 'black');
					$icolor = 0;
				?>
					<div class="section-slider">
						<div id="<?php echo $section_id; ?>-carousel-slider" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner" role="listbox">
								<?php

								if (!function_exists('get_viewer')) {
									function get_viewer($number)
									{
										if ($number > 1000) {
											$number = $number / 1000;
											return number_format($number, 0, ',', '.') . 'k';
										}
										return number_format($number, 0, ',', '.');
									}
								}
								foreach ($tulisan_slider as $i => $tulisan) {
									$icolor = ($i % (count($label_color)) == 0) ? ($icolor = 0) : $icolor;
								?>
									<div class="carousel-item <?php echo ($i == 0 ? 'active' : ''); ?>">
										<div class="carousel-content">
											<?php
											$img_src = base_url() . 'asset/foto_tulisan/small_no-image.jpg';
											if ($tulisan['gambar'] !== '') {
												$img_src = base_url() . 'asset/foto_tulisan/' . $tulisan['gambar'];
											}
											?>
											<div class="image-container" style="
								background:url('<?php echo $img_src; ?>');
								background-position:center;
								background-size:cover;
								background-repeat:no-repeat
							">
											</div>
											<div class="carousel-caption">
												<div class="caption-content-container">
													<div class="post-category">
														<a href="<?php echo base_url('kategori/detail/' . $tulisan['kategori_seo']); ?>">
															<div class="color-label <?php echo $label_color[$icolor++]; ?>">
																<?php echo $tulisan['nama_kategori']; ?>
															</div>
														</a>
													</div>
													<a href="<?php echo base_url($tulisan['judul_seo']); ?>">
														<h2 class="caption-title">
															<?php echo $tulisan['judul']; ?>
														</h2>
													</a>

													<div class="caption-content">
														<?php echo word_limiter(strip_tags($tulisan['isi_tulisan']), 20); ?>
													</div>

													<div class="post-meta">
														<i class="fa fa-clock-o"></i> <?php echo tgl_indo($tulisan['tanggal']); ?> ,
														<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($tulisan['dibaca']); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>

							<ol class="carousel-indicators">
								<?php
								$slide_count = sizeof($tulisan_slider);
								?>
								<?php for ($sc = 0; $sc < $slide_count; $sc++) { ?>
									<li data-target="#<?php echo $section_id; ?>-carousel-slider" data-slide-to="<?php echo $sc; ?>" <?php echo ($i == 0 ? 'class="active"' : ''); ?>></li>
								<?php } ?>
							</ol>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
</section>