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

namespace mikbox74\Chaldene\Widgets\Base;

use yii\helpers\ArrayHelper;
/**
 * Description of ChaldeneWidget
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
abstract class ChaldeneWidget extends \yii\base\Widget
{

    /**
     * Mix default CSS classes with new classes of a tag
     *
     * @param string $defaultPropName Name of the property containing default CSS classes
     * @param string $optionsPropName name of the property containing tag options
     */
    protected function mergeClasses($defaultPropName, $optionsPropName)
    {
        $class = (array) ArrayHelper::getValue($this->{$optionsPropName}, 'class', []);
        $this->{$optionsPropName}['class'] = array_replace($this->{$defaultPropName}, $class);
    }

    /**
     * Initializes the widget.
     */
    public function init()
    {
        if ($this->hasProperty('options')) {
            if (!isset($this->options['id'])) {
                $this->options['id'] = $this->getId();
            }
        }
    }
}