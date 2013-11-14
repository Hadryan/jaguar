<?php

/*
 * This file is part of the Jaguar package.
 *
 * (c) Hyyan Abo Fakher <tiribthea4hyyan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jaguar\Canvas;

interface Drawable {

    /**
     * @param \Jaguar\Canvas\CanvasInterface $canvas
     */
    public function draw(CanvasInterface $canvas);
}

