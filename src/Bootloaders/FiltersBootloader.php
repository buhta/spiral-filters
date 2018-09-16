<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Filters\Bootloaders;

use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Filters\FilterLocator;
use Spiral\Filters\FilterMapper;
use Spiral\Filters\LocatorInterface;
use Spiral\Filters\MapperInterface;

class FiltersBootloader extends Bootloader
{
    const SINGLETONS = [
        MapperInterface::class  => FilterMapper::class,
        LocatorInterface::class => FilterLocator::class
    ];
}