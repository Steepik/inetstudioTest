<?php

namespace Steepik\Architecture\OpenClosed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(SomeObjectsHandler::class)]
final class SomeObjectHandlerTest extends TestCase
{
    public function testItReturnArrayWithValidData()
    {
        $handler = (new SomeObjectsHandler([
            new SomeObjectA('object_1'),
            new SomeObjectB('object_2'),
        ]));

        $this->assertEquals(
            [
                'handle_object_1',
                'handle_object_2',
            ],
            $handler->handleObjects(),
        );
    }

    public function testItThrowExceptionIfWrongValue()
    {
        $handler = (new SomeObjectsHandler([
            new SomeObjectA('object_1'),
            new class {},
        ]));

        $this->expectException(\ValueError::class);

        $handler->handleObjects();
    }
}