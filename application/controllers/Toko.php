<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller 
{

	function __construct()
    {
        parent::__construct();
        check_not_login();
        // check_admin();
        $this->load->model(['model_user', 'model_toko']);
    }

	public function index()
	{
		if($this->fungsi->user_login()->level == 1)
		{
			$data = array(
				'title'				=> 'Dashboard',
				'act_dashboard'		=> ' active',
			);	
		}
		elseif ($this->fungsi->user_login()->level == 2) 
		{
			$data = array(
				'title'				=> 'Dashboard',
				'act_dashboard'		=> ' active',
				'profil' 			=> $this->model_toko->byIdUser($this->fungsi->user_login()->user_id)->row()
			);
		}
		elseif ($this->fungsi->user_login()->level == 3) 
		{
			$iduser = $this->model_user->get($this->fungsi->user_login()->user_id)->row();

			$data = array(
				'title'				=> 'Dashboard',
				'act_dashboard'		=> ' active',
				// 'profil' 			=> $this->model_toko->get($user_id)->row()
			);
		}
		
		$this->load->view('templates/backend_header', $data);
		$this->load->view('templates/backend_sidebar');
		$this->load->view('dashboard');
		$this->load->view('templates/backend_footer');
	}

	

}
