<?php
    function writeMessage($data){
        if(file_exists(APPROOT . '\msg\messages.txt')){
            file_put_contents(APPROOT . '\msg\messages.txt', $data, FILE_APPEND | LOCK_EX);
            return true;
        } else {
            $log = [
                'message' => ' Couldn\'t open file ' . APPROOT . '\msg\messages.txt' . PHP_EOL,
            ];
            writeToLog($log);
            return false;
        }
    }

    function writeToLog($data){
        array_unshift($data, (new DateTime())->format('d-m-Y H:i:s'));
        file_put_contents(APPROOT . '\msg\log.txt', $data, FILE_APPEND | LOCK_EX);
    }