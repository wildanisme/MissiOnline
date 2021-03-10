<div class="widget card mb-4 posts-widget">
	<?php
	$jumlah_tulisan = 0;

	if (isset($widget_setting['judul'])) {
		if (!empty($widget_setting['judul'])) {
	?>
			<h5 class="card-header">
				<?php echo trim($widget_setting['judul']); ?>
			</h5>
	<?php
		}
	}

	if (isset($widget_setting['jumlah'])) {
		$jumlah_tulisan = (int) $widget_setting['jumlah'];
	}
	?>
	<div class="card-body">
		<ul>
			<?php
			$this->load->helper('text');

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
			$populer = $this->model_utama->view_join_two(
				'tulisan',
				'users',
				'kategori',
				'username',
				'id_kategori',
				array('tulisan.status' => 'Y'),
				'dibaca',
				'DESC',
				0,
				$jumlah_tulisan
			);

			$label_color = array('purple', 'green', 'red', 'pink', 'tosca', 'orange', 'blue', 'black');
			$icolor = 0;

			foreach ($populer->result_array()  as $i => $tulisan) {
				$icolor = ($i % (count($label_color)) == 0) ? ($icolor = 0) : $icolor;
				$total_komentar = $this->model_utama->view_where('komentar', array('id_tulisan' => $tulisan['id_tulisan']))->num_rows();
				$img_src = base_url() . 'asset/foto_tulisan/small_no-image.jpg';
				if ($tulisan['gambar'] !== '') {
					$img_src = base_url() . 'asset/foto_tulisan/' . $tulisan['gambar'];
				}
				$img_size = getimagesize($img_src);
				$class_image = ($img_size[0] > $img_size[1]) ? 'landscape' : 'portrait';
			?>
				<li class="list-post">
					<a href="<?php echo base_url() . $tulisan['judul_seo']; ?>">
						<div class="post-img-container">
							<div class="thumbnail">
								<div class="center">
									<img class="<?php echo $class_image; ?>" src="<?php echo $img_src; ?>" title="image" />
								</div>
							</div>
						</div>
					</a>
					<div class="post-content">
						<div class="post-category">
							<a href="<?php echo base_url('kategori/detail/' . $tulisan['kategori_seo']); ?>">
								<div class="color-label <?php echo $label_color[$icolor++]; ?>">
									<?php echo $tulisan['nama_kategori']; ?>
								</div>
							</a>
						</div>
						<a href="<?php echo base_url() . $tulisan['judul_seo']; ?>">
							<h5 class="post-header">
								<?php echo word_limiter(strip_tags($tulisan['judul']), 8); ?>
							</h5>
						</a>
						<div class="post-meta">
							<i class="fa fa-clock-o"></i> <?php echo tgl_indo($tulisan['tanggal']); ?> ,
							<i class="fa fa-flash" aria-hidden="true"></i> dilihat <?php echo get_viewer($tulisan['dibaca']); ?>
						</div>
					</div>
				</li>
			<?php

			}
			?>
		</ul>
	</div>
</div>