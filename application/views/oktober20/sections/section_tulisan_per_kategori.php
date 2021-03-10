<section id="<?php echo $section_id; ?>" class="section category py-5">
	<div class="container">
		<div class="section-container ">
			<?php
			$section_tulisan_per_kategori_judul = 'tulisan Per Kategori';
			$jumlah_tulisan = 0;
			$kategori_id = 0;
			if (isset($section_setting['kategori'])) {
				$kategori_id = (int) $section_setting['kategori'];
				$kategori_data = $this->model_utama->view_where('kategori', array('id_kategori' => $kategori_id))->row_array();
				$section_tulisan_per_kategori_judul = $kategori_data['nama_kategori'];
			}

			if (isset($section_setting['jumlah'])) {
				$jumlah_tulisan = (int) $section_setting['jumlah'];
			}

			$layout = 2;
			if (isset($section_setting['layout'])) {
				$layout = (int) $section_setting['layout'];
			}
			?>
			<h5 class="section-title">
				<?php
				echo $section_tulisan_per_kategori_judul;
				?>
			</h5>
			<a href="<?php echo base_url("kategori/detail/" . $kategori_data['kategori_seo']); ?>" class="read-more">
				Selengkapnya
			</a>
			<div class="section-body">
				<div class="row">
					<?php
					$tulisan_list = $this->model_utama->view_join_two(
						'tulisan',
						'users',
						'kategori',
						'username',
						'id_kategori',
						array(
							'tulisan.status' => 'Y',
							'tulisan.id_kategori' => $kategori_id
						),
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
					foreach ($tulisan_list as $i => $tulisan) {
						$total_komentar = $this->model_utama->view_where('komentar', array('id_tulisan' => $tulisan['id_tulisan']))->num_rows();

						$img_src = base_url() . 'asset/foto_tulisan/small_no-image.jpg';
						if ($tulisan['gambar'] !== '') {
							$img_src = base_url() . 'asset/foto_tulisan/' . $tulisan['gambar'];
						}

					?>
						<div class="col-md-<?php echo $layout; ?> mb-4 space-y-5">
							<div class="section-post card">
								<a href="<?php echo base_url($tulisan['judul_seo']); ?>">
									<div class="post-img-container" style="
												background:url('<?php echo $img_src; ?>');
												background-position:center;
												background-size:cover;
												background-repeat:no-repeat
											">
									</div>
								</a>
								<div class="card-body">
									<div class="post-content">
										<a href="<?php echo base_url() . $tulisan['judul_seo']; ?>">
											<h5 class="post-title">
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
		</div>
	</div>
</section>