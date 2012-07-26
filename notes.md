#Things I Learned

1. Virtual Domains on Windows require Apache virtual hosts edit and hosts edit to function[1](http://foundationphp.com/tutorials/apache22_vhosts.php)
2. git --update-index --assume-changed <file> to hide files like database.php[2](http://blog.pagebakers.nl/2009/01/29/git-ignoring-changes-in-tracked-files/)
3. git --update-index --no-assume-changed <file> to unhide files [2](http://blog.pagebakers.nl/2009/01/29/git-ignoring-changes-in-tracked-files/)
4. To change hosts and some other files must open file as an administrator
5. /\[\[([^\|\]]*)\|?([^\]]*)\]\]/ regex pattern will parse MediaWiki Link Syntax
6. Laravel\Database\Eloquent\Pivot::$timestamps = false; to disable all pivot table timestamps
7. /(?<![\[\()\bkeyword\b(?<![\]\))/i case insensative multiple keywords replacement 
