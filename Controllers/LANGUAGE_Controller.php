<?php

require_once(__DIR__."/../core/I18n.php");

class Language_Controller {
    const LANGUAGE_SETTING = "__language__";

    public function change() {
        if(!isset($_GET["lang"])) {
            throw new Exception(i18n("No lang parameter was provided"));
        }
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        I18n::getInstance()->setLanguage($_GET["lang"]);

        header("Location: ".$_SERVER["HTTP_REFERER"]);
        die();
    }
}
