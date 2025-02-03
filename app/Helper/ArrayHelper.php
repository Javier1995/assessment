<?php

namespace Sourcetoad\Helper;

class ArrayHelper
{
    protected array $data;
    protected array $keys;
    protected string $order;

    public function __construct(array $data, array $keys = ['first_name'], string $order = 'asc')
    {
        $this->data = $data;
        $this->keys = $keys;
        $this->order = $order;
        $this->filterBy($this->data, $this->keys, $this->order);
    }

    public static function beautify(array $data, array $keys = ['first_name'], string $order = 'asc'): void
    {
        (new static($data, $keys, $order))->printOut();
    }

    protected function printOut(string $tab = "", bool $separator = true, ?array $data = null): void
    {
        $data = $data ?? $this->data;
        
        foreach ($data as $key => $value) {
            $formattedKey = ucwords(str_replace("_", " ", (string)$key));

            if (is_array($value)) {
                echo !is_numeric($key) ? " " . $formattedKey . ':' . PHP_EOL : '';
                $this->printOut($tab . " ", false, $value);
            } else {
                echo $tab . $formattedKey . ": " . $value . PHP_EOL;
            }

            if ($separator) {
                echo str_repeat("=", 25) . PHP_EOL;
            }
        }
    }

    protected function filterBy(array &$data, array $keys, string $order = 'asc'): void
    {
        usort($data, function ($a, $b) use ($keys, $order) {
            foreach ($keys as $key) {
                $valA = $this->filterIn($a, $key);
                $valB = $this->filterIn($b, $key);

                if ($valA != $valB) {
                    return match ($order) {
                        'asc' => $valA <=> $valB,
                        'desc' => -1 * ($valA <=> $valB),
                        default => $valA <=> $valB,
                    };
                }
            }
            return 0;
        });
    }

    protected function filterIn(array $array, string|int $key)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        
        foreach ($array as $value) {
            if (is_array($value)) {
                $nestedValue = $this->filterIn($value, $key);
                if ($nestedValue !== null) {
                    return $nestedValue;
                }
            }
        }
        return null;
    }
}
