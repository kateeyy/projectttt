<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Admin_Controller extends CI_Controller {

  
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['form_validation']);
		$this->load->model('Users_model');
      //  $this->load->library('upload');
        $this->load->helper('form');
        $this->load->helper('url');

	}


	public function index ()
    {

        if(isset($_SESSION['user'])){
            redirect(base_url('index.php/dashboard'));
        }

        if (isset($_POST['login_btn'])) {
            $email= $this->input->post('user_email');
            $pw= $this->input->post('user_password');

            $user_data=$this->Users_model->authenticate($email,$pw);

            if($user_data!==0){

                $user_info = [
                    'user_id'=>$user_data[0]->id,
                    'fullname'=>$user_data[0]->fullname,
                ];

                $this->session->set_userdata('user',$user_info);
                redirect('dashboard');

            }else{

                $this->session->set_flashdata('msg_login','Invalid Password. Please try again.');
            }
    
        }

        $this->load->view('backend/pages/login');
    }


	public function dashboard()
	{
		if(!isset($_SESSION['user'])){
			$this->session->set_flashdata('msg_login', 'Please Login');
			redirect(base_url('index.php/admin'));
		}

        $data['resident'] = $this->Users_model->get_all_residents();
        $data['total_residents'] = count($data['resident']);

		$this->load->view('backend/include/header');
		$this->load->view('backend/include/nav');
		$this->load->view('backend/pages/dashboard', $data);
		$this->load->view('backend/include/footer');
		
	}

	
	public function logout()
	{
		$this->session->unset_userdata('user');
		redirect(base_url('index.php/admin'));
	}

	
   /*public function addresident(){
        
        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }


        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('household_members','Total Household Members','trim|required');
        $this->form_validation->set_rules('land_ownership','Land Ownership Status','trim|required');
        $this->form_validation->set_rules('ownership_status','Household Ownership Status','trim|required');
        $this->form_validation->set_rules('blood_type','Blood Type','trim|required');
        $this->form_validation->set_rules('disability','Differently-Abled','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('occupation','Occupation','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('monthly_income','Monthly Income','trim|required');
        $this->form_validation->set_rules('education','Educational Attainment','trim|required');
        $this->form_validation->set_rules('lightning_facilities','Lightning Facilities','trim|required');
        $this->form_validation->set_rules('image','Image','trim|required');
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/addresident');
            $this->load->view('backend/include/footer');

        }else{

            $resident_data = [
                'first_name'=>$this->input->post('firstname',TRUE),
                'middle_name'=>$this->input->post('middlename',TRUE),
                'last_name'=>$this->input->post('lastname',TRUE),
                'purok'=>$this->input->post('purok',TRUE),
                'streetname'=>$this->input->post('streetname',TRUE),
                'barangay'=>$this->input->post('barangay',TRUE),
                'sex'=>$this->input->post('sex',TRUE),
                'birth_date'=>$this->input->post('birth_date',TRUE),
                'birth_place'=>$this->input->post('birth_place',TRUE),
                'nationality'=>$this->input->post('nationality',TRUE),
                'civil_status'=>$this->input->post('civil_status',TRUE),
                'religion'=>$this->input->post('religion',TRUE),
                'household_members'=>$this->input->post('household_members',TRUE),
                'land_ownership'=>$this->input->post('land_ownership',TRUE),
                'ownership_status'=>$this->input->post('ownership_status',TRUE),
                'blood_type'=>$this->input->post('blood_type',TRUE),
                'disability'=>$this->input->post('disability',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'occupation'=>$this->input->post('occupation',TRUE),
                'monthly_income'=>$this->input->post('monthly_income',TRUE),
                'education'=>$this->input->post('education',TRUE),
                'lightning_facilities'=>$this->input->post('lightning_facilities',TRUE),

                
            ];


            $insert = $this->db->insert('resident',$resident_data);

            $insert_id = $this->db->insert_id();

            if( is_int($insert_id) ){
                redirect(base_url('index.php/dashboard/view-resident'));
            }


        }
        


    }*/

   /* public function addresident(){
        
        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }

        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('household_members','Total Household Members','trim|required');
        $this->form_validation->set_rules('land_ownership','Land Ownership Status','trim|required');
        $this->form_validation->set_rules('ownership_status','Household Ownership Status','trim|required');
        $this->form_validation->set_rules('blood_type','Blood Type','trim|required');
        $this->form_validation->set_rules('disability','Differently-Abled','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('occupation','Occupation','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('monthly_income','Monthly Income','trim|required');
        $this->form_validation->set_rules('education','Educational Attainment','trim|required');
        $this->form_validation->set_rules('lightning_facilities','Lightning Facilities','trim|required');
        $this->form_validation->set_rules('image','Image','trim|required');
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/addresident');
            $this->load->view('backend/include/footer');

        }else{

            $resident_data = [
                'first_name'=>$this->input->post('firstname',TRUE),
                'middle_name'=>$this->input->post('middlename',TRUE),
                'last_name'=>$this->input->post('lastname',TRUE),
                'purok'=>$this->input->post('purok',TRUE),
                'streetname'=>$this->input->post('streetname',TRUE),
                'barangay'=>$this->input->post('barangay',TRUE),
                'sex'=>$this->input->post('sex',TRUE),
                'birth_date'=>$this->input->post('birth_date',TRUE),
                'birth_place'=>$this->input->post('birth_place',TRUE),
                'nationality'=>$this->input->post('nationality',TRUE),
                'civil_status'=>$this->input->post('civil_status',TRUE),
                'religion'=>$this->input->post('religion',TRUE),
                'household_members'=>$this->input->post('household_members',TRUE),
                'land_ownership'=>$this->input->post('land_ownership',TRUE),
                'ownership_status'=>$this->input->post('ownership_status',TRUE),
                'blood_type'=>$this->input->post('blood_type',TRUE),
                'disability'=>$this->input->post('disability',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'occupation'=>$this->input->post('occupation',TRUE),
                'monthly_income'=>$this->input->post('monthly_income',TRUE),
                'education'=>$this->input->post('education',TRUE),
                'lightning_facilities'=>$this->input->post('lightning_facilities',TRUE),

                
            ];


            $insert = $this->db->insert('resident',$resident_data);

            $insert_id = $this->db->insert_id();

            if( is_int($insert_id) ){
                redirect(base_url('index.php/dashboard/view-resident'));
            }


        }
        


    }*/

   /* public function add.resident(){
        
        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }

        $this->form_validation->set_rules('image','Image','validate_image_upload');
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('household_members','Total Household Members','trim|required');
        $this->form_validation->set_rules('land_ownership','Land Ownership Status','trim|required');
        $this->form_validation->set_rules('ownership_status','Household Ownership Status','trim|required');
        $this->form_validation->set_rules('blood_type','Blood Type','trim|required');
        $this->form_validation->set_rules('disability','Differently-Abled','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('occupation','Occupation','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('monthly_income','Monthly Income','trim|required');
        $this->form_validation->set_rules('education','Educational Attainment','trim|required');
        $this->form_validation->set_rules('lightning_facilities','Lightning Facilities','trim|required');
       
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/addresident');
            $this->load->view('backend/include/footer');

        }else{

            $resident_data = [
                'image'=>$image,
                'first_name'=>$this->input->post('firstname',TRUE),
                'middle_name'=>$this->input->post('middlename',TRUE),
                'last_name'=>$this->input->post('lastname',TRUE),
                'purok'=>$this->input->post('purok',TRUE),
                'streetname'=>$this->input->post('streetname',TRUE),
                'barangay'=>$this->input->post('barangay',TRUE),
                'sex'=>$this->input->post('sex',TRUE),
                'birth_date'=>$this->input->post('birth_date',TRUE),
                'birth_place'=>$this->input->post('birth_place',TRUE),
                'nationality'=>$this->input->post('nationality',TRUE),
                'civil_status'=>$this->input->post('civil_status',TRUE),
                'religion'=>$this->input->post('religion',TRUE),
                'household_members'=>$this->input->post('household_members',TRUE),
                'land_ownership'=>$this->input->post('land_ownership',TRUE),
                'ownership_status'=>$this->input->post('ownership_status',TRUE),
                'blood_type'=>$this->input->post('blood_type',TRUE),
                'disability'=>$this->input->post('disability',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'occupation'=>$this->input->post('occupation',TRUE),
                'monthly_income'=>$this->input->post('monthly_income',TRUE),
                'education'=>$this->input->post('education',TRUE),
                'lightning_facilities'=>$this->input->post('lightning_facilities',TRUE),

                
            ];


            $insert = $this->db->insert('resident',$resident_data);

            $insert_id = $this->db->insert_id();

            if( is_int($insert_id) ){

                  // Handle image upload
            $config['upload_path'] = './uploads/'; // Specify the path where the image will be uploaded
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Allowed image file types
            $config['max_size'] = 2048; // Maximum file size in kilobytes (2MB)

            $this->load->library('upload', $config);

            if($_FILES['image']['name']==''){

                $this->session->set_flashdata('error','Please select an image');
    
                //  redirect(base_url('demo'));	
            }

            if(!$this->upload->do_upload('image')){
        
                $this->session->set_flashdata('error',$this->upload->display_errors());
     
                   //redirect(base_url('demo'));
             }
             else{

                $this->session->set_flashdata('success','Image successfully uploaded');

                $data = array(
                    'image' => $image,
                );

                $doc_id = $this->Users_model->insert_data($data);
    
                  //redirect(base_url('demo'));	
            }

          

                redirect(base_url('index.php/dashboard/view-resident'));
            }


        }
        


    }*/

   /*final public function addresident(){
        
        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }

        $this->form_validation->set_rules('image','Image','validate_image_upload');
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('extname','Extension name','trim|required');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('household_members','Total Household Members','trim|required');
        $this->form_validation->set_rules('land_ownership','Land Ownership Status','trim|required');
        $this->form_validation->set_rules('ownership_status','Household Ownership Status','trim|required');
        $this->form_validation->set_rules('blood_type','Blood Type','trim|required');
        $this->form_validation->set_rules('disability','Differently-Abled','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('occupation','Occupation','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('monthly_income','Monthly Income','trim|required');
        $this->form_validation->set_rules('education','Educational Attainment','trim|required');
        $this->form_validation->set_rules('lightning_facilities','Lightning Facilities','trim|required');
       
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/addresident');
            $this->load->view('backend/include/footer');

        }else{

            $config['upload_path'] = './uploads/'; // Specify the path where the image will be uploaded
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Allowed image file types
            $config['max_size'] = 2048; // Maximum file size in kilobytes (2MB)

            $this->load->library('upload', $config);

            
            if($_FILES['image']['name']==''){

                $this->session->set_flashdata('error','Please select an image');
    
                //  redirect(base_url('demo'));	
            }

            if(!$this->upload->do_upload('image')){
        
                $this->session->set_flashdata('error',$this->upload->display_errors());
     
                   //redirect(base_url('demo'));
             }
             else{

                $this->session->set_flashdata('success','Image successfully uploaded');

                $image_data = $this->upload->data();
               // $image_path = 'uploads/'. $image_data['file_name'];
              $image_path ='./uploads/'. $image_data['file_name'];



                $resident_data = [
                    'image' => $image_path,
                    'first_name'=>$this->input->post('firstname',TRUE),
                    'middle_name'=>$this->input->post('middlename',TRUE),
                    'last_name'=>$this->input->post('lastname',TRUE),
                    'extname'=>$this->input->post('extname',TRUE),
                    'purok'=>$this->input->post('purok',TRUE),
                    'streetname'=>$this->input->post('streetname',TRUE),
                    'barangay'=>$this->input->post('barangay',TRUE),
                    'sex'=>$this->input->post('sex',TRUE),
                    'birth_date'=>$this->input->post('birth_date',TRUE),
                    'birth_place'=>$this->input->post('birth_place',TRUE),
                    'nationality'=>$this->input->post('nationality',TRUE),
                    'civil_status'=>$this->input->post('civil_status',TRUE),
                    'religion'=>$this->input->post('religion',TRUE),
                    'household_members'=>$this->input->post('household_members',TRUE),
                    'land_ownership'=>$this->input->post('land_ownership',TRUE),
                    'ownership_status'=>$this->input->post('ownership_status',TRUE),
                    'blood_type'=>$this->input->post('blood_type',TRUE),
                    'disability'=>$this->input->post('disability',TRUE),
                    'contact'=>$this->input->post('contact',TRUE),
                    'occupation'=>$this->input->post('occupation',TRUE),
                    'monthly_income'=>$this->input->post('monthly_income',TRUE),
                    'education'=>$this->input->post('education',TRUE),
                    'lightning_facilities'=>$this->input->post('lightning_facilities',TRUE),
    
                    
                ];

                $insert = $this->db->insert('resident',$resident_data);

                $insert_id = $this->db->insert_id();
    
                  //redirect(base_url('demo'));	

                  if( is_int($insert_id) ){

                    // Handle image upload
           
  
            
  
                  redirect(base_url('index.php/dashboard/view-resident'));
              }
            }


        }
        


    }*/

 /*finale */  public function addresident(){
        
        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }

        $this->form_validation->set_rules('image','Image','validate_image_upload');
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('extname','Extension name');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('household_members','Total Household Members','trim|required');
        $this->form_validation->set_rules('land_ownership','Land Ownership Status','trim|required');
        $this->form_validation->set_rules('ownership_status','Household Ownership Status','trim|required');
        $this->form_validation->set_rules('blood_type','Blood Type','trim|required');
        $this->form_validation->set_rules('disability','Differently-Abled','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('occupation','Occupation','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('monthly_income','Monthly Income','trim|required');
        $this->form_validation->set_rules('education','Educational Attainment','trim|required');
        $this->form_validation->set_rules('lightning_facilities','Lightning Facilities','trim|required');
       
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/addresident');
            $this->load->view('backend/include/footer');

        }else{

            $config['upload_path'] = './uploads/'; // Specify the path where the image will be uploaded
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Allowed image file types
            $config['max_size'] = 2048; // Maximum file size in kilobytes (2MB)

            $this->load->library('upload', $config);

            
            if($_FILES['image']['name']==''){

                $this->session->set_flashdata('error','Please select an image');
    
                //  redirect(base_url('demo'));	
            }

            if(!$this->upload->do_upload('image')){
        
                $this->session->set_flashdata('error',$this->upload->display_errors());
     
                   //redirect(base_url('demo'));
             }
             else{

                $this->session->set_flashdata('success','Image successfully uploaded');

                $image_data = $this->upload->data();
               // $image_path = 'uploads/'. $image_data['file_name'];
              $image_path ='./uploads/'. $image_data['file_name'];



                $resident_data = [
                    'image' => $image_path,
                    'first_name'=>$this->input->post('firstname',TRUE),
                    'middle_name'=>$this->input->post('middlename',TRUE),
                    'last_name'=>$this->input->post('lastname',TRUE),
                    'extname'=>$this->input->post('extname',TRUE),
                    'purok'=>$this->input->post('purok',TRUE),
                    'streetname'=>$this->input->post('streetname',TRUE),
                    'barangay'=>$this->input->post('barangay',TRUE),
                    'sex'=>$this->input->post('sex',TRUE),
                    'birth_date'=>$this->input->post('birth_date',TRUE),
                    'birth_place'=>$this->input->post('birth_place',TRUE),
                    'nationality'=>$this->input->post('nationality',TRUE),
                    'civil_status'=>$this->input->post('civil_status',TRUE),
                    'religion'=>$this->input->post('religion',TRUE),
                    'household_members'=>$this->input->post('household_members',TRUE),
                    'land_ownership'=>$this->input->post('land_ownership',TRUE),
                    'ownership_status'=>$this->input->post('ownership_status',TRUE),
                    'blood_type'=>$this->input->post('blood_type',TRUE),
                    'disability'=>$this->input->post('disability',TRUE),
                    'contact'=>$this->input->post('contact',TRUE),
                    'occupation'=>$this->input->post('occupation',TRUE),
                    'monthly_income'=>$this->input->post('monthly_income',TRUE),
                    'education'=>$this->input->post('education',TRUE),
                    'lightning_facilities'=>$this->input->post('lightning_facilities',TRUE),
    
                    
                ];

                $rbi_data = [
                    
                    'first_name'=>$this->input->post('firstname',TRUE),
                    'middle_name'=>$this->input->post('middlename',TRUE),
                    'last_name'=>$this->input->post('lastname',TRUE),
                    'extname'=>$this->input->post('extname',TRUE),
                    'purok'=>$this->input->post('purok',TRUE),
                    'streetname'=>$this->input->post('streetname',TRUE),
                   
                    'sex'=>$this->input->post('sex',TRUE),
                    'birth_date'=>$this->input->post('birth_date',TRUE),
                    'birth_place'=>$this->input->post('birth_place',TRUE),
                    'nationality'=>$this->input->post('nationality',TRUE),
                    'civil_status'=>$this->input->post('civil_status',TRUE),
                   
                    'contact'=>$this->input->post('contact',TRUE),
                    'occupation'=>$this->input->post('occupation',TRUE),
                   
    
                    
                ];


                $insert = $this->db->insert('resident',$resident_data);

                $insert_id = $this->db->insert_id();
    
                  //redirect(base_url('demo'));	

                  if( is_int($insert_id) ){

                    $insert_another_table = $this->db->insert('rbi', $rbi_data);
                    $insert_id_another_table = $this->db->insert_id();

                    // Handle image upload
                    ;

                    if (is_int($insert_id_another_table)) {
                        // Both insertions were successful
                        redirect(base_url('index.php/dashboard/view-resident'));
                    } 
           
  
            
  
                  redirect(base_url('index.php/dashboard/view-resident'));
              }
            }


        }
        


    }/**/

  /*  public function addresident(){
        
        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }

        $this->form_validation->set_rules('image','Image','validate_image_upload');
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('extname','Extension name');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('household_members','Total Household Members','trim|required');
        $this->form_validation->set_rules('land_ownership','Land Ownership Status','trim|required');
        $this->form_validation->set_rules('ownership_status','Household Ownership Status','trim|required');
        $this->form_validation->set_rules('blood_type','Blood Type','trim|required');
        $this->form_validation->set_rules('disability','Differently-Abled','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('occupation','Occupation','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('monthly_income','Monthly Income','trim|required');
        $this->form_validation->set_rules('education','Educational Attainment','trim|required');
        $this->form_validation->set_rules('lightning_facilities','Lightning Facilities','trim|required');
       
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/addresident');
            $this->load->view('backend/include/footer');

        }else{

            $config['upload_path'] = './uploads/'; // Specify the path where the image will be uploaded
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Allowed image file types
            $config['max_size'] = 2048; // Maximum file size in kilobytes (2MB)

            $this->load->library('upload', $config);

            
            if($_FILES['image']['name']==''){

                $this->session->set_flashdata('error','Please select an image');
    
                //  redirect(base_url('demo'));	
            }elseif(!$this->upload->do_upload('image')){
        
                $this->session->set_flashdata('error',$this->upload->display_errors());
     
                   //redirect(base_url('demo'));
             }
             else{

                $this->session->set_flashdata('success','Image successfully uploaded');

                $image_data = $this->upload->data();
               // $image_path = 'uploads/'. $image_data['file_name'];
              $image_path ='./uploads/'. $image_data['file_name'];


                $resident_data = [
                    'image' => $image_path,
                    'first_name'=>$this->input->post('firstname',TRUE),
                    'middle_name'=>$this->input->post('middlename',TRUE),
                    'last_name'=>$this->input->post('lastname',TRUE),
                    'extname'=>$this->input->post('extname',TRUE),
                    'purok'=>$this->input->post('purok',TRUE),
                    'streetname'=>$this->input->post('streetname',TRUE),
                    'barangay'=>$this->input->post('barangay',TRUE),
                    'sex'=>$this->input->post('sex',TRUE),
                    'birth_date'=>$this->input->post('birth_date',TRUE),
                    'birth_place'=>$this->input->post('birth_place',TRUE),
                    'nationality'=>$this->input->post('nationality',TRUE),
                    'civil_status'=>$this->input->post('civil_status',TRUE),
                    'religion'=>$this->input->post('religion',TRUE),
                    'household_members'=>$this->input->post('household_members',TRUE),
                    'land_ownership'=>$this->input->post('land_ownership',TRUE),
                    'ownership_status'=>$this->input->post('ownership_status',TRUE),
                    'blood_type'=>$this->input->post('blood_type',TRUE),
                    'disability'=>$this->input->post('disability',TRUE),
                    'contact'=>$this->input->post('contact',TRUE),
                    'occupation'=>$this->input->post('occupation',TRUE),
                    'monthly_income'=>$this->input->post('monthly_income',TRUE),
                    'education'=>$this->input->post('education',TRUE),
                    'lightning_facilities'=>$this->input->post('lightning_facilities',TRUE),
    
                    
                ];

              //  echo json_encode(['image_path' => $image_path]);

                $rbi_data = [
                    
                    'first_name'=>$this->input->post('firstname',TRUE),
                    'middle_name'=>$this->input->post('middlename',TRUE),
                    'last_name'=>$this->input->post('lastname',TRUE),
                    'extname'=>$this->input->post('extname',TRUE),
                    'purok'=>$this->input->post('purok',TRUE),
                    'streetname'=>$this->input->post('streetname',TRUE),
                   
                    'sex'=>$this->input->post('sex',TRUE),
                    'birth_date'=>$this->input->post('birth_date',TRUE),
                    'birth_place'=>$this->input->post('birth_place',TRUE),
                    'nationality'=>$this->input->post('nationality',TRUE),
                    'civil_status'=>$this->input->post('civil_status',TRUE),
                   
                    'contact'=>$this->input->post('contact',TRUE),
                    'occupation'=>$this->input->post('occupation',TRUE),
                   
    
                    
                ];


                $insert = $this->db->insert('resident',$resident_data);

                $insert_id = $this->db->insert_id();
    
                  //redirect(base_url('demo'));	

                  if( is_int($insert_id) ){

                    $insert_another_table = $this->db->insert('rbi', $rbi_data);
                    $insert_id_another_table = $this->db->insert_id();

                    // Handle image upload
                    ;

                    if (is_int($insert_id_another_table)) {
                        // Both insertions were successful
                        redirect(base_url('index.php/dashboard/view-resident'));
                    } 
           
  
            
  
                  redirect(base_url('index.php/dashboard/view-resident'));
              }
            }


        }
        


    }*/
   

   public function validate_image_upload()
    {
        if (!empty($_FILES['image']['name'])) {
            return true;
        } else {
            $this->form_validation->set_message('validate_image_upload', 'Please select an image to upload.');
            return false;
        }
    }
    
   
    
    

	public function viewresident(){

        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }


        $resident_list = $this->db->get('resident')->result();

        $data = ['resident_list'=>$resident_list];

        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/viewresident',$data);
        $this->load->view('backend/include/footer');
    }

  /*  public function delete($resident_id) {
        $this->load->model('Users_model');
        if ($this->Users_model->delete_user($resident_id)) {
            redirect(base_url('index.php/dashboard/view-resident')); // Redirect to user list page or any other page
        } else {
            echo 'Failed to delete the user.';
        }
    }*/

    public function deleteresident($id){
        $this->db->db_debug = TRUE;
        $this->db->where('resident_id', $id);
        $this->db->delete('resident');
        redirect(base_url('index.php/dashboard/view-resident'));
    }

  
   /* origfinal public function update_resident($resident_id) {
        if (!isset($_SESSION['user'])) {
            $this->session->set_flashdata('msg_login', 'You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }
    
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '<p>');
    
        if ($this->form_validation->run() == FALSE) {
            // Load the resident data based on the resident_id
            $resident_data = $this->db->get_where('resident', array('resident_id' => $resident_id))->row();
    
            $data = [
                'resident_data' => $resident_data
            ];
            
    
            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/updateresident', $data);
            $this->load->view('backend/include/footer');
        } else {
            // Update the resident data
            $resident_data = [
                'first_name'=>$this->input->post('firstname',TRUE),
                'middle_name'=>$this->input->post('middlename',TRUE),
                'last_name'=>$this->input->post('lastname',TRUE),
                'purok'=>$this->input->post('purok',TRUE),
                'streetname'=>$this->input->post('streetname',TRUE),
                'barangay'=>$this->input->post('barangay',TRUE),
                'sex'=>$this->input->post('sex',TRUE),
                'birth_date'=>$this->input->post('birth_date',TRUE),
                'birth_place'=>$this->input->post('birth_place',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'nationality'=>$this->input->post('nationality',TRUE),
                'civil_status'=>$this->input->post('civil_status',TRUE),
                'religion'=>$this->input->post('religion',TRUE),
            ];
    
            $this->db->where('resident_id', $resident_id);
            $update = $this->db->update('resident', $resident_data);
    
            if ($update) {
                redirect(base_url('index.php/dashboard/view-resident'));
            }
        }

    }*/

    public function update_resident($resident_id) {
        if (!isset($_SESSION['user'])) {
            $this->session->set_flashdata('msg_login', 'You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }
    
        $this->form_validation->set_rules('image','Image','call_validate_image_upload');
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('extname','Extension name');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('household_members','Total Household Members','trim|required');
        $this->form_validation->set_rules('land_ownership','Land Ownership Status','trim|required');
        $this->form_validation->set_rules('ownership_status','Household Ownership Status','trim|required');
        $this->form_validation->set_rules('blood_type','Blood Type','trim|required');
        $this->form_validation->set_rules('disability','Differently-Abled','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('occupation','Occupation','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('monthly_income','Monthly Income','trim|required');
        $this->form_validation->set_rules('education','Educational Attainment','trim|required');
        $this->form_validation->set_rules('lightning_facilities','Lightning Facilities','trim|required');
       
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');
    
        if ($this->form_validation->run() == FALSE) {
            // Load the resident data based on the resident_id
            $resident_data = $this->db->get_where('resident', array('resident_id' => $resident_id))->row();
    
            $data = [
                'resident_data' => $resident_data
            ];
            
    
            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/updateresident', $data);
            $this->load->view('backend/include/footer');
        } else {
            
            $config['upload_path'] = './uploads/'; // Specify the path where the image will be uploaded
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Allowed image file types
            $config['max_size'] = 2048; // Maximum file size in kilobytes (2MB)

            $this->load->library('upload', $config);

            
            if($_FILES['image']['name']==''){

                $this->session->set_flashdata('error','Please select an image');
    
                //  redirect(base_url('demo'));	
            }

            if(!$this->upload->do_upload('image')){
        
                $this->session->set_flashdata('error',$this->upload->display_errors());
     
                   //redirect(base_url('demo'));
             }
             else{

                $this->session->set_flashdata('success','Image successfully uploaded');

                $image_data = $this->upload->data();
               // $image_path = 'uploads/'. $image_data['file_name'];
              $image_path ='./uploads/'. $image_data['file_name'];

            // Update the resident data
            $resident_data = [
                'image' => $image_path,
                'first_name'=>$this->input->post('firstname',TRUE),
                'middle_name'=>$this->input->post('middlename',TRUE),
                'last_name'=>$this->input->post('lastname',TRUE),
                'extname'=>$this->input->post('extname',TRUE),
                'purok'=>$this->input->post('purok',TRUE),
                'streetname'=>$this->input->post('streetname',TRUE),
                'barangay'=>$this->input->post('barangay',TRUE),
                'sex'=>$this->input->post('sex',TRUE),
                'birth_date'=>$this->input->post('birth_date',TRUE),
                'birth_place'=>$this->input->post('birth_place',TRUE),
                'nationality'=>$this->input->post('nationality',TRUE),
                'civil_status'=>$this->input->post('civil_status',TRUE),
                'religion'=>$this->input->post('religion',TRUE),
                'household_members'=>$this->input->post('household_members',TRUE),
                'land_ownership'=>$this->input->post('land_ownership',TRUE),
                'ownership_status'=>$this->input->post('ownership_status',TRUE),
                'blood_type'=>$this->input->post('blood_type',TRUE),
                'disability'=>$this->input->post('disability',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'occupation'=>$this->input->post('occupation',TRUE),
                'monthly_income'=>$this->input->post('monthly_income',TRUE),
                'education'=>$this->input->post('education',TRUE),
                'lightning_facilities'=>$this->input->post('lightning_facilities',TRUE),
            ];
    
            $this->db->where('resident_id', $resident_id);
            $update = $this->db->update('resident', $resident_data);
    
            if ($update) {
                redirect(base_url('index.php/dashboard/view-resident'));
            }else{
                echo("Error");
            }
        }

    }
}

 /*final   public function update_resident($resident_id) {
        if (!isset($_SESSION['user'])) {
            $this->session->set_flashdata('msg_login', 'You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }
    
       
        $this->form_validation->set_rules('image','Image','validate_image_upload');
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('extname','Extension name','trim|required');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('household_members','Total Household Members','trim|required');
        $this->form_validation->set_rules('land_ownership','Land Ownership Status','trim|required');
        $this->form_validation->set_rules('ownership_status','Household Ownership Status','trim|required');
        $this->form_validation->set_rules('blood_type','Blood Type','trim|required');
        $this->form_validation->set_rules('disability','Differently-Abled','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('occupation','Occupation','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('monthly_income','Monthly Income','trim|required');
        $this->form_validation->set_rules('education','Educational Attainment','trim|required');
        $this->form_validation->set_rules('lightning_facilities','Lightning Facilities','trim|required');
    
        if ($this->form_validation->run() == FALSE) {
            // Load the resident data based on the resident_id
            $resident_data = $this->db->get_where('resident', array('resident_id' => $resident_id))->row();
    
            $data = [
                'resident_data' => $resident_data
            ];
            
    
            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/updateresident', $data);
            $this->load->view('backend/include/footer');
        } else {
            // Update the resident data

            
            $config['upload_path'] = './uploads/'; // Specify the path where the image will be uploaded
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Allowed image file types
            $config['max_size'] = 2048; // Maximum file size in kilobytes (2MB)

            $this->load->library('upload', $config);

            
            if($_FILES['image']['name']==''){

                $this->session->set_flashdata('error','Please select an image');
    
                //  redirect(base_url('demo'));	
            }

            if(!$this->upload->do_upload('image')){
        
                $this->session->set_flashdata('error',$this->upload->display_errors());
     
                   //redirect(base_url('demo'));
             }
             else{

                $this->session->set_flashdata('success','Image successfully uploaded');

                $image_data = $this->upload->data();
               // $image_path = 'uploads/'. $image_data['file_name'];
              $image_path ='./uploads/'. $image_data['file_name'];

            $resident_data = [
                'image' => $image_path,
                'first_name'=>$this->input->post('firstname',TRUE),
                'middle_name'=>$this->input->post('middlename',TRUE),
                'last_name'=>$this->input->post('lastname',TRUE),
                'extname'=>$this->input->post('extname',TRUE),
                'purok'=>$this->input->post('purok',TRUE),
                'streetname'=>$this->input->post('streetname',TRUE),
                'barangay'=>$this->input->post('barangay',TRUE),
                'sex'=>$this->input->post('sex',TRUE),
                'birth_date'=>$this->input->post('birth_date',TRUE),
                'birth_place'=>$this->input->post('birth_place',TRUE),
                'nationality'=>$this->input->post('nationality',TRUE),
                'civil_status'=>$this->input->post('civil_status',TRUE),
                'religion'=>$this->input->post('religion',TRUE),
                'household_members'=>$this->input->post('household_members',TRUE),
                'land_ownership'=>$this->input->post('land_ownership',TRUE),
                'ownership_status'=>$this->input->post('ownership_status',TRUE),
                'blood_type'=>$this->input->post('blood_type',TRUE),
                'disability'=>$this->input->post('disability',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'occupation'=>$this->input->post('occupation',TRUE),
                'monthly_income'=>$this->input->post('monthly_income',TRUE),
                'education'=>$this->input->post('education',TRUE),
                'lightning_facilities'=>$this->input->post('lightning_facilities',TRUE),
            ];
    
            $this->db->where('resident_id', $resident_id);
            $update = $this->db->update('resident', $resident_data);
    
            if ($update) {
                redirect(base_url('index.php/dashboard/view-resident'));
            }
        }
    }

    }*/

    /* sec. final public function update_resident($resident_id) {
        if (!isset($_SESSION['user'])) {
            $this->session->set_flashdata('msg_login', 'You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }
    
       
        $this->form_validation->set_rules('image','Image','validate_image_upload');
        $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('extname','Extension name','trim|required');
        $this->form_validation->set_rules('purok','Purok','trim|required');
        $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('sex','Sex','trim|required');
        $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
        $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('household_members','Total Household Members','trim|required');
        $this->form_validation->set_rules('land_ownership','Land Ownership Status','trim|required');
        $this->form_validation->set_rules('ownership_status','Household Ownership Status','trim|required');
        $this->form_validation->set_rules('blood_type','Blood Type','trim|required');
        $this->form_validation->set_rules('disability','Differently-Abled','trim|required');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('occupation','Occupation','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('monthly_income','Monthly Income','trim|required');
        $this->form_validation->set_rules('education','Educational Attainment','trim|required');
        $this->form_validation->set_rules('lightning_facilities','Lightning Facilities','trim|required');
    
        if ($this->form_validation->run() == FALSE) {
            // Load the resident data based on the resident_id
            $resident_data = $this->db->get_where('resident', array('resident_id' => $resident_id))->row();
    
            $data = [
                'resident_data' => $resident_data
            ];
            
    
            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/updateresident', $data);
            $this->load->view('backend/include/footer');
        } else {
            // Update the resident data

                $config['upload_path'] = './uploads/'; // Specify the path where the image will be uploaded
                $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Allowed image file types
                $config['max_size'] = 2048; // Maximum file size in kilobytes (2MB)
            
                $this->load->library('upload', $config);
            
            if(!$this->upload->do_upload('image')){
        
                $this->session->set_flashdata('error',$this->upload->display_errors());
     
                   //redirect(base_url('demo'));
             }
             else{

                $this->session->set_flashdata('success','Image successfully uploaded');

                $image_data = $this->upload->data();
               // $image_path = 'uploads/'. $image_data['file_name'];
              $image_path ='./uploads/'. $image_data['file_name'];

              $resident_data = $this->db->get_where('resident', array('resident_id' => $resident_id))->row();

              if (!empty($resident_data->image) && file_exists($resident_data->image)) {
                unlink($resident_data->image);
            }

            $resident_data = [
                'image' => $image_path,
                'first_name'=>$this->input->post('firstname',TRUE),
                'middle_name'=>$this->input->post('middlename',TRUE),
                'last_name'=>$this->input->post('lastname',TRUE),
                'extname'=>$this->input->post('extname',TRUE),
                'purok'=>$this->input->post('purok',TRUE),
                'streetname'=>$this->input->post('streetname',TRUE),
                'barangay'=>$this->input->post('barangay',TRUE),
                'sex'=>$this->input->post('sex',TRUE),
                'birth_date'=>$this->input->post('birth_date',TRUE),
                'birth_place'=>$this->input->post('birth_place',TRUE),
                'nationality'=>$this->input->post('nationality',TRUE),
                'civil_status'=>$this->input->post('civil_status',TRUE),
                'religion'=>$this->input->post('religion',TRUE),
                'household_members'=>$this->input->post('household_members',TRUE),
                'land_ownership'=>$this->input->post('land_ownership',TRUE),
                'ownership_status'=>$this->input->post('ownership_status',TRUE),
                'blood_type'=>$this->input->post('blood_type',TRUE),
                'disability'=>$this->input->post('disability',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'occupation'=>$this->input->post('occupation',TRUE),
                'monthly_income'=>$this->input->post('monthly_income',TRUE),
                'education'=>$this->input->post('education',TRUE),
                'lightning_facilities'=>$this->input->post('lightning_facilities',TRUE),
            ];

    
            $this->db->where('resident_id', $resident_id);
            $update = $this->db->update('resident', $resident_data);
    
            if ($update) {
                $this->session->set_flashdata('success', 'Resident data updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to update resident data');
            }
        }
        $resident_data = $this->db->get_where('resident', array('resident_id' => $resident_id))->row();
        $data = [
            'resident_data' => $resident_data
        ];

        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/updateresident', $data);
        $this->load->view('backend/include/footer');
    }
}/**/

/***public function update_resident($resident_id) {
    if (!isset($_SESSION['user'])) {
        $this->session->set_flashdata('msg_login', 'You are not logged in. Please Login First');
        redirect(base_url('index.php/admin'));
    }

    $this->form_validation->set_rules('image','Image','validate_image_upload');
    $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('purok','Purok','trim|required');
    $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('barangay','Barangay','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('sex','Sex','trim|required');
    $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
    $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('religion','Religion','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_error_delimiters('<p style="color:red;">', '<p>');

    if ($this->form_validation->run() == FALSE) {
        // Load the resident data based on the resident_id
        $resident_data = $this->db->get_where('resident', array('resident_id' => $resident_id))->row();

        $data = [
            'resident_data' => $resident_data
        ];
        

        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/updateresident', $data);
        $this->load->view('backend/include/footer');
    } else {

        $config['upload_path'] = './uploads/'; // Specify the path where the image will be uploaded
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; // Allowed image file types
        $config['max_size'] = 2048; // Maximum file size in kilobytes (2MB)

        $this->load->library('upload', $config);

        
        if($_FILES['image']['name']==''){

            $this->session->set_flashdata('error','Please select an image');

            //  redirect(base_url('demo'));	
        }

        if(!$this->upload->do_upload('image')){
    
            $this->session->set_flashdata('error',$this->upload->display_errors());
 
               //redirect(base_url('demo'));
         }
         else{

            $this->session->set_flashdata('success','Image successfully uploaded');

            $image_data = $this->upload->data();
           // $image_path = 'uploads/'. $image_data['file_name'];
          $image_path ='./uploads/'. $image_data['file_name'];
        // Update the resident data
        $resident_data = [
            'image' => $image_path,
            'first_name'=>$this->input->post('firstname',TRUE),
            'middle_name'=>$this->input->post('middlename',TRUE),
            'last_name'=>$this->input->post('lastname',TRUE),
            'purok'=>$this->input->post('purok',TRUE),
            'streetname'=>$this->input->post('streetname',TRUE),
            'barangay'=>$this->input->post('barangay',TRUE),
            'sex'=>$this->input->post('sex',TRUE),
            'birth_date'=>$this->input->post('birth_date',TRUE),
            'birth_place'=>$this->input->post('birth_place',TRUE),
            'contact'=>$this->input->post('contact',TRUE),
            'nationality'=>$this->input->post('nationality',TRUE),
            'civil_status'=>$this->input->post('civil_status',TRUE),
            'religion'=>$this->input->post('religion',TRUE),
        ];

        $this->db->where('resident_id', $resident_id);
        $update = $this->db->update('resident', $resident_data);

        if ($update) {
            redirect(base_url('index.php/dashboard/view-resident'));
        }
    }

}
}***/

public function call_validate_image_upload()
{
    if (!empty($_FILES['image']['name'])) {
        return true;
    } else {
        $this->form_validation->set_message('validate_image_upload', 'Please select an image to upload.');
        return false;
    }
}


public function updaterbi($id) {
    if (!isset($_SESSION['user'])) {
        $this->session->set_flashdata('msg_login', 'You are not logged in. Please Login First');
        redirect(base_url('index.php/admin'));
    }

   
    
    $this->form_validation->set_rules('firstname','First Name','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('middlename','Middle Name','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('lastname','Last Name','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('extname','Extension name');
    $this->form_validation->set_rules('purok','Purok','trim|required');
    $this->form_validation->set_rules('streetname','Street Name','trim|required|min_length[2]|max_length[50]');
    
    $this->form_validation->set_rules('sex','Sex','trim|required');
    $this->form_validation->set_rules('birth_date','Birth Date','trim|required');
    $this->form_validation->set_rules('birth_place','Birth Place','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('nationality','Nationality','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('civil_status','Civil Status','trim|required|min_length[2]|max_length[50]');
  
    $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('occupation','Occupation','trim|required|min_length[2]|max_length[50]');
  

    if ($this->form_validation->run() == FALSE) {
        // Load the resident data based on the resident_id
        $rbi_data = $this->db->get_where('rbi', array('id' => $id))->row();

        $data = [
            'rbi_data' => $rbi_data
        ];
        

        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/updaterbi', $data);
        $this->load->view('backend/include/footer');
    } else {

        $rbi_data = [
         
            'first_name'=>$this->input->post('firstname',TRUE),
            'middle_name'=>$this->input->post('middlename',TRUE),
            'last_name'=>$this->input->post('lastname',TRUE),
            'extname'=>$this->input->post('extname',TRUE),
            'purok'=>$this->input->post('purok',TRUE),
            'streetname'=>$this->input->post('streetname',TRUE),
            
            'sex'=>$this->input->post('sex',TRUE),
            'birth_date'=>$this->input->post('birth_date',TRUE),
            'birth_place'=>$this->input->post('birth_place',TRUE),
            'nationality'=>$this->input->post('nationality',TRUE),
            'civil_status'=>$this->input->post('civil_status',TRUE),
           
            'contact'=>$this->input->post('contact',TRUE),
            'occupation'=>$this->input->post('occupation',TRUE),
           
        ];

        $insert = $this->db->insert('rbi', $rbi_data);

        $insert_id = $this->db->insert_id();

        if( is_int($insert_id) ){
            redirect(base_url('index.php/dashboard/view-rbi'));
        }


    }
}




  

/* public function adminuser()
    {
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('confirmpass', 'Confirm Password', 'trim|required|min_length[2]|max_length[50]');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('backend/pages/adminuser');
        } else {
            $admin_data = [
                'firstname' => $this->input->post('firstname', TRUE),
                'lastname' => $this->input->post('lastname', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => $this->input->post('password', TRUE),
                'confirmpass' => $this->input->post('confirmpass', TRUE),
            ];
    
            // JavaScript code for the confirmation dialog
            $jsCode = "
                <script>
                var confirmInsertion = confirm('Do you want to proceed with data insertion?');
                if (confirmInsertion) {
                    // Perform the insertion logic here
                    // ...
                    console.log('Data inserted successfully!');
                } else {
                    console.log('Data insertion canceled!');
                    // Perform cancellation logic or do nothing
                }
                </script>
            ";
    
            $insert = $this->db->insert('admintable', $admin_data);
    
            if ($insert) {
                echo $jsCode; // Output the JavaScript code for the confirmation dialog
                $this->load->view('backend/pages/adminuser');

            }
        }
    }*/

    public function adminuser()
	{

			if (isset($_POST['adminbtn']))
		{
		  $data['firstname']=$this->input->post('firstname');
			$data['lastname']=$this->input->post('lastname');
			$data['email']=$this->input->post('email');
			$data['password']=$this->input->post('password');
			$data['confirmpass']=$this->input->post('confirmpass');
			$response=$this->Users_model->insertdata($data);
            
            
			if($response==true){
			        echo "Records Saved Successfully";
			}
			else{
					echo "Insert error !";
			}
		}

		$this->load->view('backend/pages/adminuser');
		
	}

  /*  public function adminuser()
    {
        if (isset($_POST['adminbtn'])) {
            $data['firstname'] = $this->input->post('firstname');
            $data['lastname'] = $this->input->post('lastname');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['confirmpass'] = $this->input->post('confirmpass');
    
            echo "<script>
                    if (confirm('Are you sure you want to insert the data?')) {
                        // Redirect to the insert route
                        window.location.href = '" . site_url('Admin_Controller/insert_data') . "';
                    } else {
                        alert('Insert canceled!');
                    }
                  </script>";
        }
    
        $this->load->view('backend/pages/adminuser');
    }
    
    public function insert_data()
    {
        $data['firstname'] = $this->input->post('firstname');
        $data['lastname'] = $this->input->post('lastname');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $data['confirmpass'] = $this->input->post('confirmpass');
    
        $response = $this->Users_model->insertdata($data);
    
        if ($response === true) {
            echo "<script>alert('Records Saved Successfully');</script>";
        } else {
            echo "<script>alert('Insert error!');</script>";
        }
    
        // Redirect back to the adminuser page
        echo "<script>window.location.href = '" . site_url('index.php/admin-user') . "';</script>";
    }*/

  /*  public function adminuser()
    {
        echo "<script>
                    if (confirm('Are you sure you want to insert the data?')) {
                        // Redirect to the insert route
                        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[2]|max_length[50]');
                        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[2]|max_length[50]');
                        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|min_length[2]|max_length[50]');
                        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[2]|max_length[50]');
                        $this->form_validation->set_rules('confirmpass', 'Confirm Password', 'trim|required|min_length[2]|max_length[50]');

                        $admin_data = [
                            'firstname' => $this->input->post('firstname', TRUE),
                            'lastname' => $this->input->post('lastname', TRUE),
                            'email' => $this->input->post('email', TRUE),
                            'password' => $this->input->post('password', TRUE),
                            'confirmpass' => $this->input->post('confirmpass', TRUE),
                            $insert = $this->db->insert('admintable', $admin_data);
                    } else {
                        alert('Insert canceled!');
                    }
                  </script>";

    
        $this->load->view('backend/pages/adminuser');
    }
    
    public function insert_data()
    {
        $data['firstname'] = $this->input->post('firstname');
        $data['lastname'] = $this->input->post('lastname');
        $data['email'] = $this->input->post('email');
        $data['password'] = $this->input->post('password');
        $data['confirmpass'] = $this->input->post('confirmpass');
    
        $response = $this->Users_model->insertdata($data);
    
        if ($response === true) {
            echo "<script>alert('Records Saved Successfully');</script>";
        } else {
            echo "<script>alert('Insert error!');</script>";
        }
    
        // Redirect back to the adminuser page
        echo "<script>window.location.href = '" . site_url('index.php/admin-user') . "';</script>";
    }*/
    
    public function addofficials(){
         
        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }


        $this->form_validation->set_rules('position','Position','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('address','Address','trim|required');
        $this->form_validation->set_rules('start_term','start term','trim|required');
        $this->form_validation->set_rules('end_term','end term','trim|required');
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');

        if($this->form_validation->run()==FALSE){

            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/addofficials');
            $this->load->view('backend/include/footer');

        }else{

            $officials_data = [
                'position'=>$this->input->post('position',TRUE),
                'name'=>$this->input->post('name',TRUE),
                'contact'=>$this->input->post('contact',TRUE),
                'address'=>$this->input->post('address',TRUE),
                'start_term'=>$this->input->post('start_term',TRUE),
                'end_term'=>$this->input->post('end_term',TRUE),
                
            ];


            $insert = $this->db->insert('addofficials', $officials_data);

            $insert_id = $this->db->insert_id();

            if( is_int($insert_id) ){
                redirect(base_url('index.php/dashboard/view-officials'));
            }


        }
    }

    public function viewofficials(){

        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }


        $officials_list = $this->db->get('addofficials')->result();

        $data = ['officials_list'=>$officials_list];

        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/viewofficials',$data);
        $this->load->view('backend/include/footer');
    }

    public function viewrbi(){

        if(!isset($_SESSION['user'])){
            $this->session->set_flashdata('msg_login','You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }


        $rbi_list = $this->db->get('rbi')->result();

        $data = ['rbi_list'=>$rbi_list];

        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/rbi',$data);
        $this->load->view('backend/include/footer');
    }

    public function updateofficials($id) {
        if (!isset($_SESSION['user'])) {
            $this->session
            >set_flashdata('msg_login', 'You are not logged in. Please Login First');
            redirect(base_url('index.php/admin'));
        }
    
        $this->form_validation->set_rules('position','Position','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('name','Name','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('contact','Contact','trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('address','Address','trim|required');
        $this->form_validation->set_rules('start_term','start term','trim|required');
        $this->form_validation->set_rules('end_term','end term','trim|required');
        $this->form_validation->set_error_delimiters('<p style="color:red;">','<p>');
    
        if ($this->form_validation->run() == FALSE) {
            // Load the resident data based on the resident_id
            $officials_data = $this->db->get_where('addofficials', array('id' => $id))->row();
    
            $data = [
                'officials_data' => $officials_data
            ];
            
    
            $this->load->view('backend/include/header');
            $this->load->view('backend/include/nav');
            $this->load->view('backend/pages/updateofficials', $data);
            $this->load->view('backend/include/footer');
        } else {
            // Update the resident data
            $officials_data = [
                'position'=>$this->input->post('position',TRUE),
                'name'=>$this->input->post('name',TRUE),

                'contact'=>$this->input->post('contact',TRUE),
                'address'=>$this->input->post('address',TRUE),
                'start_term'=>$this->input->post('start_term',TRUE),
                'end_term'=>$this->input->post('end_term',TRUE),
        
            ];
            $this->db->where('id', $id);
            $update = $this->db->update('addofficials', $officials_data);
    
            if ($update) {
                redirect(base_url('index.php/dashboard/view-officials'));
            }
        }

    }

    public function deleteofficials($id){
        $this->db->db_debug = TRUE;
        $this->db->where('id', $id);
        $this->db->delete('addofficials');
        redirect(base_url('index.php/dashboard/view-officials'));
    }

    public function deleterbi($id){
        $this->db->db_debug = TRUE;
        $this->db->where('id', $id);
        $this->db->delete('rbi');
        redirect(base_url('index.php/dashboard/view-rbi'));
    }

    /* AJAX  */
    public function ajax_update_official_form(){

        $official_id = $this->input->post('official_id',true);

        $officials_data  =  $this->db->where('id',$official_id)->get('addofficials')->row();
        
        $data = ['officials_data'=>$officials_data];

        $this->load->view('backend/pages/popup/edit-official',$data);
    }

    /* AJAX  */
    public function ajax_update_resident_form(){

        $resident_id = $this->input->post('resident_id',true);

        $resident_data  =  $this->db->where('resident_id',$resident_id)->get('resident')->row();
        
        $data = ['resident_data'=>$resident_data];

        $this->load->view('backend/pages/popup/edit-resident',$data);
    }

    public function barangayinfo(){

        
        $this->load->view('backend/include/header');
        $this->load->view('backend/include/nav');
        $this->load->view('backend/pages/barangayinfo');
        $this->load->view('backend/include/footer');

    }

    public function test(){


        $test_data = "<html><head><title> Test </title></head> <body>  <h1> Hello </h1> </body> </html>";

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($test_data);
       
        //download 
        //$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::DOWNLOAD);
       
       
        //preview in browser
        $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);
       
        //save
        //$mpdf->Output('filename.pdf', \Mpdf\Output\Destination::FILE);
    }
    
}
    