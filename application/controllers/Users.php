<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function index()
	{
		$ceks = $this->session->userdata('info@sman1beutong.sch.id');
		$id_user = $this->session->userdata('sman1beutong');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$data['users']  	 = $this->Mcrud->get_users();
			$data['judul_web'] = "Beranda | SISM SMAN 1 Beutong";

			$this->load->view('users/header', $data);
			$this->load->view('users/beranda', $data);
			$this->load->view('users/footer');
		}
	}

	public function profile()
	{
		$ceks = $this->session->userdata('info@sman1beutong.sch.id');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			= $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  	= $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Profil | SISM SMAN 1 Beutong";

			$this->load->view('users/header', $data);
			$this->load->view('users/profile', $data);
			$this->load->view('users/footer');

			if (isset($_POST['btnupdate'])) {
				$nama_lengkap	 		= htmlentities(strip_tags($this->input->post('nama_lengkap')));
				$email	 				= htmlentities(strip_tags($this->input->post('email')));
				$alamat	 				= htmlentities(strip_tags($this->input->post('alamat')));
				$telp	 				= htmlentities(strip_tags($this->input->post('telp')));

				$data = array(
					'nama_lengkap'			=> $nama_lengkap,
					'email'					=> $email,
					'alamat'				=> $alamat,
					'telp'					=> $telp
				);
				$this->Mcrud->update_user(array('username' => $ceks), $data);

				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Profil berhasil disimpan.
					</div>'
				);
				redirect('users/profile');
			}

			if (isset($_POST['btnupdate2'])) {
				$password 	= htmlentities(strip_tags($this->input->post('password')));
				$password2 	= htmlentities(strip_tags($this->input->post('password2')));

				if ($password != $password2) {
					$this->session->set_flashdata(
						'msg2',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Gagal!</strong> Kata sandi tidak cocok.
						</div>'
					);
				} else {
					$data = array(
						'password'	=> md5($password)
					);
					$this->Mcrud->update_user(array('username' => $ceks), $data);

					$this->session->set_flashdata(
						'msg2',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Sukses!</strong> Katasandi berhasil disimpan.
						</div>'
					);
				}
				redirect('users/profile');
			}
		}
	}

	public function pengguna($aksi = '', $id = '')
	{
		$ceks = $this->session->userdata('info@sman1beutong.sch.id');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level == 'admin' or $data['user']->row()->level == 'user') {
				redirect('404_content');
			}

			$this->db->order_by('id_user', 'DESC');
			$data['level_users']  = $this->Mcrud->get_level_users();

			if ($aksi == 't') {
				$p = "pengguna_tambah";

				$data['judul_web'] 	  = "Tambah Pengguna | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'd') {
				$p = "pengguna_detail";

				$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
				$data['judul_web'] 	  = "Detail Pengguna | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'e') {
				$p = "pengguna_edit";

				$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
				$data['judul_web'] 	  = "Edit Pengguna | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'h') {

				$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
				$data['judul_web'] 	  = "Daftar Pengguna | SISM SMAN 1 Beutong";

				if ($ceks == $data['query']->username) {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Gagal!</strong> Maaf, Anda tidak bisa menghapus Nama Pengguna "' . $ceks . '" ini.
						</div>'
					);
				} else {
					$this->Mcrud->delete_user_by_id($id);
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Sukses!</strong> Pengguna berhasil dihapus.
						</div>'
					);
				}
				redirect('users/pengguna');
			} else {
				$p = "pengguna";
				$data['judul_web'] 	  = "Daftar Pengguna | SISM SMAN 1 Beutong";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/pengaturan/$p", $data);
			$this->load->view('users/footer');

			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('d-m-Y H:i:s');

			if (isset($_POST['btnsimpan'])) {
				$username   	 		= htmlentities(strip_tags($this->input->post('username')));
				$password	 		  	= htmlentities(strip_tags($this->input->post('password')));
				$password2	 			= htmlentities(strip_tags($this->input->post('password2')));
				$level	 				= htmlentities(strip_tags($this->input->post('level')));

				$cek_user = $this->db->get_where("tbl_user", "username = '$username'")->num_rows();
				if ($cek_user != 0) {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Gagal!</strong> Nama Pengguna "' . $username . '" Sudah ada.
						</div>'
					);
				} else {
					if ($password != $password2) {
						$this->session->set_flashdata(
							'msg',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<strong>Gagal!</strong> Katasandi tidak cocok.
							</div>'
						);
					} else {
						$data = array(
							'username'	 	 	=> $username,
							'nama_lengkap'	 	=> $username,
							'password'	 	 	=> md5($password),
							'email' 			=> '-',
							'alamat' 			=> '-',
							'telp' 				 => '-',
							'level'			 	=> $level,
						);
						$this->Mcrud->save_user($data);

						$this->session->set_flashdata(
							'msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									</button>
									<strong>Sukses!</strong> Pengguna berhasil ditambahkan.
							</div>'
						);
					}
				}

				redirect('users/pengguna/t');
			}

			if (isset($_POST['btnupdate'])) {
				$nama_lengkap	 		= htmlentities(strip_tags($this->input->post('nama_lengkap')));
				$email	 				= htmlentities(strip_tags($this->input->post('email')));
				$alamat	 				= htmlentities(strip_tags($this->input->post('alamat')));
				$telp	 				= htmlentities(strip_tags($this->input->post('telp')));
				$level	 				= htmlentities(strip_tags($this->input->post('level')));

				$data = array(
					'nama_lengkap' => $nama_lengkap,
					'email'				 => $email,
					'alamat'			 => $alamat,
					'telp'				 => $telp,
					'level'			 	 => $level,
					'tgl_daftar' 	 => $tgl
				);
				$this->Mcrud->update_user(array('id_user' => $id), $data);

				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Pengguna berhasil diupdate.
					</div>'
				);
				redirect('users/pengguna');
			}
		}
	}

	public function bagian($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		$id_user = $this->session->userdata('sman1beutong');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			if ($data['user']->row()->level == 'user') {
				redirect('404_content');
			}

			$this->db->join('tbl_user', 'tbl_bagian.id_user=tbl_user.id_user');
			if ($data['user']->row()->level == 'user') {
				$this->db->where('tbl_bagian.id_user', "$id_user");
			}
			$this->db->order_by('tbl_bagian.nama_bagian', 'ASC');
			$data['bagian'] 		  = $this->db->get("tbl_bagian");

			if ($aksi == 't') {
				$p = "bagian_tambah";
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}

				$data['judul_web'] 	  = "Tambah GTK | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'e') {
				$p = "bagian_edit";
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_bagian", array('id_bagian' => "$id"))->row();
				$data['judul_web'] 	  = "Edit GTK | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'h') {
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_bagian", array('id_bagian' => "$id"))->row();
				$data['judul_web'] 	  = "Hapus GTK | SISM SMAN 1 Beutong";
				$this->Mcrud->delete_bagian_by_id($id);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> GTK berhasil dihapus.
					</div>'
				);
				redirect('users/bagian');
			} else {
				$p = "bagian";
				$data['judul_web'] 	  = "Daftar GTK | SISM SMAN 1 Beutong";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/pengaturan/$p", $data);
			$this->load->view('users/footer');
			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('d-m-Y H:i:s');
			if (isset($_POST['btnsimpan'])) {
				$nama_bagian   	 	= htmlentities(strip_tags($this->input->post('nama_bagian')));
				$nip		   	 	= htmlentities(strip_tags($this->input->post('nip')));
				$data = array(
					'nama_bagian'	 => $nama_bagian,
					'nip		'	 => $nip,
					'id_user'		 => $id_user
				);
				$this->Mcrud->save_bagian($data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> GTK berhasil ditambahkan.
					</div>'
				);
				redirect('users/bagian/t');
			}

			if (isset($_POST['btnupdate'])) {
				$nama_bagian   	 	= htmlentities(strip_tags($this->input->post('nama_bagian')));
				$nip		   	 	= htmlentities(strip_tags($this->input->post('nip')));

				$data = array(
					'nama_bagian'	 => $nama_bagian,
					'nip		'	 => $nip,
				);
				$this->Mcrud->update_bagian(array('id_bagian' => $id), $data);

				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> GTK berhasil diupdate.
					</div>'
				);
				redirect('users/bagian');
			}
		}
	}
	public function control($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		$id_user = $this->session->userdata('sman1beutong');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);
		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->level == 'kepala' or $data['user']->row()->level == 'ktu' or $data['user']->row()->level == 'admin') {
			$this->db->select('*');
			$this->db->from('tbl_sm');
			$this->db->order_by('tbl_sm.dibaca', 'asc');
			$this->db->where('dibaca =', '3');
			$data['control'] = $this->db->get();
			if ($aksi == 'd') {
				$p = "control_detail";
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
			} else {
				$p = "control";
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
		} else {
			redirect('404_content');
		}
	}
	public function ktu($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		$id_user = $this->session->userdata('sman1beutong');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);
		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'ktu') {
			$this->db->select('*');
			$this->db->from('tbl_sm');
			$this->db->where('dibaca BETWEEN 1 AND', 2);
			$this->db->order_by('tbl_sm.no_sm', 'asc');
			$data['ktu'] = $this->db->get();
			if ($aksi == 'd') {
				$p = "ktu_detail";
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
				if (isset($_POST['btnajuan'])) {
					$dibaca   	 	= htmlentities(strip_tags($this->input->post('dibaca')));
					$ajuan   	 	= htmlentities(strip_tags($this->input->post('tgl_ajuan')));
					$data2 = array(
						'dibaca' => $dibaca,
						'tgl_ajuan' => $ajuan
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					redirect('users/ktu');
				}
			} else {
				$p = "ktu";
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
		} else {
			redirect('404_content');
		}
	}

	public function kepala($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		$id_user = $this->session->userdata('sman1beutong');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		$data['user'] = $this->Mcrud->get_users_by_un($ceks);

		date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d H:i:s');

		if (!isset($ceks)) {
			redirect('web/login');
		} elseif ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'kepala') {
			$this->db->order_by('tbl_sm.tgl_sm', 'desc');
			$data['kepala'] = $this->db->get_where("tbl_sm", array('dibaca' => '2'));
			if ($aksi == 'd') {
				$p = "kepala_detail";
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
				if (isset($_POST['btndisposisi'])) {
					$disposisi 			= implode("<br>", $_POST['disposisi']);
					$petunjuk2 			= implode("<br>", $_POST['petunjuk2']);
					$catatan   	 		= htmlentities(strip_tags($this->input->post('catatan')));
					$data2 = array(
						'dibaca' 	=> '3',
						'disposisi' => $disposisi,
						'biasa' 	=> $petunjuk2,
						'catatan' 	=> $catatan,
						'tgl_disposisi' => $tgl
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					redirect('users/kepala');
				}
				if (isset($_POST['btnpriview'])) {
					$file = 'lampiran/surat_masuk/004_13_10_21_asdf_SM_1634094537.pdf';
					$filename = 'lampiran/surat_masuk/004_13_10_21_asdf_SM_1634094537.pdf';

					header('Content-type: application/pdf');
					header('Content-Disposition: inline; filename="' . $filename . '"');
					header('Content-Transfer-Encoding: binary');
					header('Accept-Ranges: bytes');

					@readfile($file);
				}
			} else {
				$p = "kepala";
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
		} else {
			redirect('404_content');
		}
	}

	public function sm($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		$id_user = $this->session->userdata('sman1beutong');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user'] = $this->Mcrud->get_users_by_un($ceks);
			$this->db->order_by('tbl_sm.no_sm', 'asc');
			$data['sm'] = $this->db->get("tbl_sm");
			if ($aksi == 't') {
				$p = "sm_tambah";
				if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
				}
				$data['judul_web'] 	= "SISM SMAN 1 Beutong";
			} elseif ($aksi == 'd') {
				$p = "sm_detail";
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
				if (isset($_POST['btndisposisi'])) {
					$data2 = array(
						'disposisi' => '1'
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					redirect('users/sm');
				}
				if (isset($_POST['btndisposisi0'])) {
					$data2 = array(
						'disposisi' => '0'
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					redirect('users/sm');
				}
			} elseif ($aksi == 'e') {
				$p = "sm_edit";
				if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
			} elseif ($aksi == 'h') {
				if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id", 'id_user' => "$id_user"))->row();
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";

				if ($data['query']->level != '') {
					$data2 = array(
						'id_user'		   	 => ''
					);
					$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
				} else {
					$query_h = $this->db->get_where("tbl_lampiran", array('token_lampiran' => $data['query']->token_lampiran));
					foreach ($query_h->result() as $baris) {
						unlink('./lampiran/surat_masuk/' . $baris->nama_berkas);
					}
					$this->Mcrud->delete_lampiran($data['query']->token_lampiran);
					$this->Mcrud->delete_sm_by_id($id);
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>BERHASIL!</strong> DATA BERHASIL DIHAPUS.
						</div>'
					);
				}

				redirect('users/sm');
			} elseif ($aksi == 'c') {
				$p = "sm_cetak";
				if ($data['user']->row()->level != 'admin') {
					redirect('404_content');
				}
				$data['sql'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
				$data['judul_web'] = "Cetak Surat Disposisi | SISM SMAN 1 Beutong";

			} else {
				$p = "sm";
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
			if (isset($_POST['no_asal'])) {
				$ns   	 		= htmlentities(strip_tags($this->input->post('ns')));
				$kode   	 	= htmlentities(strip_tags($this->input->post('penerima')));
				$namafile 		= date('Y-m-d') . '_' . 'SM_' . time() . $_FILES['userfiles']['name'];
				$this->upload->initialize(array(
					"file_name" => $namafile,
					"upload_path"   => "./lampiran/surat_masuk/",
					"allowed_types" => "*" //jpg|jpeg|png|gif|bmp|pdf,
				));

				if ($this->upload->do_upload('userfile')) {
					$ns   	 		= htmlentities(strip_tags($this->input->post('ns')));
					$no_asal   	 	= htmlentities(strip_tags($this->input->post('no_asal')));
					$tgl_sm   		= htmlentities(strip_tags($this->input->post('tgl_sm')));
					$tgl_no_asal  	= htmlentities(strip_tags($this->input->post('tgl_no_asal')));
					$pengirim   	= htmlentities(strip_tags($this->input->post('pengirim')));
					$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
					$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
					$lampiran   	= htmlentities(strip_tags($this->input->post('lampiran')));
					$status   	 	= htmlentities(strip_tags($this->input->post('status')));
					$sifat   	 	= htmlentities(strip_tags($this->input->post('sifat')));

					date_default_timezone_set('Asia/Jakarta');
					$waktu = date('Y-m-d H:m:s');
					$tgl 	 = date('d-m-Y');

					$token = md5("$id_user-$no_asal-$waktu");

					$cek_status = $this->db->get_where('tbl_sm', "token_lampiran='$token'")->num_rows();
					if ($cek_status == 0) {
						$data = array(
							'no_sm'				=> $ns,
							'no_asal'		  	=> $no_asal,
							'tgl_no_asal'		=> $tgl_no_asal,
							'pengirim'		   	=> $pengirim,
							'penerima'	 		=> $penerima,
							'perihal'		   	=> $perihal,
							'token_lampiran' 	=> $token,
							'id_user'			=> $id_user,
							'tgl_sm'			=> $tgl_sm,
							'lampiran'			=> $lampiran,
							'status'			=> $status,
							'sifat	'			=> $sifat,
							'dibaca'			=> '1'
						);
						$this->Mcrud->save_sm($data);
					}

					$nama   = $this->upload->data('file_name');
					$ukuran = $this->upload->data('file_size');

					$this->db->insert('tbl_lampiran', array('nama_berkas' => $nama, 'ukuran' => $ukuran, 'token_lampiran' => "$token"));
				}
			}
			if (isset($_POST['btnupdate'])) {
				$ns   	 		= htmlentities(strip_tags($this->input->post('ns')));
				$no_asal   	 	= htmlentities(strip_tags($this->input->post('no_asal')));
				$tgl_sm   		= htmlentities(strip_tags($this->input->post('tgl_sm')));
				$tgl_no_asal  	= htmlentities(strip_tags($this->input->post('tgl_no_asal')));
				$pengirim   	= htmlentities(strip_tags($this->input->post('pengirim')));
				$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
				$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
				$lampiran   	= htmlentities(strip_tags($this->input->post('lampiran')));
				$status   	 	= htmlentities(strip_tags($this->input->post('status')));
				$sifat   	 	= htmlentities(strip_tags($this->input->post('sifat')));

				$data = array(
					'no_sm'			=> $ns,
					'no_asal'		  	=> $no_asal,
					'tgl_no_asal'	   	=> $tgl_no_asal,
					'pengirim'		   	=> $pengirim,
					'penerima'	 		=> $penerima,
					'perihal'		   	=> $perihal,
					'tgl_sm'			=> $tgl_sm,
					'lampiran'			=> $lampiran,
					'status'			=> $status,
					'sifat	'			=> $sifat,
					'dibaca'			=> '1'
				);
				$this->Mcrud->update_sm(array('id_sm' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
						</button>
						<strong>BERHASIL!</strong> DATA BERHASIL DIPERBAHARUI.
					</div>'
				);
				redirect('users/sm');
			}
		}
	}

	public function sk($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		$id_user = $this->session->userdata('sman1beutong');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$this->db->join('tbl_user', 'tbl_sk.id_user=tbl_user.id_user');
			$this->db->order_by('tbl_sk.id_surat', 'asc');
			$data['sk'] 		  = $this->db->get("tbl_sk");
			$this->db->order_by('tbl_bagian.nama_bagian', 'ASC');
			$data['bagian'] 		  = $this->db->get_where("tbl_bagian", "id_user='$id_user'")->result();
			if ($aksi == 't') {
				$p = "sk_tambah";
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
			} elseif ($aksi == 'd') {
				$p = "sk_detail";
				$this->db->join('tbl_user', 'tbl_sk.id_user=tbl_user.id_user');
				$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id"))->row();
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
				if (isset($_POST['btndisposisi'])) {
					$data2 = array(
						'disposisi' => $_POST['bagian']
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

					redirect('users/sk');
				}
				if (isset($_POST['btndisposisi0'])) {
					$data2 = array(
						'disposisi' => '0'
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

					redirect('users/sk');
				}
				if (isset($_POST['btnperingatan'])) {
					$data2 = array(
						'peringatan' => '1'
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);
					redirect('users/sk');
				}

				if (isset($_POST['btnperingatan0'])) {
					$data2 = array(
						'peringatan' => '0'
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

					redirect('users/sk');
				}
			} elseif ($aksi == 'e') {
				$p = "sk_edit";
				if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
				}

				$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id", 'id_user' => "$id_user"))->row();
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";

				if ($data['query']->id_user == '') {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data surat keluar.
						</div>'
					);

					redirect('users/sk');
				}
			} elseif ($aksi == 'h') {
				if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id", 'id_user' => "$id_user"))->row();
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";

				if ($data['query']->level != '') {
					$data2 = array(
						'id_user'		   	 => ''
					);
					$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);
				} else {
					$query_h = $this->db->get_where("tbl_lampiran", array('token_lampiran' => $data['query']->token_lampiran));
					foreach ($query_h->result() as $baris) {
						unlink("./lampiran/surat_keluar/" . $baris->nama_berkas);
					}

					$this->Mcrud->delete_lampiran($data['query']->token_lampiran);
					$this->Mcrud->delete_sk_by_id($id);
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								</button>
								<strong>Sukses!</strong> Surat keluar berhasil dihapus.
						</div>'
					);
				}

				redirect('users/sk');
			} else {
				$p = "sk";
				$data['judul_web'] 	  = "SISM SMAN 1 Beutong";
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/pemrosesan/$p", $data);
			$this->load->view('users/footer');
			if (isset($_POST['no_sm'])) {
				$kode   	 	= htmlentities(strip_tags($this->input->post('status')));
				$ns   	 		= htmlentities(strip_tags($this->input->post('ns')));
				$namafile 		= date('Y-m-d') . '_' . 'SK_' . time() . $_FILES['userfiles']['name'];
				$this->upload->initialize(array(
					"file_name" => $namafile,
					"upload_path"   => "./lampiran/surat_keluar/",
					"allowed_types" => "*" //jpg|jpeg|png|gif|bmp
				));

				if ($this->upload->do_upload('userfile')) {
					$ns   	 		= htmlentities(strip_tags($this->input->post('ns')));
					$tgl_id_surat   = htmlentities(strip_tags($this->input->post('tgl_id_surat')));
					$no_surat   	= htmlentities(strip_tags($this->input->post('no_surat')));
					$tgl_sk   	 	= htmlentities(strip_tags($this->input->post('tgl_sk')));
					$status   	 	= htmlentities(strip_tags($this->input->post('status')));
					$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
					$tujuan   	 	= htmlentities(strip_tags($this->input->post('tujuan')));
					$pelaksana   	 = htmlentities(strip_tags($this->input->post('pelaksana')));
					$bagian   	 	= htmlentities(strip_tags($this->input->post('bagian')));
					date_default_timezone_set('Asia/Jakarta');
					$waktu = date('Y-m-d H:m:s');
					$tgl 	 = date('d-m-Y');
					$token = md5("$id_user-$ns-$waktu");
					$cek_status = $this->db->get_where('tbl_sk', "token_lampiran='$token'")->num_rows();
					if ($cek_status == 0) {
						$data = array(
							'id_surat'			 	=> $ns,
							'tgl_id_surat'	   	 	=> $tgl_id_surat,
							'no_surat'			 	=> $no_surat,
							'tgl_sk'	 		 	=> $tgl_sk,
							'kode	'		 	 	=> $status,
							'perihal'		   	 	=> $perihal,
							'tujuan'		   	 	=> $tujuan,
							'token_lampiran' 		=> $token,
							'id_user'				=> $id_user,
							'pelaksana'				=> $pelaksana,
							'bagian'				=> $bagian,
						);
						$this->Mcrud->save_sk($data);
					}
					$nama   = $this->upload->data('file_name');
					$ukuran = $this->upload->data('file_size');
					$this->db->insert('tbl_lampiran', array('nama_berkas' => $nama, 'ukuran' => $ukuran, 'token_lampiran' => "$token"));
				}
			}
			if (isset($_POST['btnupdate'])) {
				$tgl_id_surat   = htmlentities(strip_tags($this->input->post('tgl_id_surat')));
				$no_surat   	= htmlentities(strip_tags($this->input->post('no_surat')));
				$tgl_sk   	 	= htmlentities(strip_tags($this->input->post('tgl_sk')));
				$status   	 	= htmlentities(strip_tags($this->input->post('status')));
				$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
				$tujuan   	 	= htmlentities(strip_tags($this->input->post('tujuan')));
				$pelaksana   	 = htmlentities(strip_tags($this->input->post('pelaksana')));
				$bagian   	 	= htmlentities(strip_tags($this->input->post('bagian')));
				$data = array(
					'no_surat'			 	=> $no_surat,
					'tgl_sk'	 		 	=> $tgl_sk,
					'kode	'		 	 	=> $status,
					'perihal'		   	 	=> $perihal,
					'tujuan'		   	 	=> $tujuan,
					'pelaksana'				=> $pelaksana,
					'bagian'				=> $bagian,
				);
				$this->Mcrud->update_sk(array('id_sk' => $id), $data);

				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Surat Keluar berhasil diupdate.
					</div>'
				);
				redirect('users/sk');
			}
		}
	}

	public function cetak_sk($tgl1 = '', $tgl2 = '')
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		$id_user = $this->session->userdata('sman1beutong');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			if ($tgl1 != '' and $tgl2 != '') {
				$data['sql'] = $this->db->query("SELECT * FROM tbl_sk WHERE (tgl_sk BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sk DESC");
				$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
				$data['users']  	 = $this->Mcrud->get_users();
				$data['judul_web'] = "SISM SMAN 1 Beutong";
				$data['t_awal'] = $tgl1;
				$data['t_akhir'] = $tgl2;
				$this->load->view('users/laporan/cetak_sk', $data);
			} else {
				redirect('404_content');
			}
		}
	}


	public function cetak_sm($tgl1 = '', $tgl2 = '')
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			if ($tgl1 != '' and $tgl2 != '') {
				$data['sql'] = $this->db->query("SELECT * FROM tbl_sm WHERE (tgl_sm BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sm DESC");
				$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
				$data['judul_web'] = "SISM SMAN 1 Beutong";
				$data['t_awal'] = $tgl1;
				$data['t_akhir'] = $tgl2;
				$this->load->view('users/laporan/cetak_sm', $data);
			} else {
				redirect('404_content');
			}
		}
	}

	public function skl()
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$p = "skl";
			$data['skl'] 		  = $this->db->get_where("tbl_sekolah")->row(1);
			$data['judul_web'] 	  = "Profil Sekolah | SISM SMAN 1 Beutong";
		}
		$this->load->view('users/header', $data);
		$this->load->view("users/pengaturan/$p", $data);
		$this->load->view('users/footer');

		if (isset($_POST['btnupdate'])) {
			$id			 		= htmlentities(strip_tags($this->input->post('id')));
			$nm_kepala	 		= htmlentities(strip_tags($this->input->post('nm_kepala')));
			$nip	 			= htmlentities(strip_tags($this->input->post('nip')));
			$jabatan	 		= htmlentities(strip_tags($this->input->post('jabatan')));
			$sekolah			= htmlentities(strip_tags($this->input->post('sekolah')));
			$npsn	 	  		= htmlentities(strip_tags($this->input->post('npsn')));
			$alamat	 	  		= htmlentities(strip_tags($this->input->post('alamat')));
			$tapel	 	  		= htmlentities(strip_tags($this->input->post('tapel')));
			$kop_1	 	  		= htmlentities(strip_tags($this->input->post('kop_1')));
			$kop_2	 	  		= htmlentities(strip_tags($this->input->post('kop_2')));
			$telp	 	  		= htmlentities(strip_tags($this->input->post('telp')));

			$data = array(
				'nm_kepala'			=> $nm_kepala,
				'nip'				=> $nip,
				'jabatan'			=> $jabatan,
				'sekolah'			=> $sekolah,
				'npsn'	 			=> $npsn,
				'alamat'	 		=> $alamat,
				'tapel'	 			=> $tapel,
				'kop_1'	 			=> $kop_1,
				'kop_2'	 			=> $kop_2,
				'telp'	 			=> $telp,
			);
			$this->Mcrud->update_skl(array('id' => $id), $data);
			$this->session->set_flashdata(
				'msg',
				'
				<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
						</button>
						<strong>Sukses!</strong> Data Sekolah berhasil disimpan.
				</div>'
			);
			redirect('users/skl');
		}
	}

	public function siswa($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		$id_user = $this->session->userdata('sman1beutong');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$this->db->order_by('tbl_siswa.nm_siswa', 'ASC');
			$data['siswa'] 		  = $this->db->get("tbl_siswa");

			if ($aksi == 't') {
				$p = "siswa_tambah";
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$data['judul_web'] 	  = "Tambah Siswa | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'd') {
				$p = "siswa_detail";
				$data['query'] = $this->db->get_where("tbl_siswa", array('id' => "$id"))->row();
				$data['judul_web'] 	  = "Detail Siswa | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'e') {
				$p = "siswa_edit";
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_siswa", array('id' => "$id"))->row();
				$data['judul_web'] 	  = "Edit Siswa | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'h') {

				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_siswa", array('id' => "$id"))->row();
				$data['judul_web'] 	  = "Hapus Siswa | SISM SMAN 1 Beutong";
				$this->Mcrud->delete_siswa_by_id($id);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Siswa berhasil dihapus.
					</div>'
				);
				redirect('users/siswa');
			} else {
				$p = "siswa";
				$data['judul_web'] 	  = "Daftar Siswa | SISM SMAN 1 Beutong";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/siswa/$p", $data);
			$this->load->view('users/footer');

			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('d-m-Y H:i:s');

			if (isset($_POST['btnsimpan'])) {
				$nis   	 		= htmlentities(strip_tags($this->input->post('nis')));
				$nisn   	 	= htmlentities(strip_tags($this->input->post('nisn')));
				$nama   	 	= htmlentities(strip_tags($this->input->post('nm_siswa')));
				$ttl   	 		= htmlentities(strip_tags($this->input->post('ttl')));
				$kelas   	 	= htmlentities(strip_tags($this->input->post('kelas')));
				$jurusan   	 	= htmlentities(strip_tags($this->input->post('jurusan')));
				$nm_ort  	 	= htmlentities(strip_tags($this->input->post('nm_ort')));
				$alamat   	 	= htmlentities(strip_tags($this->input->post('alamat')));

				$data = array(
					'nis' 			=> $nis,
					'nisn'			=> $nisn,
					'nm_siswa'		=> $nama,
					'ttl'			=> $ttl,
					'kelas'			=> $kelas,
					'jurusan'		=> $jurusan,
					'nm_ort'		=> $nm_ort,
					'alamat'		=> $alamat,
					'id_user'		=> $id_user,

				);
				$this->Mcrud->save_siswa($data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Siswa berhasil ditambahkan.
					</div>'
				);

				redirect('users/siswa/');
			}

			if (isset($_POST['btnupdate'])) {
				$nis   	 		= htmlentities(strip_tags($this->input->post('nis')));
				$nisn   	 	= htmlentities(strip_tags($this->input->post('nisn')));
				$nama   	 	= htmlentities(strip_tags($this->input->post('nm_siswa')));
				$ttl   	 		= htmlentities(strip_tags($this->input->post('ttl')));
				$kelas   	 	= htmlentities(strip_tags($this->input->post('kelas')));
				$jurusan   	 	= htmlentities(strip_tags($this->input->post('jurusan')));
				$nm_ort   	 	= htmlentities(strip_tags($this->input->post('nm_ort')));
				$alamat   	 	= htmlentities(strip_tags($this->input->post('alamat')));
				// $id_user   	 	= htmlentities(strip_tags($this->input->post('id_user')));

				$data = array(
					'nis' 			=> $nis,
					'nisn'			=> $nisn,
					'nm_siswa'		=> $nama,
					'ttl'			=> $ttl,
					'kelas'			=> $kelas,
					'jurusan'		=> $jurusan,
					'nm_ort'		=> $nm_ort,
					'alamat'		=> $alamat,
					'id_user'		=> $id_user,

				);
				$this->Mcrud->update_siswa(array('id' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Siswa berhasil diupdate.
					</div>'
				);
				redirect('users/siswa');
			}
		}
	}

	public function ska($aksi = '', $id = '')
	{
		$ceks 	 = $this->session->userdata('info@sman1beutong.sch.id');
		$id_user = $this->session->userdata('sman1beutong');
		$data['skl'] = $this->db->get_where("tbl_sekolah")->row(1);
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			$data['user'] = $this->Mcrud->get_users_by_un($ceks);
			$this->db->join('tbl_user', 'tbl_ska.id_user=tbl_user.id_user');
			$this->db->order_by('tbl_ska.nomor_ska', 'asc');
			$this->db->join('tbl_siswa', 'tbl_ska.id_siswa=tbl_siswa.id');
			$data['ska'] 		  = $this->db->get("tbl_ska");
			if ($aksi == 't') {
				$p = "ska_tambah";
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$data['judul_web'] 	  = "Tambah Surat Keterangan Aktif | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'd') {
				$p = "ska_detail";
				$data['query'] = $this->db->get_where("tbl_ska", array('id_ska' => "$id"))->row();
				$data['judul_web'] 	  = "Detail Surat Keterangan Aktif | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'e') {
				$p = "ska_edit";
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$this->db->join('tbl_siswa', 'tbl_ska.id_siswa=tbl_siswa.id');
				$data['query'] = $this->db->get_where("tbl_ska", array('id_ska' => "$id"))->row();
				$data['judul_web'] 	  = "Edit Surat Keterangan Aktif | SISM SMAN 1 Beutong";
			} elseif ($aksi == 'h') {
				if ($data['user']->row()->level == 's_admin') {
					redirect('404_content');
				}
				$data['query'] = $this->db->get_where("tbl_ska", array('id_ska' => "$id"))->row();
				$data['judul_web'] 	  = "Hapus Surat Keterangan Aktif | SISM SMAN 1 Beutong";
				$this->Mcrud->delete_ska_by_id($id);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Surat Keterangan Aktif berhasil dihapus.
					</div>'
				);
				redirect('users/ska');
			} elseif ($aksi == 'c') {
				$p = "ska_cetak";
				$this->db->join('tbl_siswa', 'tbl_ska.id_siswa=tbl_siswa.id');
				$data['sql'] = $this->db->get_where("tbl_ska", array('id_ska' => "$id"))->row();
				$data['judul_web'] = "Surat_Keterangan | SISM SMAN 1 Beutong";
			} else {
				$p = "ska";
				$data['judul_web'] 	  = "Surat Keterangan Aktif | SISM SMAN 1 Beutong";
			}

			$this->load->view('users/header', $data);
			$this->load->view("users/ska/$p", $data);
			$this->load->view('users/footer');

			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('Y-m-d H:i:s');

			if (isset($_POST['btnsimpan'])) {
				$id_siswa   	= htmlentities(strip_tags($this->input->post('id_siswa')));
				$nomor_ska   	= htmlentities(strip_tags($this->input->post('nomor_ska')));
				$no_ska   	 	= htmlentities(strip_tags($this->input->post('no_ska')));
				$jenis_ska   	= htmlentities(strip_tags($this->input->post('jenis_ska')));
				$keterangan   	= htmlentities(strip_tags($this->input->post('keterangan')));
				$tgl_ska   	 	= htmlentities(strip_tags($this->input->post('tgl_ska')));
				$ttd   	 		= htmlentities(strip_tags($this->input->post('ttd')));

				$data = array(
					'id_siswa' 			=> $id_siswa,
					'nomor_ska'			=> $nomor_ska,
					'no_ska'			=> $no_ska,
					'jenis_ska'			=> $jenis_ska,
					'keterangan'		=> $keterangan,
					'tgl_ska'			=> $tgl_ska,
					'id_user'			=> $id_user,
					'date'				=> $tgl,
					'ttd'				=> $ttd,

				);
				$this->Mcrud->save_ska($data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Surat Keterangan Aktif berhasil ditambahkan.
					</div>'
				);

				redirect('users/ska/');
			}

			if (isset($_POST['btnupdate'])) {
				$id_siswa   	= htmlentities(strip_tags($this->input->post('id_siswa')));
				$nomor_ska   	= htmlentities(strip_tags($this->input->post('nomor_ska')));
				$no_ska   	 	= htmlentities(strip_tags($this->input->post('no_ska')));
				$jenis_ska   	= htmlentities(strip_tags($this->input->post('jenis_ska')));
				$keterangan   	= htmlentities(strip_tags($this->input->post('keterangan')));
				$tgl_ska   	 	= htmlentities(strip_tags($this->input->post('tgl_ska')));
				$ttd   	 		= htmlentities(strip_tags($this->input->post('ttd')));
				$data = array(
					'id_siswa' 			=> $id_siswa,
					'nomor_ska'			=> $nomor_ska,
					'no_ska'			=> $no_ska,
					'jenis_ska'			=> $jenis_ska,
					'keterangan'		=> $keterangan,
					'tgl_ska'			=> $tgl_ska,
					'id_user'			=> $id_user,
					'date'				=> $tgl,
					'ttd'				=> $ttd,
				);
				$this->Mcrud->update_ska(array('id_ska' => $id), $data);
				$this->session->set_flashdata(
					'msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Surat Keterangan Aktif berhasil diupdate.
					</div>'
				);
				redirect('users/ska');
			}
		}
	}
}
