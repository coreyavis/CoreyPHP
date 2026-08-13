# loadCustomBlacklist

Extends the core security blacklist by merging custom prohibited words, dictionary terms, or brand-specific keywords into the active instance.

> :pushpin: Automatic Normalization: All custom entries are automatically converted to lowercase and de-duplicated. When evaluated by `passStrength()`, leet-speak substitutions (e.g., `@` -> `a`, `0` -> `o`, `$` -> `s`) are stripped, so adding `company` will automatically block `C0mp@ny123!`.

## Usage

```
loadCustomBlacklist(array $words): static
```

## Parameters

**words** (array)
: An array of strings representing disallowed root words or forbidden terms.

## Return Value

Returns the current instance to allow for method chaining.

## Examples

1. Adding Company-Specific Blacklist Words

```
$sec->loadCustomBlacklist(['mycompany', 'internalApp', 'acmeCorp']);
$sec->passStrength('MyC0mp@ny2026!', $data);
$data['Complexity'] = Common / Vulnerable
```

2. Fluent Chaining During Configuration

```
$sec->loadCustomBlacklist(['payroll', 'finance', 'admin2026'])->passStrength($userPassword, $auditData);
```

## Debug Errors

- No debug errors.

## Related Methods

[passStrength](passStrength.md)

---
[Home](../Home.md) | [CoreySecurity](../CoreySecurity.md) | [Config](../CoreySecurity.md#config)
