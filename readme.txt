=== MC Login Code ===

Contributors: Mike Hickcox, lowest, birgire
Donate link: https://mid-coast.com/mc-plugin-donations
Tags: Login Code,Login Form,Third Login Field,Authorization Code,Custom Login Form,Login Protection
Tested up to: 6.3.2
Stable tag: 2.3.2
Requires PHP: 7.0
License: GPLv2 or later license
URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds an authentication code field to your login form for better security and a block to brute-force attacks.


== Description ==

This lightweight plugin is ideal for solo admins and for admin groups.
* Adds an authorization code field as the third field in your login form for better security.
* Access is denied when the login code field is invalid or empty.
* Users must know the login code to login to the website.
* When the code is updated or disabled, the website administator receives an email to confirm the code or disabling of the Login Code.
* To disable this feature, the admin can leave the login code field blank on the settings page.


== Installation ==

* Download and Activate the plugin.
* Go to Settings -> MC Login Code.
* Or, Find the Settings link under the name in the admin plugins list.
* Type in your login code and save it. The third field is now active on your login form.


== Frequently Asked Questions ==

= When do I need to use the login code? =
Whenever anyone logs in to the website, they need to use their username and password as before, and also use this login code to gain access.

= How do I set the code? =
After to activate this plugin, go to Tools > MC Login Code and enter your desired code, 4 to 20 characters.

= Do I need to set the code for every user? =
No. there is one code for the website. Everyone who signs in must use that code.

= What if I forget my login code? =
Use a program like FileZilla or access the File Manager through your host's CPanel.
Delete the "mc-login-code" folder from your plugins folder.
Log back in as admin. (There will now be no third field.) Reinstall the plugin.

= What's the purpose of this again? =
Any bot that tries to guess username and password to get into your site will fail.
Even if they have the right username and password, they won't have a login code.


== Screenshots ==
1. This is your WordPress login screen. This plugin add the third field: Login Code.
2. After activating, you'll find the plugin listed in your left Settings menu.
3. You can also access the setting for this plugin from the main list of plugins.
4. On the settings page, you enter your new greeting and click on Submit.
5. An example of the email the website administrator receives when the code is updated or removed.


== Changelog ==
* 2.3.2 Code updated for compatibilty with PHP 7.4
* 2.3 Initial Release to WordPress


== Upgrade Notice ==

* 2.3.2 Code updated for compatibilty with PHP 7.4
