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
/**
 * Description of ChaldeneView
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class ChaldeneView extends \yii\web\View
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
     * @var array Widgets must be rendered in specified blocks
     */
    public $widgets;

    /**
     * @var boolean Show title in heading
     */
    public $showTitle = true;

    /**
     * @var boolean Fix page
     * @see http://chl.onokumus.com/third/document.html#page-fixed
     */
    public $fixPage = false;

    /**
     * @var boolean Fix sidebar content
     * @see http://chl.onokumus.com/third/document.html#side-fixed
     */
    public $fixSide = false;

    /**
     * @var boolean Fix main content
     * @see http://chl.onokumus.com/third/document.html#main-fixed
     */
    public $fixMain = false;

    /**
     * @var boolean View page as boxed
     * @see http://chl.onokumus.com/third/document.html#boxed-layout
     */
    public $boxed = false;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (!is_object($this->theme) && !isset($this->theme['class'])) {
            $this->theme['class'] = 'yii\base\Theme';
            $this->theme = Yii::createObject($this->theme);
        }

        $layoutPath = '@app/views/layouts';
        if (!isset($this->theme->pathMap[$layoutPath])) {
            $this->theme->pathMap[$layoutPath]
                = '@vendor/mikbox74/yii2-chl/src/layouts/' . $this->layout;
        }
    }

    /**
     * Counts widgets placed inside a block
     *
     * @param string $block Name of the block
     * @return integer
     */
    public function countWidgetsIn($block)
    {
        if (empty($this->widgets[$block])) {
            return 0;
        }
        return count($this->widgets[$block]);
    }

    /**
     * Renders widgets placed inside a block
     *
     * @param string $block Name of the block
     * @return string
     */
    public function renderBlock($block)
    {
        if (empty($this->widgets[$block])) {
            return;
        }
        $this->beginBlock($block);
        foreach ($this->widgets[$block] as $config) {
            echo ChaldeneHelper::widget($config);
        }
        $this->endBlock();
        return $this->blocks[$block];
    }

    /**
     * Adds breadcrumb entry for Breadcrumbs widget
     *
     * @param string $label
     * @param string|array $url
     * @param string $template
     */
    public function addCrumb($label, $url = false, $template = null)
    {
        $this->params['breadcrumbs'][] = [
            'label'    => $label,
            'url'      => $url,
            'template' => $template,
        ];
    }

    /**
     * Gets CSS classes for <body> using `fixMain`, `fixPage` and `fixSide` properties.
     * @return string
     */
    public function getBodyClass()
    {
        $class = '';
        if ($this->fixMain || $this->fixPage || $this->fixSide) {
            $class .= 'page-fixed';
        }
        if ($this->fixMain) {
            $class .= ' main-fixed';
        }
        if ($this->fixSide) {
            $class .= ' side-fixed';
        }
        return $class;
    }
}