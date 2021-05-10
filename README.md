# ISO-639

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
