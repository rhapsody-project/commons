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
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Traits
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
trait ObjectTrait
{

	/**
	 * Returns a hash code value for the object. This method is supported for
	 * the benefit of hash tables and maps, such as those provided by the
	 * <code>php.util.HashMap</code>.
	 *
	 * The general contract of hashCode is:
	 * <ul>
	 * <li>Whenever it is invoked on the same object more than once during an
	 * execution of a PHP application, the <tt>hashCode</tt> method must
	 * consistently return the same integer, provided no information used in
	 * <tt>equals</tt> comparisons on the object is modified. This integer need
	 * not remain consistent from one execution of an application to another
	 * execution of the same application.</li>
	 * <li>If two objects are equal according to the <tt>equals(Object)</tt>
	 * method, then calling the <tt>hashCode</tt> method on each of the two
	 * objects must produce the same integer result.</li>
	 * <li>It is not required that if two objects are unequal according to the
	 * <tt>equals(php.lang.Object)</tt> method, then calling the <tt>hashCode</tt>
	 * method on each of the two objects must produce distinct integer results.
	 * However, the programmer should be aware that producing distinct integer
	 * results for unequal objects may improve the performance of hashtables.</li>
	 * </ul>
	 *
	 * As much as is reasonably practical, the <tt>hashCode</tt> method defined
	 * by class Object does return distinct integers for distinct objects.
	 */
	public function hashCode()
	{
		return spl_object_hash($this);
	}

	/**
	 * @return string
	 */
	public static function __class()
	{
		return get_called_class();
	}

	/**
	 * {@inheritDoc}
	 */
	public final function __callIntern($methodName)
	{
		// **
		// Retrieves all of the arguments, including $methodName ($args[0]), and
		// then shifts the array by one step so that all the other arguments
		// passed are treated as the array of arguments for the actual method
		// call. [SWQ]
		$args = func_get_args();
		array_shift($args);

		// ** Validate the method name.
		if (!is_string($methodName) || empty($methodName)) {
			throw new \InvalidArgumentException("Must specify a method name that is a "
					. "non-empty string.");
		}

		// **
		// In order to do some validation against the method requested, and the
		// parameters passed to the method, we need to leverage PHP's reflection
		// library. This will allow us to, at the very least determine if the method
		// is viable (e.g. public or protected), and compare the number of
		// parameters passed against the number of required parameters for the
		// function in question.
		//
		// If the either test fails, we will need to throw an exception bringing
		// this to the attention of the developer. [SWQ]
		$reflectionClass = new \ReflectionClass($this);
		$method = $reflectionClass->getMethod($methodName);

		if ($method->isPrivate()) {
			throw new \InvalidArgumentException("Unable to access private methods "
					. "through the __callIntern() method.");
		}

		if (count($args) < $method->getNumberOfRequiredParameters()) {
			throw new \InvalidArgumentException("Minimum required arguments count "
					. "mismatch.");
		}

		// ** Call and return the results of the method.
		return call_user_func_array(array($this, $methodName), $args);
	}

	/**
	 * <p>Obfuscated <tt>__toString</tt> method that can't be seen publicly by the
	 * code calling into the object.</p>
	 *
	 * <p>Returns the string representation of this object. By default, if not
	 * overridden by extending classes the object itself (via the <tt>$this</tt>
	 * operator) will be returned.</p>
	 *
	 * @return string the string representation of the object, if not overrriden
	 * 		the object itself (via the <tt>$this</tt> operator) will be returned.
	 */
	public function __toString()
	{
		$hashCode = $this->hashCode();
		return get_called_class().'@'.$hashCode;
	}
}

?>