<?php

namespace Controllers;

use Services\TextAnalyzer\TextAnalyzerFactory;

class IndexContorller
{
    /**
     * @return mixed
     */
    public function indexAction()
    {
        $createdAt =  (new \DateTime('now'))->format('D, d M Y H:i:s');

        $text = '';

        if (array_key_exists('text', $_POST)) {
            $text = strip_tags($_POST['text']);
            $text = htmlspecialchars($text);
        }

        $analyzer = TextAnalyzerFactory::createTextAnalyzer($text);

        return require_once './Templates/statistic.php';
    }
}
