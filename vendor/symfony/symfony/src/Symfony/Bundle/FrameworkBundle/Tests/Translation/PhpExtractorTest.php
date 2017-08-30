<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\FrameworkBundle\Tests\Translation;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor;
use Symfony\Component\Translation\MessageCatalogue;

class PhpExtractorTest extends TestCase
{
    /**
     * @dataProvider resourcesProvider
     *
     * @param array|string $resource
     */
    public function testExtraction($resource)
    {
        // Arrange
        $extractor = new PhpExtractor();
        $extractor->setPrefix('prefix');
        $catalogue = new MessageCatalogue('en');

        // Act
        $extractor->extract($resource, $catalogue);

        $expectedHeredoc = <<<EOF
heredoc key with whitespace and escaped \$\n sequences
EOF;
        $expectedNowdoc = <<<'EOF'
nowdoc key with whitespace and nonescaped \$\n sequences
EOF;
        // Assert
        $expectedCatalogue = array(
            'messages' => array(
                'single-quoted key' => 'prefixsingle-quoted key',
                'double-quoted key' => 'prefixdouble-quoted key',
                'heredoc key' => 'prefixheredoc key',
                'nowdoc key' => 'prefixnowdoc key',
                "double-quoted key with whitespace and escaped \$\n\" sequences" => "prefixdouble-quoted key with whitespace and escaped \$\n\" sequences",
                'single-quoted key with whitespace and nonescaped \$\n\' sequences' => 'prefixsingle-quoted key with whitespace and nonescaped \$\n\' sequences',
                'single-quoted key with "quote mark at the end"' => 'prefixsingle-quoted key with "quote mark at the end"',
                $expectedHeredoc => 'prefix'.$expectedHeredoc,
                $expectedNowdoc => 'prefix'.$expectedNowdoc,
                '{0} There is no apples|{1} There is one apple|]1,Inf[ There are %count% apples' => 'prefix{0} There is no apples|{1} There is one apple|]1,Inf[ There are %count% apples',
            ),
            'not_messages' => array(
                'other-domain-bonjour-no-params-short-array' => 'prefixother-domain-bonjour-no-params-short-array',
                'other-domain-bonjour-no-params-long-array' => 'prefixother-domain-bonjour-no-params-long-array',
                'other-domain-bonjour-params-short-array' => 'prefixother-domain-bonjour-params-short-array',
                'other-domain-bonjour-params-long-array' => 'prefixother-domain-bonjour-params-long-array',
                'other-domain-bonjour-trans-choice-short-array-%count%' => 'prefixother-domain-bonjour-trans-choice-short-array-%count%',
                'other-domain-bonjour-trans-choice-long-array-%count%' => 'prefixother-domain-bonjour-trans-choice-long-array-%count%',
                'typecast' => 'prefixtypecast',
                'msg1' => 'prefixmsg1',
                'msg2' => 'prefixmsg2',
            ),
        );
        $actualCatalogue = $catalogue->all();

        $this->assertEquals($expectedCatalogue, $actualCatalogue);
    }

    public function resourcesProvider()
    {
        $directory = __DIR__.'/../Fixtures/Resources/views/';
        $splFiles = array();
        foreach (new \DirectoryIterator($directory) as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }
            if ('translation.html.php' === $fileInfo->getBasename()) {
                $phpFile = $fileInfo->getPathname();
            }
            $splFiles[] = $fileInfo->getFileInfo();
        }

        return array(
            array($directory),
            array($phpFile),
            array(glob($directory.'*')),
            array($splFiles),
            array(new \ArrayObject(glob($directory.'*'))),
            array(new \ArrayObject($splFiles)),
        );
    }
}
