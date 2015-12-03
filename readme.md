# MDwiki

A static file wiki-like system using markdown formatting.   

## Features
* MDwiki has multiple storage types (dropbox, local, aws, rack by default - can add anything in the [Flysystem](http://flysystem.thephpleague.com/) or create your own adapters)
* CommonMark markdown parser

## Change Log

0.1.0 - Initial Release (2015-12-03)
* local storage only
* images hard coded to be stored in images folder
* images resized and served via intervention/image
* relative links add in base_url of the site
* Common Mark markdown parsing

0.2.0 - Update
* dropbox storage working (most other storage should work too)
* 