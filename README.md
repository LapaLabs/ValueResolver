# ValueResolver

A tiny library for convenient typecasting and default value resolving.

## Installation

Install package to your project with `Composer`:

``` bash
$ composer require lapalabs/value-resolver dev-master
```

## Usage

> **NOTE:** The *scalar types* (`boolean`, `integer`, `float` and `string`) 
are typecasting first and then resolving with default value if necessary,
but *compound types* (`array` and `object`) are resolving first and then typecasting.

### Value Resolving

```php
use LapaLabs\ValueResolver\Resolver\ValueResolver;

// Create resolver object in order to use available methods
$resolver = new ValueResolver();
$resolver->resolve('some string', 'default'); // returns 'some string' - because first argument is NOT empty

// or simply use static methods directly:
ValueResolver::resolve('', 'default'); // returns 'default' - because first argument is empty
```

### Value Typecasting

``` php
// to string
ValueResolver::toString('6 apples');              // '6 apples'
ValueResolver::toString('6 apples', 'pears');     // '6 apples'
ValueResolver::toString('There are 6 apples');    // ''
ValueResolver::toString('A few apples', 'pears'); // pears

// to integer
ValueResolver::toInteger('6 apples');           // 6
ValueResolver::toInteger('6 apples', 1);        // 6
ValueResolver::toInteger('There are 6 apples'); // 0
ValueResolver::toInteger('A few apples', 1);    // 1

// to float
ValueResolver::toFloat('6 apples');           // 6.0
ValueResolver::toFloat('6 apples', 1.5);      // 6.0
ValueResolver::toFloat('There are 6 apples'); // 0.0
ValueResolver::toFloat('A few apples', 1.5);  // 1.5

// to boolean
ValueResolver::toBoolean('1');                       // true
ValueResolver::toBoolean('not empty string', false); // true
ValueResolver::toBoolean(null);                      // false
ValueResolver::toBoolean('', true);                  // true

// to array
ValueResolver::toArray([1, 2]);                          // [1, 2]
ValueResolver::toArray([1, 2, 3], ['Hello' => 'World']); // [1, 2, 3]
ValueResolver::toArray('Hello');                         // [0 => 'Hello']
ValueResolver::toArray(5, ['Hello' => 'World']);         // [0 => 5]
ValueResolver::toArray('', ['Hello' => 'World']);        // ['Hello' => 'World']

// to object
ValueResolver::toObject('1');                         // {scalar: 1}
ValueResolver::toObject('not empty string');          // {scalar: 'not empty string'}
ValueResolver::toObject(null);                        // {}
ValueResolver::toObject('', $defaultObject);          // {...} default object
ValueResolver::toObject($someObject, $defaultObject); // {...} some object

// or use low-level typecasting method
ValueResolver::typecast(ValueResolver::TYPE_INT, '6 apples', 1);     // 6
ValueResolver::typecast(ValueResolver::TYPE_STRING, 12345, 'Hello'); // '12345'
ValueResolver::typecast(ValueResolver::TYPE_FLOAT, '36.6');          // 36.6
ValueResolver::typecast(ValueResolver::TYPE_BOOL, null, true);       // true
```
