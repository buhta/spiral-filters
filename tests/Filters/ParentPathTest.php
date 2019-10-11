<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
declare(strict_types=1);

namespace Spiral\Filters\Tests;

use Spiral\Filters\ArrayInput;
use Spiral\Filters\Tests\Fixtures\ParentPathFilter;

class ParentPathTest extends BaseTest
{
    public function testChildrenValid(): void
    {
        $filter = new ParentPathFilter(new ArrayInput([
            'custom' => [
                'id' => 'value'
            ]
        ]), $this->getMapper());

        $this->assertTrue($filter->isValid());
        $this->assertSame('value', $filter->test->id);
    }

    public function testChildrenInvalid(): void
    {
        $filter = new ParentPathFilter(new ArrayInput([]), $this->getMapper());

        $this->assertFalse($filter->isValid());
        $this->assertSame([
            'custom' => [
                'id' => 'This value is required.'
            ]
        ], $filter->getErrors());
    }
}
