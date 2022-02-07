<?php

namespace LegacyFighter\Dietary\NewProducts\Tests\Unit;

use LegacyFighter\Dietary\NewProducts\OldProduct;
use Brick\Math\BigDecimal;
use PHPUnit\Framework\TestCase;

class OldProductTest extends TestCase
{

    public function testIncrementCounterThrowsExceptionWhenCounterIsNull()
    {
        $oldProduct = new OldProduct(BigDecimal::of(10), 'Test desc', 'Test long desc', null);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('null counter');
        $oldProduct->incrementCounter();
    }

    public function testIncrementCounterThrowsExceptionWhenCounterIsNegative()
    {
        $oldProduct2 = new OldProduct(BigDecimal::of(10), 'Test desc', 'Test long desc', -1);
        $oldProduct2->incrementCounter();
        // no exception

        $oldProduct = new OldProduct(BigDecimal::of(10), 'Test desc', 'Test long desc', -2);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Negative counter');
        $oldProduct->incrementCounter();
    }

    public function testIncrementCounterThrowsExceptionWhenPriceIsNull()
    {
        $oldProduct = new OldProduct(null, 'Test desc', 'Test long desc', 0);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid price');
        $oldProduct->incrementCounter();

        $oldProduct2 = new OldProduct(BigDecimal::of(-10), 'Test desc', 'Test long desc', 0);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid price');
        $oldProduct2->incrementCounter();
    }

    public function testDecrementCounterThrowsExceptionWhenCounterIsNull()
    {
        $oldProduct = new OldProduct(BigDecimal::of(10), 'Test desc', 'Test long desc', null);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('null counter');
        $oldProduct->DecrementCounter();
    }

    public function testDecrementCounterThrowsExceptionWhenCounterIsNegative()
    {
        $oldProduct = new OldProduct(BigDecimal::of(10), 'Test desc', 'Test long desc', 1);
        $oldProduct->decrementCounter();
        // no exception

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Negative counter');
        $oldProduct->decrementCounter();
    }

    public function testDecrementCounterThrowsExceptionWhenPriceIsNull()
    {
        $oldProduct = new OldProduct(null, 'Test desc', 'Test long desc', 0);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid price');
        $oldProduct->decrementCounter();

        $oldProduct2 = new OldProduct(BigDecimal::of(-10), 'Test desc', 'Test long desc', 0);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid price');
        $oldProduct2->decrementCounter();
    }

    public function testChangePriceToThrowsExceptions()
    {
        $oldProduct = new OldProduct(BigDecimal::of(10), 'Test desc', 'Test long desc', null);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('null counter');
        $oldProduct->changePriceTo(BigDecimal::of(20));

        $oldProduct2 = new OldProduct(null, 'Test desc', 'Test long desc', 1);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('new price null');
        $oldProduct2->changePriceTo(BigDecimal::of(20));
    }

    public function testReplaceCharFromDesc()
    {
        $oldProduct = new OldProduct(BigDecimal::of(10), 'Test FOO desc', 'Test FOO long desc', 0);
        $oldProduct->replaceCharFromDesc('FOO', 'BAR');
        $this->assertSame('Test BAR desc *** Test BAR long desc', $oldProduct->formatDesc());
    }

    public function testFormatDescNotNull()
    {
        $oldProduct = new OldProduct(BigDecimal::of(10), 'Test desc', 'Test long desc', 0);
        $this->assertSame('Test desc *** Test long desc', $oldProduct->formatDesc());
    }

    public function testFormatDescNull()
    {
        $oldProduct = new OldProduct(null, null, null, 0);
        $this->assertSame('', $oldProduct->formatDesc());

        $oldProduct2 = new OldProduct(null, 'Test desc', null, 0);
        $this->assertSame('', $oldProduct2->formatDesc());

        $oldProduct3 = new OldProduct(null, null, 'Test long desc', 0);
        $this->assertSame('', $oldProduct3->formatDesc());
    }
}
