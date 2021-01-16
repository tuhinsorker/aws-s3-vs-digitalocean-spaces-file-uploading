<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @System  : S3 and Space setup controller
 * @author  : BDTASK <bdtask@gmail.com>
 * @link    : http://www.bdtask.com
 */
class s3_space_setup extends MX_Controller {

    public function __construct() {

        parent::__construct();
        if (! $this->session->userdata('isLogIn'))
            redirect('login');
        $this->load->model('setup_model');

    }

       
    public function index() {

        $data['s3Info'] = $this->setup_model->getSetup(1);
        $data['spaceInfo'] = $this->setup_model->getSetup(2);

        $data['title'] = display('s3_and_spaces');
        $data['module'] = "s3_and_spaces"; 
        $data['page']   = "setup/__setup"; 
        echo Modules::run('template/layout', $data);   

    }

    public function getUrl($bucket_name,$type,$region){
        $https = false;
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
           $protocol = 'https://';
        }
        else {
          $protocol = 'http://';
        }

        if($type==2){
            $name = 'digitaloceanspaces.com/';
        }

        if($type==1){
            $name = 'amazonaws.com/';
        }

        return $protocol.$bucket_name.'.'.$region.'.'.$name;
    }



    public function save_setup(){

        $this->form_validation->set_rules('access_key', 'access_key','required');
        $this->form_validation->set_rules('secret_key', 'secret_key','required');
        $this->form_validation->set_rules('bucket_name', 'bucket or space name','required');
        $this->form_validation->set_rules('type', 'type','required');
        $this->form_validation->set_rules('region', 'region','required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('exception', validation_errors()); 
        } else {

            $url = $this->getUrl($this->input->post('bucket_name',TRUE),$this->input->post('type',TRUE),$this->input->post('region',TRUE));
            $status = ($this->input->post('status',TRUE)?1:0);

            $data = array(
                'access_key'            => $this->input->post('access_key',TRUE),
                'secret_key'            => $this->input->post('secret_key',TRUE),
                'bucket_name'           => $this->input->post('bucket_name',TRUE),
                'type'                  => $this->input->post('type',TRUE),
                'url'                   =>  $url,
                'region'                => $this->input->post('region',TRUE),
                'active_status'         => $status
            );


            if($this->setup_model->save_setup($data)){
                $this->session->set_flashdata('message', display('update_message')); 
            }else{
                $this->session->set_flashdata('message', display('internal_error_message')); 
            }

        }
        redirect('s3_and_spaces/s3_space_setup');

    }





}
