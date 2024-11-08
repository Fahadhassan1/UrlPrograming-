<?php
namespace Threecolts\Phptest;

// require 'src/Hello.php';
require 'src/UrlCounter.php';

// echo (new Hello())?->run();

echo (new UrlCounter())?->countUniqueUrls(["https://example.com", "http://example.com"]);
 print_r((new UrlCounter())?->countUniqueUrlsPerTopLevelDomain(["https://subdomain.example.com", "https://example.com"]));