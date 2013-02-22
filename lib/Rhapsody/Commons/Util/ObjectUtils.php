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
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Util
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @license   http://opensource.org/licenses/MIT
 * @version   $Id$
 * @since     1.0
 */
class ObjectUtils
{

  /**
   * <p>
   * Compares two objects for equality, where either one or both objects may
   * be <code>null</code>.
   * </p>
   *
   * <pre>
   * ObjectUtils::equals(null, null)                  = true
   * ObjectUtils::equals(null, "")                    = false
   * ObjectUtils::equals("", null)                    = false
   * ObjectUtils::equals("", "")                      = true
   * ObjectUtils::equals(Boolean.TRUE, null)          = false
   * ObjectUtils::equals(Boolean.TRUE, "true")        = false
   * ObjectUtils::equals(Boolean.TRUE, Boolean.TRUE)  = true
   * ObjectUtils::equals(Boolean.TRUE, Boolean.FALSE) = false
   * </pre>
   *
   * @param Object $object1 the first object, may be <code>null</code>
   * @param Object $object2 the second object, may be <code>null</code>
   * @return <code>true</code> if the values of both objects are the same
   */
  public static function equals($object1, $object2) {
    if (!($object1 instanceof Object) || !($object2 instanceof Object)) {
      throw new Exception();
    }
    if ($object1 === $object2) {
      return true;
    }
    if (is_null($object1) || is_null($object2)) {
      return false;
    }
    return $object1->equals($object2);
  }

  /**
   * <p>Gets the toString that would be produced by <code>Object</code>
   * if a class did not override toString itself. <code>null</code>
   * will return <code>null</code>.</p>
   *
   * <pre>
   * ObjectUtils::identityToString(null)         = null
   * </pre>
   *
   * @param Object $object the object to create a toString for, may be
   * 		<code>null</code>
   * @return string the default toString text, or <code>null</code> if
   * 		<code>null</code> passed in
   */
  public static function identityToString($object)
  {
    if (is_null($object)) {
      return null;
    }
    $buffer = self::appendIdentityToString(null, $object);
    return $buffer->toString();
  }

  /**
   * <p>Appends the toString that would be produced by <code>Object</code>
   * if a class did not override toString itself. <code>null</code>
   * will return <code>null</code>.</p>
   *
   * <pre>
   * ObjectUtils::appendIdentityToString(*, null) = null
   * </pre>
   *
   * @param buffer  the buffer to append to, may be <code>null</code>
   * @param object  the object to create a toString for, may be <code>null</code>
   * @return StringBuilder the default toString text, or <code>null</code> if
   *  <code>null</code> passed in
   */
  public static function appendIdentityToString($buffer, $object)
  {
    if (is_null($object)) {
      return null;
    }
    if (is_null($buffer)) {
      $buffer = new StringBuilder();
    }
    return $buffer->append(get_class($object))
    ->append('@')
    ->append(System::identityHashCode($object) . "L");
  }
}
?>