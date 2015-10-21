<?php

namespace BinSoul\Test\Common;

use BinSoul\Common\Dictionary;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    public function test_uses_provided_data()
    {
        $dictionary = new Dictionary(['foo' => 'bar']);
        $this->assertEquals('bar', $dictionary->get('foo'));
    }

    public function test_handles_null_values()
    {
        $dictionary = new Dictionary(['foo' => null]);
        $this->assertTrue($dictionary->has('foo'));
        $this->assertNull($dictionary->get('foo', 'bar'));
    }

    public function test_get_returns_default()
    {
        $dictionary = new Dictionary(['foo' => 'bar']);
        $this->assertFalse($dictionary->has('baz'));
        $this->assertEquals('qux', $dictionary->get('baz', 'qux'));
    }

    public function test_set_adds_values()
    {
        $dictionary = new Dictionary(['foo' => 'bar']);
        $this->assertFalse($dictionary->has('baz'));
        $dictionary->set('baz', 'qux');
        $this->assertEquals('qux', $dictionary->get('baz'));
    }

    public function test_set_changes_values()
    {
        $dictionary = new Dictionary(['foo' => 'bar']);
        $dictionary->set('foo', 'qux');
        $this->assertEquals('qux', $dictionary->get('foo'));
    }

    public function test_remove_unsets_entry()
    {
        $dictionary = new Dictionary(['foo' => 'bar']);
        $dictionary->remove('foo');
        $this->assertFalse($dictionary->has('foo'));
    }

    public function test_returns_all_keys()
    {
        $dictionary = new Dictionary(['foo' => 'bar']);
        $this->assertEquals(['foo'], $dictionary->keys());
    }

    public function test_returns_all_values()
    {
        $dictionary = new Dictionary(['foo' => 'bar']);
        $this->assertEquals(['bar'], $dictionary->values());
    }

    public function test_returns_all_entries()
    {
        $dictionary = new Dictionary(['foo' => 'bar']);
        $this->assertEquals(['foo' => 'bar'], $dictionary->all());
    }

    public function test_array_access()
    {
        $dictionary = new Dictionary(['foo' => 'bar']);
        $this->assertTrue(isset($dictionary['foo']));
        $this->assertEquals('bar', $dictionary['foo']);

        $dictionary['foo'] = 'qux';
        $this->assertEquals('qux', $dictionary['foo']);

        unset($dictionary['foo']);
        $this->assertFalse($dictionary->has('foo'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function test_push()
    {
        $dictionary = new Dictionary(['foo' => 'bar']);
        $dictionary[] = 'baz';
    }
}
