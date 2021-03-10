<section id="<?php echo $section_id; ?>" class="section latest-news py-5">
	<div class="container">
		<div class="section-container">
			<?php
			$section_tulisan_terbaru_judul = '';
			$jumlah_tulisan = 0;
			if (isset($section_setting['judul'])) {
				if (!empty($section_setting['judul'])) {
					$section_tulisan_terbaru_judul = trim($section_setting['judul']);
				}
			}

			if (isset($section_setting['jumlah'])) {
				$jumlah_tulisan = (int) $section_setting['jumlah'];
			}

			?>

			<?php if (!empty($section_tulisan_terbaru_judul)) { ?>
				<h5 class="section-title">
					<?php echo $section_tulisan_terbaru_judul; ?>
				</h5>
			<?php } ?>

			<div class="section-body m-0">
				<div class="row">
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

					$this->load->helper('text');
					$tulisan_terbaru = $this->model_utama->view_join_two(
						'tulisan',
						'users',
						'kategori',
						'username',
						'id_kategori',
						array('tulisan.status' => 'Y'),
						'tanggal',
						'DESC',
						0,
						$jumlah_tulisan
					);

					$label_color = array('purple', 'green', 'red', 'pink', 'tosca', 'orange', 'blue', 'black');
					$icolor = 0;

					foreach ($tulisan_terbaru->result_array() as $i => $tulisan) {
						$icolor = ($i % (count($label_color)) == 0) ? ($icolor = 0) : $icolor;
						$img_src = base_url() . 'asset/foto_tulisan/no-image.jpg';
						if ($tulisan['gambar'] !== '') {
							$img_src = base_url() . 'asset/foto_tulisan/' . $tulisan['gambar'];
						}
						$img_size = getimagesize($img_src);
						$class_image = ($img_size[0] > $img_size[1]) ? 'landscape' : 'portrait';
					?>
						<div class="col-md-12 mb-4">
							<div class="section-post card post-list">
								<div class="post-img-container">
									<div class="thumbnail">
										<div class="center">
											<img class="<?php echo $class_image; ?>" src="<?php echo $img_src; ?>" title="image" />
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="post-category">
										<a href="<?php echo base_url('kategori/detail/' . $tulisan['kategori_seo']); ?>">
											<div class="color-label <?php echo $label_color[$icolor++]; ?>">
												<?php echo $tulisan['nama_kategori']; ?>
											</div>
										</a>
									</div>
									<a href="<?php echo base_url() . $tulisan['judul_seo']; ?>">
										<h4>
											<?php echo $tulisan['judul']; ?>
										</h4>
									</a>
									<div class="post-meta">
										<i class="fa fa-clock-o"></i> <?php echo tgl_indo($tulisan['tanggal']); ?> ,
										<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($tulisan['dibaca']); ?>
									</div>
									<div class="post-content py-1">
										<?php echo word_limiter(strip_tags($tulisan['isi_tulisan']), 15); ?>
									</div>
									<a href="<?php echo base_url() . $tulisan['judul_seo']; ?>" class="read-more d-none d-md-block">
										Selengkapnya
									</a>
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