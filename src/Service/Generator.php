<?php
declare(strict_types=1);

namespace Subsets\Service;

final class Generator
{
    public function make(array $s, int $k): array
    {
        if ($k === 0) {
            return [[]];
        } elseif ($k < 1) {
            return [];
        }

        $result = [];

        foreach ($s as $i) {
            $partials = $this->make($this->getItemsGreaterThan($s, $i), $k - 1);

            foreach ($partials as $partial) {
                $result[] = array_merge([$i], $partial);
            }
        }

        return $result;
    }

    private function getItemsGreaterThan(array $s, $i): array
    {
        return array_filter($s, fn($n) => $n > $i);
    }
}
