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
use yii\helpers\Html;
use mikbox74\Chaldene\Base\ChaldeneWidget;

/**
 * Description of Breadcrumbs
 *
 * @author Михаил Ураков <mikbox74@gmail.com>
 */
class Breadcrumbs extends ChaldeneWidget
{

    public $tag = 'span';

    public $itemTemplate = "{link}\n";

    public $activeItemTemplate = "<span class=\"active\">{link}</span>\n";

    public $options = [];

    public $separator = '/';

    public $links = [];

    public function init()
    {
        parent::init();
        $params = $this->getView()->params;
        $this->links = !empty($params['breadcrumbs']) ? $params['breadcrumbs'] : [];
    }
    /**
     * Renders the widget.
     */
    public function run()
    {
        if (empty($this->links)) {
            return;
        }
        $links = [];
        if ($this->homeLink === null) {
            $links[] = $this->renderItem([
                'label' => Yii::t('yii', 'Home'),
                'url' => Yii::$app->homeUrl,
            ], $this->itemTemplate);
        } elseif ($this->homeLink !== false) {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }
        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }
            $links[] = $this->renderItem($link, isset($link['url'])
                    ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag($this->tag, implode(' ' . $this->separator . ' ', $links), $this->options);
    }
}