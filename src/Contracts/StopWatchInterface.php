<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Contracts;


interface StopWatchInterface
{
    public function start(): void;

    public function stop(): void;

    public function reset(): void;

    public function getLaps(): array;
}
