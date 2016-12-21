<?php
define("DEFAULT_CONTROLLER", "user");
define("DEFAULT_ACTION", "login");

function run() {
    try{
        if (!isset($_GET["controller"])) {
            $_GET["controller"] = DEFAULT_CONTROLLER; 
        }
    
        if (!isset($_GET["action"])) {
            $_GET["action"] = DEFAULT_ACTION;
        }
    
        $controller = loadController($_GET["controller"]);
    
        $actionName = $_GET["action"];
        $controller->$actionName();
    } catch (Exception $ex) {
        die($ex->getMessage());
    }
}
 
function loadController($controllerName) {  
    $controllerClassName = getControllerClassName($controllerName);
  
    require_once(__DIR__."/Controllers/".$controllerClassName.".php");  
    return new $controllerClassName();
}
 
function getControllerClassName($controllerName) {
    return strToUpper($controllerName)."_Controller";
}

run();

?>