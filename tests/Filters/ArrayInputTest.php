<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Filters\Tests;

use PHPUnit\Framework\TestCase;
use Spiral\Filters\ArrayInput;

class ArrayInputTest extends TestCase
{
    public function testGetValue()
    {
        $arr = new ArrayInput(['key' => 'value']);
        $this->assertSame('value', $arr->getValue('', 'key'));
        $this->assertSame(null, $arr->getValue('', 'other'));
    }

    public function testGetValueNested()
    {
        $arr = new ArrayInput(['key' => ['a' => 'b']]);
        $this->assertSame('b', $arr->getValue('', 'key.a'));
        $this->assertSame(null, $arr->getValue('', 'key.c'));
        $this->assertSame(null, $arr->getValue('', 'key.a.d'));
    }

    public function testSliced()
    {
        $arr = new ArrayInput(['key' => ['a' => 'b']]);
        $this->assertSame('b', $arr->getValue('', 'key.a'));

        $arr2 = $arr->withPrefix('key');
        $this->assertSame('b', $arr->getValue('', 'key.a'));
        $this->assertSame('b', $arr2->getValue('', 'a'));
    }

    public function testSlicedOverwrite()
    {
        $arr = new ArrayInput(['key' => ['a' => ['x' => 'y']]]);
        $this->assertSame('y', $arr->getValue('', 'key.a.x'));

        $arr2 = $arr->withPrefix('key');
        $this->assertSame('y', $arr2->getValue('', 'a.x'));

        $arr3 = $arr2->withPrefix('a');
        $this->assertSame('y', $arr3->getValue('', 'x'));

        // return
        $arr4 = $arr3->withPrefix('key', false);
        $this->assertSame('y', $arr4->getValue('', 'a.x'));
    }

    public function testGetSlice()
    {
        $arr = new ArrayInput(['key' => ['a' => ['x' => 'y']]]);
        $this->assertSame(['key' => ['a' => ['x' => 'y']]], $arr->getValue('', ''));
    }
}