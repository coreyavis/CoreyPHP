# isPhone

Validates if a string is a valid phone number, supporting both North American (NANP) and international formats.

## Usage

```
isPhone(mixed $phone, array &$matches): bool
```

## Parameters

**phone** (mixed)
: The phone number string or value to validate.

**matches** (array)
: If matches is populated, then it returns an associative array containing the parsed components of the phone number. **^(optional)^**

## Return Value

(bool)
: Returns `true` on success and `false` on failure.

If `$matches` is provided then an array is returned with the following:
| Key | Example (US/NANP) | Example (International) | Description |
| --- | --- | --- |
| phone | `+1 (555) 678-9012` | `+33 142685300` | Formatted phone number. |
| cc | `1` | `33` | Country calling code. |
| area | `555` | `""` | 3-digit area code (NANP only; empty string for int'l). |
| prefix | `678` | `""` | 3-digit exchange prefix (NANP only; empty string for int'l). |
| line | `9012` | `""` | 4-digit subscriber line (NANP only; empty string for int'l). |
| national | `5556789012` | `142685300` | Full national subscriber number excluding the country code. |
| ext | `123` | `123` | Extension number if present (otherwise empty string). |
| e164 | `+15556789012` | `+33142685300` | Standard E.164 formatted international string. |

## Examples

```
// North American (NANP) Formats
$fx->isPhone('555-678-9012') = true
$fx->isPhone('(555) 678-9012') = true
$fx->isPhone('555678901') = false

// International Formats
$fx->isPhone('+33 1 42 68 53 00') = true (France)
$fx->isPhone('+33 (0) 1 42 68 53 00') = false (Trunk prefix (0) is invalid in international format)
$fx->isPhone('+555 123 4567') = false (Invalid country code block)
$fx->isPhone('+44 12') = false (National number too short)
```

## Supported Country Codes

Below is the list of supported calling codes recognized by the international validation engine:

| Code | Region / Country | Code | Region / Country | Code | Region / Country |
| :--- | :--- | :--- | :--- | :--- | :--- |
| 1 | North America (US, CA, Caribbean) | 234 | Nigeria | 386 | Slovenia |
| 7 | Russia / Kazakhstan | 235 | Chad | 387 | Bosnia and Herzegovina |
| 20 | Egypt | 236 | Central African Republic | 389 | North Macedonia |
| 27 | South Africa | 237 | Cameroon | 420 | Czech Republic |
| 30 | Greece | 238 | Cape Verde | 421 | Slovakia |
| 31 | Netherlands | 239 | São Tomé and Príncipe | 423 | Liechtenstein |
| 32 | Belgium | 240 | Equatorial Guinea | 500 | Falkland Islands |
| 33 | France | 241 | Gabon | 501 | Belize |
| 34 | Spain | 242 | Republic of the Congo | 502 | Guatemala |
| 36 | Hungary | 243 | DR Congo | 503 | El Salvador |
| 39 | Italy | 244 | Angola | 504 | Honduras |
| 40 | Romania | 245 | Guinea-Bissau | 505 | Nicaragua |
| 41 | Switzerland | 246 | Diego Garcia | 506 | Costa Rica |
| 43 | Austria | 247 | Ascension Island | 507 | Panama |
| 44 | United Kingdom | 248 | Seychelles | 508 | Saint Pierre and Miquelon |
| 45 | Denmark | 249 | Sudan | 509 | Haiti |
| 46 | Sweden | 250 | Rwanda | 590 | Guadeloupe / St. Martin |
| 47 | Norway | 251 | Ethiopia | 591 | Bolivia |
| 48 | Poland | 252 | Somalia | 592 | Guyana |
| 49 | Germany | 253 | Djibouti | 593 | Ecuador |
| 51 | Peru | 254 | Kenya | 594 | French Guiana |
| 52 | Mexico | 255 | Tanzania | 595 | Paraguay |
| 53 | Cuba | 256 | Uganda | 596 | Martinique |
| 54 | Argentina | 257 | Burundi | 597 | Suriname |
| 55 | Brazil | 258 | Mozambique | 598 | Uruguay |
| 56 | Chile | 260 | Zambia | 599 | Curaçao / Caribbean NL |
| 57 | Colombia | 261 | Madagascar | 670 | East Timor |
| 58 | Venezuela | 262 | Réunion / Mayotte | 672 | Norfolk Island |
| 60 | Malaysia | 263 | Zimbabwe | 673 | Brunei |
| 61 | Australia | 264 | Namibia | 674 | Nauru |
| 62 | Indonesia | 265 | Malawi | 675 | Papua New Guinea |
| 63 | Philippines | 266 | Lesotho | 676 | Tonga |
| 64 | New Zealand | 267 | Botswana | 677 | Solomon Islands |
| 65 | Singapore | 268 | Eswatini | 678 | Vanuatu |
| 66 | Thailand | 269 | Comoros | 679 | Fiji |
| 81 | Japan | 290 | Saint Helena | 680 | Palau |
| 82 | South Korea | 291 | Eritrea | 681 | Wallis and Futuna |
| 84 | Vietnam | 297 | Aruba | 682 | Cook Islands |
| 86 | China | 298 | Faroe Islands | 683 | Niue |
| 90 | Turkey | 299 | Greenland | 685 | Samoa |
| 91 | India | 350 | Gibraltar | 686 | Kiribati |
| 92 | Pakistan | 351 | Portugal | 687 | New Caledonia |
| 93 | Afghanistan | 352 | Luxembourg | 688 | Tuvalu |
| 94 | Sri Lanka | 353 | Ireland | 689 | French Polynesia |
| 95 | Myanmar | 354 | Iceland | 690 | Tokelau |
| 98 | Iran | 355 | Albania | 691 | Micronesia |
| 212 | Morocco | 356 | Malta | 692 | Marshall Islands |
| 213 | Algeria | 357 | Cyprus | 850 | North Korea |
| 216 | Tunisia | 358 | Finland | 852 | Hong Kong |
| 218 | Libya | 359 | Bulgaria | 853 | Macau |
| 220 | Gambia | 370 | Lithuania | 855 | Cambodia |
| 221 | Senegal | 371 | Latvia | 856 | Laos |
| 222 | Mauritania | 372 | Estonia | 880 | Bangladesh |
| 223 | Mali | 373 | Moldova | 886 | Taiwan |
| 224 | Guinea | 374 | Armenia | 960 | Maldives |
| 225 | Ivory Coast | 375 | Belarus | 961 | Lebanon |
| 226 | Burkina Faso | 376 | Andorra | 962 | Jordan |
| 227 | Niger | 377 | Monaco | 963 | Syria |
| 228 | Togo | 378 | San Marino | 964 | Iraq |
| 229 | Benin | 379 | Vatican City | 965 | Kuwait |
| 230 | Mauritius | 380 | Ukraine | 966 | Saudi Arabia |
| 231 | Liberia | 381 | Serbia | 967 | Yemen |
| 232 | Sierra Leone | 382 | Montenegro | 968 | Oman |
| 233 | Ghana | 383 | Kosovo | 970 | Palestine |
| 971 | United Arab Emirates | 974 | Qatar | 993 | Turkmenistan |
| 972 | Israel | 975 | Bhutan | 994 | Azerbaijan |
| 973 | Bahrain | 976 | Mongolia | 995 | Georgia |
| | | 977 | Nepal | 996 | Kyrgyzstan |
| | | 992 | Tajikistan | 998 | Uzbekistan |

## Debug Errors

- No debug errors.

## Related Methods

[isEmail](isEmail.md)

---
[Home](../Home.md) | [CoreyFX](../CoreyFX.md) | [Validation](../CoreyFX.md#validation)
