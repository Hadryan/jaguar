<?php

/*
 * This file is part of the Jaguar package.
 * (c) Hyyan Abo Fakher <tiribthea4hyyan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jaguar\Action\Fancy;

use Jaguar\Tests\Action\AbstractActionTest;
use Jaguar\Action\Fancy\Wavy;

class WavyTest extends AbstractActionTest
{

    public function getAction()
    {
        return new Wavy();
    }

    public function testApply()
    {
        $this->assertInstanceOf(
                '\Jaguar\Action\Fancy\Wavy'
                , $this->getAction()->apply($this->getCanvas())
        );
    }

}
