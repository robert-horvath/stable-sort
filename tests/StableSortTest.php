<?php
declare(strict_types = 1);
namespace RHo\HttpTest;

use RHo\StableSort\StableSort;
use PHPUnit\Framework\TestCase;

final class AcceptTest extends TestCase
{

    public static function intcmp(array $a, array $b)
    {
        return $a[0] - $b[0];
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

        $this->assertTrue(StableSort::uasort($actual, 'strcmp'));
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

        $this->assertTrue(StableSort::asort($actual));
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
        $valueCmpFunc = [ __CLASS__, 'intcmp' ];
        // @formatter:on

        $this->assertTrue(StableSort::usort($actual, $valueCmpFunc));
        $this->assertSame($expected, $actual);
    }
}