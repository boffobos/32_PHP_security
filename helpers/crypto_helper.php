<?php
    function getToken(){
        return hash('sha256', random_int(0, 100000));
    }