<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{

	public function index()
	{
		$ceks = $this->session->userdata('info@sman1beutong.sch.id');
		if (!isset($ceks)) {
			redirect('web/login');
		} else {
			redirect('users');
		}
	}

	public function login()
	{
		$ceks = $this->session->userdata('info@sman1beutong.sch.id');
		if (isset($ceks)) {
			$this->load->view('404_content');
		} else {
			$this->load->view('web/header');
			$this->load->view('web/login');
			$this->load->view('web/footer');

			if (isset($_POST['btnlogin'])) {
				$username = htmlentities(strip_tags($_POST['username']));
				$pass	   = htmlentities(strip_tags(md5($_POST['password'])));

				$query  = $this->Mcrud->get_users_by_un($username);
				$cek    = $query->result();
				$cekun  = $cek[0]->username;
				$jumlah = $query->num_rows();

				if ($jumlah == 0) {
					$this->session->set_flashdata(
						'msg',
						'
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;&nbsp;</span>
							</button>
							<strong>Username "' . $username . '"</strong> belum terdaftar.
						</div>'
					);
					redirect('web/login');
				} else {
					$row = $query->row();
					$cekpass = $row->password;
					if ($cekpass <> $pass) {
						$this->session->set_flashdata(
							'msg',
							'<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;&nbsp;</span>
								</button>
								<strong>Username atau Password Salah!</strong>.
							</div>'
						);
						redirect('web/login');
					} else {

						$this->session->set_userdata('info@sman1beutong.sch.id', "$cekun");
						$this->session->set_userdata('sman1beutong', "$row->id_user");
						redirect('web');
					}
				}
			}
		}
	}

	public function logout()
	{
		if ($this->session->has_userdata('info@sman1beutong.sch.id') and $this->session->has_userdata('info@sman1beutong.sch.id')) {
			$this->session->sess_destroy();
			redirect('');
		}
		redirect('');
	}

	function error_not_found()
	{
		$this->load->view('404_content');
	}
}
