# between

The `between` method allows you to query records where a column's value falls within an inclusive range. It is designed to be chained directly after the `where` method. If the method is passed a single argument than the query will be converted.

> NOTE: If the `between` method is used before the `where` method than the `between` method will be ignored.

## Usage

```
between(string|int|float $min, string|int|float|null $max = null): static
between(string|int|float $max): static
```

## Parameters

**min** (string|int|float)
: The minumum value (lower bound) of the range.

**max** (string|int|float|null)
: The maximum value (upper bound) of the range. *^(optional)^*

> If only `max` is provided than the query will be converted to either a standard `WHERE` equality condition for strings or create a range query starting from zero for positive integers or ending at zero for negative numbers.

## Return Value

Returns the current instance to allow for method chaining.

## Examples

```
$db->select()->where('qty')->between(10, 20)->execute();
// Result: SELECT * FROM `table` WHERE `qty` BETWEEN 10 AND 20

$db->select()->where('qty')->between(20)->execute();
// Result: SELECT * FROM `table` WHERE `qty` BETWEEN 0 AND 20

$db->select()->where('qty')->between(-20)->execute();
// Result: SELECT * FROM `table` WHERE `qty` BETWEEN -20 AND 0

$db->select()->where('user')->between('L', 'M')->execute();
// Result: SELECT * FROM `table` WHERE `user` BETWEEN 'L' AND 'M'

$db->select()->where('user')->between('M')->execute();
// Result: SELECT * FROM `table` WHERE `user` = 'M'
```

## Debug Errors

- Logs a notice is query is modified.
- Logs a notice if method is ignored.

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Modifiers](../CoreyDB.md#modifiers)
