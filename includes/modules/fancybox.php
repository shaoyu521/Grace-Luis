<?php
add_filter('the_content', 'fancybox');
function fancybox ($content)  
{ global $post;  
$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf)('|\")(.*?)>(.*?)<\/a>/i";  
$replacement = '<a$1href=$2$3.$4$5 rel="box" class="fancybox"$6>$7</a>';  
$content = preg_replace($pattern, $replacement, $content);  
return $content;  
} 
?>