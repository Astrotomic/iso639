<?php

namespace Astrotomic\ISO639;

use Countable;
use Generator;
use InvalidArgumentException;
use IteratorAggregate;
use OutOfBoundsException;

class ISO639 implements Countable, IteratorAggregate
{
    public const KEY_639_1 = '639-1';
    public const KEY_639_2B = '639-2/B';
    public const KEY_639_2T = '639-2/T';
    public const KEY_NAME = 'name';

    protected const KEYS = [
        self::KEY_639_1,
        self::KEY_639_2B,
        self::KEY_639_2T,
        self::KEY_NAME,
    ];

    protected array $languages;

    public function __construct(?array $languages = null)
    {
        $this->languages = $languages ?? self::LANGUAGES;
    }

    public function name(string $name): array
    {
        return $this->lookup(self::KEY_NAME, $name);
    }

    public function iso639_1(string $code): array
    {
        return $this->lookup(self::KEY_639_1, $code);
    }

    public function iso639_2T(string $code): array
    {
        return $this->lookup(self::KEY_639_2T, $code);
    }

    public function iso639_2B(string $code): array
    {
        return $this->lookup(self::KEY_639_2B, $code);
    }

    public function all(): array
    {
        return $this->languages;
    }

    public function iterator(string $indexBy = self::KEY_639_1): Generator
    {
        if (! in_array($indexBy, self::KEYS, true)) {
            throw new InvalidArgumentException(sprintf('Invalid value for $indexBy, got "%s", expected one of: %s', $indexBy, implode(', ', self::KEYS)));
        }

        foreach ($this->languages as $language) {
            yield $language[$indexBy] => $language;
        }
    }

    public function count(): int
    {
        return count($this->languages);
    }

    public function getIterator(): Generator
    {
        foreach ($this->languages as $language) {
            yield $language;
        }
    }

    protected function lookup($key, $value): array
    {
        foreach ($this->languages as $language) {
            if (strcasecmp($value, $language[$key]) === 0) {
                return $language;
            }
        }

        throw new OutOfBoundsException(sprintf('No "%s" key found matching: %s', $key, $value));
    }

    protected const LANGUAGES = [
        [
            self::KEY_NAME => 'Abkhazian',
            self::KEY_639_1 => 'ab',
            self::KEY_639_2T => 'abk',
            self::KEY_639_2B => 'abk',
        ],
        [
            self::KEY_NAME => 'Afar',
            self::KEY_639_1 => 'aa',
            self::KEY_639_2T => 'aar',
            self::KEY_639_2B => 'aar',
        ],
        [
            self::KEY_NAME => 'Afrikaans',
            self::KEY_639_1 => 'af',
            self::KEY_639_2T => 'afr',
            self::KEY_639_2B => 'afr',
        ],
        [
            self::KEY_NAME => 'Akan',
            self::KEY_639_1 => 'ak',
            self::KEY_639_2T => 'aka',
            self::KEY_639_2B => 'aka',
        ],
        [
            self::KEY_NAME => 'Albanian',
            self::KEY_639_1 => 'sq',
            self::KEY_639_2T => 'sqi',
            self::KEY_639_2B => 'alb',
        ],
        [
            self::KEY_NAME => 'Amharic',
            self::KEY_639_1 => 'am',
            self::KEY_639_2T => 'amh',
            self::KEY_639_2B => 'amh',
        ],
        [
            self::KEY_NAME => 'Arabic',
            self::KEY_639_1 => 'ar',
            self::KEY_639_2T => 'ara',
            self::KEY_639_2B => 'ara',
        ],
        [
            self::KEY_NAME => 'Aragonese',
            self::KEY_639_1 => 'an',
            self::KEY_639_2T => 'arg',
            self::KEY_639_2B => 'arg',
        ],
        [
            self::KEY_NAME => 'Armenian',
            self::KEY_639_1 => 'hy',
            self::KEY_639_2T => 'hye',
            self::KEY_639_2B => 'arm',
        ],
        [
            self::KEY_NAME => 'Assamese',
            self::KEY_639_1 => 'as',
            self::KEY_639_2T => 'asm',
            self::KEY_639_2B => 'asm',
        ],
        [
            self::KEY_NAME => 'Avaric',
            self::KEY_639_1 => 'av',
            self::KEY_639_2T => 'ava',
            self::KEY_639_2B => 'ava',
        ],
        [
            self::KEY_NAME => 'Avestan',
            self::KEY_639_1 => 'ae',
            self::KEY_639_2T => 'ave',
            self::KEY_639_2B => 'ave',
        ],
        [
            self::KEY_NAME => 'Aymara',
            self::KEY_639_1 => 'ay',
            self::KEY_639_2T => 'aym',
            self::KEY_639_2B => 'aym',
        ],
        [
            self::KEY_NAME => 'Azerbaijani',
            self::KEY_639_1 => 'az',
            self::KEY_639_2T => 'aze',
            self::KEY_639_2B => 'aze',
        ],
        [
            self::KEY_NAME => 'Bambara',
            self::KEY_639_1 => 'bm',
            self::KEY_639_2T => 'bam',
            self::KEY_639_2B => 'bam',
        ],
        [
            self::KEY_NAME => 'Bashkir',
            self::KEY_639_1 => 'ba',
            self::KEY_639_2T => 'bak',
            self::KEY_639_2B => 'bak',
        ],
        [
            self::KEY_NAME => 'Basque',
            self::KEY_639_1 => 'eu',
            self::KEY_639_2T => 'eus',
            self::KEY_639_2B => 'baq',
        ],
        [
            self::KEY_NAME => 'Belarusian',
            self::KEY_639_1 => 'be',
            self::KEY_639_2T => 'bel',
            self::KEY_639_2B => 'bel',
        ],
        [
            self::KEY_NAME => 'Bengali',
            self::KEY_639_1 => 'bn',
            self::KEY_639_2T => 'ben',
            self::KEY_639_2B => 'ben',
        ],
        [
            self::KEY_NAME => 'Bihari languages',
            self::KEY_639_1 => 'bh',
            self::KEY_639_2T => 'bih',
            self::KEY_639_2B => 'bih',
        ],
        [
            self::KEY_NAME => 'Bislama',
            self::KEY_639_1 => 'bi',
            self::KEY_639_2T => 'bis',
            self::KEY_639_2B => 'bis',
        ],
        [
            self::KEY_NAME => 'Bosnian',
            self::KEY_639_1 => 'bs',
            self::KEY_639_2T => 'bos',
            self::KEY_639_2B => 'bos',
        ],
        [
            self::KEY_NAME => 'Breton',
            self::KEY_639_1 => 'br',
            self::KEY_639_2T => 'bre',
            self::KEY_639_2B => 'bre',
        ],
        [
            self::KEY_NAME => 'Bulgarian',
            self::KEY_639_1 => 'bg',
            self::KEY_639_2T => 'bul',
            self::KEY_639_2B => 'bul',
        ],
        [
            self::KEY_NAME => 'Burmese',
            self::KEY_639_1 => 'my',
            self::KEY_639_2T => 'mya',
            self::KEY_639_2B => 'bur',
        ],
        [
            self::KEY_NAME => 'Catalan, Valencian',
            self::KEY_639_1 => 'ca',
            self::KEY_639_2T => 'cat',
            self::KEY_639_2B => 'cat',
        ],
        [
            self::KEY_NAME => 'Chamorro',
            self::KEY_639_1 => 'ch',
            self::KEY_639_2T => 'cha',
            self::KEY_639_2B => 'cha',
        ],
        [
            self::KEY_NAME => 'Chechen',
            self::KEY_639_1 => 'ce',
            self::KEY_639_2T => 'che',
            self::KEY_639_2B => 'che',
        ],
        [
            self::KEY_NAME => 'Chichewa, Chewa, Nyanja',
            self::KEY_639_1 => 'ny',
            self::KEY_639_2T => 'nya',
            self::KEY_639_2B => 'nya',
        ],
        [
            self::KEY_NAME => 'Chinese',
            self::KEY_639_1 => 'zh',
            self::KEY_639_2T => 'zho',
            self::KEY_639_2B => 'chi',
        ],
        [
            self::KEY_NAME => 'Chuvash',
            self::KEY_639_1 => 'cv',
            self::KEY_639_2T => 'chv',
            self::KEY_639_2B => 'chv',
        ],
        [
            self::KEY_NAME => 'Cornish',
            self::KEY_639_1 => 'kw',
            self::KEY_639_2T => 'cor',
            self::KEY_639_2B => 'cor',
        ],
        [
            self::KEY_NAME => 'Corsican',
            self::KEY_639_1 => 'co',
            self::KEY_639_2T => 'cos',
            self::KEY_639_2B => 'cos',
        ],
        [
            self::KEY_NAME => 'Cree',
            self::KEY_639_1 => 'cr',
            self::KEY_639_2T => 'cre',
            self::KEY_639_2B => 'cre',
        ],
        [
            self::KEY_NAME => 'Croatian',
            self::KEY_639_1 => 'hr',
            self::KEY_639_2T => 'hrv',
            self::KEY_639_2B => 'hrv',
        ],
        [
            self::KEY_NAME => 'Czech',
            self::KEY_639_1 => 'cs',
            self::KEY_639_2T => 'ces',
            self::KEY_639_2B => 'cze',
        ],
        [
            self::KEY_NAME => 'Danish',
            self::KEY_639_1 => 'da',
            self::KEY_639_2T => 'dan',
            self::KEY_639_2B => 'dan',
        ],
        [
            self::KEY_NAME => 'Divehi, Dhivehi, Maldivian',
            self::KEY_639_1 => 'dv',
            self::KEY_639_2T => 'div',
            self::KEY_639_2B => 'div',
        ],
        [
            self::KEY_NAME => 'Dutch, Flemish',
            self::KEY_639_1 => 'nl',
            self::KEY_639_2T => 'nld',
            self::KEY_639_2B => 'dut',
        ],
        [
            self::KEY_NAME => 'Dzongkha',
            self::KEY_639_1 => 'dz',
            self::KEY_639_2T => 'dzo',
            self::KEY_639_2B => 'dzo',
        ],
        [
            self::KEY_NAME => 'English',
            self::KEY_639_1 => 'en',
            self::KEY_639_2T => 'eng',
            self::KEY_639_2B => 'eng',
        ],
        [
            self::KEY_NAME => 'Esperanto',
            self::KEY_639_1 => 'eo',
            self::KEY_639_2T => 'epo',
            self::KEY_639_2B => 'epo',
        ],
        [
            self::KEY_NAME => 'Estonian',
            self::KEY_639_1 => 'et',
            self::KEY_639_2T => 'est',
            self::KEY_639_2B => 'est',
        ],
        [
            self::KEY_NAME => 'Ewe',
            self::KEY_639_1 => 'ee',
            self::KEY_639_2T => 'ewe',
            self::KEY_639_2B => 'ewe',
        ],
        [
            self::KEY_NAME => 'Faroese',
            self::KEY_639_1 => 'fo',
            self::KEY_639_2T => 'fao',
            self::KEY_639_2B => 'fao',
        ],
        [
            self::KEY_NAME => 'Fijian',
            self::KEY_639_1 => 'fj',
            self::KEY_639_2T => 'fij',
            self::KEY_639_2B => 'fij',
        ],
        [
            self::KEY_NAME => 'Finnish',
            self::KEY_639_1 => 'fi',
            self::KEY_639_2T => 'fin',
            self::KEY_639_2B => 'fin',
        ],
        [
            self::KEY_NAME => 'French',
            self::KEY_639_1 => 'fr',
            self::KEY_639_2T => 'fra',
            self::KEY_639_2B => 'fre',
        ],
        [
            self::KEY_NAME => 'Fulah',
            self::KEY_639_1 => 'ff',
            self::KEY_639_2T => 'ful',
            self::KEY_639_2B => 'ful',
        ],
        [
            self::KEY_NAME => 'Galician',
            self::KEY_639_1 => 'gl',
            self::KEY_639_2T => 'glg',
            self::KEY_639_2B => 'glg',
        ],
        [
            self::KEY_NAME => 'Georgian',
            self::KEY_639_1 => 'ka',
            self::KEY_639_2T => 'kat',
            self::KEY_639_2B => 'geo',
        ],
        [
            self::KEY_NAME => 'German',
            self::KEY_639_1 => 'de',
            self::KEY_639_2T => 'deu',
            self::KEY_639_2B => 'ger',
        ],
        [
            self::KEY_NAME => 'Greek, Modern (1453–)',
            self::KEY_639_1 => 'el',
            self::KEY_639_2T => 'ell',
            self::KEY_639_2B => 'gre',
        ],
        [
            self::KEY_NAME => 'Guarani',
            self::KEY_639_1 => 'gn',
            self::KEY_639_2T => 'grn',
            self::KEY_639_2B => 'grn',
        ],
        [
            self::KEY_NAME => 'Gujarati',
            self::KEY_639_1 => 'gu',
            self::KEY_639_2T => 'guj',
            self::KEY_639_2B => 'guj',
        ],
        [
            self::KEY_NAME => 'Haitian, Haitian Creole',
            self::KEY_639_1 => 'ht',
            self::KEY_639_2T => 'hat',
            self::KEY_639_2B => 'hat',
        ],
        [
            self::KEY_NAME => 'Hausa',
            self::KEY_639_1 => 'ha',
            self::KEY_639_2T => 'hau',
            self::KEY_639_2B => 'hau',
        ],
        [
            self::KEY_NAME => 'Hebrew',
            self::KEY_639_1 => 'he',
            self::KEY_639_2T => 'heb',
            self::KEY_639_2B => 'heb',
        ],
        [
            self::KEY_NAME => 'Herero',
            self::KEY_639_1 => 'hz',
            self::KEY_639_2T => 'her',
            self::KEY_639_2B => 'her',
        ],
        [
            self::KEY_NAME => 'Hindi',
            self::KEY_639_1 => 'hi',
            self::KEY_639_2T => 'hin',
            self::KEY_639_2B => 'hin',
        ],
        [
            self::KEY_NAME => 'Hiri Motu',
            self::KEY_639_1 => 'ho',
            self::KEY_639_2T => 'hmo',
            self::KEY_639_2B => 'hmo',
        ],
        [
            self::KEY_NAME => 'Hungarian',
            self::KEY_639_1 => 'hu',
            self::KEY_639_2T => 'hun',
            self::KEY_639_2B => 'hun',
        ],
        [
            self::KEY_NAME => 'Interlingua (International Auxiliary Language Association)',
            self::KEY_639_1 => 'ia',
            self::KEY_639_2T => 'ina',
            self::KEY_639_2B => 'ina',
        ],
        [
            self::KEY_NAME => 'Indonesian',
            self::KEY_639_1 => 'id',
            self::KEY_639_2T => 'ind',
            self::KEY_639_2B => 'ind',
        ],
        [
            self::KEY_NAME => 'Interlingue, Occidental',
            self::KEY_639_1 => 'ie',
            self::KEY_639_2T => 'ile',
            self::KEY_639_2B => 'ile',
        ],
        [
            self::KEY_NAME => 'Irish',
            self::KEY_639_1 => 'ga',
            self::KEY_639_2T => 'gle',
            self::KEY_639_2B => 'gle',
        ],
        [
            self::KEY_NAME => 'Igbo',
            self::KEY_639_1 => 'ig',
            self::KEY_639_2T => 'ibo',
            self::KEY_639_2B => 'ibo',
        ],
        [
            self::KEY_NAME => 'Inupiaq',
            self::KEY_639_1 => 'ik',
            self::KEY_639_2T => 'ipk',
            self::KEY_639_2B => 'ipk',
        ],
        [
            self::KEY_NAME => 'Ido',
            self::KEY_639_1 => 'io',
            self::KEY_639_2T => 'ido',
            self::KEY_639_2B => 'ido',
        ],
        [
            self::KEY_NAME => 'Icelandic',
            self::KEY_639_1 => 'is',
            self::KEY_639_2T => 'isl',
            self::KEY_639_2B => 'ice',
        ],
        [
            self::KEY_NAME => 'Italian',
            self::KEY_639_1 => 'it',
            self::KEY_639_2T => 'ita',
            self::KEY_639_2B => 'ita',
        ],
        [
            self::KEY_NAME => 'Inuktitut',
            self::KEY_639_1 => 'iu',
            self::KEY_639_2T => 'iku',
            self::KEY_639_2B => 'iku',
        ],
        [
            self::KEY_NAME => 'Japanese',
            self::KEY_639_1 => 'ja',
            self::KEY_639_2T => 'jpn',
            self::KEY_639_2B => 'jpn',
        ],
        [
            self::KEY_NAME => 'Javanese',
            self::KEY_639_1 => 'jv',
            self::KEY_639_2T => 'jav',
            self::KEY_639_2B => 'jav',
        ],
        [
            self::KEY_NAME => 'Kalaallisut, Greenlandic',
            self::KEY_639_1 => 'kl',
            self::KEY_639_2T => 'kal',
            self::KEY_639_2B => 'kal',
        ],
        [
            self::KEY_NAME => 'Kannada',
            self::KEY_639_1 => 'kn',
            self::KEY_639_2T => 'kan',
            self::KEY_639_2B => 'kan',
        ],
        [
            self::KEY_NAME => 'Kanuri',
            self::KEY_639_1 => 'kr',
            self::KEY_639_2T => 'kau',
            self::KEY_639_2B => 'kau',
        ],
        [
            self::KEY_NAME => 'Kashmiri',
            self::KEY_639_1 => 'ks',
            self::KEY_639_2T => 'kas',
            self::KEY_639_2B => 'kas',
        ],
        [
            self::KEY_NAME => 'Kazakh',
            self::KEY_639_1 => 'kk',
            self::KEY_639_2T => 'kaz',
            self::KEY_639_2B => 'kaz',
        ],
        [
            self::KEY_NAME => 'Central Khmer',
            self::KEY_639_1 => 'km',
            self::KEY_639_2T => 'khm',
            self::KEY_639_2B => 'khm',
        ],
        [
            self::KEY_NAME => 'Kikuyu, Gikuyu',
            self::KEY_639_1 => 'ki',
            self::KEY_639_2T => 'kik',
            self::KEY_639_2B => 'kik',
        ],
        [
            self::KEY_NAME => 'Kinyarwanda',
            self::KEY_639_1 => 'rw',
            self::KEY_639_2T => 'kin',
            self::KEY_639_2B => 'kin',
        ],
        [
            self::KEY_NAME => 'Kirghiz, Kyrgyz',
            self::KEY_639_1 => 'ky',
            self::KEY_639_2T => 'kir',
            self::KEY_639_2B => 'kir',
        ],
        [
            self::KEY_NAME => 'Komi',
            self::KEY_639_1 => 'kv',
            self::KEY_639_2T => 'kom',
            self::KEY_639_2B => 'kom',
        ],
        [
            self::KEY_NAME => 'Kongo',
            self::KEY_639_1 => 'kg',
            self::KEY_639_2T => 'kon',
            self::KEY_639_2B => 'kon',
        ],
        [
            self::KEY_NAME => 'Korean',
            self::KEY_639_1 => 'ko',
            self::KEY_639_2T => 'kor',
            self::KEY_639_2B => 'kor',
        ],
        [
            self::KEY_NAME => 'Kurdish',
            self::KEY_639_1 => 'ku',
            self::KEY_639_2T => 'kur',
            self::KEY_639_2B => 'kur',
        ],
        [
            self::KEY_NAME => 'Kuanyama, Kwanyama',
            self::KEY_639_1 => 'kj',
            self::KEY_639_2T => 'kua',
            self::KEY_639_2B => 'kua',
        ],
        [
            self::KEY_NAME => 'Latin',
            self::KEY_639_1 => 'la',
            self::KEY_639_2T => 'lat',
            self::KEY_639_2B => 'lat',
        ],
        [
            self::KEY_NAME => 'Luxembourgish, Letzeburgesch',
            self::KEY_639_1 => 'lb',
            self::KEY_639_2T => 'ltz',
            self::KEY_639_2B => 'ltz',
        ],
        [
            self::KEY_NAME => 'Ganda',
            self::KEY_639_1 => 'lg',
            self::KEY_639_2T => 'lug',
            self::KEY_639_2B => 'lug',
        ],
        [
            self::KEY_NAME => 'Limburgan, Limburger, Limburgish',
            self::KEY_639_1 => 'li',
            self::KEY_639_2T => 'lim',
            self::KEY_639_2B => 'lim',
        ],
        [
            self::KEY_NAME => 'Lingala',
            self::KEY_639_1 => 'ln',
            self::KEY_639_2T => 'lin',
            self::KEY_639_2B => 'lin',
        ],
        [
            self::KEY_NAME => 'Lao',
            self::KEY_639_1 => 'lo',
            self::KEY_639_2T => 'lao',
            self::KEY_639_2B => 'lao',
        ],
        [
            self::KEY_NAME => 'Lithuanian',
            self::KEY_639_1 => 'lt',
            self::KEY_639_2T => 'lit',
            self::KEY_639_2B => 'lit',
        ],
        [
            self::KEY_NAME => 'Luba-Katanga',
            self::KEY_639_1 => 'lu',
            self::KEY_639_2T => 'lub',
            self::KEY_639_2B => 'lub',
        ],
        [
            self::KEY_NAME => 'Latvian',
            self::KEY_639_1 => 'lv',
            self::KEY_639_2T => 'lav',
            self::KEY_639_2B => 'lav',
        ],
        [
            self::KEY_NAME => 'Manx',
            self::KEY_639_1 => 'gv',
            self::KEY_639_2T => 'glv',
            self::KEY_639_2B => 'glv',
        ],
        [
            self::KEY_NAME => 'Macedonian',
            self::KEY_639_1 => 'mk',
            self::KEY_639_2T => 'mkd',
            self::KEY_639_2B => 'mac',
        ],
        [
            self::KEY_NAME => 'Malagasy',
            self::KEY_639_1 => 'mg',
            self::KEY_639_2T => 'mlg',
            self::KEY_639_2B => 'mlg',
        ],
        [
            self::KEY_NAME => 'Malay',
            self::KEY_639_1 => 'ms',
            self::KEY_639_2T => 'msa',
            self::KEY_639_2B => 'may',
        ],
        [
            self::KEY_NAME => 'Malayalam',
            self::KEY_639_1 => 'ml',
            self::KEY_639_2T => 'mal',
            self::KEY_639_2B => 'mal',
        ],
        [
            self::KEY_NAME => 'Maltese',
            self::KEY_639_1 => 'mt',
            self::KEY_639_2T => 'mlt',
            self::KEY_639_2B => 'mlt',
        ],
        [
            self::KEY_NAME => 'Māori',
            self::KEY_639_1 => 'mi',
            self::KEY_639_2T => 'mri',
            self::KEY_639_2B => 'mao',
        ],
        [
            self::KEY_NAME => 'Marathi',
            self::KEY_639_1 => 'mr',
            self::KEY_639_2T => 'mar',
            self::KEY_639_2B => 'mar',
        ],
        [
            self::KEY_NAME => 'Marshallese',
            self::KEY_639_1 => 'mh',
            self::KEY_639_2T => 'mah',
            self::KEY_639_2B => 'mah',
        ],
        [
            self::KEY_NAME => 'Mongolian',
            self::KEY_639_1 => 'mn',
            self::KEY_639_2T => 'mon',
            self::KEY_639_2B => 'mon',
        ],
        [
            self::KEY_NAME => 'Nauru',
            self::KEY_639_1 => 'na',
            self::KEY_639_2T => 'nau',
            self::KEY_639_2B => 'nau',
        ],
        [
            self::KEY_NAME => 'Navajo, Navaho',
            self::KEY_639_1 => 'nv',
            self::KEY_639_2T => 'nav',
            self::KEY_639_2B => 'nav',
        ],
        [
            self::KEY_NAME => 'North Ndebele',
            self::KEY_639_1 => 'nd',
            self::KEY_639_2T => 'nde',
            self::KEY_639_2B => 'nde',
        ],
        [
            self::KEY_NAME => 'Nepali',
            self::KEY_639_1 => 'ne',
            self::KEY_639_2T => 'nep',
            self::KEY_639_2B => 'nep',
        ],
        [
            self::KEY_NAME => 'Ndonga',
            self::KEY_639_1 => 'ng',
            self::KEY_639_2T => 'ndo',
            self::KEY_639_2B => 'ndo',
        ],
        [
            self::KEY_NAME => 'Norwegian Bokmål',
            self::KEY_639_1 => 'nb',
            self::KEY_639_2T => 'nob',
            self::KEY_639_2B => 'nob',
        ],
        [
            self::KEY_NAME => 'Norwegian Nynorsk',
            self::KEY_639_1 => 'nn',
            self::KEY_639_2T => 'nno',
            self::KEY_639_2B => 'nno',
        ],
        [
            self::KEY_NAME => 'Norwegian',
            self::KEY_639_1 => 'no',
            self::KEY_639_2T => 'nor',
            self::KEY_639_2B => 'nor',
        ],
        [
            self::KEY_NAME => 'Sichuan Yi, Nuosu',
            self::KEY_639_1 => 'ii',
            self::KEY_639_2T => 'iii',
            self::KEY_639_2B => 'iii',
        ],
        [
            self::KEY_NAME => 'South Ndebele',
            self::KEY_639_1 => 'nr',
            self::KEY_639_2T => 'nbl',
            self::KEY_639_2B => 'nbl',
        ],
        [
            self::KEY_NAME => 'Occitan',
            self::KEY_639_1 => 'oc',
            self::KEY_639_2T => 'oci',
            self::KEY_639_2B => 'oci',
        ],
        [
            self::KEY_NAME => 'Ojibwa',
            self::KEY_639_1 => 'oj',
            self::KEY_639_2T => 'oji',
            self::KEY_639_2B => 'oji',
        ],
        [
            self::KEY_NAME => 'Church Slavic, Old Slavonic, Church Slavonic, Old Bulgarian, Old Church Slavonic',
            self::KEY_639_1 => 'cu',
            self::KEY_639_2T => 'chu',
            self::KEY_639_2B => 'chu',
        ],
        [
            self::KEY_NAME => 'Oromo',
            self::KEY_639_1 => 'om',
            self::KEY_639_2T => 'orm',
            self::KEY_639_2B => 'orm',
        ],
        [
            self::KEY_NAME => 'Oriya',
            self::KEY_639_1 => 'or',
            self::KEY_639_2T => 'ori',
            self::KEY_639_2B => 'ori',
        ],
        [
            self::KEY_NAME => 'Ossetian, Ossetic',
            self::KEY_639_1 => 'os',
            self::KEY_639_2T => 'oss',
            self::KEY_639_2B => 'oss',
        ],
        [
            self::KEY_NAME => 'Punjabi, Panjabi',
            self::KEY_639_1 => 'pa',
            self::KEY_639_2T => 'pan',
            self::KEY_639_2B => 'pan',
        ],
        [
            self::KEY_NAME => 'Pali',
            self::KEY_639_1 => 'pi',
            self::KEY_639_2T => 'pli',
            self::KEY_639_2B => 'pli',
        ],
        [
            self::KEY_NAME => 'Persian',
            self::KEY_639_1 => 'fa',
            self::KEY_639_2T => 'fas',
            self::KEY_639_2B => 'per',
        ],
        [
            self::KEY_NAME => 'Polish',
            self::KEY_639_1 => 'pl',
            self::KEY_639_2T => 'pol',
            self::KEY_639_2B => 'pol',
        ],
        [
            self::KEY_NAME => 'Pashto, Pushto',
            self::KEY_639_1 => 'ps',
            self::KEY_639_2T => 'pus',
            self::KEY_639_2B => 'pus',
        ],
        [
            self::KEY_NAME => 'Portuguese',
            self::KEY_639_1 => 'pt',
            self::KEY_639_2T => 'por',
            self::KEY_639_2B => 'por',
        ],
        [
            self::KEY_NAME => 'Quechua',
            self::KEY_639_1 => 'qu',
            self::KEY_639_2T => 'que',
            self::KEY_639_2B => 'que',
        ],
        [
            self::KEY_NAME => 'Romansh',
            self::KEY_639_1 => 'rm',
            self::KEY_639_2T => 'roh',
            self::KEY_639_2B => 'roh',
        ],
        [
            self::KEY_NAME => 'Rundi',
            self::KEY_639_1 => 'rn',
            self::KEY_639_2T => 'run',
            self::KEY_639_2B => 'run',
        ],
        [
            self::KEY_NAME => 'Romanian, Moldavian, Moldovan',
            self::KEY_639_1 => 'ro',
            self::KEY_639_2T => 'ron',
            self::KEY_639_2B => 'rum',
        ],
        [
            self::KEY_NAME => 'Russian',
            self::KEY_639_1 => 'ru',
            self::KEY_639_2T => 'rus',
            self::KEY_639_2B => 'rus',
        ],
        [
            self::KEY_NAME => 'Sanskrit',
            self::KEY_639_1 => 'sa',
            self::KEY_639_2T => 'san',
            self::KEY_639_2B => 'san',
        ],
        [
            self::KEY_NAME => 'Sardinian',
            self::KEY_639_1 => 'sc',
            self::KEY_639_2T => 'srd',
            self::KEY_639_2B => 'srd',
        ],
        [
            self::KEY_NAME => 'Sindhi',
            self::KEY_639_1 => 'sd',
            self::KEY_639_2T => 'snd',
            self::KEY_639_2B => 'snd',
        ],
        [
            self::KEY_NAME => 'Northern Sami',
            self::KEY_639_1 => 'se',
            self::KEY_639_2T => 'sme',
            self::KEY_639_2B => 'sme',
        ],
        [
            self::KEY_NAME => 'Samoan',
            self::KEY_639_1 => 'sm',
            self::KEY_639_2T => 'smo',
            self::KEY_639_2B => 'smo',
        ],
        [
            self::KEY_NAME => 'Sango',
            self::KEY_639_1 => 'sg',
            self::KEY_639_2T => 'sag',
            self::KEY_639_2B => 'sag',
        ],
        [
            self::KEY_NAME => 'Serbian',
            self::KEY_639_1 => 'sr',
            self::KEY_639_2T => 'srp',
            self::KEY_639_2B => 'srp',
        ],
        [
            self::KEY_NAME => 'Gaelic, Scottish Gaelic',
            self::KEY_639_1 => 'gd',
            self::KEY_639_2T => 'gla',
            self::KEY_639_2B => 'gla',
        ],
        [
            self::KEY_NAME => 'Shona',
            self::KEY_639_1 => 'sn',
            self::KEY_639_2T => 'sna',
            self::KEY_639_2B => 'sna',
        ],
        [
            self::KEY_NAME => 'Sinhala, Sinhalese',
            self::KEY_639_1 => 'si',
            self::KEY_639_2T => 'sin',
            self::KEY_639_2B => 'sin',
        ],
        [
            self::KEY_NAME => 'Slovak',
            self::KEY_639_1 => 'sk',
            self::KEY_639_2T => 'slk',
            self::KEY_639_2B => 'slo',
        ],
        [
            self::KEY_NAME => 'Slovenian',
            self::KEY_639_1 => 'sl',
            self::KEY_639_2T => 'slv',
            self::KEY_639_2B => 'slv',
        ],
        [
            self::KEY_NAME => 'Somali',
            self::KEY_639_1 => 'so',
            self::KEY_639_2T => 'som',
            self::KEY_639_2B => 'som',
        ],
        [
            self::KEY_NAME => 'Southern Sotho',
            self::KEY_639_1 => 'st',
            self::KEY_639_2T => 'sot',
            self::KEY_639_2B => 'sot',
        ],
        [
            self::KEY_NAME => 'Spanish, Castilian',
            self::KEY_639_1 => 'es',
            self::KEY_639_2T => 'spa',
            self::KEY_639_2B => 'spa',
        ],
        [
            self::KEY_NAME => 'Sundanese',
            self::KEY_639_1 => 'su',
            self::KEY_639_2T => 'sun',
            self::KEY_639_2B => 'sun',
        ],
        [
            self::KEY_NAME => 'Swahili',
            self::KEY_639_1 => 'sw',
            self::KEY_639_2T => 'swa',
            self::KEY_639_2B => 'swa',
        ],
        [
            self::KEY_NAME => 'Swati',
            self::KEY_639_1 => 'ss',
            self::KEY_639_2T => 'ssw',
            self::KEY_639_2B => 'ssw',
        ],
        [
            self::KEY_NAME => 'Swedish',
            self::KEY_639_1 => 'sv',
            self::KEY_639_2T => 'swe',
            self::KEY_639_2B => 'swe',
        ],
        [
            self::KEY_NAME => 'Tamil',
            self::KEY_639_1 => 'ta',
            self::KEY_639_2T => 'tam',
            self::KEY_639_2B => 'tam',
        ],
        [
            self::KEY_NAME => 'Telugu',
            self::KEY_639_1 => 'te',
            self::KEY_639_2T => 'tel',
            self::KEY_639_2B => 'tel',
        ],
        [
            self::KEY_NAME => 'Tajik',
            self::KEY_639_1 => 'tg',
            self::KEY_639_2T => 'tgk',
            self::KEY_639_2B => 'tgk',
        ],
        [
            self::KEY_NAME => 'Thai',
            self::KEY_639_1 => 'th',
            self::KEY_639_2T => 'tha',
            self::KEY_639_2B => 'tha',
        ],
        [
            self::KEY_NAME => 'Tigrinya',
            self::KEY_639_1 => 'ti',
            self::KEY_639_2T => 'tir',
            self::KEY_639_2B => 'tir',
        ],
        [
            self::KEY_NAME => 'Tibetan',
            self::KEY_639_1 => 'bo',
            self::KEY_639_2T => 'bod',
            self::KEY_639_2B => 'tib',
        ],
        [
            self::KEY_NAME => 'Turkmen',
            self::KEY_639_1 => 'tk',
            self::KEY_639_2T => 'tuk',
            self::KEY_639_2B => 'tuk',
        ],
        [
            self::KEY_NAME => 'Tagalog',
            self::KEY_639_1 => 'tl',
            self::KEY_639_2T => 'tgl',
            self::KEY_639_2B => 'tgl',
        ],
        [
            self::KEY_NAME => 'Tswana',
            self::KEY_639_1 => 'tn',
            self::KEY_639_2T => 'tsn',
            self::KEY_639_2B => 'tsn',
        ],
        [
            self::KEY_NAME => 'Tonga (Tonga Islands)',
            self::KEY_639_1 => 'to',
            self::KEY_639_2T => 'ton',
            self::KEY_639_2B => 'ton',
        ],
        [
            self::KEY_NAME => 'Turkish',
            self::KEY_639_1 => 'tr',
            self::KEY_639_2T => 'tur',
            self::KEY_639_2B => 'tur',
        ],
        [
            self::KEY_NAME => 'Tsonga',
            self::KEY_639_1 => 'ts',
            self::KEY_639_2T => 'tso',
            self::KEY_639_2B => 'tso',
        ],
        [
            self::KEY_NAME => 'Tatar',
            self::KEY_639_1 => 'tt',
            self::KEY_639_2T => 'tat',
            self::KEY_639_2B => 'tat',
        ],
        [
            self::KEY_NAME => 'Twi',
            self::KEY_639_1 => 'tw',
            self::KEY_639_2T => 'twi',
            self::KEY_639_2B => 'twi',
        ],
        [
            self::KEY_NAME => 'Tahitian',
            self::KEY_639_1 => 'ty',
            self::KEY_639_2T => 'tah',
            self::KEY_639_2B => 'tah',
        ],
        [
            self::KEY_NAME => 'Uighur, Uyghur',
            self::KEY_639_1 => 'ug',
            self::KEY_639_2T => 'uig',
            self::KEY_639_2B => 'uig',
        ],
        [
            self::KEY_NAME => 'Ukrainian',
            self::KEY_639_1 => 'uk',
            self::KEY_639_2T => 'ukr',
            self::KEY_639_2B => 'ukr',
        ],
        [
            self::KEY_NAME => 'Urdu',
            self::KEY_639_1 => 'ur',
            self::KEY_639_2T => 'urd',
            self::KEY_639_2B => 'urd',
        ],
        [
            self::KEY_NAME => 'Uzbek',
            self::KEY_639_1 => 'uz',
            self::KEY_639_2T => 'uzb',
            self::KEY_639_2B => 'uzb',
        ],
        [
            self::KEY_NAME => 'Venda',
            self::KEY_639_1 => 've',
            self::KEY_639_2T => 'ven',
            self::KEY_639_2B => 'ven',
        ],
        [
            self::KEY_NAME => 'Vietnamese',
            self::KEY_639_1 => 'vi',
            self::KEY_639_2T => 'vie',
            self::KEY_639_2B => 'vie',
        ],
        [
            self::KEY_NAME => 'Volapük',
            self::KEY_639_1 => 'vo',
            self::KEY_639_2T => 'vol',
            self::KEY_639_2B => 'vol',
        ],
        [
            self::KEY_NAME => 'Walloon',
            self::KEY_639_1 => 'wa',
            self::KEY_639_2T => 'wln',
            self::KEY_639_2B => 'wln',
        ],
        [
            self::KEY_NAME => 'Welsh',
            self::KEY_639_1 => 'cy',
            self::KEY_639_2T => 'cym',
            self::KEY_639_2B => 'wel',
        ],
        [
            self::KEY_NAME => 'Wolof',
            self::KEY_639_1 => 'wo',
            self::KEY_639_2T => 'wol',
            self::KEY_639_2B => 'wol',
        ],
        [
            self::KEY_NAME => 'Western Frisian',
            self::KEY_639_1 => 'fy',
            self::KEY_639_2T => 'fry',
            self::KEY_639_2B => 'fry',
        ],
        [
            self::KEY_NAME => 'Xhosa',
            self::KEY_639_1 => 'xh',
            self::KEY_639_2T => 'xho',
            self::KEY_639_2B => 'xho',
        ],
        [
            self::KEY_NAME => 'Yiddish',
            self::KEY_639_1 => 'yi',
            self::KEY_639_2T => 'yid',
            self::KEY_639_2B => 'yid',
        ],
        [
            self::KEY_NAME => 'Yoruba',
            self::KEY_639_1 => 'yo',
            self::KEY_639_2T => 'yor',
            self::KEY_639_2B => 'yor',
        ],
        [
            self::KEY_NAME => 'Zhuang, Chuang',
            self::KEY_639_1 => 'za',
            self::KEY_639_2T => 'zha',
            self::KEY_639_2B => 'zha',
        ],
        [
            self::KEY_NAME => 'Zulu',
            self::KEY_639_1 => 'zu',
            self::KEY_639_2T => 'zul',
            self::KEY_639_2B => 'zul',
        ],
    ];
}
