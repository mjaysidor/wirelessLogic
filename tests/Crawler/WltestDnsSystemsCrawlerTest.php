<?php
declare(strict_types=1);
namespace App\Tests\Crawler;

use App\Crawler\WltestDnsSystemsCrawler;
use PHPUnit\Framework\TestCase;

class WltestDnsSystemsCrawlerTest extends TestCase
{
    public function test(): void
    {
        self::assertNotSame(
            [],
            (new WltestDnsSystemsCrawler())->crawl()
        );
        self::assertSame(
            [
                [
                    "title"       => "Basic: 500MB Data - 12 Months",
                    "description" => "Up to 500MB of data per monthincluding 20 SMS(5p / MB data and 4p / SMS thereafter)",
                    "price"       => 7188,
                    "discount"    => 0,
                ],
                [
                    "title"       => "Standard: 1GB Data - 12 Months",
                    "description" => "Up to 1 GB data per monthincluding 35 SMS(5p / MB data and 4p / SMS thereafter)",
                    "price"       => 11988,
                    "discount"    => 0,
                ],
                [
                    "title"       => "Optimum: 2 GB Data - 12 Months",
                    "description" => "2GB data per monthincluding 40 SMS(5p / minute and 4p / SMS thereafter)",
                    "price"       => 19188,
                    "discount"    => 0,
                ],
                [
                    "title"       => "Basic: 6GB Data - 1 Year",
                    "description" => "Up to 6GB of data per yearincluding 240 SMS(5p / MB data and 4p / SMS thereafter)",
                    "price"       => 6600,
                    "discount"    => 586,
                ],
                [
                    "title"       => "Standard: 12GB Data - 1 Year",
                    "description" => "Up to 12GB of data per year including 420 SMS(5p / MB data and 4p / SMS thereafter)",
                    "price"       => 10800,
                    "discount"    => 1190,
                ],
                [
                    "title"       => "Optimum: 24GB Data - 1 Year",
                    "description" => "Up to 12GB of data per year including 480 SMS(5p / MB data and 4p / SMS thereafter)",
                    "price"       => 17400,
                    "discount"    => 1790,
                ],
            ],
            (new WltestDnsSystemsCrawler())->crawl()
        );
    }
}