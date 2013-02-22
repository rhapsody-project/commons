<?php
/* Copyright 2009 PHP Commons
 *
 * Licensed under the Apache License, Version 2.0
 * (the "License"); you may not use this file except
 * in compliance with the License. You may obtain a
 * copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in
 * writing, software distributed under the License is
 * distributed on an "AS IS" BASIS, WITHOUT WARRANTIES
 * OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing
 * permissions and limitations under the License.
 */

final class Modifier {

  const IS_STATIC = 1;
  const IS_PUBLIC = 256;
  const IS_PROTECTED = 512;
  const IS_PRIVATE = 1024;
  const IS_ABSTRACT = 2;
  const IS_FINAL = 4;

  /**
   * <p>
   * Return <tt>true</tt> if the integer argument includes the
   * <tt>public</tt> modifier, <tt>false</tt> otherwise.
   * </p>
   *
   * @param int $mod a set of modifiers
   * @return <tt>true</tt> if <code>mod</code> includes the
   * <tt>public</tt> modifier; <tt>false</tt> otherwise.
   */
  public static function isPublic($mod) {
    return ($mod & self::IS_PUBLIC) != 0;
  }
}