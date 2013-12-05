<?php

/*
 * This file is part of the Jaguar package.
 * (c) Hyyan Abo Fakher <tiribthea4hyyan@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jaguar\Action;

use Jaguar\CanvasInterface;
use Jaguar\Dimension;
use Jaguar\Box;

class ResizeAction extends AbstractAction
{
    /**
     * New Resource Dimension
     * @var Dimension
     */
    private $dimension;

    /**
     * Constrcut new Resize Action
     * 
     * @param \Jaguar\Dimension $dimension
     */
    public function __construct(Dimension $dimension)
    {
        $this->setDimension($dimension);
    }

    /**
     * Set dimension
     * 
     * @param \Jaguar\Dimension $dimension
     * 
     * @return \Jaguar\Action\ResizeAction
     */
    public function setDimension(Dimension $dimension)
    {
        $this->dimension = $dimension;
        return $this;
    }

    /**
     * Get dimension
     * 
     * @return \Jaguar\Dimension
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    protected function doApply(CanvasInterface $canvas)
    {
        $copy = new \Jaguar\Canvas($this->getDimension());
        $copy->paste($canvas, null, new Box($this->getDimension()));
        $canvas->fromCanvas($copy);
        $copy->destroy();
    }

}
