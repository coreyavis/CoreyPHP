# interest

Calculates credit card interest over a specific billing period using daily periodic rates, with an option to return a formatted currency string.

## Usage

```
method(float $balance = 0.0, float $apr = 12.0, integer $days = 30, integer $daysInYear = 365, bool $asString = false): string|float
```

## Parameters

**balance** (float)
: The balance subject to interest. (*default*: `0.0`) *^(optional)^*

**apr** (float)
: Annual Percentage Rate as a percentage (e.g., `18.5` for 18.5%) (*default*: `12.0`) *^(optional)^*

**days** (integer)
: Number of days in the billing cycle. (*default*: `30`) *^(optional)^*

**daysInYear** (integer)
: Annual rate divisor (typically `365`, occasionally `360` or `366`) (*default*: `365`) *^(optional)^*

**asString** (bool)
: If set to `true`, returns a formatted currency string prefixed with `$` and padded to 2 decimal places.
: If `false`, returns a float. (*default*: `false`) *^(optional)^*

## Return Value

Returns the calculated interest as a rounded `float`, or as a formatted `string` (e.g., `"$14.79"`) if `$asString` is set to `true`.

(string|float)
: Returns `0.0` or `"$0.00"` for zero or negative balances/days.

## Examples

```
// Calculate interest as a float
$fx->interest(1000.00, 18.0, 30) = 14.79 (float)

// Return formatted currency string
$fx->interest(1000.00, 18.0, 30, 365, true) = "$14.79" (string)

// Zero balance with asString enabled
$fx->interest(0.00, 18.0, 30, 365, true) = "$0.00"
```

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Financial](../CoreyFX.md#financial)
