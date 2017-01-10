<?php

define('MB', 1048576);
require_once(__DIR__ . "/../core/ValidationException.php");


class Upload
{
    private $allowedExts = array();
    private $allowedMimeTypes = array();
    private $maxSize;
    private $destination;
    private $var;
    
    public function __construct($var="file")
    {
        $this->allowedExts = array(
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
        $this->maxSize = 7 * MB;
        $this->destination = null;
        /*-- 10* 1024 * 1024 -- */
        $this->var = $var;
    }
    
    public function checkFile()
    {
        $errors   = array();
        $size     = $_FILES["$this->var"]["size"];
        $name     = $_FILES["$this->var"]["name"];
        $mime     = $_FILES["$this->var"]["type"];
        $tmp_name = $_FILES["$this->var"]["tmp_name"];
        
        if (!$this->checkExt($name)) {
            /*die("Ext not valid");*/
            throw new ValidationException($errors, "Ext not valid");
        }
        if (!$this->checkMime($mime)) {
            /*die("Mime not valid");*/
            throw new ValidationException($errors, "Mime not valid");
        }
        if ($this->checkUploadSize($size)) {
            /*die("Provide a smaller file");*/
            throw new ValidationException($errors, "Provide a smaller file");
        }
        if ($this->moveUploadedFile($tmp_name, $name)) {
            return true;
        }
        
    }
    
    private function moveUploadedFile($tmp_name, $name)
    {
        $destination = $this->Destination($name);
        $this->setDestination($destination, $name);
        
        if (!move_uploaded_file($tmp_name, $this->getDestination())) {
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
            $destination = __DIR__ . "/../media/documents/";
        }
        if (in_array($extension, $array_img)) {
            $destination = __DIR__ . "/../media/images/";
        }
        return $destination;
    }
    
    private function checkUploadSize($size)
    {
        $errors = array();
        if ($this->getMaxSize() < $size) {
            return true;
        } else {
            return false;
        }
    }
    
    private function checkExt($name)
    {
        $errors    = array();
        $extension = end(explode(".", $name));
        if (!(in_array($extension, $this->getAllowedExts()))) {
            return false;
        } else {
            return true;
        }
    }
    
    private function checkMime($mime)
    {
        $errors = array();
        if (!(in_array($mime, $this->getAllowedMimeTypes()))) {
            return false;
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
    
    private function setDestination($destination, $name)
    {
        $this->destination = $destination . $name;
        
        return $this;
    }
    
    public function getDestination()
    {
        return $this->destination;
    }
}
?>
<!-- PRUEBAS -->
<!-- <form action="Upload.php" method="post" enctype="multipart/form-data">
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
    catch (ValidationException $ex) {
        /*   $errors = $ex->getMessage();
        echo $errors;*/
        $errors = $ex->getMessage();
        echo $errors;
    }
    
}
?>
 -->
