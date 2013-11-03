<?php

namespace Jaguar\Canvas;

use Jaguar\Box;
use Jaguar\Coordinate;
use Jaguar\Color\ColorInterface;
use Jaguar\Dimension;

/*
 * This file is part of the Jaguar package.
 *
 * (c) Hyyan Abo Fakher <tiribthea4hyyan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

interface CanvasInterface {

    /**
     * Set canvas handler
     * 
     * @param resource $handler gd resource 
     * 
     * @return \Jaguar\Canvas\CanvasInterface 
     * @throws \InvalidArgumentException
     */
    public function setHandler($handler);

    /**
     * Get canvas handler
     * 
     * @return resource gd resource
     */
    public function getHandler();

    /**
     * Check if the handler is empty 
     * 
     * @return boolean
     */
    public function isHandlerSet();

    /**
     * Get canvas width
     * 
     * @return integer 
     */
    public function getWidth();

    /**
     * Get height
     * 
     * @return integer 
     */
    public function getHeight();

    /**
     * Get canvas dimension
     * 
     * @return \Jaguar\Dimension
     */
    public function getDimension();

    /**
     * Set alpha blending
     * 
     * @param boolean $bool default true
     * 
     * @return \Jaguar\Canvas\CanvasInterface 
     * 
     * @throws \Jaguar\Exception\Canvas\CanvasException
     * @throws \Jaguar\Exception\Canvas\CanvasEmptyException
     */
    public function alphaBlending($bool);

    /**
     * Turns the interlace bit on or off
     * 
     * @param boolean $boolean True to enable or false to disable
     * 
     * @return \Jaguar\Canvas\CanvasInterface
     * 
     * @throws \InvalidArgumentException 
     * @throws \Jaguar\Exception\Canvas\CanvasException 
     * @throws \Jaguar\Exception\Canvas\CanvasEmptyException
     */
    public function interlace($boolean);

    /**
     * Get Copy of the current canvas
     * 
     * @return \Jaguar\Canvas\CanvasInterface return a canvas with a completey 
     *                                        different gd resource
     * 
     * @throws \Jaguar\Exception\Canvas\CanvasEmptyException 
     */
    public function getCopy();


    /**
     * Create canvas (true colors only)
     * 
     * @param \Jaguar\Dimension $dimension
     * 
     * @return \Jaguar\Canvas\CanvasInterface self
     * 
     * @throws \Jaguar\Execption\InvalidDimensionException
     */
    public function create(Dimension $dimension);

    /**
     * Create new canvas from another one
     * 
     * <b>Note :</b>
     * 
     * New canvas Object will be created and any changes to the loaded canvas
     * will not affect the current one.
     * 
     * Also you must note that the current canvas handler will be destroyed 
     * before assigning the new one . and even if you have assigned the handler 
     * to a variable.
     * 
     * This behaviour will not allow to create canvas and depend 
     * on php garbage collection to clean it
     * 
     * @param \Jaguar\Canvas\CanvasInterface $canvas
     * 
     * @return \Jaguar\Canvas\CanvasInterface self
     * 
     * @throws \Jaguar\Exception\Canvas\CanvasException
     * @throws \Jaguar\Exception\Canvas\CanvasEmptyException
     */
    public function fromResource(CanvasInterface $canvas);

    /**
     * Create new canvas from file
     * 
     * @param string $image
     * 
     * @return \Jaguar\Canvas\CanvasInterface self
     */
    public function fromFile($file);

    /**
     * Create new canvas representing the canvas obtained from the given string
     * 
     * <b>Note : </b>
     * the current canvas handler will be destroy before creating the new one
     * and you have no more access for it
     * 
     * @param string $string canvas as string
     * 
     * @return \Jaguar\Canvas\CanvasInterface self
     * 
     * @throws \Jaguar\Exception\Canvas\CanvasException
     */
    public function fromString($string);

    /**
     * Draw drawable object on the current canvas
     * 
     * @param \Jaguar\Canvas\Drawable $drawable
     * 
     * @return \Jaguar\Canvas\CanvasInterface self
     * @throws \Jaguar\Exception\Canvas\CanvasEmptyException
     */
    public function draw(Drawable $drawable);

    /**
     * Merge two canvas together 
     * 
     * <b>Note :</b>
     * 
     * if <tt>$srcBox</t> or <tt>$destBox</tt> is null then a new box object 
     * will be created its dimension equlas the <tt>$src</tt> dimension 
     * and at (0,0) coordinate 
     * 
     * @param \Jaguar\Canvas\CanvasInterface $src the canvas that should be merged
     *                                            into current one
     * 
     * @param \Jaguar\Box $srcBox Box from src canvas
     * @param \Jaguar\Box $destBox Box for the current canvas 
     * 
     * @return \Jaguar\Canvas\CanvasInterface self
     * 
     * @throws \Jaguar\Exception\Canvas\CanvasException
     * @throws \Jaguar\Exception\Canvas\CanvasEmptyException
     */
    public function paste(CanvasInterface $src, Box $srcBox = null, Box $destBox = null);

    /**
     * Fill canvas with color
     * 
     * @param \Jaguar\Color\ColorInterface $color
     * @param \Jaguar\Coordinate $coordinate start point
     * 
     * @return \Jaguar\Canvas\CanvasInterface self
     * @throws \Jaguar\Exception\Canvas\CanvasEmptyException
     */
    public function fill(ColorInterface $color, Coordinate $coordinate = null);

    /**
     * Fill canvas with pattern
     * 
     * @param \Jaguar\Canvas\CanvasInterface $pattern 
     * @param \Jaguar\Coordinate $coordinate start point
     * 
     * @return \Jaguar\Canvas\CanvasInterface self
     * 
     * @throws \Jaguar\Exception\Canvas\CanvasException
     * @throws \Jaguar\Exception\Canvas\CanvasEmptyException
     */
    public function fillPattern(CanvasInterface $pattern, Coordinate $coordinate = null);

    /**
     * Save canvas 
     * 
     * @param string $path The path to save the canvas to. If not set or NULL,
     *                     the raw canvas stream will be outputted directly.
     * 
     * @return \Jaguar\Canvas\CanvasInterface self
     * 
     * @throws \Jaguar\Exception\Canvas\CanvasEmptyException
     * @throws \Jaguar\Exception\Canvas\CanvasOutputException
     */
    public function save($path = null);

    /**
     * Destroy canvas
     * 
     * Destroy gd resource handler
     * 
     * @return \Jaguar\Canvas\CanvasInterface self
     * @throws \Jaguar\Execption\Canvas\CanvasDestroyException 
     */
    public function destroy();

    /**
     * Get a string representation of the current canvas object
     * 
     * @return string
     */
    public function __toString();
}

