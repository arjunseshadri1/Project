
<?php

session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);

class Manage {

    public static function autoload($class) {

        include $class . '.php';
    }

}

spl_autoload_register(array('Manage', 'autoload'));

$obj = new main();

class main {

    public function __construct() {
        $pageRequest = 'homepage';

        if (isset($_REQUEST['page'])) {
            $pageRequest = $_REQUEST['page'];
        }

        $page = new $pageRequest;

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $page->get();
        } else {
            $page->post();
        }
    }

}

abstract class page {

    protected $html;

    public function __construct() {
        $this->html .= '<html>';
        $this->html .= '<link rel="stylesheet" href="layout.css">';
        $this->html .= '<body>';
    }

    public function __destruct() {
        $this->html .= '</body></html>';
        stringFunctions::printThis($this->html);
    }

    public function get() {
        echo 'default get message';
    }

    public function post() {
        print_r($_POST);
    }

}

class homepage extends page {

//create html upload form
    public function get() {
        $form = '<form method="post" enctype="multipart/form-data">';
        $form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
        $form .= '<input type="submit" value="Upload" name="submit">';
        $form .= '</form> ';
        $this->html .= '<h1>Upload Form</h1>';
        $this->html .= $form;
    }

//Upload file on Post request i.e on submit.
    public function post() {
        //get upload file name
        $name = $_FILES['fileToUpload']['name'];
        //get temp file name
        $temp_name = $_FILES['fileToUpload']['tmp_name'];
        if (isset($name)) {
            //set upload directory
            $location = 'upload/';
            //set upload location + file name
            $upload_file_path = $location . $name;
            $_SESSION['path'] = $upload_file_path;

            //move file to upload folder
            if (move_uploaded_file($temp_name, $upload_file_path)) {
                //redirect to table.php
                header("Location: table.php");
            }
        } else {
            echo 'You should select a file to upload !!';
        }
    }

}

class stringFunctions {

    static public function printThis($inputText) {
        return print($inputText);
    }

    static public function stringLength($text) {
        return strLen($text);
    }

}
?>




