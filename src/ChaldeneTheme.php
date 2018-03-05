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

namespace mikbox74\Chaldene;

/**
 * Chaldene Theme
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class ChaldeneTheme extends \yii\base\Theme
{

    /**
     * @var string Layout name, see \mikbox74\Chaldene\ChaldeneLayouts class
     */
    public $layout;

    /**
     * @var boolean Right to left orientation
     */
    public $rtl;

    /**
     * @var boolean Theme switcher usage
     */
    public $switcher;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $layoutPath = '@app/views/layouts/main.php';
        if (!isset($this->pathMap[$layoutPath])) {
            $this->pathMap[$layoutPath]
                = '@vendor/mikbox74/yii2-chl/src/layouts' . $this->layout . '.php';
        }
    }
}