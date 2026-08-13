# scoreStrength *[Private]*

Formats a numerical score into a stylized string representation (e.g., adding plus/minus signs or percentage symbols) based on a specific formatting type.

## Usage

```
scoreStrength(integer $score, string $type = 'add'): string
```

## Parameters

**score** (integer)
: The raw numerical score to be formatted.

**type** (string)
: The formatting style to apply. Options: `add`, `sub`, `pct` (*default*: `'add'`) *^(optional)^*

## Return Value

Returns the formatted score as a string.

## Examples

```
$sec->scoreStrength(5, 'add') = "+5"
$sec->scoreStrength(5, 'sub') = "-5"
$sec->scoreStrength(5, 'pct') = "5%"
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Helpers](../CoreySecurity.md#helpers)
