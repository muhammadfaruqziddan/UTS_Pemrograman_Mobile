
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_barang_group extends CI_Controller {

	public function index()
	{
		$this->load->view('barang_group/form');
	}

	// public function insert()
	// {
	// 	$data = array('nama_barang'=>$this->input->post('nama_barang'));
	// 	//print_r($data);
	// 	$this->session->set_userdata('Simpan_data','Berhasil Disimpan');
	// 	$this->db->insert('barang_group',$data);
	// 	echo "<meta http-equiv='refresh' conten='0; url=".base_url()."code_igniter/index.php/C_barang_group/insert'>"; 
	// }

	public function insert()
	{
		$nama_barang = $this->input->post('nama_barang');

		if (!empty($nama_barang)) {
			$data = array('nama_barang' => $nama_barang);
			$this->db->insert('barang_group', $data);

			// Set pesan sukses
			$this->session->set_flashdata('success_message', 'Data berhasil disimpan.');

			// Redirect ke halaman form setelah data disimpan
			redirect('C_barang_group/index');
		} else {
			// Set pesan error jika nama barang kosong
			$this->session->set_flashdata('error_message', 'Nama barang tidak boleh kosong.');

			// Redirect kembali ke halaman form jika ada kesalahan
			redirect('C_barang_group/index');
		}
	}



	public function lihat(){
		$data['data']= $this->db->get('barang_group')->result();
		$this->load->view('barang_group/lihat', $data);
	}

	public function edit(){
		$id_group = $this->uri->segment(3);
		$data ['data'] = $this->db->get_where('barang_group', array('id_group' => $id_group))->result();
		$this->load->view('barang_group/edit', $data);
	}

	public function Update(){
		$id_group = $this->input->post('id_group');
		$nama_barang = $this->input->post('nama_barang');
		//$data = array('Nama Barang'=>$nama_barang);
		// nama_barang hrs sama dengan nama field yg ada di tabel
		$data=array('nama_barang'=>$nama_barang);
		//print_r($data);

		$this->db->where('id_group', $id_group);
		$this->db->update('barang_group',$data);
		echo "Update data berhasil";
		//echo "<meta http-equiv='refresh' content='0; url=".base_url()."code_igniter/index.php/C_barang_group/Insert'>";
	}	
	
	public function Hapus(){
		$id_group = $this->uri->segment(3);
		//echo $id_group;
		$this->db->where('id_group',$id_group) ;
		$this->db->delete('barang_group');
	}		
	
}