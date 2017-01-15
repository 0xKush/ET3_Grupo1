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
    
    public function __construct($var = "file")
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
        $this->var              = $var;
    }
    
    public function checkFile()
    {
        $errors   = array();
        $size     = $_FILES["$this->var"]["size"];
        $name     = $_FILES["$this->var"]["name"];
        $mime     = $_FILES["$this->var"]["type"];
        $tmp_name = $_FILES["$this->var"]["tmp_name"];
        
        if (!$this->checkExt($name)) {
            throw new ValidationException($errors, "Ext not valid");
        }
        
        if (!$this->checkMime($mime)) {
            throw new ValidationException($errors, "Mime not valid");
        }
        
        if ($this->checkUploadSize($size)) {
            throw new ValidationException($errors, "Provide a smaller file");
        }
        if ($this->moveUploadedFile($tmp_name, $name)) {
            return true;
        }
        
    }
    
    public function moveUploadedFile($tmp_name, $name)
    {
        $destination = $this->Destination($name);
        $this->setDestination($destination, $name);
        
        if (!move_uploaded_file($tmp_name, $this->getDestination())) {
            return false;
        } else {
            return true;
        }
        
    }
    
    public function Destination($name)
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
            $destination = "media/documents/";
            /*$destination = __DIR__ . "/../media/documents";*/
        }
        if (in_array($extension, $array_img)) {
            $destination = "media/images/";
            /*$destination = __DIR__ . "/../media/images";*/
        }
        return $destination;
    }
    
    public function checkUploadSize($size)
    {
        $errors = array();
        if ($this->getMaxSize() < $size) {
            return true;
        } else {
            return false;
        }
    }
    
    public function checkExt($name)
    {
        $errors    = array();
        $extension = end(explode(".", $name));
        if (!(in_array($extension, $this->getAllowedExts()))) {
            return false;
        } else {
            return true;
        }
    }
    
    public function checkMime($mime)
    {
        $errors = array();
        if (!(in_array($mime, $this->getAllowedMimeTypes()))) {
            return false;
        } else {
            return true;
        }
    }
    
    
    public function getAllowedExts()
    {
        return $this->allowedExts;
    }
    
    
    
    public function getAllowedMimeTypes()
    {
        return $this->allowedMimeTypes;
    }
    
    
    
    public function getMaxSize()
    {
        return $this->maxSize;
    }
    
    public function setDestination($destination, $name)
    {
        $this->destination = $destination . $name;
        
        return $this;
    }
    
    public function setAllowedExt($array)
    {
        $this->allowedExts = $array;
        
        return $this;
    }
    
    public function getDestination()
    {
        return $this->destination;
    }
}