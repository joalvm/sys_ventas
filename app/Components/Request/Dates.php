<?php

namespace App\Components\Request;

use App\Components\Builder;
use Illuminate\Support\Facades\DB;

class Dates
{
    public const TIMESTAMPTZ_FORMAT = 'Y-m-d H:i:sO';
    public const TIMESTAMP_FORMAT = 'Y-m-d H:i:s';
    public const DATE_FORMAT = 'Y-m-d';
    public const TIME_FORMAT = 'H:i:s';

    public const TIMESTAMPTZ_REGEX = '/^((19|20)[0-9][0-9])[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])[T|\s]([01][0-9]|[2][0-3])[:]([0-5][0-9])[:]([0-5][0-9])([+|-]([01][0-9]|[2][0-3])(([:])?([0-5][0-9])){0,1})?$/';
    public const TIMESTAMP_REGEX = '/(((19|20)\\d\\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])\\s((?:\\d|[01]\\d|2[0-3])):[0-5]\\d:[0-5]\\d)/';
    public const DATE_REGEX = '/^((19|20)\\d\\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/';
    public const TIME_REGEX = '/^([01]\\d|2[0-3]):([0-5]\\d)(:[0-5]\\d)$/';
    public const DAY_REGEX = '/^(0?[1-9]|[12][0-9]|3[01])$/';
    public const HOUR_REGEX = '/^([01]?[0-9]|2[0-3])$/';
    public const MONTH_REGEX = '/^(0?[1-9]|1[012])$/';
    public const YEAR_REGEX = '/^(19|20)\d\d$/';

    public $regexs = [
        self::TIMESTAMPTZ_FORMAT => self::TIMESTAMPTZ_REGEX,
        self::TIMESTAMP_FORMAT => self::TIMESTAMP_REGEX,
        self::DATE_FORMAT => self::DATE_REGEX,
        self::TIME_FORMAT => self::TIME_REGEX,
    ];

    private $years = [];
    private $months = [];
    private $weeks = [];
    private $days = [];
    private $hours = [];
    private $dates = [];
    private $ranges = [];
    private $field = '';
    private $conditional = 'AND';

    public function __construct(string $field, ?string $columnTz = null)
    {
        $this->field = $columnTz ? "(${field} AT TIME ZONE ${columnTz})" : $field;

        $this->setYears();
        $this->setMonths();
        $this->setWeeks();
        $this->setDays();
        $this->setHours();
        $this->setDates();

        $this->setRanges();
    }

    public function run(Builder &$builder)
    {
        if ($this->years) {
            $builder->whereIn(
                DB::raw("extract(year from {$this->field})"),
                $this->years
            );
        }

        if ($this->months) {
            $builder->whereIn(
                DB::raw("extract(month from {$this->field})"),
                $this->months
            );
        }

        if ($this->days) {
            $builder->whereIn(
                DB::raw("extract(day from {$this->field})"),
                $this->days
            );
        }

        if ($this->dates) {
            $builder->whereIn(DB::raw("{$this->field}::date"), $this->dates);
        }

        if ($this->weeks) {
            $builder->whereIn(
                DB::raw("extract(week from {$this->field})"),
                $this->weeks
            );
        }

        if ($this->hours) {
            $builder->whereIn(
                DB::raw("extract(hour from {$this->field})"),
                $this->hours
            );
        }

        if ($this->ranges) {
            $builder->where(function ($query) {
                foreach ($this->ranges as $index => $range) {
                    $fn = $this->getFnFromRange($range);
                    $query->orWhere(function ($query2) use ($fn, $range) {
                        $query2->where([
                            [DB::raw($fn), '>=', DB::raw("'$range->start'::timestamptz")],
                            [DB::raw($fn), '<=', DB::raw("'$range->end'::timestamptz")],
                        ]);
                    });
                }
            });
        }
    }

    private function getFnFromRange($range): string
    {
        return self::DATE_FORMAT == $range->format
            ? "{$this->field}::date"
            : (
                self::TIME_FORMAT == $range->format
                    ? "{$this->field}::time"
                    : $this->field
            );
    }

    private function setYears(): self
    {
        $this->years = array_filter(
            to_array_int($this->pGet('years')),
            function ($item) {
                return preg_match(self::YEAR_REGEX, $item);
            }
        );

        return $this;
    }

    private function setMonths()
    {
        $this->months = array_filter(
            to_array_int($this->pGet('months')),
            function ($item) {
                return preg_match(self::MONTH_REGEX, $item);
            }
        );
    }

    private function setWeeks()
    {
        $this->weeks = array_filter(
            to_array_int($this->pGet('weeks')),
            function ($item) {
                return preg_match(self::MONTH_REGEX, $item);
            }
        );
    }

    private function setDays()
    {
        $this->days = array_filter(
            to_array_int($this->pGet('days')),
            function ($item) {
                return preg_match(self::DAY_REGEX, $item);
            }
        );
    }

    private function setHours()
    {
        $this->hours = array_filter(
            to_array_int($this->pGet('hours')),
            function ($item) {
                return preg_match(self::HOUR_REGEX, $item);
            }
        );
    }

    private function setDates()
    {
        $this->dates = array_filter(
            to_array_str($this->pGet('dates')),
            function ($item) {
                return preg_match(self::DATE_REGEX, $item);
            }
        );
    }

    private function setRanges()
    {
        $this->ranges = $this->filterRanges(
            $this->cleanRanges($this->pGet('ranges'))
        );

        return $this;
    }

    private function pGet(string $param)
    {
        return $_GET[$param] ?? [];
    }

    private function cleanRanges(?array $ranges = null): ?array
    {
        return is_array($ranges) ? (
            is_assoc($ranges)
                ? ($this->validateRangeKeys($ranges) ? [$ranges] : [])
                : array_filter($ranges, [$this, 'validateRangeKeys'])
        ) : [];
    }

    private function validateRangeKeys(array $range): bool
    {
        return key_exists('end', $range) and key_exists('start', $range);
    }

    private function filterRanges(array $ranges): array
    {
        $frms = [];

        foreach ($ranges as $index => $range) {
            $start = $this->selectDate($range['start']);
            $end = $this->selectDate($range['end']);

            if (!is_null($start) and !is_null($end)) {
                array_push($frms, (object) [
                    'start' => $start['date'],
                    'end' => $end['date'],
                    'format' => $start['format'],
                ]);
            }
        }

        return $frms;
    }

    public function selectDate(string $str_date): ?array
    {
        switch (strlen($str_date)) {
            case 8:
                return $this->partRange($str_date, self::TIME_FORMAT);
            case 10:
                return $this->partRange($str_date, self::DATE_FORMAT);
            case 19:
                return $this->partRange($str_date, self::TIMESTAMP_FORMAT);
            case 16:
                return $this->partRange("${str_date}:00", self::TIMESTAMP_FORMAT);
            case 13:
                return $this->partRange("${str_date}:00:00", self::TIMESTAMP_FORMAT);
            case 22:
            case 24:
            case 25:
                return $this->partRange("${str_date}", self::TIMESTAMPTZ_FORMAT);
            default:
                return null;
        }
    }

    private function partRange(string $str_date, string $format): ?array
    {
        return preg_match($this->regexs[$format], $str_date) ? [
            'date' => $str_date,
            'format' => $format,
        ] : null;
    }
}
