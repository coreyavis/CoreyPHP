# getSymbols *[Protected]*

Returns the curated string of symbols that will be used for password generation and entropy calculations, after applying any user-defined exclusions.

## Usage

```
getSymbols(): string
```

## Parameters

- Takes no arguments.

## Return Value

Returns a list of symbols as string.

## Examples

```
$sec->getSymbols() = !@#$%^*+-=_.,?:;()

$sec->setConfig('symbols_exclusion', '@_');
$sec->getSymbols() = !#$%^*+-=.,?:;()
```

## Config Options

| Config Key | Default Value | Allowed Values | Description |
| --- | --- | --- | --- |
| exclusion | '' (Empty string) | *string* | Letters, numbers, or symbols you would like to exclude from password generation as string. |

## Debug Errors

- No debug errors.

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Helpers](../CoreySecurity.md#helpers)
