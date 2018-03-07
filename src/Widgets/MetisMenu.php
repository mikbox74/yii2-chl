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
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Chaldene menu widget (remastered yii\bootstrap\Nav widget)
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Михаил Ураков <mikbox74@gmail.com>
 *
 */
class MetisMenu extends \yii\base\Widget
{
    /**
     * @var array|Closure
     * list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - icon: string, required, the nav item label.
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: bool|Closure, optional, whether this menu item is visible.
     *   Defaults to true. Also can be an anonimous function returns bool.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: bool, optional, whether the item should be on active state or not.
     * - dropDownOptions: array, optional,
     *   the HTML options that will passed to the [[Dropdown]] widget.
     * - items: array|string, optional,
     *   the configuration array for creating a [[Dropdown]] widget,
     * - encode: bool, optional, whether the label will be HTML-encoded.
     *   If set, supersedes the $encodeLabels option for only this item.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     *
     * You can also define this property as anonimous function returns same array,
     * and all items will be generated right before widget rendering.
     */
    public $items = [];

    /**
     * @var bool whether the nav items labels should be HTML-encoded.
     */
    public $encodeLabels = true;

    /**
     * @var bool whether to automatically activate items according to whether their route setting
     * matches the currently requested route.
     * @see isItemActive
     */
    public $activateItems = true;

    /**
     * @var bool whether to activate parent menu items when one of the corresponding child menu items is active.
     */
    public $activateParents = false;

    /**
     * @var string the route used to determine if a menu item is active or not.
     * If not set, it will use the route of the current request.
     * @see params
     * @see isItemActive
     */
    public $route;

    /**
     * @var array the parameters used to determine if a menu item is active or not.
     * If not set, it will use `$_GET`.
     * @see route
     * @see isItemActive
     */
    public $params;

    /**
     * @var array the HTML attributes for the widget container tag.
     * For properly class definition use array and predefined keys from $defaultClass.
     *
     * @see \yii\helpers\Html::renderTagAttributes()
     *      for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array Options for dropdown menu UL tag.
     * For properly class definition use array and predefined keys from $defaultDdClass.
     */
    public $dropDownOptions = [];

    /**
     * @var array Default classes. No need be overrided usually.
     */
    public $defaultClass = [
        'metismenu'     => 'metismenu',
        'nav'           => 'nav',
        'nav-inverse'   => 'nav-inverse',
        'nav-inline'    => '', //nav-inline
        'nav-bordered'  => '', //nav-bordered
        'nav-hoverable' => '', //nav-hoverable
        'align'         => '', //is-center, is-right
    ];

    /**
     * @var array Default classes. No need be overrided usually.
     */
    public $defaultDdClass = [
        'nav-sub' => 'nav nav-sub nav-stacked',
    ];

    /**
     * @var boolean Submenu or not. No need be overrided usually.
     */
    public $isSub = false;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        if (!$this->isSub) {
            $this->options['data-plugin'] = 'metismenu';
        }
        $class = (array) ArrayHelper::getValue($this->options, 'class', []);
        $this->options['class'] = array_replace($this->defaultClass, $class);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        return $this->renderItems();
    }

    /**
     * Renders widget items.
     */
    public function renderItems()
    {
        $items = [];
        if (($this->items instanceof \Closure)) {
            $func   = $this->items;
            $config = $func($this);
        } else {
            $config = $this->items;
        }
        foreach ($config as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            } else
            if (isset($item['visible']) && ($item['visible'] instanceof \Closure)) {
                $func = $item['visible'];
                if (!$func($this)) {
                    continue;
                }
            }
            $items[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $items), $this->options);
    }

    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }

        $icon = ArrayHelper::getValue($item, 'icon', null);
        if ($icon) {
            $icon = Html::tag('i', '', ['class' => $icon]);
            $icon = Html::tag('span', $icon, ['class' => 'nav-icon']) . ' ';
        }

        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $label = Html::tag('span', $icon . $label, ['class' => 'nav-title']);

        $options = ArrayHelper::getValue($item, 'itemOptions', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        if (!empty($items) || !empty($item['badge']['label'])) {
            $badgeTag = '';
            $arrowTag = '';
            //Badge
            if (!empty($item['badge']['label'])) {
                $badge        = $item['badge'];
                $encode       = isset($badge['encode'])
                                        ? $badge['encode'] : $this->encodeLabels;
                $badgeLabel   = $encode ? Html::encode($badge['label']) : $badge['label'];
                $badgeOptions = ArrayHelper::getValue($badge, 'options', []);
                $badgeOptions['class']   = (array) $badgeOptions['class'];
                $badgeOptions['class'][] = 'label';
                $badgeTag     = Html::tag('span', $badgeLabel, $badgeOptions);
            }
            //Arrow
            if (!empty($items)) {
                $arrowClass   = 'fa fa-fw arrow';
                $parentClass  = $this->options['class'];
                if (!empty($parentClass['nav-inline']) && ($parentClass['nav-inline'] == 'nav-inline')) {
                    $arrowClass .= ' visible-xs';
                }
                $arrowTag     = Html::tag('i', '', ['class' => $arrowClass]);
            }

            $label .= Html::tag('span', $badgeTag . $arrowTag, ['class' => 'nav-tools']);
        }

        if (empty($items)) {
            $items = '';
        } else {
            if (is_array($items)) {
                $items = $this->isChildActive($items, $active);
                $items = self::widget([
                    'options'         => $this->dropDownOptions,
                    'dropDownOptions' => $this->dropDownOptions,
                    'items'           => $items,
                    'encodeLabels'    => $this->encodeLabels,
                    'view'            => $this->getView(),
                    'defaultClass'    => $this->defaultDdClass,
                    'defaultDdClass'  => $this->defaultDdClass,
                    'isSub'           => true,
                ]);
            }
        }

        if ($active) {
            Html::addCssClass($options, 'active');
        }

        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }

    /**
     * Check to see if a child item is active optionally activating the parent.
     * @param array $items @see items
     * @param bool $active should the parent be active too
     * @return array @see items
     */
    protected function isChildActive($items, &$active)
    {
        foreach ($items as $i => $child) {
            if (is_array($child) && !ArrayHelper::getValue($child, 'visible', true)) {
                continue;
            }
            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
                Html::addCssClass($items[$i]['options'], 'active');
                if ($this->activateParents) {
                    $active = true;
                }
            }
            $childItems = ArrayHelper::getValue($child, 'items');
            if (is_array($childItems)) {
                $activeParent = false;
                $items[$i]['items'] = $this->isChildActive($childItems, $activeParent);
                if ($activeParent) {
                    Html::addCssClass($items[$i]['options'], 'active');
                    $active = true;
                }
            }
        }
        return $items;
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return bool whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (!$this->activateItems) {
            return false;
        }
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this->route) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }
}