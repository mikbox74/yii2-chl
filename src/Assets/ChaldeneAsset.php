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

namespace mikbox74\Chaldene\Assets;

use mikbox74\Chaldene\ChaldeneThemes;
use mikbox74\Chaldene\ChaldeneHelper;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\YiiAsset;

/**
 * Asset bundle for Chaldene Admin template
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class ChaldeneAsset extends \yii\web\AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/chl/public/assets';

    /**
     * @var string|null Theme name, see \mikbox74\Chaldene\ChaldeneThemes class.
     * No theme if null (use custom)
     */
    public $theme      = ChaldeneThemes::ALIZARIN;

    /**
     * @var boolean Theme switcher usage
     */
    //public $switcher   = false;

    /**
     * @inheritdoc
     */
    public $js = [
        'js/chl.min.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        BootstrapPluginAsset::class,
        YiiAsset::class,
        AnimateAsset::class,
        FontawesomeAsset::class,
        InViewAsset::class,
        LoadersAsset::class,
        MetisCanvasAsset::class,
        MetisMenuAsset::class,
        MomentAsset::class,
        ScreenFullAsset::class,
    ];

    /**
     * @inheritdoc
     */
    public function init($config = [])
    {
        parent::init($config);

        $rtl = ChaldeneHelper::getViewProp('rtl');

        $suffix      = $rtl ? '-rtl' : '';

        $this->css[] = 'css/chl' . $suffix . '.min.css';

        if ($this->theme !== null) {
            $this->css[] = 'css/theme-' . $this->theme . $suffix . '.min.css';
        }
//       TODO: make theme-switcher work properly someday
//        if ($this->switcher) {
//            $this->js[]  = 'js/theme-switcher.min.js';
//            $this->css[] = 'css/theme-switcher' . $suffix . '.min.css';
//        }
    }
}