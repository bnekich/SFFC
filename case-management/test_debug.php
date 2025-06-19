<?php
// Test script for debugging
echo "Debug test script loaded\n";

$testVar = "Hello from debug test!";
$testArray = [1, 2, 3, 4, 5];

// Set a breakpoint on the next line
echo "About to loop through array\n";

foreach ($testArray as $item) {
    echo "Item: $item\n";
}

echo "Test completed\n";
