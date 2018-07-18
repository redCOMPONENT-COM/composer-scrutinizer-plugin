# Intro

This is a simple plugin made for easy integration with Scrutinizer

# Usage

In your projects `composer.json` file, you'll first have to add the `"extra"` property, this is were the plugin gets it's data from.

Inside that you'll add a property called `"scrutinizer"` and inside here you add properties for each of your nodes.

Inside the node properties you can define what packages should be downloaded.

Example:
```
"name": "vortrixs/app",
"require": {
	"vortrixs/composer-scrutinizer-plugin": "*",
	"squizlabs/php_codesniffer": "2.9.1",
	"joomla/coding-standards": "1.3.4",
	"vortrixs/joomla-namespace-checker": "1.0.0"
},
"extra": {
	"scrutinizer": {
		"phpcs": [
			"squizlabs/php_codesniffer",
			"joomla/coding-standards"
		],
		"namespace": [
			"vortrixs/joomla-namespace-checker"
		]
	}
},
```
