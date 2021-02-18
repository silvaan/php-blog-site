<?php


/**
 * Class Format.
 */
class Format
{
    public function dateFormat($date)
    {
        return date('F, j, Y, g:i a', strtotime($date));
    }

    public function shortText($text, $limit = 300)
    {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, " "));
        return $text;
    }

    public function validation($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
