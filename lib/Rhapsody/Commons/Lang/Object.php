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
namespace Rhapsody\Commons\Lang;

/**
 * <p>
 * The <code>Object</code> class is a root class. All classes are advised
 * to implement this class as it provides certain standard functionality that
 * can be beneficial.
 * </p>
 * <p>
 * Adds lifecycle methods breaking apart the normal constructor.
 *  __init()
 *  __create()
 *  __postCreate()
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Lang
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
class Object implements InternableInterface
{

	/**
	 * A cache of the arguments passed to instantiate this object.
	 * @var array
	 * @access private
	 */
	private $__constructorArgs;

	/**
	 * @var int A hash code that represents this objects unique signature. This
	 * 		hash code is effectively the serial id of an Object, and is its checksum
	 * 		value.
	 * @access private
	 */
	private $hashCode;

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
		return $this->hashCode;
	}

	/**
	 * @return string
	 */
	public static function __class()
	{
		return get_called_class();
	}

	/**
	 * <p>
	 * The <code>Object</code>'s constructor takes a variable number of parameters
	 * via the PHP <tt>func_get_args()</tt> method. This allows implementing
	 * <code>Object</code>s, to handle their construction differently as is
	 * required by the business logic.
	 * </p>
	 * <p>
	 * If an <tt>array</tt> is passed in as the only parameter to an Object's
	 * constructor, by default <tt>func_get_args()</tt> will return that array
	 * as one within another, for example:
	 * <blockquote>
	 * <pre>
	 * function foo() {
	 *   $args = func_get_args();
	 *   printr($args);
	 * }
	 * foo(array('one', 'two', 'three'));
	 * // OUTPUT: array(1) { [0] => array(3) { [0] => 'one', [1] => 'two', [2] => 'three' } }
	 * </pre>
	 * </blockquote>
	 * To address the case where you clearly wanted to pass as the first argument
	 * an array, but now it is a two-dimensional array we remove the top level of
	 * the array. This is only done when the first and <i>only</i> parameter is
	 * an <tt>array</tt> otherwise we leave the value returned by
	 * <tt>func_get_args()</tt> alone.
	 * </p>
	 *
	 * @param mixed... $parameters optional parameters to be handled during
	 *    Object construction.
	 */
	public function __construct()
	{
		$args = func_get_args();
		$this->__constructInternal($args);
	}

	private function __constructInternal(array $args = array())
	{
		$argCount = count($args);
		if ($argCount == 1) {
			if (is_array($args[0])) {
				$args = $args[0];
				$this->__constructorArgs = $args;
			}
		}
		$this->generateHashCode();

		// **
		// Before you call either create or postCreate methods
		// you may find it useful to define certain variables that you couldn't
		// otherwise set up in the class-scope.
		$this->__init();

		// **
		// The __create method is only called when arguments have been passed
		// in. If a class needs to perform logic during the construction phase
		// of the object, regardless of whether arguments have been supplied
		// then either the __init or __postCreate methods should be used.
		if (!empty($args)) {
			$this->__create($args);
		}

		// ** Performs post-create lifecycle operations
		$this->__postCreate();
	}

	/**
	 * <p>
	 * The pre-create initialization function. If class members need to be
	 * initialized as an object instance before the <tt>__create</tt> method is
	 * invoked, that should be done in this method.
	 * </p>
	 * @return void
	 */
	protected function __init()
	{
		// Empty. Extending classes should override this.
	}

	/**
	 * <p>
	 * The <tt>__create()</tt> method gives any object extending the PHP
	 * Commons <code>Object</code> class a pseudo-polymorhphic construction
	 * paradigm.
	 * </p>
	 * <p>
	 * PHP's function overloading restriction limits the number of constructors
	 * an object can have to only one. The <tt>__create</tt> allows us to take
	 * any number of arguments in and react to them appropriately. Arguments are
	 * passed to the <tt>__create</tt> method as an <tt>array</tt>, it is
	 * recommended that an associative array of key-value pairs be used, as it
	 * makes the code clearer and easier to understand.
	 * </p>
	 *
	 * @param array $args
	 * @return void
	 */
	protected function __create(array $args = array())
	{
		$class = new \ReflectionClass(self::__class());

		foreach ($args as $name => $value) {
			$property = $class->getProperty($name);
			$property->setAccessible(true);
			$property->setValue($this, $value);
		}
	}

	/**
	 *
	 * @param array $args
	 * @param string|int $key
	 * @param mixed $default
	 * @return mixed
	 */
	protected function _getArg(array $args = array(), $key, $default = null)
	{
		if (!empty($args)) {
			if (is_int($key) && ($key >= 0) && ($key < count($args))) {
				$_values = array_values($args);
				return $_values[$key];
			}
			if (is_string($key) && array_key_exists($key, $args)) {
				return $args[$key];
			}
		}
		return $default;
	}

	/**
	 * <p>
	 * Post-creation lifecycle method. The <tt>__postCreate</tt> method is
	 * called immediately after <tt>__create</tt> method finishes.
	 * </p>
	 * @return void
	 */
	protected function __postCreate()
	{
		// Empty.
	}

	/**
	 * <p>Creates and returns a copy of this object. This method is a convenience
	 * method that will invoke the internal <tt>__clone</tt> method associated
	 * with this Object.</p>
	 *
	 * @return Object a copy of this <code>Object</code>.
	 */
	public final function cloneObject()
	{
		$args = func_get_args();
		return clone($args);
	}



	/**
	 * Generates a random hash code for this object.
	 * @return void
	 */
	private final function generateHashCode()
	{
		$this->hashCode = spl_object_hash($this);
	}

	/**
	 * <p>Pass-through function that calls the built-in <tt>__toString</tt> method
	 * that is standard to all objects. The value returned is a string
	 * representation of the object.</p>
	 *
	 * @return String the string representation of this object.
	 */
	public final function toString()
	{
		$args = func_get_args();
		return $this->__toString($args);
	}

	/**
	 * {@inheritDoc}
	 */
	final public function __callIntern($methodName)
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

	public function __clone()
	{
		// TODO:
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
		return get_called_class().'@'.$this->hashCode;
	}
}

?>