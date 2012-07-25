#Markdown Wiki

A static file wiki using Markdown Syntax.  With an index file internal links are generated dynamically with out marring the saved files.

##Components
* Laravel
* Sparkdown
* Modelo
* Dropbox API

##Included Bundles for Development
* Artisan Web Bundle
* ChromePhp

##Change Log
2012-07-05: Fixed non-missing file issue related to last change
2012-07-05: Updated Dropbox API to allow for missing files instead of throwing an exception
2012-07-05: Initial Release

##To Do List

* Figure out how to save dropbox auth to session (Completed 7/25/2012)
* Verify file exists before trying to parse it (Completed 7/25/2012)
* Figure out how to make viewable to the public - possible database needed to store dropbox auth and username
* Check if  home.md and index.csv files exist on association with dropbox if not create basic ones and save to dropbox
* Work index generation to add heirarchy to index via directory structure
