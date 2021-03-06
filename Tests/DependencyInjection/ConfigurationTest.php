<?php

declare(strict_types=1);

namespace Ruvents\I18nRoutingBundle\Tests\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;
use Ruvents\I18nRoutingBundle\DependencyInjection\Configuration;

class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    public function testLocalesRequired(): void
    {
        $this->assertConfigurationIsInvalid([
            'ruvents_i18n_routing' => [
                'default_locale' => 'ru',
            ],
        ], 'must be configured');
    }

    public function testLocalesNotEmpty(): void
    {
        $this->assertConfigurationIsInvalid([
            'ruvents_i18n_routing' => [
                'locales' => [],
                'default_locale' => 'ru',
            ],
        ], 'should have at least 1 element');
    }

    public function testLocaleNotEmpty(): void
    {
        $this->assertConfigurationIsInvalid([
            'ruvents_i18n_routing' => [
                'locales' => [''],
                'default_locale' => 'ru',
            ],
        ], 'cannot contain an empty value');
    }

    public function testDefaultLocaleRequired(): void
    {
        $this->assertConfigurationIsInvalid([
            'ruvents_i18n_routing' => [
                'locales' => ['ru'],
            ],
        ], 'must be configured');
    }

    public function testDefaultLocaleNotEmpty(): void
    {
        $this->assertConfigurationIsInvalid([
            'ruvents_i18n_routing' => [
                'locales' => ['ru'],
                'default_locale' => '',
            ],
        ], 'cannot contain an empty value');
    }

    protected function getConfiguration()
    {
        return new Configuration();
    }
}
