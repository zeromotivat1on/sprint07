<?php

class ListAvengerQuotes {

    protected $list = [];

    public function addAvengerQuote($avengerQuote) {

        array_push($this->list, $avengerQuote);

    }

    public function toXML($filename) {

        $file = fopen($filename, "w");
        $xml = new SimpleXMLElement('<document/>');

        foreach ($this->list as $quote) {

            $xml_quote = $xml->addChild("quote");
            $xml_quote->addChild("id", $quote->getId());
            $xml_quote->addChild("author", $quote->getAuthor());
            $xml_quote->addChild("quote", $quote->getQuote());
            $xml_photos = $xml_quote->addChild("photos");

            //if (is_array($quote->getPhoto()) || is_object($curr_photo)) {

                foreach($quote->getPhoto() as $curr_photo) {

                    $xml_photos->addChild("curr_photo", $curr_photo);

                }

            //}

            $xml_quote->addChild("date", $quote->getDate());
            $xml_comments = $xml_quote->addChild("comments");

            foreach((array)$quote->getComments() as $comment) {

                $xml_comment = $xml_comments->addChild("comment");

                foreach((array)$comment->date as $comment_date) {

                    $xml_comment->addChild("comment_date", $comment_date);

                }

                foreach((array)$comment->getComment() as $comment) {

                    $xml_comment->addChild("comment", $comment);

                }

            }

        }

        file_put_contents($filename, $xml->asXML());
        fclose($file);

    }

    public function fromXML($filename) {

        $file = fopen($filename, "r");
        $xml_obj = simplexml_load_file($filename);
        $list = new ListAvengerQuotes();

        foreach($xml_obj->children() as $quotes) {

            $id = $quotes->id->__toString();
            $author = $quotes->author->__toString();
            $quote = $quotes->quote->__toString();
            $photos = [];

            foreach ((array)$quotes->photos as $photo) {

                $photos = $photo;

            }

            $avengerQuote = new AvengerQuote( $id, $author, $quote, $photos );
            $comments = [];

            foreach ((array)$quotes->comments as $comment) {

                $comments = $comment;

            }

            $avengerQuote->setComments($comments);
            $list->addAvengerQuote($avengerQuote);
        }

        fclose($file);
        return $list;

    }

}

?>