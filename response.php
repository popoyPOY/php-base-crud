<?php


function NOT_FOUND($message="404 NOT FOUND"){
    http_response_code(404);
    echo $message;
}

?>