<?php
/*
-- ---------------------------------------------------------------
-- SWARAKALIBATA Ci CMS
-- CREATED BY : ROBBY PRIHANDAYA
-- COPYRIGHT  : Copyright (c) 2018 - 2019, PHPMU.COM. (https://phpmu.com/)
-- LICENSE    : http://opensource.org/licenses/MIT  MIT License
-- CREATED ON : 2019-03-26
-- UPDATED ON : 2019-11-18
-- ---------------------------------------------------------------
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Kategori extends CI_Controller
{
	public function detail()
	{
		$query = $this->model_utama->view_where('kategori', array('kategori_seo' => $this->uri->segment(3)));
		if ($query->num_rows() <= 0) {
			redirect('main');
		} else {
			$row = $query->row_array();
			$jumlah = $this->model_utama->view_where('tulisan', array('id_kategori' => $row['id_kategori']))->num_rows();
			$config['base_url'] = base_url() . 'kategori/detail/' . $this->uri->segment(3);
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 10;
			if ($this->uri->segment('4') == '') {
				$dari = 0;
			} else {
				$dari = $this->uri->segment('4');
			}
			$data['title'] = "tulisan Kategori $row[nama_kategori]";
			$data['description'] = description();
			$data['keywords'] = keywords();
			$data['rows'] = $row;
			if (is_numeric($dari)) {
				$data['tulisankategori'] = $this->model_utama->view_join_two('tulisan', 'users', 'kategori', 'username', 'id_kategori', array('tulisan.status' => 'Y', 'tulisan.id_kategori' => $row['id_kategori']), 'id_tulisan', 'DESC', $dari, $config['per_page']);
			} else {
				redirect('main');
			}
			$this->pagination->initialize($config);
			$this->template->load(template() . '/template', template() . '/detailkategori', $data);
		}
	}
}
