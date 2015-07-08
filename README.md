# ValueResolver

A tiny library for convenient typecasting and default value resolving.

## Installation

Install package to your project with `Composer`:

``` bash
$ composer require lapalabs/value-resolver dev-master
```

## Usage

### Value Resolving

```php
use LapaLabs\ValueResolver\Resolver\ValueResolver;

$value1 = ;
$value2 = ''; // empty string

// Create resolver object in order to use available methods
$resolver = new ValueResolver();
$resolver->resolve('some string', 'default'); // returns 'some string' - because first argument is NOT empty

// or simply use static methods directly:
ValueResolver::resolve('', 'default'); // returns 'default' - because first argument is empty
```

### Value Typecasting

``` php
// to string
ValueResolver::string('6 apples');              // '6 apples'
ValueResolver::string('6 apples', 'pears');     // '6 apples'
ValueResolver::string('There are 6 apples');    // ''
ValueResolver::string('A few apples', 'pears'); // pears

// to integer
ValueResolver::integer('6 apples');           // 6
ValueResolver::integer('6 apples', 1);        // 6
ValueResolver::integer('There are 6 apples'); // 0
ValueResolver::integer('A few apples', 1);    // 1

// to float
ValueResolver::float('6 apples');           // 6.0
ValueResolver::float('6 apples', 1.5);      // 6.0
ValueResolver::float('There are 6 apples'); // 0.0
ValueResolver::float('A few apples', 1.5);  // 1.5

// to boolean
ValueResolver::boolean('1');                       // true
ValueResolver::boolean('not empty string', false); // true
ValueResolver::boolean(null);                      // false
ValueResolver::boolean('', true);                  // true

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

// or use low-level method
ValueResolver::typecasting(ValueResolver::TYPE_INT, '6 apples', 1);     // 6
ValueResolver::typecasting(ValueResolver::TYPE_STRING, 12345, 'Hello'); // '12345'
ValueResolver::typecasting(ValueResolver::TYPE_FLOAT, '36.6');          // 36.6
ValueResolver::typecasting(ValueResolver::TYPE_BOOL, null, true);       // true
```
