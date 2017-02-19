# Match Input plugin for Craft CMS 3.x

Craft field type for text fields that match a regex pattern.

## Installation

To install Match Input, follow these steps:

1. Download and unzip the file and place the `matchinput` directory into your `craft/plugins` directory
3.  -OR- install with Composer via `composer require marionnewlevant/match-input`
4. Install plugin in the Craft Control Panel under Settings > Plugins

Match Input works on Craft 3.x.

## Match Input Overview

A _Match Input_ field is
a _Plain Text_ field with the addition of a regex pattern that the field must match to
be valid.

## Using Match Input

When you create the field, you specify the `Input Mask`.
This is the [PCRE Pattern](http://php.net/manual/en/pcre.pattern.php) which the
input is required to match.
You also specify an `Error Message` to display when the field does not match the
pattern.

If you need to translate the `Error Message` (for a multi-language control panel), those translations
will be in the `site` translation category.

## Sample Input Masks
- `https://` - not a valid pattern (no delimiters)
- `/https:\/\//` - valid pattern, will match string with `https://` in it anywhere
- `#https://#` - valid pattern, will match string with `https://` in it anywhere (sometimes / isn't the best delimiter)
- `#^https://#` - will match string that begins with `https://`
- `/^\d{5}(-\d{4})?$/` - will match 5 digits, optionally followed by `-` and 4 digits (uses ^ and $ to match the entire string)

## Acknowledgements
Brought to you by [Marion Newlevant](http://marion.newlevant.com).
Icon interior by SlideGenius from the Noun Project