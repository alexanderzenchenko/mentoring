<?php

namespace Services\HtmlReader;

interface HtmlReaderInterface
{
    public function read(string $html): string;
}
