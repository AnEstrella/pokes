<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
    if ($this->session->userdata('logged_in') == TRUE)
    {
      redirect('pokes');
    }
    else {$this->load->view('main');};
	}

	public function pokes()
	{
    if ($this->session->userdata('logged_in') == TRUE) 
    {
      $this->load->model('User');
      $this->load->model('Poke');
      $poke_count = $this->Poke->poke_count($this->session->userdata('id'));
      $users_pokes = $this->Poke->users_pokes($this->session->userdata('id'));
      $all_users = $this->User->all_users($this->session->userdata('id'));
  		$this->load->view('pokes', array('users_pokes' => $users_pokes, 'all_users' => $all_users, 'poke_count' => $poke_count));
    }
    else {redirect('/');};
  }

	public function register()
	{
		//required fields cannot be blank
        if( !$this->input->post('name') || 
        	!$this->input->post('alias') ||
        	!$this->input->post('email') ||
        	!$this->input->post('password') ||
        	!$this->input->post('confirm_pw')
        	){
        	$errors = array(
                   'blank_error' => 'All required fields must be filled out.'
               );
            $this->session->set_flashdata($errors);
            redirect('/');
        }
        //email must be valid 
        if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL))
    	{
    	$errors = array(
               'email_error' => 'Email must be valid.'
           );
    	$this->session->set_flashdata($errors);
      redirect('/');
    	}
        //password must be at least 8 characters
        if (strlen($this->input->post('password')) < 8){
        	$errors = array(
                   'password_error' => 'Password must be at least 8 characters.'
               );
            $this->session->set_flashdata($errors);
            redirect('/');
        }
        //password must match confirmed password 
        if ($this->input->post('password') != $this->input->post('confirm_pw')){
        	$errors = array(
                   'confirmpw_error' => 'Confirmed passwords must match'
               );
            $this->session->set_flashdata($errors);
            redirect('/');
        }
        else{
        //successfully register user, go to pokes page
            $this->load->model("User");
            $user_data = array(
                   'name' => $this->input->post('name'),
                   'alias' => $this->input->post('alias'),
                   'email' => $this->input->post('email'),
                   'password' => $this->input->post('password'),
                   'dob' => $this->input->post('dob')
            ); 
            $add_user = $this->User->add_user($user_data);
            if($add_user === TRUE)
            {
                $errors = array(
                   'registration' => 'Thank you! You have successfully been registered. Please log in with your username and password.'
                );
                $this->session->set_flashdata($errors);
        	    redirect('/');
            };
        }
    }

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$this->load->model('User');
		$user = $this->User->get_user_by_email($email);
		if($user && $user['password'] == $password)
		{
			// current user
			$current_user = array(
				'name' => $user['name'],
				'email' => $user['email'],
				'id' => $user['id'],
				'logged_in'=> TRUE
				);
			$this->session->set_userdata($current_user);	
			// pass user's poke data
			$this->load->model('Poke');
			$users_pokes = $this->Poke->users_pokes($user['id']);
			$all_users = $this->User->all_users($user['id']);
      $poke_count = $this->Poke->poke_count($user['id']);
			$this->load->view('pokes', array('users_pokes' => $users_pokes, 'all_users' => $all_users, 'poke_count' => $poke_count));
		}
		// if login email or password is blank
		else 
		{
			$this->session->set_flashdata("login_error", "Invalid email or password.");
			redirect('/');
		}
	}
	public function logout()
	{
    $this->session->set_userdata('logged_in', FALSE);
		$this->session->unset_userdata();
		redirect('/');
	}
	//poke
	public function poke($pokee_id)
	{
    $this->load->model("Poke");
    $poker_id = $this->session->userdata('id');
    $update_item = $this->Poke->add_poke($poker_id, $pokee_id);
    redirect('pokes');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */