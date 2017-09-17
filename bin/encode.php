<?php

// $argv[1] = comma delimited product ids

$encoded = base64_encode(json_encode([
  'p '=> explode(',', $argv[1]),
  't' => time()
]));

echo "Encoded: $encoded";
echo PHP_EOL;
