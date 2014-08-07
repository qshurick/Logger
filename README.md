Logger
======
Abstract Logger engine to integrate any Logger with ZendFramework2

# Usage

By default it can be used without additional configuration.

```
namespace some\namespace;

class MyClass {
    protected $logger;

    /** ... */

    function __construct() {
        $this->logger = \Logger\Logger::getLogger(__CLASS__);
    }

    public function doSomething() {
        /** ... */
        $this->logger->info("Something is done");
    }
}
```

# Configuration
Default configuration present at `config/logger.global.php` which should be copied into in one of the `config_glob_paths` ZF2 Application.

## Available options

- `adapter` — adapter class name or its alias, default value id 'monolog'
- `level` — default log level. Should be a lowercase string with one of the following values: debug|info|notice|warning|error|critical|alert|emergency
- `system` — specify default path for a log file
- `error` — specify default path for a error log
- `format` — log format, this value depends on logger adapter

**Example**

```
return array(
    "logger" => array(
        "adapter" => "\\CompanyName\\Logger\\Adapter",
        "level" => "warning",
        "system" => APPLICATION_LOG_PATH . "default.log",
        "error" => APPLICATION_LOG_PATH . "error.log",
        "format" => "[$date] [$level] [$session] $stream $message\n"
    ),
);
```

## Additional options

Also you can specify different options for each of log stream. Specified parameters are: level, path and format. All element are optional, if one of them missed system (default) value will be used.

**Example**

```
return array(
    "logger" => array(
        "my-stream-name" => array(
            "level" => "error",
            "path" => "/some/custom/path/my.log",
            "format" => "[$date] $message"
        ),
        "\\My\\Class\\ForDebug" => array(
            "level" => "debug"
        ),
        "\\Some\\Specific\\Class" => array(
            "path" => "/tmp/other.log"
        ),
    ),
);
```