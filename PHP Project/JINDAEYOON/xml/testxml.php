<?php

      $visitors = 1;		// 첫번째 visitor
      $fr = fopen('/var/www/html/counter.txt','w');
      if(!$fr) {
         echo "Could not create the counter file!";
         exit;
      }
      fputs($fr, $visitors);
	  fclose($fr);


?> 