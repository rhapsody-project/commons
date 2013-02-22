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
 * <p>
 * Factory class to parse, and return, <code>XMLElement</code> objects from
 * <tt>.xml</tt> files.
 * </p>
 *
 * @author 	  Sean W. Quinn
 * @category  Rhapsody Commons
 * @package   Rhapsody\Commons\Xml
 * @copyright Copyright (c) 2013 Rhapsody Project
 * @version   $Id$
 */
class XMLParser
{

  /** The local instance of the parsed <tt>XML</tt>. */
  private $_xml;

  /** Any errors in loading the XML file that were encountered. */
  private $_loadFileErrorStr = null;

  protected function getXml()
  {
    return $this->_xml;
  }

  private function __construct($xml)
  {
    $this->_xml = $this->_parse($xml);
  }

  /**
   * @param string $xml the <tt>XML</tt> of <tt>.xml</tt> file that will be
   *    parsed into <code>XMLElement</code>s.
   * @return XMLElement
   */
  protected function _parse($xml)
  {
    $config = null;

    // **
    // Suppress warnings and errors while we load the XML, moving them rather
    // into a string that we can reference later.
    set_error_handler(array($this, '_loadFileErrorHandler'));
    if (strstr($xml, '<?xml')) {
      $config = simplexml_load_string($xml, 'Commons\Xml\XMLElement');
    }
    else {
      $config = simplexml_load_file($xml, 'Commons\Xml\XMLElement');
    }
    restore_error_handler();

    // Check if there was a error while loading file
    if ($this->_loadFileErrorStr !== null) {
      throw new \Exception($this->_loadFileErrorStr);
    }

    return $config;
  }

  /**
   * Handle any errors from simplexml_load_file or parse_ini_file
   *
   * @param integer $errno
   * @param string $errstr
   * @param string $errfile
   * @param integer $errline
   */
  protected function _loadFileErrorHandler($errno, $errstr, $errfile, $errline)
  {
    if ($this->_loadFileErrorStr === null) {
      $this->_loadFileErrorStr = $errstr;
    } else {
      $this->_loadFileErrorStr .= (PHP_EOL . $errstr);
    }
  }

  /**
   * <p>
   * </p>
   * @param mixed $xml either a string representing an <tt>XML</tt> data
   *     structure or an <tt>.xml</tt> file.
   * @return XMLElement the <code>XMLElement</code>.
   */
  public static function parse($xml, $section = null)
  {
    $parser = new XMLParser($xml);
    if (is_string($section) && !empty($section)) {
      return $parser->getXml()->get($section, true);
    }
    return $parser->getXml();
  }
}
?>
