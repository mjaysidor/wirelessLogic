<?php
declare(strict_types=1);
require __DIR__.'/vendor/autoload.php';

use App\Crawler\WltestDnsSystemsCrawler;
use App\Entity\Collection\EntityCollection;
use App\Entity\Item\Sorter\ItemCollectionSorter;
use App\Factory\ItemFactory;

$crawler = new WltestDnsSystemsCrawler();
$itemCollection = new EntityCollection();

$crawledItems = $crawler->crawl();
foreach ($crawledItems as $array) {
    $item = ItemFactory::createFromArray($array);
    $itemCollection->addItem($item);
}

$itemCollection->sortCollection(
    fn($a, $b) => ItemCollectionSorter::getDefaultSortCallback($a, $b)
);

echo PHP_EOL;
echo '--------------------------------------------------';
echo PHP_EOL;
echo 'Running the crawler:';
echo PHP_EOL;
echo PHP_EOL;

try {
    echo $itemCollection->toJson();
} catch (JsonException $e) {
    echo $e->getMessage();
}

echo PHP_EOL;
echo PHP_EOL;
echo 'Finished!';
echo PHP_EOL;
echo '--------------------------------------------------';
echo PHP_EOL;
echo PHP_EOL;