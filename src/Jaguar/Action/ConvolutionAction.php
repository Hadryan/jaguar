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

class ConvolutionAction extends AbstractAction
{
    private $offset;
    private $divisor;
    private $matrix;

    /**
     * Constrcut new convolution action
     * 
     * @param array $matrix
     * @param float $offset
     * @param float $divisor
     */
    public function __construct(array $matrix, $offset = 0.0, $divisor = 1.0)
    {
        $this->setOffset($offset)->setDivisor($divisor)->setMatrix($matrix);
    }

    /**
     * Set color offeset
     * 
     * @param float $offset
     * 
     * @return \Jaguar\Action\ConvolutionAction
     */
    public function setOffset($offset)
    {
        $this->offset = (float) $offset;
        return $this;
    }

    /**
     * Get color offset
     * 
     * @return float
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Set The divisor of the result of the convolution
     * 
     * @param float $divisor
     * 
     * @return \Jaguar\Action\ConvolutionAction
     */
    public function setDivisor($divisor)
    {
        $this->divisor = (float) $divisor;
        return $this;
    }

    /**
     * Get divisor
     * 
     * @return float
     */
    public function getDivisor()
    {
        return $this->divisor;
    }

    /**
     * Set matrix
     * 
     * A 3x3 matrix: an array of three arrays of three floats. 
     * 
     * @param array $matrix
     * 
     * @return \Jaguar\Action\ConvolutionAction
     * 
     * @throws \RuntimeException if not valid matrix
     */
    public function setMatrix(array $matrix)
    {
        $this->assertValidMatrix($matrix);
        $this->matrix = $matrix;
        return $this;
    }

    /**
     * Get matrix
     * 
     * @return array
     */
    protected function getMatrix()
    {
        return $this->matrix;
    }

    /**
     * {@inheritdoc}
     */
    protected function doApply(CanvasInterface $canvas)
    {
        imageconvolution(
                $canvas->getHandler()
                , $this->getMatrix()
                , $this->getDivisor()
                , $this->getOffset()
        );
    }

    /**
     * Assert that the given matrix is valid convolution matrix
     * 
     * @param array $matrix
     * 
     * @throws \RuntimeException
     */
    private function assertValidMatrix(array $matrix)
    {
        $count = count($matrix);
        if ($count === 3) {
            for ($x = 0; $x < $count; $x++) {
                if (!is_array($matrix[$x])) {
                    throw new \RuntimeException(sprintf(
                            'Item "%d" In The Given Matrix Is Not An Array', $x
                    ));
                }

                $subcount = count($matrix[$x]);
                if ($subcount < 3 || $subcount > 3) {
                    throw new \RuntimeException(sprintf(
                            'Item "%d" In The Given Matrix Must Be An Array With (3) '
                            . 'Flotas But "%d" Float(s) Was Found'
                            , $x, $subcount
                    ));
                }
            }
        } else {
            throw new \RuntimeException(sprintf(
                    'Expect Matrix (3*3) But The Given Matrix Length is (%s)'
                    , $count
            ));
        }
    }

}
