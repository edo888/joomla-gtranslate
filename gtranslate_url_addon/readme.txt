1. Edit gtranslate/config.php file to set correct main_lang language code
2. Upload gtranslate folder into www root directory
3. Edit/create .htaccess file in www root directory and add the following into the top of the file

# gtranslate config
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(af|sq|ar|hy|az|eu|be|bg|ca|hr|cs|da|nl|en|et|tl|fi|fr|gl|ka|de|el|ht|iw|hi|hu|is|id|ga|it|ja|ko|lv|lt|mk|ms|mt|no|fa|pl|pt|ro|ru|sr|sk|sl|es|sw|sv|th|tr|uk|ur|vi|cy|yi|bn|bs|ceb|eo|gu|ha|hmn|ig|jw|kn|km|lo|la|mi|mr|mn|ne|pa|so|ta|te|yo|zu|zh-CN|zh-TW)/(.*)$ /gtranslate/gtranslate.php?glang=$1&gurl=$2 [L,QSA]
RewriteRule ^(af|sq|ar|hy|az|eu|be|bg|ca|hr|cs|da|nl|en|et|tl|fi|fr|gl|ka|de|el|ht|iw|hi|hu|is|id|ga|it|ja|ko|lv|lt|mk|ms|mt|no|fa|pl|pt|ro|ru|sr|sk|sl|es|sw|sv|th|tr|uk|ur|vi|cy|yi|bn|bs|ceb|eo|gu|ha|hmn|ig|jw|kn|km|lo|la|mi|mr|mn|ne|pa|so|ta|te|yo|zu|zh-CN|zh-TW)$ /$1/ [R=301,L]

4. Make sure DNS cname records for language sub-domains are removed
5. Change the language selector configuration to use sub-directory URL structure
