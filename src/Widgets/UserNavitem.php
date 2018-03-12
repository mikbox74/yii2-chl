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
use yii\helpers\ArrayHelper;
use mikbox74\Chaldene\Base\ChaldeneWidget;

/**
 * Description of UserNavitem
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class UserNavitem extends ChaldeneWidget
{
    /**
     * @var array|Closure Array of items, HTML or plain text strings.
     * Each item structure:
     * - icon (string)  CSS class for I tag (gyphicon, fontawesome etc).
     * - label (string) Label of menu item.
     * - link (string)  Link of menu item.
     * - badge (string) Text for badge. No badge will be shown if not set
     * - badgeClass (string) CSS class for badge tag (will be used with 'label pull-right ' prefix)
     * - visible (boolean) Sow this item or not. True if not set.
     */
    public $items = [];

    /**
     * @var array IL tag options
     * For properly class definition use array and predefined keys from $defaultClass.
     */
    public $options = [];

    /**
     * @var array Default classes. No need be overrided usually.
     *
     * ```php
     *  [
     *      'dropdown' => 'dropdown',
     *  ]
     * ```
     */
    public $defaultClass = [
        'dropdown' => 'dropdown',
    ];

    /**
     * @var array A tag options
     * For properly class definition use array and predefined keys from $defaultButtonClass.
     */
    public $buttonOptions = [];

    /**
     * @var array Default classes of A tag. No need be overrided usually.
     *
     * ```php
     *  [
     *      'dropdown-toggle' => 'dropdown-toggle',
     *      'profile-pic'     => 'profile-pic',
     *  ]
     * ```
     */
    public $defaultButtonClass = [
        'dropdown-toggle' => 'dropdown-toggle',
        'profile-pic'     => 'profile-pic',
    ];

    /**
     * @var array Options for dropdown menu UL tag.
     * For properly class definition use array and predefined keys from $defaultDdClass.
     */
    public $dropDownOptions = [];

    /**
     * @var array Default classes. No need be overrided usually.
     *
     * ```php
     *  [
     *      'dropdown-menu' => 'dropdown-menu',
     *      'pull-right'    => 'pull-right',
     *      'animated'      => 'animated',
     *      'fadeInDown'    => 'fadeInDown',
     *  ]
     * ```
     */
    public $defaultDdClass = [
        'dropdown-menu' => 'dropdown-menu',
        'pull-right'    => 'pull-right',
        'animated'      => 'animated',
        'fadeInDown'    => 'fadeInDown',
    ];

    /**
     * @var string Userpic URL. Userpic will be not shown if this property empty.
     */
    public $userPic = '';

    /**
     * @var array Options for userpic IMG tag.
     * For properly class definition use array and predefined keys from $defaultPicClass.
     */
    public $userPicOptions = [];

    /**
     * @var array Default classes for userpic IMG tag. No need be overrided usually.
     *
     * ```php
     *  [
     *      'img-circle' => 'img-circle',
     *  ]
     * ```
     */
    public $defaultPicClass = [
        'img-circle' => 'img-circle',
    ];

    /**
     * @var string Username.
     */
    public $userName = '';

    /**
     * @var array Options for dropdown menu UL tag.
     * For properly class definition use array and predefined keys from $defaultNameOptions.
     */
    public $userNameOptions = [];

    /**
     * @var array Default classes for user name B tag. No need be overrided usually.
     *
     * ```php
     *  [
     *      'hidden-xs' => 'hidden-xs',
     *      'hidden-sm' => 'hidden-sm',
     *  ]
     * ```
     */
    public $defaultNameOptions = [
        'hidden-xs' => 'hidden-xs',
        'hidden-sm' => 'hidden-sm',
    ];

    /**
     * @var array Options for menu item LI tag.
     */
    public $itemOptions = [];

    /**
     * @var boolean Still show the widget even if it has no items.
     */
    public $showIfEmpty = true;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        $this->mergeClasses('defaultClass', 'options');
        $this->mergeClasses('defaultDdClass', 'dropDownOptions');
        $this->mergeClasses('defaultButtonClass', 'buttonOptions');
        $this->mergeClasses('defaultNameOptions', 'userNameOptions');
        $this->mergeClasses('defaultPicClass', 'userPicOptions');

        $this->buttonOptions = array_replace([
            'href'          => '#',
            'data-toggle'   => "dropdown",
            'role'          => "button",
            'aria-haspopup' => "true",
            'aria-expanded' => "false",
        ], $this->buttonOptions);

        $this->dropDownOptions = array_replace([
            'encode'      => false,
            'itemOptions' => $this->itemOptions,
        ], $this->dropDownOptions);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $items = [];
        if (($this->items instanceof \Closure)) {
            $func   = $this->items;
            $config = $func($this);
        } else {
            $config = $this->items;
        }
        if (!count($items) && !$this->showIfEmpty) {
            return ;
        }
        foreach ($config as $itemConfig) {
            $item = '';
            if (is_string($itemConfig)) {
                $item = $itemConfig;
            } else {
                $label      = ArrayHelper::getValue($itemConfig, 'label', null);
                $link       = ArrayHelper::getValue($itemConfig, 'link', '#');
                $visible    = ArrayHelper::getValue($itemConfig, 'visible', true);
                $icon       = ArrayHelper::getValue($itemConfig, 'icon', null);
                $badge      = ArrayHelper::getValue($itemConfig, 'badge', null);
                $badgeClass = ArrayHelper::getValue($itemConfig, 'badgeClass', null);
                if (empty($label) || !$visible) {
                    continue;
                }
                if (!empty($icon)) {
                    $item .= '<i class="' . $icon . '"></i>';
                }
                $item .= $label;
                if ($badge) {
                    $item .= '<span class="label pull-right ' . $badgeClass . '">' . $badge . '</span>';
                }
                $item = '<a href="' . $link . '">' . $item . '</a>';
            }
            $items[] = $item;
        }

        //userpic
        if (!empty($this->userPic)) {
            $userPic = Html::img($this->userPic, $this->userPicOptions);
        } else {
            $userPic = '';
        }

        //user name
        $userName = Html::tag('b', $this->userName, $this->userNameOptions);

        //button
        $button  = Html::tag('a', $userPic . $userName, $this->buttonOptions);

        //dropdown
        $dropdown = Html::ul($items, $this->dropDownOptions);

        //whole item
        return Html::tag('li', $button . $dropdown, $this->options);
    }
}