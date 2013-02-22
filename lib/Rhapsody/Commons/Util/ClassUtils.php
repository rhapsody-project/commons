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
class ClassUtils
{

  /** The PEAR separator. */
  const PEAR_SEPARATOR = '_';

  /** The PHP namespace separator. */
  const PHP_NAMESPACE_SEPARATOR = '\\';

  /** Conversion pattern identifier for converting to lower-camelcasing. */
  const CONVERT_TO_LOWER_CAMEL = 0x00;

  /** Conversion pattern identifier for converting to upper-camelcasing. */
  const CONVERT_TO_UPPER_CAMEL = 0x01;

  /** Conversion pattern identifier for converting to underscore format. */
  const CONVERT_TO_UNDERSCORE = 0x02;

  /**
   * <p>Gets the class name minus the package name from a String.</p>
   *
   * <p>The string passed in is assumed to be a class name - it is not checked.</p>
   *
   * @param string $className the <tt>className</tt> to get the short name for
   * @return string the class name of the class without the package name or an
   * 		empty string.
   */
  public static final function getShortClassName($class)
  {
    if (empty($className)) {
      return StringUtils::EMPTY_STRING;
    }

    $className = is_object($$class) ? get_class($class) : $class;
    $length = strlen($className);
    $lastSlash = 0;
    for($i = 0; $i < $length; $i++) {
      if ($className[$i] == PACKAGE_SEPARATOR_CHAR) {
        $lastSlash = $i + 1;
      }
    }
    return substr($className, $lastSlash, $length - $lastSlash);
  }

  /**
   *
   * @param unknown_type $functionName
   * @param unknown_type $mode
   */
  public static final function convertFunctionName($functionName, $mode = ClassUtils::CONVERT_TO_LOWER_CAMEL)
  {
    $converted = null;
    if (!empty($functionName)) {
      switch ($mode) {
        case ClassUtils::CONVERT_TO_UPPER_CAMEL:
          $converted = preg_replace('/(?:^|_)(.?)/e', "strtoupper('$1')" , $functionName);
          break;

        case ClassUtils::CONVERT_TO_UNDERSCORE:
          $converted = strtolower(preg_replace('/([^A-Z])([A-Z])/', "$1_$2", $functionName));
          break;

        case ClassUtils::CONVERT_TO_LOWER_CAMEL:
        default:
          $converted = preg_replace('/_(.?)/e', "strtoupper('$1')", $functionName);
          break;
      }
    }
    return $converted;
  }

  private static final function escapePattern($pattern)
  {
    $escapedPattern = str_replace('.', '\.', $pattern);
    return $escapedPattern;
  }

  /**
   *
   * @param string $className
   */
  public static final function toAbsoluteClassName($className)
  {
    $trimmedClass = ltrim($className, '\/\\');
    return self::PHP_NAMESPACE_SEPARATOR . $trimmedClass;
  }

  /**
   *
   * @param stirng $filename
   * @param string $baseDir
   * @param string $extension
   */
  public static final function getAbsoluteClassFromFileName($filename, $baseDir = null, $extension = '.php')
  {
    $className = self::getClassFromFileName($filename, $baseDir, $extension);
    return self::toAbsoluteClassName($className);
  }

  /**
   *
   * @param stirng $filename
   * @param string $baseDir
   * @param string $extension
   */
  public static final function getAbsolutePearClassFromFileName($filename, $baseDir = null, $extension = '.php') {
    $className = self::getPearClassFromFileName($filename, $baseDir, $extension);
    return self::toAbsoluteClassName($className);
  }

  /**
   * <p>
   * Derives the class name based on the <tt>$filename</tt> passed. This
   * assumes the following: there is only one class per file, and that the
   * class name follows Java's dot-path convention of naming files, namespace
   * and all, according to their physical path with respect to the project's
   * class path.
   * </p>
   * <p>
   * The class name returned can be returned as a fully qualified class name
   * if the <tt>$fullyQualified</tt> flag is set to <tt>true</tt> and a
   * <tt>$baseDir</tt> given. If both of these conditions are met, this
   * method will be able to reliably differentiate between a fully qualified
   * PEAR class name, and one using the PHP native namespace separator.
   * </p>
   *
   * 1. If an underscore exists as part of the filename, e.g. Foo_Bar.php
   *    do not bother with PEAR
   * 2. If fully qualified is TRUE, we will always add namespace information.
   * 3.
   *
   * @param string $filename the name of the file
   * @param boolean $baseDir
   * @param string $extension
   */
  public static final function getClassFromFileName($filename, $baseDir = null, $extension = '.php') 
  {
    $pos = 0;
    $className = null;
    if (!is_null($baseDir)) {
      $pos = strpos($filename, $baseDir);
      $filename = substr($filename, $pos + strlen($baseDir));
    }

    $_filename = str_replace('\\', DIRECTORY_SEPARATOR, $filename);
    $_filename = str_replace('/', DIRECTORY_SEPARATOR, $_filename);
    $extensionPattern = ClassUtils::escapePattern($extension);
    $pattern = '/^(?P<className>[a-zA-Z0-9\/\\\\_]+)([\.]?' . $extensionPattern . '){1}$/';
    if (preg_match($pattern, $_filename, $matches)) {
      $className = ltrim($matches['className'], DIRECTORY_SEPARATOR);
    }
    $className = str_replace(DIRECTORY_SEPARATOR, self::PHP_NAMESPACE_SEPARATOR, $className);
    return $className;
  }

  /**
   *
   * @param string $filename the name of the file
   * @param boolean $baseDir
   * @param string $extension
   */
  public static final function getPearClassFromFileName($filename, $baseDir = null, $extension = '.php')
  {
    $className = self::getClassFromFileName($filename, $baseDir, $extension);
    $pearClass = str_replace(self::PHP_NAMESPACE_SEPARATOR, self::PEAR_SEPARATOR, $className);
    return $pearClass;
  }
}
?>