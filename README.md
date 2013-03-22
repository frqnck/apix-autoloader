APIx Autoloader, PSR-0 for PHP5.3+
==================================

Apix Autoloader is a light [PSR-0][] compliant autoloader which can autoload both PHP5.3 namespaces and older PEAR-style classes.

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
        require '/path_to/Apix/Autoloader.php';

        $prepend = array('path/to/libs', 'path/to/vendor'); // paths to prepend
        $append  = array('path/to/last/dir');               // paths to append
        Apix\Autoloader::init($prepend, $append);
  ```

Advanced usage
--------------

```php
  <?php
      require '/path_to/Apix/Autoloader.php';

      $loader = new Apix\Autoloader;
      $loader->prepend('path/my/libs')
             ->prepend('path/vendors')
             ->append('some/other/path');

      $loader->register(true);  // True to take precedence on registered autoloaders.
                                // False (the default) to follow the stack order.
```

Installation
------------

* If you are creating a component that relies on Apix Autoloader locally:

  * either update your **`composer.json`** file:

    ```json
    {
      "require": {
        "apix/autoloader": "1.0.*"
      }
    }
    ```

  * or update your **`package.xml`** file as follow:

    ```xml
    <dependencies>
      <required>
        <package>
          <name>apix_autoloader</name>
          <channel>pear.ouarz.net</channel>
          <min>1.0.0</min>
          <max>1.999.999</max>
        </package>
      </required>
    </dependencies>
    ```
* For a system-wide installation, use PEAR as follow:

    ```
    sudo pear channel-discover pear.ouarz.net
    sudo pear install --alldeps ouarz/apix_autoloader
    ```
Checkout [pear.ouarz.net](http://pear.ouarz.net) for more details.

License
-------
Apix Autoloader is licensed under the New BSD license -- see the `LICENSE.txt` for the full license details.

[PSR-0]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
