<?php
namespace Plexo\Sdk;

use PHPUnit\Framework\TestCase;
use Plexo\Sdk\Models;

final class InfoLineTest extends TestCase
{
    public function testAmountStringCoercion()
    {
        $infoLine = new Models\InfoLine('test string', '1234');
        $this->assertEmpty($infoLine->validate());
        $this->assertArraySubset([
              'Amount' => 1234.0,
              'Text' => 'test string',
            ],
            $infoLine->toArray()
        );
        $this->assertArraySubset([
                'Amount' => 'float(1234)',
                'Text' => 'test string',
            ],
            $infoLine->toArray(true)
        );

        $infoLine->Amount = '1234.1';
        $this->assertEmpty($infoLine->validate());
        $this->assertArraySubset([
              'Amount' => 1234.1,
              'Text' => 'test string',
            ],
            $infoLine->toArray()
        );
        $this->assertArraySubset([
                'Amount' => 'float(1234.1)',
                'Text' => 'test string',
            ],
            $infoLine->toArray(true)
        );

        $infoLine['Amount'] = '1234.01';
        $this->assertEmpty($infoLine->validate());
        $this->assertArraySubset([
              'Amount' => 1234.01,
              'Text' => 'test string',
            ],
            $infoLine->toArray()
        );
        $this->assertArraySubset([
                'Amount' => 'float(1234.01)',
                'Text' => 'test string',
            ],
            $infoLine->toArray(true)
        );

        $infoLine['Amount'] = 'a';
        $errors = $infoLine->validate();
        $this->assertNotEmpty($errors);
        $this->assertArraySubset([[
                'class' => 'Plexo\Sdk\Models\InfoLine',
                'error' => 'Amount must be of type float, string given.'
            ]],
            $errors
        );
    }

    public function testAmountIntCoercion()
    {
        $infoLine = new Models\InfoLine('test string', 2345);
        $this->assertEmpty($infoLine->validate());
        $this->assertArraySubset([
              'Amount' => 2345.0,
              'Text' => 'test string',
            ],
            $infoLine->toArray()
        );
        $this->assertArraySubset([
                'Amount' => 'float(2345)',
                'Text' => 'test string',
            ],
            $infoLine->toArray(true)
        );
    }

    public function testTextCoercion()
    {
        $infoLine = new Models\InfoLine('Abcd', 0);
        $this->assertEmpty($infoLine->validate());

        $infoLine->Text = 123456;
        $this->assertEmpty($infoLine->validate());
        $this->assertArraySubset([
              'Text' => '123456',
            ],
            $infoLine->toArray()
        );
    
        $infoLine->Text = 987.65;
        $this->assertEmpty($infoLine->validate());
        $this->assertArraySubset([
              'Text' => '987.65',
            ],
            $infoLine->toArray()
        );
    
        $infoLine->Text = new \Exception('Message');
        $errors = $infoLine->validate();
        $this->assertNotEmpty($errors);
        $this->assertArraySubset([[
                'class' => 'Plexo\Sdk\Models\InfoLine',
                'error' => 'Text must be of type string, object given.',
            ]],
            $errors
        );

        $infoLine->Text = ['a', 'b'];
        $errors = $infoLine->validate();
        $this->assertNotEmpty($errors);
        $this->assertArraySubset([[
                'class' => 'Plexo\Sdk\Models\InfoLine',
                'error' => 'Text must be of type string, array given.',
            ]],
            $errors
        );
    }

    public function testToArray()
    {
        $infoLine = new Models\InfoLine('test string', 123.45);
        $this->assertArraySubset([
            'Amount' => 123.45,
            'Text' => 'test string',
        ], $infoLine->toArray());
        $this->assertArraySubset([
            'Amount' => 'float(123.45)',
            'Text' => 'test string',
        ], $infoLine->toArray(true));
    }

    public function testFloatFormat()
    {
        $infoLine = new Models\InfoLine('a', 987);
        $infoLine->Amount = 987;
        $this->assertArraySubset([
            'Amount' => 'float(987)'
        ], $infoLine->toArray(true));

        $infoLine->Amount = 987.6;
        $this->assertArraySubset([
            'Amount' => 'float(987.6)'
        ], $infoLine->toArray(true));

        $infoLine->Amount = 987.06;
        $this->assertArraySubset([
            'Amount' => 'float(987.06)'
        ], $infoLine->toArray(true));
    }

    public function testSetters()
    {
        $infoLine = new Models\InfoLine();
        $infoLine->Amount = 12345.67;
        $this->assertSame(12345.67, $infoLine->Amount);
        $this->assertSame(12345.67, $infoLine['Amount']);
        $infoLine['Amount'] = 76543.21;
        $this->assertSame(76543.21, $infoLine->Amount);
        $this->assertSame(76543.21, $infoLine['Amount']);
    }

    public function testValid()
    {
        $infoLine = new Models\InfoLine('test string', 123.45);
        $this->assertEmpty($infoLine->validate());
    }

    public function testNotValid()
    {
        $infoLine = new Models\InfoLine();
        $this->assertArraySubset([
            [
                'class' => 'Plexo\Sdk\Models\InfoLine',
                'error' => 'Text cannot be empty',
            ],
            [
                'class' => 'Plexo\Sdk\Models\InfoLine',
                'error' => 'Amount cannot be empty',
            ]
        ], $infoLine->validate());
    }

}
