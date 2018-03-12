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
use mikbox74\Chaldene\Base\ChaldeneWidget;

/**
 * Description of Alert
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class AlertNavitem extends ChaldeneWidget
{
    /**
     * Show number of items inside badge
     */
    const BADGE_TYPE_COUNT = 'count';

    /**
     * Show badge as dot
     */
    const BADGE_TYPE_DOT   = 'dot';

    /**
     * @var array IL tag options
     */
    public $options = [];

    /**
     * @var string Icon class
     */
    public $icon = '';

    /**
     * @var string Text must be showed if no items.
     */
    public $emptyText = '';

    /**
     * @var boolean Pulse badge
     */
    public $pulse = true;

    /**
     * @var string Badge type, see BADGE_TYPE_* constants
     */
    public $type = AlertNavitem::BADGE_TYPE_COUNT;

    /**
     * @var array|Closure Array of items, HTML or plain text strings.
     */
    public $items = [];

    /**
     * @var string Footer HTML or plain text strings.
     */
    public $footer = '';

    /**
     * @var boolean Still show the widget even if it has no items.
     */
    public $showIfEmpty = true;

    /**
     * @var array Options for dropdown menu UL tag.
     * For properly class definition use array and predefined keys from $defaultBadgeClass.
     */
    public $badgeOptions = [];

    /**
     * @var array Options for dropdown menu UL tag.
     * For properly class definition use array and predefined keys from $defaultDdClass.
     */
    public $dropDownOptions = [];

    /**
     * @var array Options for dropdown menu IL tag.
     */
    public $itemOptions = [];

    /**
     * @var array Options for footer menu IL tag.
     */
    public $footerOptions = [];

    /**
     * @var array Default classes. No need be overrided usually.
     */
    public $defaultClass = [
        'dropdown' => 'dropdown',
    ];

    /**
     * @var array Default classes. No need be overrided usually.
     */
    public $defaultDdClass = [
        'dropdown' => 'dropdown-menu',
    ];

    /**
     * @var array Default classes. No need be overrided usually.
     */
    public $defaultBadgeClass = [
        'label' => 'label',
        'color' => 'label-primary',
    ];

    /**
     * @var array Default classes. No need be overrided usually.
     */
    public $defaultPulseClass = [
        'point' => 'point',
    ];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        $this->mergeClasses('defaultClass', 'options');
        $this->mergeClasses('defaultDdClass', 'dropDownOptions');

        $defaultName = ($this->type == AlertNavitem::BADGE_TYPE_COUNT) ?
                'defaultBadgeClass' : 'defaultPulseClass';
        $this->mergeClasses($defaultName, 'badgeOptions');
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $items = [];
        if (($this->items instanceof \Closure)) {
            $func  = $this->items;
            $items = $func($this);
        } else {
            $items = $this->items;
        }
        $count = count($items);
        if (!$count && !$this->showIfEmpty) {
            return ;
        }
        //icon
        $icon  = Html::tag('span', '', ['class' => $this->icon . ' u-posRelative']);
        //badge
        $pulse = ($this->pulse ? '<span class="waves"></span>' : '');
        if ($count) {
            if ($this->type == AlertNavitem::BADGE_TYPE_COUNT) {
                $badge = $count . $pulse;
                $icon .= Html::tag('span', $badge, $this->badgeOptions);
            } else {
                $icon .= Html::tag('span', $pulse, $this->badgeOptions);
            }
        }
        //button
        $button  = Html::a($icon, '#', [
            'class'         => 'dropdown-toggle',
            'data-toggle'   => 'dropdown',
            'role'          => 'button',
            'aria-haspopup' => 'true',
            'aria-expanded' => 'false',
        ]);
        if ($count || !empty($this->emptyText)) {
            //dropdown items
            if ($count) {
                $content  = '';
                foreach ($items as $item) {
                    $content .= Html::tag('li', $item, $this->itemOptions);
                }
            } else {
                $content = Html::tag('li', $this->emptyText, $this->itemOptions);
            }
            //dropdown footer
            if (!empty($this->footer)) {
                $content .= Html::tag('li', $this->footer, $this->footerOptions);
            }
            //dropdown
            $dropdown = Html::tag('ul', $content, $this->dropDownOptions);
        } else {
            $dropdown = '';
        }

        //whole item
        return Html::tag('li', $button . $dropdown, $this->options);
    }
}