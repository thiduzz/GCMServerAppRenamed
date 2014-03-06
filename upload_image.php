<?php
var_dump($_POST);
var_dump($_FILES);

    function log_debug($message) {
            $path = 'log/debug.log';
            $time = \date("y-m-d H:i:s");
            $message = \str_replace("\n", "<br/>", $message);
            $line = "<div class=\"debug\" title=\"debug\"><b>{$time}&nbsp;</b>{$message}</div>\n";
            try {
                $handle = \fopen($path, "a");
                \fwrite($handle, $line);
                \fclose($handle);
            } catch (Exception $e) {
                
            }
        
    }

    function get_var_dump($property) {
        \ob_start();
        echo '<pre>';
        \var_dump($property);
        echo '</pre>';
        $fluffy_html = \ob_get_contents();
        \ob_end_clean();
        return $fluffy_html;
    }

$target_path  = "./img/";
$target_path = $target_path . basename( $_FILES['userfile']['name']);
log_debug(get_var_dump($_FILES['userfile']['error']));
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) {
 echo "The file ".  basename( $_FILES['userfile']['name']).
 " has been uploaded";
} else{
 echo "There was an error uploading the file, please try again!";
}




