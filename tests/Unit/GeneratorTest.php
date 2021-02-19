<?php

namespace Tests\Unit;

use Subsets\Service\Generator;
use Tests\TestCase;

class GeneratorTest extends TestCase
{
    public function testWhenKIsEqualZero()
    {
        list($s, $k) = $this->getGeneratorParameter(0);

        $output = (new Generator)->make($s, $k);

        $this->assertCount(1, $output);
        $this->assertEquals([[]], $output);
    }

    public function testWhenKIsOne()
    {
        list($s, $k) = $this->getGeneratorParameter(1);

        $output = (new Generator)->make($s, $k);

        $this->assertCount(4, $output);
        $this->assertEquals([[1], [2], [3], [4]], $output);
    }

    public function testWhenKIsTwo()
    {
        list($s, $k) = $this->getGeneratorParameter(2);

        $output = (new Generator)->make($s, $k);

        $this->assertCount(6, $output);
        $this->assertEquals([[1, 2], [1, 3], [1, 4], [2, 3], [2, 4], [3, 4]], $output);
    }

    public function testWhenKIsEqualSLength()
    {
        list($s, $k) = $this->getGeneratorParameter(4);

        $output = (new Generator)->make($s, $k);

        $this->assertCount(1, $output);
        $this->assertEquals([[1, 2, 3, 4]], $output);
    }

    public function testWhenKIsGreaterThanSLength()
    {
        list($s, $k) = $this->getGeneratorParameter(5);

        $output = (new Generator)->make($s, $k);

        $this->assertCount(0, $output);
        $this->assertEquals([], $output);
    }

    public function testAnyInputWhenKIsOneLessThanSLength()
    {
        $s = range(1, rand(5, 15));
        $k = count($s) - 1;

        $output = (new Generator)->make($s, $k);

        $this->assertCount($k + 1, $output);

        for ($i = 1; count($output) <= $i; $i++) {
            $inCurrentPosition = $s;
            array_splice($inCurrentPosition, count($s) - $i, 1);

            $this->assertEquals($output[$i - 1], $inCurrentPosition);
        }
    }

    private function getGeneratorParameter(int $k): array
    {
        return [
            [1, 2, 3, 4],
            $k
        ];
    }
}
