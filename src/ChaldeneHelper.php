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

use Yii;
use mikbox74\Chaldene\Assets\ChaldeneAsset;
use mikbox74\Chaldene\Assets\ChaldeneAddonAsset;

/**
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class ChaldeneHelper
{

    protected static $_baseUrl;
    
    protected static $_baseAddonUrl;

    /**
     * Renders widget with specified config.
     * If config is string just returns this string.
     *
     * @param array|string|\Closure $config
     * @return string
     */
    public static function widget($config)
    {
        if (is_string($config)) {
            return $config;
        }
        if ($config instanceof \Closure) {
            $config = $config();
        }
        /* @var $class \yii\base\Widget */
        $class = $config['class'];
        unset($config['class']);
        if (is_subclass_of($class, 'yii\base\Widget')) {
            return $class::widget($config);
        }
    }

    /**
     * Returns URL to Chaldene assets directory
     * @return string
     */
    public static function getAssetUrl()
    {
        if (self::$_baseUrl === null) {
            $bundle = Yii::$app->assetManager->getBundle(ChaldeneAsset::class);
            self::$_baseUrl = $bundle->baseUrl;
        }
        return self::$_baseUrl;
    }

    /**
     * Returns URL to ChaldeneAddon assets directory
     * @return string
     */
    public static function getAddonAssetUrl()
    {
        if (self::$_baseAddonUrl === null) {
            $bundle = Yii::$app->assetManager->getBundle(ChaldeneAddonAsset::class);
            self::$_baseAddonUrl = $bundle->baseUrl;
        }
        return self::$_baseAddonUrl;
    }

    /**
     * Get property of \mikbox74\Chaldene\Assets\ChaldeneAsset by name
     *
     * @param string $name
     * @return mixed
     */
    public static function getAssetProp($name)
    {
        $bundle = Yii::$app->assetManager->getBundle(ChaldeneAsset::class);
        return isset($bundle->{$name}) ? $bundle->{$name} : null;
    }

    /**
     * Get property of current view by name
     *
     * @param string $name
     * @return mixed
     */
    public static function getViewProp($name)
    {
        $view = Yii::$app->getView();
        return isset($view->{$name}) ? $view->{$name} : null;
    }
}