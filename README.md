ApixAutoloader, PSR-0 for PHP5.3+
==============

Out of the box, ApixAutoloader is a light [PSR-0][], [PSR-1][], and [PSR-2][] compliant autoloader.
Able to autoload both PHP5.3 namespaces and older PEAR-style classes.

Basic usage
--------------

* At its most basic, it will autoload PSR-0 complient class names in the current include-path:

  ```php
    <?php
        require '/path_to/Apix/Autoloader.php';
        Apix\Autoloader::init();
  ```

* If you want to add some paths to the include-path:

  ```php
    <?php
        require '/path_to/Apix/Autoload.php';

        $prepend = array('path/to/libs', 'path/to/vendor'); // paths to prepend
        $append  = array('path/to/last/dir');               // paths to append
        Apix\Autoload::init($prepend, $append);
  ```

Advanced usage
--------------

```php
  <?php
      require '/path_to/Apix/Autoload.php';

      $loader = new Apix\Autoload;
      $loader->prepend('path/my/libs')
             ->prepend('path/vendors')
             ->append('some/other/path');

      $loader->register(true);  // True to take precedence on registered autoloaders.
                                // False (the default) to follow the stack order.
```

Installation
------------

* Use PEAR for a system-wide installation:

    ```
    sudo pear channel-discover pear.ouarz.net
    sudo pear install --alldeps ouarz/ApixAutoloader
    ```
For more details see [pear.ouarz.net](http://pear.ouarz.net).

* If you are creating a component that relies on ApixAutoloader locally:

  * either update your **`composer.json`** file:

    ```json
    {
      "require": {
        "apix/ApixAutoloader": "1.*.*"
      }
    }
    ```

  * or update your **`package.xml`** file as follow:

    ```xml
    <dependencies>
      <required>
        <package>
          <name>ApixAutoloader</name>
          <channel>pear.ouarz.net</channel>
          <min>1.0.0</min>
          <max>1.999.9999</max>
        </package>
      </required>
    </dependencies>
    ```

License
-------
ApixAutoloader is licensed under the New BSD license -- see the `LICENSE.txt` for the full license details.

[PSR-0]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md