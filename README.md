# MyBB SafeLink
Originally developed by fizz on MyBB.
Copyright 2011-2016 fizz
Copyright 2022 Travis Newton
License: GPL v3

## Installation
1. In the 'upload' directory, upload all contents to your root MyBB folder.
2. Install and activate the plugin from the AdminCP -> Plugins section of your forums.
3. Modify the settings from within the Settings page in the AdminCP.

## Changelog
### v1.3.x
- 1.3.5 -> Fixed compatibility with MyBB 1.8.X
- 1.3.4 -> added Spoiler BBCode compatibility (thanks Nick1307!), also modified names of lang variables slightly, Fixed problem with replacing incorrect characters in posts (&)
- 1.3.3 -> updated for 1.8 compatibility
- 1.3.2 -> fixed the safelink logic in plugins/safelink.php (thanks charafweb!)
- 1.3.1 -> removed code I accidentally left in the plugin that printed the board url
### v1.2
- Fixed bugs with URL exclusion logic

### v1.1
- Added support for usergroups
- Added support for individual forums
- New language variable added, used when safelink is disabled