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
 * Description of ChaldeneView
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class ChaldeneView extends \yii\base\View
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
     * @var array Widgets must be rendered in specified blocks
     */
    public $widgets;

    /**
     * @var array link+title pairs for Breadcrumbs widget
     */
    public $crumbs;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $layoutPath = '@app/views/layouts/main.php';
        if (!isset($this->theme->pathMap[$layoutPath])) {
            $this->theme->pathMap[$layoutPath]
                = '@vendor/mikbox74/yii2-chl/src/layouts' . $this->layout . '.php';
        }

        if ($this->widgets) {
            foreach ($this->widgets as $block => $widget) {
                $this->beginBlock($block);
                foreach ($widget as $config) {
                    $this->blocks[$block] .= $this->widget($config);
                }
                $this->endBlock();
            }
        }
    }

    /**
     * Counts widgets placed inside a block
     *
     * @param string $block Name of the block
     * @return integer
     */
    public function blockExists($block)
    {
        return !empty($this->blocks[$block]);
    }

    /**
     * Renders widgets placed inside a block
     *
     * @param string $block Name of the block
     * @return string
     */
    public function renderBlock($block)
    {
        return !empty($this->blocks[$block])?$this->blocks[$block]:'';
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
     * Renders widget with specified config
     *
     * @param array $config
     * @return string
     */
    public function widget($config)
    {
        /* @var $class \yii\base\Widget */
        $class = $config['class'];
        unset($config['class']);
        if (is_subclass_of($class, 'yii\base\Widget')) {
            return $class::widget($config);
        }
    }
}