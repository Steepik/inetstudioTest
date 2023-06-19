<?php

namespace Steepik\Architecture\OpenClosed;

final readonly class SomeObjectsHandler
{
    /** @param non-empty-list<ObjectHandler> $objects */
    public function __construct(
        private array $objects
    ) {
    }

    /**
     * @return non-empty-list<string>
     */
    public function handleObjects(): array
    {
        $handlers = [];
        foreach ($this->objects as $item) {
            if (! $item instanceof ObjectHandler) {
                throw new \ValueError(sprintf('Wrong object passed. %s only available', ObjectHandler::class));
            }

            $handlers[] = $item->getObjectName();
        }

        return $handlers;
    }
}