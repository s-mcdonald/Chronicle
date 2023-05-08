<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Contracts;

interface DateStringFormatsInterface
{
    public function toAbbreviatedMonthDayString(bool $hyphenate = false): string;

    public function toAbbreviatedDayMonthYearString(): string;

    public function toShortDateString(): string;

    public function toUSShortDateString(): string;

    public function toLongDateString(): string;
}
