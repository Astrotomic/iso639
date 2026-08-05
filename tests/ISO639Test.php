<?php

namespace Astrotomic\ISO639\Tests;

use Astrotomic\ISO639\ISO639;
use OutOfBoundsException;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Transliterator;

class ISO639Test extends TestCase
{
    public ISO639 $iso639;

    public function setUp(): void
    {
        $this->iso639 = new ISO639();
    }

    public function test_get_language_by_invalid_name(): void
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso639->name('foobar');
    }

    public function test_get_language_by_name(): void
    {
        $language = $this->iso639->name('German');

        self::assertIsLanguage($language);
        Assert::assertSame('German', $language[ISO639::KEY_NAME]);
        Assert::assertSame('de', $language[ISO639::KEY_639_1]);
        Assert::assertSame('ger', $language[ISO639::KEY_639_2B]);
        Assert::assertSame('deu', $language[ISO639::KEY_639_2T]);
    }

    public function test_name_uses_lookup_extension_point(): void
    {
        $iso639 = new class() extends ISO639 {
            protected function lookup($key, $value): array
            {
                return parent::lookup($key, $key === self::KEY_NAME ? 'German' : $value);
            }
        };

        Assert::assertSame('de', $iso639->name('custom')[ISO639::KEY_639_1]);
    }

    public function test_get_language_by_alias(): void
    {
        $iso639 = new ISO639(null, ['German language' => 'de']);

        $language = $iso639->name('GERMAN LANGUAGE');

        Assert::assertSame('de', $language[ISO639::KEY_639_1]);
    }

    public function test_get_language_by_localized_name(): void
    {
        Assert::assertSame('de', $this->iso639->name('Deutsch')[ISO639::KEY_639_1]);
        Assert::assertSame('de', $this->iso639->name('ALLEMAND')[ISO639::KEY_639_1]);
        Assert::assertSame('fr', $this->iso639->name('FRANÇAIS')[ISO639::KEY_639_1]);
        Assert::assertSame('el', $this->iso639->name('ΕΛΛΗΝΙΚΆ')[ISO639::KEY_639_1]);
    }

    public function test_find_language_by_any_identifier(): void
    {
        $iso639 = new ISO639(null, ['German language' => 'de']);

        foreach (['German', 'German language', 'Deutsch', 'de', 'ger', 'deu'] as $identifier) {
            Assert::assertSame('de', $iso639->find($identifier)[ISO639::KEY_639_1]);
        }
    }

    public function test_find_unknown_language(): void
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso639->find('foobar');
    }

    public function test_serialization_preserves_languages_and_aliases(): void
    {
        $iso639 = new ISO639(null, ['German language' => 'de']);
        $iso639->name('Deutsch');

        $serialized = serialize($iso639);
        $restored = unserialize($serialized);

        Assert::assertInstanceOf(ISO639::class, $restored);
        Assert::assertStringNotContainsString(Transliterator::class, $serialized);
        Assert::assertSame('de', $restored->name('German language')[ISO639::KEY_639_1]);
        Assert::assertSame('de', $restored->name('Deutsch')[ISO639::KEY_639_1]);
    }

    public function test_unserializes_legacy_payload(): void
    {
        $language = $this->iso639->name('German');
        $class = ISO639::class;
        $serialized = sprintf(
            'O:%d:"%s":1:{%s%s}',
            strlen($class),
            $class,
            serialize("\0*\0languages"),
            serialize([$language])
        );

        $restored = unserialize($serialized);

        Assert::assertInstanceOf(ISO639::class, $restored);
        Assert::assertSame([$language], $restored->all());
        Assert::assertSame('de', $restored->name('Deutsch')[ISO639::KEY_639_1]);
    }

    public function test_get_language_by_invalid_alpha2(): void
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso639->alpha2('xy');
    }

    public function test_get_language_by_alpha2(): void
    {
        $language = $this->iso639->alpha2('de');

        self::assertIsLanguage($language);
        Assert::assertSame('German', $language[ISO639::KEY_NAME]);
        Assert::assertSame('de', $language[ISO639::KEY_639_1]);
        Assert::assertSame('ger', $language[ISO639::KEY_639_2B]);
        Assert::assertSame('deu', $language[ISO639::KEY_639_2T]);
    }

    public function test_get_language_by_invalid_639_1(): void
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso639->iso639_1('xy');
    }

    public function test_get_language_by_639_1(): void
    {
        $language = $this->iso639->iso639_1('de');

        self::assertIsLanguage($language);
        Assert::assertSame('German', $language[ISO639::KEY_NAME]);
        Assert::assertSame('de', $language[ISO639::KEY_639_1]);
        Assert::assertSame('ger', $language[ISO639::KEY_639_2B]);
        Assert::assertSame('deu', $language[ISO639::KEY_639_2T]);
    }

    public function test_get_language_by_invalid_639_2B(): void
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso639->iso639_2B('xyz');
    }

    public function test_get_language_by_639_2B(): void
    {
        $language = $this->iso639->iso639_2B('ger');

        self::assertIsLanguage($language);
        Assert::assertSame('German', $language[ISO639::KEY_NAME]);
        Assert::assertSame('de', $language[ISO639::KEY_639_1]);
        Assert::assertSame('ger', $language[ISO639::KEY_639_2B]);
        Assert::assertSame('deu', $language[ISO639::KEY_639_2T]);
    }

    public function test_get_language_by_invalid_639_2T(): void
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso639->iso639_2T('xyz');
    }

    public function test_get_language_by_639_2T(): void
    {
        $language = $this->iso639->iso639_2T('deu');

        self::assertIsLanguage($language);
        Assert::assertSame('German', $language[ISO639::KEY_NAME]);
        Assert::assertSame('de', $language[ISO639::KEY_639_1]);
        Assert::assertSame('ger', $language[ISO639::KEY_639_2B]);
        Assert::assertSame('deu', $language[ISO639::KEY_639_2T]);
    }

    public function test_get_all_languages(): void
    {
        $languages = $this->iso639->all();

        Assert::assertIsArray($languages);
        foreach ($languages as $language) {
            self::assertIsLanguage($language);
        }
    }

    public function test_get_all_language_iso_639_1(): void
    {
        $languages = $this->iso639->all(ISO639::KEY_639_1);

        Assert::assertIsArray($languages);
        foreach ($languages as $language) {
            self::assertIsIso639_1($language);
        }
    }

    public function test_iterator_aggregate(): void
    {
        $i = 0;
        foreach ($this->iso639 as $language) {
            self::assertIsLanguage($language);
            $i++;
        }

        Assert::assertSame($this->iso639->count(), $i);
    }

    public function test_iterate_by(): void
    {
        $i = 0;
        foreach ($this->iso639->iterator(ISO639::KEY_639_1) as $key => $language) {
            self::assertIsIso639_1($key);
            self::assertIsLanguage($language);
            $i++;
        }

        Assert::assertSame($this->iso639->count(), $i);
    }

    protected static function assertIsLanguage($actual): void
    {
        Assert::assertIsArray($actual);
        Assert::assertArrayHasKey(ISO639::KEY_NAME, $actual);
        Assert::assertArrayHasKey(ISO639::KEY_639_1, $actual);
        self::assertIsIso639_1($actual[ISO639::KEY_639_1]);
        Assert::assertArrayHasKey(ISO639::KEY_639_2B, $actual);
        self::assertIsIso639_2B($actual[ISO639::KEY_639_2B]);
        Assert::assertArrayHasKey(ISO639::KEY_639_2T, $actual);
        self::assertIsIso639_2T($actual[ISO639::KEY_639_2T]);
    }

    protected static function assertIsIso639_1($actual): void
    {
        Assert::assertIsString($actual);
        Assert::assertSame(2, strlen($actual));
    }

    protected static function assertIsIso639_2B($actual): void
    {
        Assert::assertIsString($actual);
        Assert::assertSame(3, strlen($actual));
    }

    protected static function assertIsIso639_2T($actual): void
    {
        Assert::assertIsString($actual);
        Assert::assertSame(3, strlen($actual));
    }
}
