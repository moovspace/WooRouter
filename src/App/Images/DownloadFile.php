<?php
namespace Woo\App\Images;
use \Exception;

class DownloadFile
{
    protected $File = '';
    protected $Speed = 0;
    protected $Mb = 1024 * 1024;
    protected $AllowedExtensions = array();

    function __construct($speed = 1){
        $this->MaxSpeed($speed);
    }

    function Download($path){
        // Add file
        $this->AddFile($path);
        // Test extension
        $this->IsValidExtension($path);
        // Clean
        @ob_end_clean();
        // Errors
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
        // Compress
        if(ini_get('zlib.output_compression')){
            ini_set('zlib.output_compression', 'Off');
        }
        // Headers
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"". basename($this->File) ."\"");
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($this->File));
        // Download
        set_time_limit(0);
        $fh = fopen($this->File, 'rb');
        while (!feof($fh)) {
            echo fread($fh, $this->Speed);
            ob_flush();
            // Download speed
            sleep(1);
        }
        exit;
    }

    function IsValidExtension($path){
        if(!empty($this->AllowedExtensions)){
            if(!in_array(pathinfo($path, PATHINFO_EXTENSION), $this->AllowedExtensions)){
                throw new Exception("Error: Incorrect file extension", 9003);
            }
        }
    }

    function AddExtension($ext){
        if(!empty($ext)){
            $this->AllowedExtensions[] = $ext;
        }else{
            throw new Exception("Error: Add not empty extension", 9002);
        }
    }

    protected function MaxSpeed($mb = 1){
        $this->Speed = (int) $mb * $this->Mb;
        if($this->Speed < 0){
            $this->Speed = $this->Mb;
        }
    }

    protected function AddFile($path){
        if(file_exists($path)){
            $this->File = $path;
        }else{
            throw new Exception("Error: Set file path!", 9001);
        }
    }
}

/*
try{
    // Set download speed
    $d = new DownloadFile(1);

    // Allow only with extensions
    // $d->AddExtension('jpg');
    // $d->AddExtension('png');
    // $d->AddExtension('route');

    // Download from browser
    $d->Download("route/user-route.route");

}catch(Exception $e){
    echo $e->getMessage() .' '. $e->getCode();
    exit;
}
*/
?>
