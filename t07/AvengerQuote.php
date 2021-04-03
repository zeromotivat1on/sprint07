<?php

    class AvengerQuote {

        private $comments = [];

        public function __construct($id, $author, $quote, $photo) {

            $this->id = $id;
            $this->author = $author;
            $this->quote = $quote;
            $this->photo = $photo;
            $this->date = date('Y-m-d');

        }

        public function addComment() {

            array_push($this->comments, new Comment($text));

        }

        public function setComments($comments) {

            $this->comments = $comments;

        }

        public function getId() { return $this->id; }
        public function getAuthor() { return $this->author; }
        public function getQuote() { return $this->quote; }
        public function getPhoto() { return $this->photo; }
        public function getDate() { return $this->date; }
        public function getComments() { return $this->comments; }

    }

?>