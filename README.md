# ISO-639

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/iso639.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/iso639)
[![MIT License](https://img.shields.io/github/license/Astrotomic/iso639.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/iso639/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://plant.treeware.earth/Astrotomic/iso639)
[![Larabelles](https://img.shields.io/badge/Larabelles-%F0%9F%A6%84-lightpink?style=for-the-badge)](https://www.larabelles.com/)

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/Astrotomic/iso639/run-tests?style=flat-square&logoColor=white&logo=github&label=Tests)](https://github.com/Astrotomic/iso639/actions?query=workflow%3Arun-tests)
[![StyleCI](https://styleci.io/repos/284008331/shield)](https://styleci.io/repos/284008331)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/iso639.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/iso639)

A PHP library providing ISO 639-1 data.

## Installing

```bash
composer require astrotomic/iso639
```

## Usage

```php
use Astrotomic\ISO639\ISO639;

$iso639 = new ISO639();

// dataset methods
$iso639->count();
$iso639->all();
$iso639->all(ISO639::KEY_639_1);
$iso639->iterator(ISO639::KEY_639_1);

// language retriever
$iso639->name('German');
$iso639->alpha2('de');

// ISO specific methods
$iso639->iso639_1('de');
$iso639->iso639_2B('ger');
$iso639->iso639_2T('deu');
```
