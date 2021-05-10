<?php

namespace Astrotomic\ISO639\Tests;

use Astrotomic\ISO639\ISO639;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class ISO3166Test extends TestCase
{
    /** @var \Astrotomic\ISO639\ISO639 */
    public $iso639;

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

        $this->assertIsLanguage($language);
        $this->assertSame('German', $language[ISO639::KEY_NAME]);
        $this->assertSame('de', $language[ISO639::KEY_639_1]);
        $this->assertSame('ger', $language[ISO639::KEY_639_2B]);
        $this->assertSame('deu', $language[ISO639::KEY_639_2T]);
    }

    public function test_get_language_by_invalid_639_1(): void
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso639->iso639_1('xy');
    }

    public function test_get_language_by_639_1(): void
    {
        $language = $this->iso639->iso639_1('de');

        $this->assertIsLanguage($language);
        $this->assertSame('German', $language[ISO639::KEY_NAME]);
        $this->assertSame('de', $language[ISO639::KEY_639_1]);
        $this->assertSame('ger', $language[ISO639::KEY_639_2B]);
        $this->assertSame('deu', $language[ISO639::KEY_639_2T]);
    }

    public function test_get_language_by_invalid_639_2B(): void
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso639->iso639_2B('xyz');
    }

    public function test_get_language_by_639_2B(): void
    {
        $language = $this->iso639->iso639_2B('ger');

        $this->assertIsLanguage($language);
        $this->assertSame('German', $language[ISO639::KEY_NAME]);
        $this->assertSame('de', $language[ISO639::KEY_639_1]);
        $this->assertSame('ger', $language[ISO639::KEY_639_2B]);
        $this->assertSame('deu', $language[ISO639::KEY_639_2T]);
    }

    public function test_get_language_by_invalid_639_2T(): void
    {
        $this->expectException(OutOfBoundsException::class);

        $this->iso639->iso639_2T('xyz');
    }

    public function test_get_language_by_639_2T(): void
    {
        $language = $this->iso639->iso639_2T('deu');

        $this->assertIsLanguage($language);
        $this->assertSame('German', $language[ISO639::KEY_NAME]);
        $this->assertSame('de', $language[ISO639::KEY_639_1]);
        $this->assertSame('ger', $language[ISO639::KEY_639_2B]);
        $this->assertSame('deu', $language[ISO639::KEY_639_2T]);
    }

    public function test_get_all_languages(): void
    {
        $languages = $this->iso639->all();

        $this->assertIsArray($languages);
        foreach ($languages as $language) {
            $this->assertIsLanguage($language);
        }
    }

    public function test_iterator_aggregate(): void
    {
        $i = 0;
        foreach ($this->iso639 as $language) {
            $this->assertIsLanguage($language);
            $i++;
        }

        $this->assertSame($this->iso639->count(), $i);
    }

    public function test_iterate_by():void
    {
        $i = 0;
        foreach ($this->iso639->iterator(ISO639::KEY_639_1) as $key => $language) {
            $this->assertIsString($key);
            $this->assertSame(2, strlen($key));
            $this->assertIsLanguage($language);
            $i++;
        }

        $this->assertSame($this->iso639->count(), $i);
    }

    protected function assertIsLanguage($actual): void
    {
        $this->assertIsArray($actual);
        $this->assertArrayHasKey(ISO639::KEY_NAME, $actual);
        $this->assertArrayHasKey(ISO639::KEY_639_1, $actual);
        $this->assertArrayHasKey(ISO639::KEY_639_2B, $actual);
        $this->assertArrayHasKey(ISO639::KEY_639_2T, $actual);
    }
}