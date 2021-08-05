# kw_paths

Define used paths inside the KWCMS tree. Parse them from REQUEST_URI or other sources.

## PHP Installation

```
{
    "require": {
        "alex-kalanis/kw_paths": ">=1.0"
    }
}
```

(Refer to [Composer Documentation](https://github.com/composer/composer/blob/master/doc/00-intro.md#introduction) if you are not
familiar with composer)


## PHP Usage

1.) Use your autoloader (if not already done via Composer autoloader)

2.) Add some external packages with connection to the local or remote services.

3.) Connect the "kalanis\kw_paths" into your app. Extends it for setting your case.

4.) Connect library into your bootstrap process.

5.) Just use class "kalanis\kw_paths\Path" as data storage

This package contains example file from KWCMS bootstrap. Use it as reference.
