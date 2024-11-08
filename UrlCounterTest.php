<?php


use Threecolts\Phptest\UrlCounter;
use PHPUnit\Framework\TestCase;


class UrlCounterTest extends TestCase
{
    /** @test */
    public function TestRun()
    {
        $this->assertSame((new UrlCounter())?->countUniqueUrls('https://example.com/'),"https://example.com/");
    }
}