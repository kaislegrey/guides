#Tabula Rasa theme readme#

This theme is not really for use as a theme as it stands.
It's a basis on which to build a custom theme but is at the same time, not a base theme.e

###How to modify the Tabula Rasa to suit your purposes###

Firstly there are some files and folders that need to be renamed.

- Should you be using this as a drupal theme; the whole folder "fd_tabularasa" should be renamed to your own custom theme name.-

    fd_tabularasa => fd_[your-theme-name]

- Rename the fd_tabularasa.info file to your theme name.

    fd_tabularasa.info => fd_[your-theme-name].info

- Open the **template.php** file and do a _find and replace_ on fd_tabularasa and replace with your theme name.
The template.php file contains some functions that are necessary and required by the theme. Should the functions in the file not have the same name as the theme, many of them will not work and therefore the theme will not work.

- Open **bower.json** and edit the following:

    "name": "[your-theme-name]",
    "version": "[your-theme-version-number]",
    "authors": [
    "[your-name]"
    ],
    "description": "[your-theme-description]",

- Replace the current default **logo.png** in the root directory with the project logo.

