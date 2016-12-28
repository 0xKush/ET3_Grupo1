<?php

define('MB', 1048576);
require_once(__DIR__ . "/../core/ValidationException.php");


class Upload
{
    private $allowedExts = array();
    private $allowedMimeTypes = array();
    private $maxSize;
    private $destination;
    
    public function __construct()
    {
        $this->allowedExts      = array(
            "pdf",
            "doc",
            "docx",
            "odt",
            "PNG",
            "JPG",
            "jpg",
            "gif"
        );
        $this->allowedMimeTypes = array(
            "application/pdf",
            "application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/vnd.oasis.opendocument.text",
            "image/jpeg",
            "image/png",
            "image/gif"
        );
        $this->maxSize          = 7 * MB;
        $this->destination      = null;
        /*-- 10* 1024 * 1024 -- */
    }
    
    public function checkFile()
    {
        $errors   = array();
        $size     = $_FILES["file"]["size"];
        $name     = $_FILES["file"]["name"];
        $mime     = $_FILES["file"]["type"];
        $tmp_name = $_FILES["file"]["tmp_name"];
        
        if ($this->checkUploadSize($size) && $this->checkExt($name) && $this->checkMime($mime) && $this->moveUploadedFile($tmp_name, $name)) {
            return true;
        } else {
            /* throw new ValidationException($errors, "ERROR:");*/
            throw new Exception("ERROR:");
        }
        
    }
    
    private function moveUploadedFile($tmp_name, $name)
    {
        $destination = $this->Destination($name);
        $this->setDestination($destination);
        
        if (!move_uploaded_file($tmp_name, $this->getDestination() . $name)) {
            return false;
        } else {
            return true;
        }
        
    }
    
    private function Destination($name)
    {
        $extension = end(explode(".", $name));
        $array_doc = array(
            "pdf",
            "doc",
            "docx",
            "odt"
        );
        $array_img = array(
            "PNG",
            "JPG",
            "jpg",
            "gif"
        );
        
        if (in_array($extension, $array_doc)) {
            $destination = __DIR__ . "/../Uploads/documents/";
        }
        if (in_array($extension, $array_img)) {
            $destination = __DIR__ . "/../Uploads/images/";
        }
        return $destination;
    }
    
    private function checkUploadSize($size)
    {
        $errors = array();
        if ($size > $this->getMaxSize()) {
            /* throw new ValidationException($errors, "Please provide a smaller file");*/
            throw new Exception("Please provide a smaller file:");
        } else {
            return true;
        }
    }
    
    private function checkExt($name)
    {
        $errors    = array();
        $extension = end(explode(".", $name));
        if (!(in_array($extension, $this->getAllowedExts()))) {
            /* throw new ValidationException($errors, "Please provide another file type: Ext not valid");*/
            throw new Exception("Please provide another file type: Ext not valid:");
        } else {
            return true;
        }
    }
    
    private function checkMime($mime)
    {
        $errors = array();
        if (!(in_array($mime, $this->getAllowedMimeTypes()))) {
            /*  throw new ValidationException($errors, "Please provide another file type: Mime not valid");*/
            throw new Exception("Please provide another file type: Mime not valid");
        } else {
            return true;
        }
    }
    
    
    private function getAllowedExts()
    {
        return $this->allowedExts;
    }
    
    
    
    private function getAllowedMimeTypes()
    {
        return $this->allowedMimeTypes;
    }
    
    
    
    private function getMaxSize()
    {
        return $this->maxSize;
    }
    
    private function setDestination($destination)
    {
        $this->destination = $destination;
        
        return $this;
    }
    
    public function getDestination()
    {
        return $this->destination;
    }
}
?>
<!-- PRUEBAS -->
<form action="Upload.php" method="post" enctype="multipart/form-data">
    <div class="col-xs-3">
        <label for="archivo">Tipo documento</label>
        <input type="file" name="file">
        <button type="submit" name="submit">Enviar</button>
    </div>
</form>

<?php
$upload = new Upload();
if (isset($_POST["submit"])) {
    try {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime  = finfo_file($finfo, $_FILES['file']['tmp_name']);
        echo "<h3>MIME:$mime</h3>";
        $extension = end(explode(".", $_FILES["file"]["name"]));
        echo "<h3>EXTENSION:$extension</h3>";
        $size = $_FILES['file']['size'];
        echo "<h3>SIZE:" . round($size / MB, 3) . " MB</h3>";
        
        
        if ($upload->checkFile()) {
            echo "Document successfully added in :" . $upload->getDestination();
        }
        
    }
    catch (Exception $ex) {
        $errors = $ex->getMessage();
        print_r($errors);
    }
    
}
?>
<!-- PRUEBAS -->
