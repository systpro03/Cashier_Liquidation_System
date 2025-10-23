<?php
if ( ! defined('BASEPATH') )
    exit( 'No direct script access allowed' );

class Nativesession
{
    public function __construct()
    {
       session_start();
       
    }
   
    public function get($key1)
    {       
        require $_SERVER["DOCUMENT_ROOT"] . '../hrms/config.php';  
        return array('username' => $_SESSION['username'], 
                     'emp_id'   => $_SESSION['emp_id']
                     );   

           // AKO-A
       /* return array('username' => 'jaylou', 
        'emp_id'   => '15797-2018'
        ); */

    }
}