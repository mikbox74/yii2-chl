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

use mikbox74\Chaldene\Widgets\Base\ChaldeneWidget;

/**
 * Description of SearchForm
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class SearchForm extends ChaldeneWidget
{

    /**
     * @var string Form action
     */
    public $action;

    /**
     * @var string Form CSS class
     */
    public $cssClass;

    /**
     * @var string Request method, "get" by default
     */
    public $method      = 'get';

    /**
     * @var string Input placeholder, "Search" by default
     */
    public $placeholder = 'Search';

    /**
     * @var string Name of input, "search" by default
     */
    public $fieldName   = 'search';

    /**
     * @var string|\Closure Input value or anonimous function returns value
     */
    public $fieldValue;

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->fieldValue instanceof \Closure) {
            $func  = $this->fieldValue;
            $value = $func($this);
        } else {
            $value = $this->fieldValue;
        }
        return $this->render('search', ['widget' => $this, 'value' => $value]);
    }
}