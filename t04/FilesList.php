<?php

    class FilesList {

        function __construct($path) {

            $this->files = [];
            if(file_exists($path)) {

                $this->files = array_diff(scandir($path), array('.', '..'));

            }

        }

        function toList() {

            $res = '<ul>';
            foreach($this->files as $v) {

                $res .= '<li><a href="?file='.$v. '">'.$v.'</a></li>';

            }
            $res .= '</ul>';
            
            return $res;

        }

    } 
?>