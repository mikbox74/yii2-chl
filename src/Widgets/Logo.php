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

use Yii;
use mikbox74\Chaldene\Widgets\Base\ChaldeneWidget;
use mikbox74\Chaldene\ChaldeneHelper;

/**
 * Adaptive logo widget
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class Logo extends ChaldeneWidget
{
    /**
     * @var string Large image URL (URI), 240x60
     */
    public $lgImage;

    /**
     * @var string Small image URL (URI), 60x60
     */
    public $xsImage;

    /**
     * @var string Large image CSS class
     */
    public $lgImageClass = 'logo-lg hidden-xs';

    /**
     * @var string Small image CSS class
     */
    public $xsImageClass = 'logo-xs visible-xs';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!$this->lgImage && $bundle) {
            $this->lgImage = ChaldeneHelper::getAssetUrl() . '/img/logo_lg.svg';
        }
        if (!$this->xsImage && $bundle) {
            $this->xsImage = ChaldeneHelper::getAssetUrl() . '/img/logo_xs.svg';
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        ?><a class="logo" href="<?=Yii::$app->getHomeUrl()?>">
            <span class="<?= $this->xsImageClass ?>">
                <img src="<?= $this->xsImage ?>" alt="logo-xs">
            </span>
            <span class="<?= $this->lgImageClass ?>">
              <img src="<?= $this->lgImage ?>" alt="logo-lg">
            </span>
        </a><?php
    }
}