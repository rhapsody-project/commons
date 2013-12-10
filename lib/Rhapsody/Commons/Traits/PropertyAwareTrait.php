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
namespace Rhapsody\Commons\Traits;

/**
 * <p>
 * </p>
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Lang
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
trait PropertyAwareTrait
{

	/**
	 * An array of identified properties (by name) that are accessible. If this
	 * array is empty, all properties are accessible.
	 * @var array
	 * @access private
	 */
	private $_getters = array();

	/**
	 * An array of identified properties that have accessible setters. If this
	 * array is empty, all properties are writable; otherwise only those
	 * properties specified are writable, everything else is read-only.
	 * @var array
	 * @access private
	 */
	private $_setters = array();

	public function &__get($propertyName)
	{
		$this->isPropertyLegal($propertyName);
		if (!empty($this->_getters)) {
			if (!in_array($propertyName, $this->_getters)) {
				throw new \Exception('Access denied. Property: ' . $propertyName . ' is not accessible.');
			}
		}
		return $this->$propertyName;
	}

	public function __set($propertyName, $value)
	{
		$this->isPropertyLegal($propertyName);
		if (!empty($this->_setters)) {
			if (!in_array($propertyName, $this->_setters)) {
				throw new \Exception('Access denied. Property: ' . $propertyName . ' is read-only.');
			}
		}
		$this->$propertyName = $value;
	}

	/**
	 *
	 * @param string $propertyName
	 */
	public function addPropertyGetter($propertyName)
	{
		if (!in_array($propertyName, $this->_getters)) {
			array_push($this->_getters, $propertyName);
		}
	}

	/**
	 *
	 * @param string $propertyName
	 */
	public function addPropertySetter($propertyName)
	{
		if (!in_array($propertyName, $this->_setters)) {
			array_push($this->_setters, $propertyName);
		}
	}

	public function isPropertyLegal($propertyName)
	{
		if ($propertyName == '_getters' || $propertyName == '_setters') {
			throw new \Exception('Access denied. Getter and setter properties are read only.');
		}
	}
}