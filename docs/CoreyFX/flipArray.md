# flipArray

Flips an array, swapping keys and values, but uses conditional logic to handle two special cases:
1. Duplicate Values: If multiple keys share the same value, the resulting key will have an array containing all the original keys.
2. Nested Numerical Arrays: If a value is a numerically indexed array, the nested values are extracted and become new keys in the output, using the original parent key as their value. Otherwise, all other entries flip as normal.

> There are examples below with a comparison to PHP's `array_flip` function.

## Usage

```
flipArray(array $array): array
```

## Parameters

**array** (array)
: Array to flip.

## Return Value

(array)
: Returns the flipped array.

## Examples

```
$fx->flipArray(['a' => 10, 1 => 'apple'])
// Result: [10 => 'a', 'apple' => 1]
```

### Output Examples

| Array [^1] | flipArray [^2] | array_flip [^3] |
| --- | :---: | :---: |
| `['a' => 10, 1 => 'apple']` | `[10 => 'a', 'apple' => 1]` | `[10 => 'a', 'apple' => 1]` |
| `['one', 'two', 'three']` | `['one' => 0, 'two' => 1, 'three' => 2]` | `['one' => 0, 'two' => 1, 'three' => 2]` |
| `['opt' => ['a' => 'one', 'b' => 'two']]` | `['opt' => ['one' => 'a', 'two' => 'b']]` | `[null]` |
| `['int' => ['one', 'two', 'three']]` | `['one' => 'int', 'two' => 'int', 'three' => 'int']` | `[null]` |
| `['one' => 'int', 'two' => 'int', 'three' => 'int']` | `['int' => ['one', 'two', 'three']]` | `['int' => 'three']` |
| `['num', 'num', 'num']` | `['num' => [0, 1, 2]]` | `['num' => 2]` |

[^1]: The array supplied to each function.
[^2]: The output from the supplied array using the `flipArray` method.
[^3]: The output from the supplied array using the `array_flip` function.

## Debug Errors

- Triggers a warning if the argument is an empty array.

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Array Management](../CoreyFX.md#array-management)
