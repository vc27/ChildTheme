ChildTheme
====================

ChildTheme is intended to be a barebones starting point for WordPress use. ChildTheme requires ParentTheme.

### Current Task

### Issues

### Notes

ChangeLog
====================

### 03.27.16 - v-6.2.0 randy-c-9.1
- add "foundation-sites": "^6.0.0", to package.json

### 03.27.16 - v-6.1.0 randy-c-9.0
- add composer.json
- include vendor autoload for Monolog and RollBar
- create base init classes for Monolog and RollBar
- minor cleaning of general class files

### 03.23.16 - v-6.0.2 randy-c-8.0
- move style.css to /css and leave style.css in root for theme info

### 03.21.16 - v-6.0.1 randy-c-7.0
- update scss mixins
- update addons classes with minor cleaning

### 03.20.16 - v-6.0.0 randy-c-6.2
- fine tune grunt setup

### 03.20.16 - v-6.0.0 randy-c-6.1
- update compile to grunt
- update gitignore
- update css & html foundations
- update template with clean start
- confirm function.php is clean
- confirm js is clean

### 03.20.16 - v-6.0.0 randy-c-6.0
- remove randy commit log and merge it into the readme file.
- set current task list

### 12.05.15 - randy-c-5.7.0
- add icomoon
- clean functions.php a little more
- clean css a bit more
- clean ngApp a little
- update admin customizations a little
- clean theme options a little

### 10.09.15 - randy-c-5.6.1
- final commit to master
- update theme options to remove featured image on page

### 10.09.15 - randy-c-5.6.0
- split mixin file in two parts
- add a few mixins from various projects
- remove old IE scss files
- tidy functions.php

### 08.17.15 - randy-c-5.5.2
- update ACFWP
- remove methods from ACF admin
- add metacake to hidden ACF admin

### 08.17.15 - randy-c-5.5.1
- break out scss into sections and layout
- updae scss mixin
- update addon admin customization to re-include login-logo
- add blank -login-logo.png - remove preceding "-" to use

### 08.17.15 - randy-c-5.5.0
- re-add change-log
- re-add db-update.sql

### 06.03.15 - 5.4.0
- update readme file with basic info

### 05.30.15 - 5.3.0
- update wpseo edits with clean approach for submenus
- update admin customization
- update acfthemeoptions
- swap html5shiv for modernizr
- update modal in ngApp.js

### 05.28.15 - 5.2.0
- cleanup prep

### 02.27.15 - 5.1.0
- update childTheme.js to remove un-needed items
- update mixin.scss with align
- update AdminCustomizationsWP with less constrictions

### 02.21.15 - 5.0.0
- update theme options to pull from parent theme
- update theme templates header footer
- remove tpl-home.php
- add ACFWP addon as default

### 02.21.15 - 4.4.0
- update css fundumentals

### 01.29.15 - 4.3.0
- add angular as default
- add template files for modal and loader

### 12.01.14 - 4.2.0
- remove a clear div
- add section-main-inner-wrap to primary inner-wrap
- clean IE scss files
- update @mixin box-sizing

### 11.03.14 - 4.1.0
- update reset with better fade.in fade.out

### 09.07.14 - 4.0.2
- finish acf options
- clean a little css

### 09.06.14 - 4.0.1
- clean up header footer css

### 07.26.14 - 4.0.0
- clean out functions.php with new functions from ParentTheme 6.9

### 06.02.14 - 3.10.0
- update IE check to include get variable

### 05.30.14 - 3.9.0
- standardize a few css items for a more clean start

### 05.28.14 - 3.8.0
- update login_enqueue_scripts

### 05.08.14 - 3.7.0
- update scss default with new variables

### 04.08.14 - 3.6.0
- update wpseo
- add login js

### 04.08.14 - 3.5.0
- update to codekit
- add IE conditional css

### 04.08.14 - 3.4.0
- add google universal analytics to wp_head
- optional js file for ga click-tracking

### 03.18.14 - 3.3.0
- add admin customization class to addons for easy filtering

### 02.05.14 - 3.2.1
- remove wp_print_styles in favor of wp_enqueue_scripts

### 01.20.14 - 3.2
- update templates to utilize bootstrap columns
- update options to utilize get__option from parent theme wrapper
- update header.php and footer.php from ParentTheme
- update change-log.txt to mardown file

### 11.18.13 - 3.1
- update package to more abstract name for ParentTheme re-branding

### 10.17.13 - 3.0
- update functions.php

### 08.16.13 - 2.9
- updated default responsive.css

### 07.16.13 - 2.8
- added load_theme_textdomain 'childtheme'

### 06.28.13 - 2.7
- added responsive css file in favor of 568
- updated default.css

### 06.19.13 - 2.6
- updated default.css

### 06.14.13 - 2.5
- update font-awesome
- Updates to addons: AzzaOptionsPageVCWP, AzzaStarterPostMetaVCWP, FeaturedPostMetaVCWP, PostTypes/AzzaPostType

### 03.16.13 - 2.3
- Update: various code cleanup. No actual changes.
- added tpl-test.php
- functions.php - update child-custom js to be dependent on "helper"

### 02.07.13 - 2.1
- font-awesome.css - update to v3

### 01.19.13 - 2.0
- azza-post_type.php - added value checking

### 01.10.13
- featured-post_meta.php - added classes to local featured paragraph

### 12.22.12
- post-types/ - updated class layout, restructured post_type_tax_filters
