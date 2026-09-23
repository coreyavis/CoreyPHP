# normalizeWhere *[Protected]*

Processes and converts key-value pairs, indexed arrays, and fully-keyed associative arrays into a uniform format to simplify downstream SQL generation. Used within the `andWhere` and `orWhere` methods.

## Usage

```
normalizeWhere(array $array = []): array
```

## Parameters

**array** (array)
: The multi-dimensional array containing supported input formats.

> Each element must follow one of the three supported structures:
>
>> :one: Key-Value Pair: An associative array where the key is the `column` and the value is the `value`. Uses the default `=` operator. (ex. ``['user' => 'name']``)
>
>> :two: Indexed Array: A numerically indexed array representing `column`, `value` and `op` (in that order). The 3rd value is optional and defaults to `=`. (ex. ``['qty', 10, '>']`` or ``['user', 'name']``)
>
>> :three: Full Associative Array: A formal array using explicit `column`, `value`, and `op` keys. (ex. ``['column' => 'user', 'value' => 'name', 'op' => '<>']``)

## Return Value

(array)
: Returns the uniform array.

## Examples

```
$db->normalizeWhere(['id' => 12])
// Result: ['column' => 'id', 'value' => 12, 'op' => '=']

$db->normalizeWhere(['qty', 10, '>'])
// Result: ['column' => 'qty', 'value' => 10, 'op' => '>']
```

## Debug Errors

- Logs a notice if no array is present.

## Related Methods

[where](where.md) | [andWhere](andWhere.md) | [orWhere](orWhere.md) | [whereGroup](whereGroup.md) | [whereStr](whereStr.md)

---
[Home](../Home.md) | [CoreyDB](../CoreyDB.md) | [Helpers](../CoreyDB.md#helpers)
