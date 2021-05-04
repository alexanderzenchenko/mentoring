<?php
require_once 'vendor\autoload.php';

use Controllers\IndexContorller;
use Services\TextAnalyzer\TextAnalyzerFactory;

$indexController = new IndexContorller();
$content = $indexController->indexAction();

require_once './Templates/layout.php';

?>
