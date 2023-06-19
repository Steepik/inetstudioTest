<?php

namespace Steepik\Architecture\Concept;

interface Storage
{
    public function get(): string;
    public function put(): void;
}