<?php 

function get_mysqli() {
    return new mysqli("db", "root", "root", "store"); 
}

?>