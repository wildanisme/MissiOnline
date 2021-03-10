<div class="widget card mb-4 widget-categories">
	<?php
	$tampilkan_jumlah_tulisan = 0;
	if (isset($widget_setting['judul'])) {
		if (!empty($widget_setting['judul'])) {
	?>
			<h5 class="card-header">
				<?php echo trim($widget_setting['judul']); ?>
			</h5>
	<?php
		}
	}
	if (isset($widget_setting['tampilkan_jumlah_tulisan'])) {
		$tampilkan_jumlah_tulisan = (int) $widget_setting['tampilkan_jumlah_tulisan'];
	}
	?>
	<div class="card-body">
		<ul>
			<?php
			$kategori = $this->db->query("
			SELECT 
				cat.nama_kategori as nama_kategori,
				cat.kategori_seo as kategori_seo,
				count(b.id_kategori) as jml_tulisan 
			FROM 
				kategori cat
				LEFT JOIN tulisan b ON b.id_kategori = cat.id_kategori  and b.status = 'Y'
			WHERE 
				cat.aktif='Y' 
			group by cat.id_kategori 
			ORDER BY cat.nama_kategori ASC
		");
			$list_data = $kategori->result_array();
			if (!empty($list_data)) {
				foreach ($list_data as $i => $item_kategori) {
					if ($item_kategori['jml_tulisan'] > 0) {
			?>
						<li>
							<a href="<?php echo base_url() . "kategori/detail/" . $item_kategori['kategori_seo']; ?>">
								<?php echo $item_kategori['nama_kategori']; ?>
							</a>
							<?php if ($tampilkan_jumlah_tulisan) { ?>
								<span>
									(<?php echo $item_kategori['jml_tulisan']; ?>)
								</span>
							<?php } ?>
						</li>
			<?php
					}
				}
			}
			?>
			</li>
	</div>
</div>