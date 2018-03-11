<?php

/*
 * The MIT License
 *
 * Copyright 2018 Михаил Ураков <mikbox74@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace mikbox74\Chaldene\Widgets;

use yii\helpers\Html;
use mikbox74\Chaldene\Widgets\Base\ChaldeneWidget;

/**
 * Box Widget
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class Box extends ChaldeneWidget
{

    /**
     * @var string CSS class for main box tag
     */
    public $cssClassBox    = '';

    /**
     * @var string CSS class for main box tag
     */
    public $cssClassHeader = '';

    /**
     * @var string CSS class for main box tag
     */
    public $cssClassBody   = '';

    /**
     * @var string CSS class for main box tag
     */
    public $cssClassFooter = '';

    /**
     * @var string
     */
    public $header = '';

    /**
     * @var string
     */
    public $body = '';

    /**
     * @var string
     */
    public $footer = '';

    /**
     * @var array
     */
    public $tools = [
        'collapse' => true,
        'box'      => true,
        'refresh'  => true,
        'close'    => true,
    ];

    /**
     * @var boolean
     */
    public $encode = true;

    /**
     * Renders the widget.
     */
    public function run()
    {
        $classBox    = implode(' ', (array) $this->cssClassBox);
        $classHeader = implode(' ', (array) $this->cssClassHeader);
        $classBody   = implode(' ', (array) $this->cssClassBody);
        $classFooter = implode(' ', (array) $this->cssClassFooter);
        return $this->render('box', [
            'classBox'    => $classBox,
            'classHeader' => $classHeader,
            'classBody'   => $classBody,
            'classFooter' => $classFooter,
            'header'      => $this->header,
            'body'        => $this->body,
            'footer'      => $this->footer,
            'tools'       => $this->tools,
        ]);
    }

    /**
     * Encode string accordingly to $encode property
     * @param string $string
     */
    protected function _enc($string)
    {
        return $this->encode ? Html::encode($string) : $string;
    }
}