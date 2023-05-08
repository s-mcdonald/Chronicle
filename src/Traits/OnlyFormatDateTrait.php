<?php

declare(strict_types=1);

namespace SamMcDonald\Chronicle\Traits;

use SamMcDonald\Chronicle\Enums\DateSeperator;
use SamMcDonald\Chronicle\Enums\MonthOfYear;

trait OnlyFormatDateTrait
{
    public function asYmd(DateSeperator $sep = DateSeperator::Dash): string
    {
        return $this->format(
            sprintf(
                'Y%sm%sd',
                $sep->value,
                $sep->value,
                $sep->value
            )
        );
    }

    public function toShortDateString(): string
    {
        return $this->asYmd(DateSeperator::Dash);
    }

    /**
     * @description Will format as m-d-Y
     */
    public function toUSShortDateString(): string
    {
        return $this->format('m-d-Y');
    }

    public function toLongDateString(): string
    {
        return $this->format('l jS \of F Y');
    }

    /**
     * @description Wed, Jul 05, 2023
     */
    public function toAbbreviatedDayMonthYearString(): string
    {
        return $this->format('D, M d, Y');
    }

    public function toAbbreviatedMonthDayString(bool $hyphenate = false): string
    {
        return $this->format(
            sprintf(
                'M%sj',
                ($hyphenate) ? DateSeperator::Dash->value : DateSeperator::Space->value
            )
        );
    }

    public function getDayOfWeek(): string
    {
        return $this->toDateTimeImmutable()->format('l');
    }

    public function getDayOfWeekInt(): string
    {
        return $this->toDateTimeImmutable()->format('w');
    }

    public function getMonthOfYear(): string
    {
        return MonthOfYear::byMonthId(
            $this->getMonth()
        );
    }
}
