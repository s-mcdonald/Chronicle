<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Enums;

enum DateShiftRule: int
{
    case Strict = 0;

    case Business = 1;

    case PhpCore = 2;
}
