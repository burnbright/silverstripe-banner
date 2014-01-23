# SilverStripe banner

Provides a simple framework for adding banners to pages.

## Features

 * introduces a 'Banners' CMS section.
 * Set title, subtitle, link
 * Choose an image
 * Sort banners

## Install

Incldude the module via composer:

```
composer require burnbright/silverstripe-banner 1.x
```

Add the `BannersExtension` to a page type in your yaml config:
```yaml
Page:
	extensions:
		- 'BannersExtension'
```

## License

BSD2