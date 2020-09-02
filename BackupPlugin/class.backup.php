<?php

    /*
    *  Copyright (c) Codiad & daeks & Coulee Techlink, distributed
    *  as-is and without warranty under the MIT License. See 
    *  [root]/license.txt for more. This information must remain intact.
    */
    
require_once('../../common.php');

class Backup extends Common {
  
    //////////////////////////////////////////////////////////////////
    // PROPERTIES
    //////////////////////////////////////////////////////////////////
    public $path         = '';
    public $root         = '';
    public $command_exec = '';
    public $nohup_log = 'nohup.log';
    //////////////////////////////////////////////////////////////////
    // METHODS
    //////////////////////////////////////////////////////////////////

    // -----------------------------||----------------------------- //

    //////////////////////////////////////////////////////////////////
    // Construct
    //////////////////////////////////////////////////////////////////

    public function __construct(){
    }
    
    //////////////////////////////////////////////////////////////////
    //  Repo
    //////////////////////////////////////////////////////////////////
    
    public function commit(){
        
        if($this->path){
            if($this->isAbsPath($this->path)) {
                 $this->command_exec = "(/usr/bin/zip -r ". $this->path ." ".$this->root.") 3>&1 1>&2 2>&3" ;
                      
             } else {
                    die(formatJSEND("success",array("message"=>"Can not create the backup,use absolute path")));
              }
         } 
            
         $salida = $this->ExecuteCMD(false);                                                                                                         
         echo formatJSEND("success",array("message"=>"Backup has been created"));     
        
    }
    
    //////////////////////////////////////////////////////////////////
    // Execute Command
    //////////////////////////////////////////////////////////////////
    
    /*
    * No Hup allows for background exicution of code and is default in most linux distro's
    * I was running into issue's of my svn checkout's taking longer then the code was allowed to exicute
    * So I added this, You can simply dissable this by setting ExecuteCMD( $run_nohup=true) to ExecuteCMD( $run_nohup=false)
    */
    public function nohup_command(){
        
        file_put_contents('/home/backup/codiadAM/nohup_script.sh', $this->command_exec . "\nrm -f /home/backup/codiadAM/nohup_script.sh");
        $this->cmd_orig =  $this->command_exec;
        $this->command_exec = "chmod +x /home/backup/codidadAM/nohup_script.sh";
        $this->ExecuteCMD(false);
        $this->command_exec = "nohup /home/backup/codiadAM/nohup_script.sh > /home/backup/codiadAM/nohup.log &";
        $this->ExecuteCMD(false);
        
    }
    public function ExecuteCMD( $run_nohup=true){

        $salida = "";  
        if( $run_nohup ){
            $this->nohup_command();
        }
        if(function_exists('system')){
            ob_start();
            $retVal = ""; 
            $salida = system($this->command_exec,$retVal);
             error_log("System ".$retVal,0);
            ob_end_clean();
        }
        //passthru
        else if(function_exists('passthru')){
            ob_start();
            $salida = passthru($this->command_exec);
              error_log("passthru ".$salida,0);
            ob_end_clean();
        }
        //exec
        else if(function_exists('exec')){
            $salida =exec($this->command_exec , $this->output);
             error_log("exec ".$salida,0);
        }
        //shell_exec
        else if(function_exists('shell_exec')){
            $salida = shell_exec($this->command_exec);
             error_log("shell_exec ".$salida,0);
        }
        error_log($this->command_exec,0); 
        error_log("Salida vale ".$salida,0); 
    }
   
}

?>
