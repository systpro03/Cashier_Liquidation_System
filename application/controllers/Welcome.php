<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
public function __construct() {
parent::__construct();
}
public function index()
{
	$this->load->view('welcome_message', array('error' => ' ' ));
}
public function do_upload()
{
$config = array(
'upload_path' => "./upload/", 
'allowed_types' => "txt",
'overwrite' => TRUE,
'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
'max_height' => "768",
'max_width' => "1024"
);
$this->load->library('upload', $config);
if($this->upload->do_upload())
{
$data = array('upload_data' => $this->upload->data());
foreach ($data as $key => $value) {
	var_dump($value['file_name']);
}


 	$sample = array();
 	$filess = array();

 // if ($file = fopen("upload/sample.txt", "r")) 
 // {
 //    while(!feof($file)) 
 //    {
 //        $line = fgets($file);
 //        $sample[] = $line;
 //    }

 //    foreach ($sample as $key => $value) 
 //    {
 //    	$filess[] = preg_split('/\s+/',$sample[$key]);
 //    }

	// $result = array();
	// foreach ($filess as $key => $value) 
	// {
	// 	if($value[0] == '' || $value[0] == 'empid')
	// 	{

	// 	}
	// 	else
	// 	{
	// 		$result[] = array('emp_id' => $value[0], 'trm' => $value[1], 'date' => $value[2], 'amt' => $value[3]);
	// 	}
	// }

 //    fclose($file);
   	

 //   	foreach ($result as $key => $value) 
 //   	{
 //   		if($value['emp_id'] != '' && $value['emp_id'] != 'empid')
 //   		{
   			
	//    		//  $den_exist = $this->main_model->den_exist_mod($value['emp_id'], $value['trm'], $value['date']);

	//    		// if(sizeof($den_exist) != 0)
	//    		// {
	//    		//  	 var_dump('1');
	//    		// }
	//    		// else
	//    		// {
	//    		// 	 var_dump('2');
	//    		// }   
 //   		}		
 //   	}

 //   	// var_dump('asdasdasd'.FCPATH .'uploads'.DIRECTORY_SEPARATOR.'stores');
 //   }
$this->load->view('upload_success',$data);
}
else
{
$error = array('error' => $this->upload->display_errors());
$this->load->view('welcome_message', $error);
}
}
}
?>