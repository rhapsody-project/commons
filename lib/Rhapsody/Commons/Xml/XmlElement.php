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
namespace Rhapsody\Commons\Xml;

/**
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Xml
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @version   $Id$
 */
class XmlElement extends \SimpleXMLIterator {

	/** The XPath syntax to access the root of the document. */
	const XPATH_ROOT = '//';

	/** The XPath syntax to access the current element in the document. */
	const XPATH_THIS = './';

	/**
	 * @param XmlElement $toAppend
	 * @param boolean $root
	 * @return void
	 */
	public function appendChild($toAppend, $root = false)
	{
		if($root) {
			$node = $this->addChild($toAppend->getName());
			foreach ($toAppend->attributes() as $key => $value) {
				$node->addAttribute($key, $value);
			}
			$node->appendChild($toAppend);
		}
		else {
			foreach ($toAppend as $name => $tree) {
				$child = $this->addChild($name, $this->_fixContent(strval($tree)));
				foreach ($tree->attributes() as $attrKey => $attrValue) {
					$child->addAttribute($attrKey, $attrValue);
				}
				$child->appendChild($tree->children());
			}
		}
	}

	/**
	 * <p>
	 * Returns all elements matching the XPath pattern <tt>/{$name}</tt>, such
	 * that all elements whose name is <tt>$name</tt> directly underneath this
	 * element will be returned.
	 * </p>
	 *
	 * @param $name
	 * @param boolean $flattenUnique Optional. If <tt>true</tt> unique results
	 * 		will be flattened, not being returned as an array but as an
	 * 		<tt>XmlElement</tt>. The default value is <tt>true</tt>.
	 * @return XmlElement
	 */
	public function get($name, $flattenUnique = true)
	{
		$xpathStr = self::XPATH_THIS . $name;
		$results = $this->xpath($xpathStr);
		if ($flattenUnique === true) {
			if (count($results) == 0) {
				return null;
			}

			if (count($results) == 1) {
				return $results[0];
			}
		}
		return $results;
	}

	/**
	 * <p>
	 * Returns all elements matching the XPath pattern <tt>//${name}</tt>.
	 * </p>
	 *
	 * @param string $name the name of the element to find.
	 * @return array
	 */
	public function getAll($name)
	{
		$xpathStr = '';
		if (is_string($name)) {
			$xpathStr = self::XPATH_ROOT . $name;
		}
		else if (is_array($name)) {
			$xpathStr = self::XPATH_ROOT . implode(' | ' . self::XPATH_ROOT, $name);
		}
		$results = $this->xpath($xpathStr);
		return $results;
	}

	public function getAttributes()
	{
		$attributes = array();
		foreach($this->attributes() as $attrName => $attrValue) {
			$attributes[$attrName] = strval($attrValue);
		}
		return $attributes;
	}

	/**
	 * @param $attributeName
	 * @return unknown_type
	 */
	public function getAttribute($attributeName, $default = null)
	{
		$attributeName = strtoupper($attributeName);
		foreach($this->attributes() as $attrName => $attrValue) {
			if (strtoupper($attrName) === $attributeName) {
				return strval($attrValue);
			}
		}
		return $default;
	}

	public function getBooleanAttribute($attributeName)
	{
		$boolean = array('true' => true, 'yes' => true, 'false' => false, 'no' => false);
		$value = $this->getAttribute($attributeName, false);
		$bool = strtolower(trim($value));
		if (!is_bool($value) && array_key_exists($bool, $boolean)) {
			return $boolean[$bool];
		}
		return is_bool($value) ? $value : false;
	}

	/**
	 * <p>
	 * Returns the first child, irrespective of element name, of the current
	 * XmlElement.
	 * </p>
	 *
	 * @return XmlElement|NULL
	 */
	public function getFirstChild()
	{
		$xpathStr = self::XPATH_THIS . '*[1]';
		$results = $this->xpath($xpathStr);
		if (count($results) >= 1) {
			return $results[0];
		}
		return null;
	}

	/**
	 * <p>
	 * Searchs the arttributes on this element for a required attribute whose name
	 * matches <tt>$attributeName</tt>. If no attribute with that name exists, an
	 * exception is thrown indicating that the element is missing a required
	 * attribute.
	 * </p>
	 *
	 * @param string $attributeName the name of the attribute that we are looking
	 * 		for.
	 * @return mixed the value of the required attribute.
	 */
	public function getRequiredAttribute($attributeName)
	{
		$attributes = $this->attributes();
		foreach($attributes as $attrName => $attrValue) {
			if (strcasecmp($attrName, $attributeName) === 0) {
				return strval($attrValue);
			}
		}
		throw new \Exception('Missing required attribute: ' . $attributeName . '.');
	}

	/**
	 * <p>
	 * Returns all elements matching the XPath pattern <tt>/{$name}</tt>, such
	 * that all elements whose name is <tt>$name</tt> directly underneath this
	 * element will be returned.
	 * </p>
	 *
	 * @param $name
	 * @return XmlElement
	 */
	public function getUnique($name)
	{
		$xpathStr = self::XPATH_THIS . $name;
		$results = $this->xpath($xpathStr);
		if (count($results) >= 1) {
			return $results[0];
		}
		return null;
	}

	/**
	 *
	 * @return string
	 */
	public function getValue()
	{
		$value = strval($this);
		return $value;
	}

	/**
	 * <p>
	 * Magic function, overriding the existing <code>SimpleXMLIterator</code>
	 * magic function <tt>__get</tt>. This will return the child of this element
	 * whose name matches <tt>$name</tt>.
	 * </p>
	 *
	 * @param $name the name of the element to locate.
	 * @return XmlElement the <code>XmlElement</code> or <tt>null</tt> if no
	 *     element was found matching the name specified.
	 */
	public function __get($name)
	{
		return $this->get($name);
	}

	/**
	 * <p>
	 * When the xml is read by simplexml_load_file or simplexml_load_file the
	 * values that contains & is converted to &. And then it is not possible to
	 * add these values without getting errors. This function should fix this.
	 * </p>
	 * @param string $value
	 * @return string
	 */
	private function _fixContent($value)
	{
		return str_replace('&', '&', $value);
	}

	/**
	 * @return unknown_type
	 */
	public function toArray()
	{
		$nodesArray = $this->_nodesToArray();
		$attrsArray = $this->_attributesToArray();

		if (count($attrsArray) > 0) {
			$array = array_merge(array('@attributes' => $attrsArray), $nodesArray);
			return $array;
		}
		return $nodesArray;
	}

	/**
	 * @return unknown_type
	 */
	protected function _nodesToArray()
	{
		$nodeArray = array();
		foreach($this as $iterator) {
			$key = $iterator->getName();
			if (!array_key_exists($key, $nodeArray)) {
				$nodeArray[$key] = array();
			}

			if ($iterator->countChildren() > 0) {
				$nodeArray[$key][] = $iterator->toArray();
			}
			else {
				$value = $iterator->getValue();
				if ($value !== '') {
					$nodeArray[$key][] = strval($iterator->getValue());
				}

				if (count($iterator->attributes()) > 0) {
					$attrArray = array();
					foreach ($iterator->attributes() as $attrName => $attrValue) {
						$attrArray[$attrName] = strval($attrValue);
					}
					$nodeArray[$key]['@attributes'] = $attrArray;
				}
			}
		}
		return $nodeArray;
	}

	/**
	 * @return unknown_type
	 */
	protected function _attributesToArray()
	{
		$attrArray = array();
		if (count($this->attributes()) > 0) {
			foreach ($this->attributes() as $attrName => $attrValue) {
				$attrArray[$attrName] = strval($attrValue);
			}
		}
		return $attrArray;
	}

	/**
	 * @return unknown_type
	 */
	private function countChildren()
	{
		return count($this->xpath(self::XPATH_THIS . '*'));
	}
}