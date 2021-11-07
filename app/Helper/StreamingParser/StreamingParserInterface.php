<?php
namespace App\Helper\StreamingParser;

interface StreamingParserInterface{
    public function close(): void;
    public function get(): \Generator;
}
