<?php
declare(strict_types = 1);
namespace RHo\HttpTest;

use RHo\StableSort\StableSort;
use PHPUnit\Framework\TestCase;

final class AcceptTest extends TestCase
{

    public function testUasortWithEmptyArray()
    {
        $actual = [];
        $expected = [];
        StableSort::uasort($actual, 'strcmp');
        $this->assertSame($expected, $actual);
    }

    public function testUasort()
    {
        $actual = [
            'y' => '3',
            'z' => '9',
            'b' => '1',
            'k' => '2',
            'a' => '1',
            'x' => '3'
        ];
        $expected = [
            'b' => '1',
            'a' => '1',
            'k' => '2',
            'y' => '3',
            'x' => '3',
            'z' => '9'
        ];
        StableSort::uasort($actual, 'strcmp');
        $this->assertSame($expected, $actual);
    }

    public function testAsortWithEmptyArray()
    {
        $actual = [];
        $expected = [];
        StableSort::asort($actual);
        $this->assertSame($expected, $actual);
    }

    public function testAsort()
    {
        $actual = [
            'w' => 2,
            'q' => 1,
            'z' => 9,
            'b' => 1,
            'k' => 2,
            'a' => 1
        ];
        $expected = [
            'q' => 1,
            'b' => 1,
            'a' => 1,
            'w' => 2,
            'k' => 2,
            'z' => 9
        ];
        StableSort::asort($actual);
        $this->assertSame($expected, $actual);
    }

    public function testUsortWithEmptyArray()
    {
        $actual = [];
        $expected = [];
        StableSort::usort($actual, 'strcmp');
        $this->assertSame($expected, $actual);
    }

    public function testUsort()
    {
        // @formatter:off
        $actual = [
            'z' => [ 9, 'z' ],
            'b' => [ 1, 'b' ],
            'k' => [ 2, 'k' ],
            'a' => [ 1, 'a' ]
        ];
        $expected = [
            [ 1, 'b' ],
            [ 1, 'a' ],
            [ 2, 'k' ],
            [ 9, 'z' ]
        ];
        // @formatter:on
        StableSort::usort($actual, function (array $a, array $b) {
            return $a[0] - $b[0];
        });
        $this->assertSame($expected, $actual);
    }
}