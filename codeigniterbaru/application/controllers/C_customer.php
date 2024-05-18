
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_customer extends CI_Controller {

	public function index()
	{
		$this->load->view('customer/index');
	}

	public function insert()
	{
		$nama = $this->input->post('nama');
		$telp = $this->input->post('telp');
		$alamat = $this->input->post('alamat');

		if (!empty($nama) && !empty($telp) && !empty($alamat)) {
			$data = array(
				'nama' => $nama,
				'telp' => $telp,
				'alamat' => $alamat
			);
			$this->db->insert('customer', $data);

			// Set pesan sukses
			$this->session->set_flashdata('success_message', 'Data berhasil disimpan.');

			// Redirect ke halaman form setelah data disimpan
			redirect('C_customer/index');
		} else {
			// Set pesan error jika ada data yang kosong
			$this->session->set_flashdata('error_message', 'Semua bidang harus diisi.');

			// Redirect kembali ke halaman form jika ada kesalahan
			redirect('C_customer/index');
		}
	}


	public function lihat(){
		$data['data']= $this->db->get('customer')->result();
		$this->load->view('customer/lihat', $data);
	}

	public function edit(){
		$id = $this->uri->segment(3);
		$data ['data'] = $this->db->get_where('customer', array('id' => $id))->result();
		$this->load->view('customer/edit', $data);
	}

	public function Update(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$telp = $this->input->post('telp');
		$alamat = $this->input->post('alamat');

		//$data = array('Nama Barang'=>$nama);
		// nama hrs sama dengan nama field yg ada di tabel
		$data=array('nama'=>$nama,
					'telp'=>$telp,
					'alamat'=>$alamat);
		//print_r($data);

		$this->db->where('id', $id);
		$this->db->update('customer',$data);
		echo "Update data berhasil";
		//echo "<meta http-equiv='refresh' content='0; url=".base_url()."code_igniter/index.php/C_kasir/Insert'>";
	}	
	
	public function Hapus(){
		$id = $this->uri->segment(3);
		//echo $id;
		$this->db->where('id',$id) ;
		$this->db->delete('customer');
	}
}