<?php

namespace NapoleonCat\Tests\unit\Parsers;

use Codeception\Test\Unit;
use Facebook\GraphNodes\GraphNode;
use NapoleonCat\Integrations\Parsers\FacebookParser;

class FacebookParserTest extends Unit
{
    private const EXAMPLE_PAGE_ID = 1;
    private const EXAMPLE_ITEM_TYPE = 2;

    public function testParser(): void
    {
        $data = [
            "id" => 1,
            "message" => 'asdsa',
            "created_time" => '2020-04-05'
        ];
        $graph = new GraphNode($data);
        $parser = FacebookParser::parse($graph, self::EXAMPLE_PAGE_ID, self::EXAMPLE_ITEM_TYPE);

        self::assertIsArray($parser);
        self::assertCount(6, $parser);
        self::assertEquals($graph['id'], $parser['item_id']);
        self::assertEquals(self::EXAMPLE_PAGE_ID, $parser['page_social_id']);
        self::assertEquals(self::EXAMPLE_PAGE_ID, $parser['item_parent']);
        self::assertEquals(self::EXAMPLE_ITEM_TYPE, $parser['item_type']);
        self::assertEquals($graph['message'], $parser['data']);
        self::assertEquals($graph['created_time']->getTimestamp(), $parser['created_at']);
    }
}