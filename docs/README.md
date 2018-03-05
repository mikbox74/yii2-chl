Yii2 extension for Chaldene Admin Template
=====================================

The extension includes support for the [Chaldene Admin Template](https://github.com/onokumus/chl) markup and adds Twitter Bootstrap CSS and JS assets besides.

This extension includes easy applicable asset bundles, HTML layouts and basic widgets.

For full effect you must configure your `assetManager` and `view` components:

```php
return [
    //...
    'components' => [
        'view' => [
            'class'   => \mikbox74\Chaldene\ChaldeneView::class,
        ],
        'assetManager'   => [
            'class' => \mikbox74\Chaldene\ChaldeneAssetManager::class,
        ],
    ],
    //...
];
```

The [[mikbox74\Chaldene\ChaldeneAssetManager|ChaldeneAssetManager]] adds necessary bundles and overrides Bootstrap and Jquery assets which are included in Chaldene assets,
so you can continue to use all their capabilities.

The [[mikbox74\Chaldene\ChaldeneView|ChaldeneView]] overrides system layout path and makes some nice magic.

