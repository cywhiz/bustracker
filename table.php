<?php
    $i = 0;
    $j = 0;
    $k = 0;
    $l = 0;
    
    foreach($html->find('ul[class=journey standard none]') as $node) {
        foreach($node->find('li[class=two]') as $subnode) {
            $depart[$i] = $subnode->find('p',0)->plaintext;
            $arrive[$i] = $subnode->find('p',1)->plaintext;
            $i++;
        }

        foreach($node->find('li[class=three]') as $subnode) {
            $duration[$j] = $subnode->find('p',0)->plaintext;
            $j++;
        }

        foreach($node->find('li[class=five]') as $subnode) {
            $price[$k] = $subnode->find('p',0)->plaintext;
            $k++;
        }

        foreach($node->find('li[class=six]') as $subnode) {
            $link[$l] = $subnode->find('a',0)->href;
            $l++;
        }
    }
?>
