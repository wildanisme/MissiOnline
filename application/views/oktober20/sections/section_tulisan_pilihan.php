<section id="<?php echo $section_id; ?>" class="section featured py-5">
	<div class="container">
		<div class="section-container">
			<?php
			$section_tulisan_pilihan_judul = '';
			$jumlah_tulisan = 0;
			if (isset($section_setting['judul'])) {
				if (!empty($section_setting['judul'])) {
					$section_tulisan_pilihan_judul = trim($section_setting['judul']);
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

			$layout = 3;
			if (isset($section_setting['layout'])) {
				$layout = (int) $section_setting['layout'];
			}

			if (isset($section_setting['jumlah'])) {
				$jumlah_tulisan = (int) $section_setting['jumlah'];
			}

			$jumlah_tulisan = ($layout < 10) ? $jumlah_tulisan : 3;

			$filter_tulisan = array_merge($filter_tulisan, array(
				'tulisan.status' => 'Y'
			));

			$tulisan_pilihan = $this->model_utama->view_join_two(
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
			?>

			<?php if (!empty($section_tulisan_pilihan_judul)) { ?>
				<h5 class="section-title">
					<?php echo $section_tulisan_pilihan_judul; ?>
				</h5>
			<?php } ?>

			<?php
			if (!empty($tulisan_pilihan)) {
				$this->load->helper('text');
				$label_color = array('purple', 'green', 'red', 'pink', 'tosca', 'orange', 'blue', 'black');
				$icolor = 0;
			?>

				<?php
				// layout carousel
				if ($layout < 10) {
				?>
					<div class="section-body m-0">
						<div class="row featured-item owl-md-<?php echo $layout; ?> owl-carousel">
							<?php

							foreach ($tulisan_pilihan as $i => $tulisan) {
								$icolor = ($i % (count($label_color)) == 0) ? ($icolor = 0) : $icolor;
								$total_komentar = $this->model_utama->view_where('komentar', array('id_tulisan' => $tulisan['id_tulisan']))->num_rows();

								$img_src = base_url() . 'asset/foto_tulisan/small_no-image.jpg';
								if ($tulisan['gambar'] !== '') {
									$img_src = base_url() . 'asset/foto_tulisan/' . $tulisan['gambar'];
								}
							?>
								<div class="col-md-<?php echo $layout; ?> mb-4 pl-0">
									<div class="section-post card">
										<div class="post-img-container" style="
													background:url('<?php echo $img_src; ?>');
													background-position:center;
													background-size:cover;
													background-repeat:no-repeat
												">
										</div>
										<div class="card-body">
											<div class="post-content">
												<div class="post-category">
													<a href="<?php echo base_url('kategori/detail/' . $tulisan['kategori_seo']); ?>">
														<div class="color-label <?php echo $label_color[$icolor++]; ?>">
															<?php echo $tulisan['nama_kategori']; ?>
														</div>
													</a>
												</div>
												<a href="<?php echo base_url() . $tulisan['judul_seo']; ?>">
													<h5 class="post-title pt-3">
														<?php echo $tulisan['judul']; ?>
													</h5>
												</a>
												<div class="post-meta">
													<i class="fa fa-clock-o"></i> <?php echo tgl_indo($tulisan['tanggal']); ?> ,
													<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($tulisan['dibaca']); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php
							}
							?>
						</div>
					</div>


				<?php
				} else {
					// layout grid hanya 3 row
				?>
					<div class="section-body featured-post-grid">
						<div class="row">
							<?php

							foreach ($tulisan_pilihan as $i => $tulisan) {
								$icolor = ($i % (count($label_color)) == 0) ? ($icolor = 0) : $icolor;
								$total_komentar = $this->model_utama->view_where('komentar', array('id_tulisan' => $tulisan['id_tulisan']))->num_rows();

								$img_src = base_url() . 'asset/foto_tulisan/small_no-image.jpg';
								if ($tulisan['gambar'] !== '') {
									$img_src = base_url() . 'asset/foto_tulisan/' . $tulisan['gambar'];
								}
							?>
								<?php if ($i == 0) { ?>
									<div class="col-md-8 no-gutters">
										<div class="card main">
											<div class="post-img-container" style="
													background:url('<?php echo $img_src; ?>');
													background-position:center;
													background-size:cover;
													background-repeat:no-repeat; 
												">
											</div>
											<div class="card-body">
												<div class="post-content">
													<div class="post-category">
														<a href="<?php echo base_url('kategori/detail/' . $tulisan['kategori_seo']); ?>">
															<div class="color-label <?php echo $label_color[$icolor++]; ?>">
																<?php echo $tulisan['nama_kategori']; ?>
															</div>
														</a>
													</div>
													<a href="<?php echo base_url() . $tulisan['judul_seo']; ?>">
														<h5 class="post-title pt-3">
															<?php echo $tulisan['judul']; ?>
														</h5>
													</a>
													<div class="post-meta">
														<i class="fa fa-clock-o"></i> <?php echo tgl_indo($tulisan['tanggal']); ?> ,
														<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($tulisan['dibaca']); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4 no-gutters">
										<div class="row no-gutters">
										<?php } else { ?>
											<div class="col-md-12">
												<div class="card list">
													<div class="post-img-container" style="
															background:url('<?php echo $img_src; ?>');
															background-position:center;
															background-size:cover;
															background-repeat:no-repeat; 
														">
													</div>
													<div class="card-body">
														<div class="post-content">
															<div class="post-category">
																<a href="<?php echo base_url('kategori/detail/' . $tulisan['kategori_seo']); ?>">
																	<div class="color-label <?php echo $label_color[$icolor++]; ?>">
																		<?php echo $tulisan['nama_kategori']; ?>
																	</div>
																</a>
															</div>
															<a href="<?php echo base_url() . $tulisan['judul_seo']; ?>">
																<h5 class="post-title pt-3">
																	<?php echo $tulisan['judul']; ?>
																</h5>
															</a>
															<div class="post-meta">
																<i class="fa fa-clock-o"></i> <?php echo tgl_indo($tulisan['tanggal']); ?> ,
																<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($tulisan['dibaca']); ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
										<?php if ($i == (sizeof($tulisan_header) - 1)) { ?>
										</div>
									</div>
								<?php } ?>
							<?php
							}
							?>
						</div>
					</div>

			<?php }
			}
			?>
		</div>
	</div>
</section>