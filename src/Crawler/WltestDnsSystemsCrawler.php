<?php
declare(strict_types=1);
namespace App\Crawler;

use App\Utils\MoneyConverter;
use App\Utils\StringFloatExtractor;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WltestDnsSystemsCrawler
{
    public const CRAWL_URL = 'https://wltest.dns-systems.net';

    private Crawler $crawler;

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function __construct()
    {
        $this->crawler = new Crawler(
            HttpClient::create()
                      ->request('GET', self::CRAWL_URL)
                      ->getContent()
        );
    }

    public function crawl(): array
    {
        return $this->crawler->filter('div.package')
                             ->each(
                                 fn(Crawler $node) => $this->crawlItem($node)
                             )
        ;
    }

    private function crawlItem(Crawler $node): array
    {
        return [
            'title' => $this->getTitle($node),
            'description' => $this->getDescription($node),
            'price' => $this->getPrice($node),
            'discount' => $this->getDiscount($node),
        ];
    }

    private function getTitle(Crawler $node): string
    {
        return $node->filter('.header')
                    ->text()
        ;
    }

    private function getDescription(Crawler $node): string
    {
        return $node->filter('.package-description')
                    ->text()
        ;
    }

    private function getPrice(Crawler $node): int
    {
        $nodeText = $node->filter('.price-big')
                         ->text();
        $price = MoneyConverter::convertStringPriceToIntegerCents(
            str_replace(
                '£',
                '',
                $nodeText
            )
        );

        /** Calculate annual price */
        if ($this->packageIsMonthly($node)) {
            $price *= 12;
        }

        return $price;
    }

    private function packageIsMonthly(Crawler $node): bool
    {
        return str_contains(
            $node->filter('.package-price')
                 ->text(),
            'Month'
        );
    }

    private function getDiscount(Crawler $node): int
    {
        if ($this->packageHasDiscount($node)) {
            $floatsInString = StringFloatExtractor::extractDecimalsFromString(
                $node->filter('.package-price > p')
                     ->text()
            );

            if (isset($floatsInString[0])) {
                return MoneyConverter::convertStringPriceToIntegerCents($floatsInString[0]);
            }
        }

        return 0;
    }

    private function packageHasDiscount(Crawler $node): bool
    {
        return $node->filter('.package-price > p')
                    ->count() > 0;
    }
}