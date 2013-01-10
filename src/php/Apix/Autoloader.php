<?php

/**
 * Copyright (c) 2010-2013 Franck Cassedanne, Ouarz Technology Ltd.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Apix or Ouarz nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package     Apix
 * @author      Franck Cassedanne <franck @ ouarz.net>
 * @copyright   2010-2013 Franck Cassedanne <franck @ ouarz.net>
 * @license     http://opensource.org/licenses/BSD-3-Clause  New BSD License
 * @link        http://pear.ouarz.net
 */

namespace Apix;

class Autoloader
{

    public $early_paths = array();

    public $late_paths = array();

    /**
     * Implodes an array of paths.
     *
     * @param  array  $paths
     * @return string Returns a string.
     */
    public static function implode(array $paths)
    {
        return implode(PATH_SEPARATOR, $paths);
    }

    /**
     * Registers a new autoloader.
     *
     * @param boolean $prepend Wether to prepend the autoloader on the autoload
     *                         stack instead of appending it.
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function register($prepend=false)
    {
        $str_path = '';

        if (!empty($this->early_paths)) {
            $str_path .= self::implode($this->early_paths) . PATH_SEPARATOR;
        }

        $str_path .= get_include_path();

        if (!empty($this->late_paths)) {
            $str_path .= PATH_SEPARATOR . self::implode($this->late_paths);
        }

        set_include_path($str_path);

        return spl_autoload_register(array('static', 'load'), $prepend);
    }

    /**
     * Loads a class.
     *
     * @param  string  $class
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public static function load($class)
    {
        $class = self::normalise($class);

        $paths = explode(PATH_SEPARATOR, get_include_path());

        foreach ($paths as $path) {
            $file = $path . DIRECTORY_SEPARATOR . $class;

            if ( is_file($file) ) {
                include $file;

                return true;
            }
        }

        return false;
    }

    /**
     * Normalises a class name.
     *
     * @param  string $class
     * @param  string $ext   The file extension for the file.
     * @return string
     */
    public static function normalise($class, $ext='.php')
    {
        $file = '';
        $last = strripos($class, '\\');

        if ($last != false) {
            $ns = substr($class, 0, $last);
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $ns)
                    . DIRECTORY_SEPARATOR;
            $class = substr($class, $last+1);
        }

        return $file . str_replace('_', DIRECTORY_SEPARATOR, $class) . $ext;
    }

    /**
     * Prepends a new path
     *
     * @param  string $path
     * @return self   Returns a fluent interface
     */
    public function prepend($path)
    {
        $this->early_paths[] = $path;

        return $this;
    }

    /**
     * Appends a new path
     *
     * @param  string $path
     * @return self   Returns a fluent interface
     */
    public function append($path)
    {
        $this->late_paths[] = $path;

        return $this;
    }

    /**
     * Initialise a new autoloader (static shortcut).
     *
     * @param array   $early   The paths to prepend to the include path.
     * @param array   $late    The paths to append to the include path.
     * @param boolean $prepend Wether to prepend the autoloader on the autoload
     *                         stack instead of appending it.
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public static function init(array $early=null, array $late=null, $prepend=false)
    {
        $loader = new self;
        if (null != $early) {
            $loader->early_paths = $early;
        }
        if (null != $late) {
            $loader->late_paths = $late;
        }

        return $loader->register($prepend);
    }

}
