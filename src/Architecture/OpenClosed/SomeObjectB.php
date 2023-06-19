<?php

namespace Steepik\Architecture\OpenClosed;

final readonly class SomeObjectB implements ObjectHandler
{
    public function __construct(
        protected string $name
    ) {
    }

    public function getObjectName(): string
    {
        return 'handle_' . $this->name;
    }
}