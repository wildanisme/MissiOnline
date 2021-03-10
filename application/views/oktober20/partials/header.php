<?php

// get lokasi menu utama
$get_lokasi_menu    = $this->model_utama->view_where('tbl_oktober20', array('key' => 'lokasi_menu'))->row_array();
if (isset($get_lokasi_menu['value'])) {
	if (!empty($get_lokasi_menu['value'])) {
		$lokasi_menu = json_decode($get_lokasi_menu['value'], true);
	}
}

$menu_utama_id = '';
if (isset($lokasi_menu['menu_utama'])) {
	$menu_utama_id = $lokasi_menu['menu_utama'];
}

$menu_top_id = '';
if (isset($lokasi_menu['menu_top'])) {
	$menu_top_id = $lokasi_menu['menu_top'];
}


/**
 * menata menu secara hirarki
 * menu
 * -sub menu
 * --sub menu 
 * ---dst
 * @param $menu_parent_id ( menu id)
 * @param $state_menu_id (menu id (kondisi paling awal))
 * @param $class_menu ( style menu)
 * @param $home_icon ( true => menampilkan icon home)
 * @param $deep ( true jika => menu hirarki)
 */
function build_nav_menu($menu_parent_id = 0, $state_menu_id, $class_menu = 'menu-navbar', $home_icon = true, $deep = true)
{
	// get instance CI
	$list_menu = '';
	$ci = &get_instance();
	$get_menus = $ci->db->query("
		SELECT 
			id_menu, 
			nama_menu, 
			link
		FROM 
			menu 
		WHERE 
			aktif='Ya' 
			AND 
			id_parent='" . $menu_parent_id . "'
		ORDER BY urutan
	")->result_array();
	if (!empty($get_menus)) {

		if ($menu_parent_id == $state_menu_id) {
			$list_menu .= '<ul class="' . $class_menu . '">';
			if ($home_icon == true) {
				$list_menu .= '<li class="menu-item">';
				$list_menu .= '<a href="' . base_url() . '">';
				$list_menu .= '<i class="fa fa-home" aria-hidden="true"></i>';
				$list_menu .= '</a>';
				$list_menu .= '</li>';
			}
		} else {
			$list_menu .= '<ul class="sub-menu">';
		}

		foreach ($get_menus as $menu_item) {
			// filter http link
			$ahref_ttr = '';
			$base_url = base_url($menu_item['link']);
			if (preg_match("/^http/", $menu_item['link'])) {
				$ahref_ttr = 'target="_BLANK"';
				$base_url = $menu_item['link'];
			}
			// create link			
			$a_link_menu = '<a ' . $ahref_ttr . ' href="' . $base_url . '">';
			$a_link_menu .= $menu_item['nama_menu'];
			$a_link_menu .= '</a>';
			// end

			$get_child = array();

			if ($deep == true) {
				$get_child = build_nav_menu($menu_item['id_menu'], $state_menu_id);
			}
			if (!empty($get_child) && $deep == true) {
				$list_menu .= '<li class="menu-item menu-item-has-children" id="menu-item-' . $menu_item['id_menu'] . '">';
				$list_menu .= $a_link_menu;
				$list_menu .= $get_child;
				$list_menu .= '</li>';
			} else {
				$list_menu .= '<li class="menu-item" id="menu-item-' . $menu_item['id_menu'] . '">';
				$list_menu .= $a_link_menu;
				$list_menu .= '</li>';
			}
		}
		$list_menu .= '</ul>';
	}
	return $list_menu;
}
?>


<?php
//menampilkan identias website  
$base_path = FCPATH;
$id_website = $this->model_utama->view('identitas')->row_array();
$logo_website = $this->model_utama->view('logo')->row_array();
$socmed_account = explode(",", $id_website['facebook']);
?>

<div class="header-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 text-center text-lg-left">
				<div class="social-bar">
					<a target="_BLANK" href="<?php echo $socmed_account[0]; ?>" class="social-icon"><i class="fa fa-facebook" aria-hidden="true"></i></a>
					<a target="_BLANK" href="<?php echo $socmed_account[1]; ?>" class="social-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a>
					<a target="_BLANK" href="<?php echo $socmed_account[2]; ?>" class="social-icon"><i class="fa fa-instagram" aria-hidden="true"></i></a>
					<a target="_BLANK" href="<?php echo $socmed_account[3]; ?>" class="social-icon"><i class="fa fa-youtube" aria-hidden="true"></i></a>
				</div>
				<div class="contact">
					<i class="fa fa-phone" aria-hidden="true"></i> <?php echo $id_website['no_telp']; ?>
				</div>
			</div>
			<div class="col-lg-6 text-center text-lg-right">
				<?php
				if (!empty($menu_top_id)) {
					echo build_nav_menu($menu_top_id, $menu_top_id, 'top-menu', false, false);
				}
				?>
			</div>
		</div>
	</div>
</div>
<div class="header-content d-none d-lg-block">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="header-logo">
					<a href="<?php echo base_url(); ?>">
						<?php
						if ($logo_website['gambar'] !== '' &&  file_exists($base_path . "asset/logo/" . $logo_website['gambar'])) {
							$img_src = base_url() . "asset/logo/" . $logo_website['gambar'];
						?>
							<div class="logo-header">
								<img src="<?php echo $img_src; ?>" alt="<?php echo $id_website['nama_website']; ?>">
							</div>
						<?php
						} else {
						?>
							<?php echo $id_website['nama_website']; ?>
						<?php
						}
						?>
						<?php
						if (isset($tagline['header']) && isset($tagline['text'])) {
							if (!empty($tagline['text']) && $tagline['header'] ==  '1') {
						?>
								<div class="tagline-header"> <?php echo $tagline['text']; ?> </div>
						<?php
							}
						} ?>
					</a>
				</div>
			</div>
			<div class="col-md-6">
				<?php
				// untuk iklan atas
				include "iklan_atas.php";
				// 
				?>
			</div>
		</div>
	</div>
</div>

<div class="form d-block d-lg-none p-3">
	<?php echo form_open('tulisan/index'); ?>
	<div class="form-group m-0">
		<div class="input-group">
			<input value="<?php echo set_value('kata'); ?>" type="text" class="form-control" name="kata" placeholder="Pencarian tulisan ...">
			<div class="input-group-append">
				<button class="btn btn-theme btn-header-search" type="submit" name="cari">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>

<div class="header-main-menu">
	<nav class="main-menu-container navbar navbar-dark bg-white shadow">
		<div class="button-toggle-container d-lg-none mb-2">
			<button class="btn-responsive navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
		<div class="logo-header d-lg-none logo-header ml-5 ml-lg-0">
			<img src="<?php echo $img_src; ?>" alt="<?php echo $id_website['nama_website']; ?>">
			<?php
			if (isset($tagline['header']) && isset($tagline['text'])) {
				if (!empty($tagline['text']) && $tagline['header'] ==  '1') {
			?>
					<div class="tagline-header text-small d-none d-lg-block"> <?php echo $tagline['text']; ?> </div>
			<?php
				}
			}
			?>
		</div>
		<div class="container pos-relative">
			<div class="main-menu d-lg-block d-none" id="main-menu">
				<?php
				if (!empty($menu_utama_id)) {
					echo build_nav_menu($menu_utama_id, $menu_utama_id);
				}
				?>
			</div>
			<div class="form d-none d-lg-block">
				<?php echo form_open('tulisan/index'); ?>
				<div class="form-group m-0">
					<div class="input-group">
						<input value="<?php echo set_value('kata'); ?>" type="text" class="form-control" name="kata" placeholder="Pencarian tulisan ...">
						<div class="input-group-append">
							<button class="btn btn-theme btn-header-search" type="submit" name="cari">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</nav>
</div>