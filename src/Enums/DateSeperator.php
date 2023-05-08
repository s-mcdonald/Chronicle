<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Enums;

enum DateSeperator: string
{
    case None = '';

    case Space = ' ';

    case Dash = '-';

    case ForwardSlash = '/';
}
