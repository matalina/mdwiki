# MDwiki

A static file wiki-like system using markdown formatting.  Implemeing two branches - master: all pages public, private: all pages private. 

## Features
* MDwiki has multiple storage types (dropbox, local, aws, rack by default - can add anything in the [Flysystem](http://flysystem.thephpleague.com/) or create your own adapters) - **defaults to local storage in storage/app/content**
* CommonMark markdown parser
* Automatic Navigation creation (with cache)
* YAML front matter
* Foundation base SASS and Font Awesome icons integrated

## File

## Change Log

__Note:__ When released all odd revisions will be public sites, and all even revisions will be private sites

ie:  
    1.0.0 - First Release of Public sites
    2.0.0 - First Release of Private sites

0.1.0 - Initial Release (2015-12-03)
* local storage only
* images hard coded to be stored in images folder
* images resized and served via intervention/image
* relative links add in base_url of the site
* Common Mark markdown parsing

0.2.0
* dropbox storage working (most other storage should work too)
* automatic navigation creation implemented
* yaml front matter

0.3.0
* integrated font awesome icons and foundation sass framework

0.4.0 - private branch
* implementation of private branch with all password protected site
* created add/delete/list user artisan commands
