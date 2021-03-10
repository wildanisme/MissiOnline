<div class="post-head mb-2">
	<?php echo $title; ?>
</div>
<?php
$base_path = FCPATH;
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
<div class="row">
	<?php
	$label_color = array('purple', 'green', 'red', 'tosca', 'pink', 'orange', 'blue', 'black');
	$icolor = 0;
	foreach ($tulisan->result_array() as $i => $r) {
		$icolor = ($i % (count($label_color)) == 0) ? ($icolor = 0) : $icolor;
		$baca = $r['dibaca'] + 1;
		$isi_tulisan = (strip_tags($r['isi_tulisan']));
		$isi = substr($isi_tulisan, 0, 220);
		$isi = substr($isi_tulisan, 0, strrpos($isi, " "));
		$judul = $r['judul'];
		$total_komentar = $this->model_utama->view_where('komentar', array('id_tulisan' => $r['id_tulisan']))->num_rows();
		$img_src = base_url() . "asset/foto_tulisan/no-image.jpg";
		if ($r['gambar'] !== '' &&  file_exists($base_path . "asset/foto_tulisan/" . ($r['gambar']))) {
			$img_src = base_url() . "asset/foto_tulisan/" . $r['gambar'];
		}
	?>
		<div class="col-md-<?php echo ($i == 0) ? '12' : '6'; ?> mb-4">
			<div class="blog card h-100">
				<div class="image-container" style="
								background:url('<?php echo $img_src; ?>');
								background-position:center;
								background-size:cover;
								background-repeat:no-repeat;
								<?php echo ($i == 0) ? 'height:420px;' : ''; ?> 
							">
				</div>
				<div class="card-body">
					<div class="post-category">
						<a href="<?php echo base_url('kategori/detail/' . $r['kategori_seo']); ?>">
							<div class="color-label <?php echo $label_color[$icolor++]; ?>">
								<?php echo $r['nama_kategori']; ?>
							</div>
						</a>
					</div>
					<a href="<?php echo base_url() . $r['judul_seo']; ?>">
						<h3 class="card-title"><?php echo $judul; ?></h3>
					</a>
					<div class="post-meta">
						<i class="fa fa-clock-o"></i> </i> <?php echo tgl_indo($r['tanggal']); ?> ,
						<i class="fa fa-flash"></i> dilihat <?php echo get_viewer($r['dibaca']); ?>
					</div>

					<div class="card-text">
						<?php echo $isi;  ?>
					</div>
					<?php
					if (!empty($r['tag'])) {
						$tags = explode(",", $r['tag']);
						$hitung = count($tags);
					?>
						<div class="tags">
							<i class="fa fa-tags"></i>
							<?php
							$hitung = count($tags);
							for ($x = 0; $x <= $hitung - 1; $x++) {
								if ($tags[$x] != '') {
									echo "<a href='" . base_url() . "tag/detail/$tags[$x]'>$tags[$x]</a>";
								}
							}
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php
	}
	?>
</div>
<div class="pagination">
	<?php echo $this->pagination->create_links(); ?>
</div>