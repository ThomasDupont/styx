<?php

class Swift_Bug650Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider encodingDataProvider
     *
     * @param string $name
     * @param string $expectedEncodedName
     */
    public function testMailboxHeaderEncoding($name, $expectedEncodedName)
    {
        $factory = new Swift_CharacterReaderFactory_SimpleCharacterReaderFactory();
        $charStream = new Swift_CharacterStream_NgCharacterStream($factory, 'utf-8');
        $encoder = new Swift_Mime_HeaderEncoder_QpHeaderEncoder($charStream);
        $header = new Swift_Mime_Headers_MailboxHeader('To', $encoder, new Swift_Mime_Grammar());
        $header->setCharset('utf-8');

        $header->setNameAddresses(array(
            'bonjour@example.com' => $name,
        ));

        $this->assertSame('To: '.$expectedEncodedName." <bonjour@example.com>\r\n", $header->toString());
    }

    public function encodingDataProvider()
    {
        return array(
            array('this is " a bonjour ö', 'this is =?utf-8?Q?=22?= a bonjour =?utf-8?Q?=C3=B6?='),
            array(': this is a bonjour ö', '=?utf-8?Q?=3A?= this is a bonjour =?utf-8?Q?=C3=B6?='),
            array('( bonjour ö', '=?utf-8?Q?=28?= bonjour =?utf-8?Q?=C3=B6?='),
            array('[ bonjour ö', '=?utf-8?Q?=5B?= bonjour =?utf-8?Q?=C3=B6?='),
            array('@ bonjour ö)', '=?utf-8?Q?=40?= bonjour =?utf-8?Q?=C3=B6=29?='),
        );
    }
}
