# CS-2623 Week 4 - GitHub Copilto Awareness Log

## SSP07 - Ex 11-1 (Arrays)
## Accepted
-When Adding more products to the Catalog List, I accepeted Copiltos input. I just Checked if the values where Greater than $3 dollars.
## Rejected
-Made sure all echoed values had htmlspecialchars()
## Improved
-Array $fruits Changed to [] short Syntax
-Added tru for strict type comparison  $found = in_array($search, $fruits, true);
- For array_filter improved with arrow function  $filtered = array_filter($fruits, fn($f) => strlen($f) >= 6);
-Wrapped with number_format() for currency formatting.
------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------

## SSP07 - Ex 15-1
## Accepted
-When creating the product code field, I accpeted copilots auto complete after adding it to validateContact() function.
-Accepted Copilot exception message output order.
## Rejected
-Copilot suggested Custom email regex pattern, instead used filter_var() with FILTER_VALIDATE_EMAIL.

## Improved
-Reorder Exception message output. 
-----------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------

## SSP06 - Ex 21-2
## Accepted
-Using session_destroy in order to protect user account after they log-out
-using password_verigy() with hashed password, for security.
## Rejected
using password_verify() with hashed instead of $pw === 'secret' because plain-text password is written directly in source code, making it easier to find and use.
## Improved
-session_regenerate in order for the user to get new id in order for it to be more secured. The old id could be use by attacker.
-------------------------------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------------------------------
## SSP06 - Ex 23-1
## Accepted
-When creating remove button, copilot was able to finish auto complete the rest of the button. I had to make sure it worked and it did.
## Rejected
-did not use sessions start, instead was told to use login from exrcise 21-2.
## Improved
-Was able to have price output shown in currency format due to using wrapped with number_format($price,2) this makes it look cleaner and more accurate for a shopping cart.