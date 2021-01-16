<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MX_Controller
{

    public $CI;
    public $spaceobj;
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = display('upload');
        $data['module'] = "s3_and_spaces"; 
        $data['page']   = "setup/__upload"; 
        echo Modules::run('template/layout', $data);   
    }



    public function addImages()
    {      

        $thime_y = $this->input->post('thime_y',TRUE);
        $thime_x = $this->input->post('thime_x',TRUE);
        $img_y = $this->input->post('img_y',TRUE);
        $img_x = $this->input->post('img_x',TRUE);
        $sizes = array($thime_x => $thime_y, $img_x => $img_y);
        $max_file_size = 1*1024 * 1024; // 1MB
        $valid_exts = array('jpeg', 'jpg', 'png', 'gif','webp');


        if ($_FILES['files']['size'] <= $max_file_size) {

            $FILES = $_FILES['files'];
            $ext = strtolower(pathinfo($FILES['name'], PATHINFO_EXTENSION));
            
            if (in_array($ext, $valid_exts)) {

                $file_location = $this->do_upload($_FILES['files'], $sizes);
                print_r($file_location);exit;

            }else{
                echo $msg = 'Unsupported file';
            }
            
        }else{
            echo $msg = 'Please upload image smaller than 1MB';
        }
    }



  
    #--------------------------------
    #       function org_upload;
    #--------------------------------
    function do_upload($FILES, $sizes) {
        $diractory = array('uploads/thumb', 'uploads');
        $k = 0;
        foreach ($sizes as $w => $h) {
            $files[] = $this->resize($w, $h, $FILES, $diractory[$k]);
            $k++;
        }
        return $files;
    }

   

    #------------------------------------------------- 
    # end function pb_delete_temp;
    function resize($width, $height, $FILES, $diractory) {

        // Load Space Library
        $this->load->library('Space');
        $this->spaceobj = new Space();

        //load for s3
        $this->load->library('s3');

        // Get info
        $spaceInfo = $this->db->where('active_status',1)->get('space_setup_tbl')->row();


        $this->load->library('image_lib');
        #------------resize image------------#
        $this->load->library('image_lib');
        $config['image_library']    = 'gd2';
        $config['source_image']     = $FILES['tmp_name'];
        $config['create_thumb']     = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['quality']            = 100;
        $config['width']            = $width;
        $config['height']           = $height;

        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        #-------------resize image----------#

        $ext = explode(".", $FILES['name']);
        $filename = str_replace(' ', '-', $ext[0]);
        $file_path = $FILES["tmp_name"];
        $mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file_path);
        $path = $diractory . '/' . $filename . '.' . end($ext);

        $saved = $this->spaceobj->upload_to_space($FILES['tmp_name'], $path);
        // upload file in aws s3
        $saved = $this->s3->putObjectFile($file_path,$spaceInfo->bucket_name,$path,S3::ACL_PUBLIC_READ,array(),$mime_type);
        // upload file in

    }






}