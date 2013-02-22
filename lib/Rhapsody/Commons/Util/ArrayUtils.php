<?php
/* Copyright (c) 2013 Rhapsody Project
 *
 * Licensed under the MIT License (http://opensource.org/licenses/MIT)
 *
 * Permission is hereby granted, free of charge, to any
 * person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the
 * Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice
 * shall be included in all copies or substantial portions of
 * the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY
 * KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
 * OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT
 * OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Rhapsody\Commons\Util;

/**
 * <p>
 * Operations on primitive arrays.
 * </p>
 * <p>
 * This class does its best to handle <tt>null</tt> input gracefully. Exceptions
 * will not be thrown for <tt>null</tt> array inputs, but an Object array that
 * contains <tt>null</tt> values may throw an exception.
 * </p>
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Util
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
class ArrayUtils
{

	private static final function __convert(Traversable $traversable)
	{
		$array = array();
		foreach ($traversable as $key => $value) {
			$array[$key] = $value;
		}
		return $array;
	}

	/**
	 * Adds an element to an array. When an element is added to an associative
	 * array the returned array loses all associative context and instead a
	 * non-associative array is returned with numeric indices.
	 *
	 * @param unknown $array
	 * @param unknown $element
	 * @return array the new array, including the <tt>$element</tt> added.
	 */
	public static final function add($array, $element)
	{
		if ($array instanceof \Traversable) {
			$array = self::__convert($array);
		}

		$arr = array();
		$arr = array_values($array);
		array_push($arr, $element);
		return $arr;
	}

	/**
	 *
	 * @param unknown $array
	 * @param unknown $elements
	 * @return multitype:
	 */
	public static final function addAll($array, $elements)
	{
		if ($array instanceof \Traversable) {
			$array = self::__convert($array);
		}

		if ($elements instanceof \Traversable) {
			$elements = self::__convert($elements);
		}
		return array_merge(array_values($array), array_values($elements));
	}

	public static final function map()
	{
		$callback = null;
		$args = func_get_args();
		if (is_callable($args[0])) {
			$callback = $args[0];
			array_shift($args);
		}

		$result = array();
		foreach ($args as &$array) {
			foreach ($array as $key => $value) {
				$_value = ($callback !== null && is_callable($callback))
					? $callback($value, $key) : array($key => $value);
				array_push($result, $_value);
			}
		}
		return $result;
	}

	public static final function cloneArray(array $array = array()) {

	}

	public static final function contains(array $array = array(), $needle, $tolerance = 0) {

	}

	public static final function getLength(array $array = array()) {

	}

	public static final function indexOf(array $array = array(), $needle, $tolerance = 0) {

	}

	public static final function isEmpty($array)
	{
		if (is_array($array)) {
			return empty($array);
		}
		if ($array instanceof \Countable) {
			return $array->count() <= 0;
		}
		throw new \InvalidArgumentException('Cannot determine emptiness of object: '.gettype($array));
	}

	/**
	 * <p>
	 * Merges a variable number of <tt>arrays</tt> or iterable objects together
	 * into a new <tt>array</tt> and returns it.
	 * </p>
	 * @param mixed the array or iterable objects you wish to merge.
	 * @return array the merged array.
	 */
	public static function merge()
	{
		$result = array();
		$args = func_get_args();
		foreach ($args as &$array) {
			if ($array instanceof \Traversable) {
				foreach ($array as $key => $value) {
					$result[$key] = $value;
				}
			}
		}
		return $result;
	}

	/**
	 *
	 * Enter description here...
	 * @param $array
	 * @param int|string $index the <tt>$index</tt> in the array to be removed,
	 *    specified as either a <tt>string</tt> or an <tt>int</tt>.
	 * @return unknown_type
	 */
	public static final function remove(array $array = array(), $index)
	{
		unset($array[$index]);
		// if the array's values are all numeric, we should reshuffle with array_values($array);
		return $array;
	}

	public static final function union()
	{
		$result = array();
		$args = func_get_args();
		foreach ($args as &$array) {
			if ($array instanceof \Traversable) {
				foreach ($array as $key => $value) {
					if (!array_key_exists($key, $result)) {
						$result[$key] = $value;
					}
				}
			}
		}
		return $result;
	}
}
?>