#Markdown Wiki

A personal static file wiki using Markdown Syntax.  With an index file internal links are generated dynamically with out marring the saved files.  Files are saved in your dropbox account.

##Requirements
* cURL
* mcrypt
* Dropbox Account

##Components
* Laravel
* Sparkdown
* Modelo
* Dropbox API
* Basset
* Foundation 3.0

##Included Bundles for Development
* Artisan Web Bundle
* ChromePhp

##Change Log
* 2012-07-26: Fixed a Unix Bug with internal link parsing  
* 2012-07-26: Added Foundation 3 for base templating with Foundation web icons support & Basset Bundle for asset control  
* 2012-07-26: Viewable to public after your first visit.  
* 2012-07-25: Fixed non-missing file issue related to last change  
* 2012-07-25: Updated Dropbox API to allow for missing files instead of throwing an exception  
* 2012-07-25: Initial Release  

##To Do List
* Figure out how to save dropbox auth to session (Completed 7/25/2012)
* Verify file exists before trying to parse it (Completed 7/25/2012)
* Figure out how to make viewable to the public (Completed 7/25/2012)
* Check if  home.md and index.csv files exist on association with dropbox if not create basic ones and save to dropbox
* Work index generation to add heirarchy to index via directory structure
* Make multiuser
