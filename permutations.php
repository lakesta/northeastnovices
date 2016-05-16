<?php
# 20.9 trillion permutations possible
# Used wordsmith.org/anagram/anagram.cgi?anagram=northeast+novices&language=english&t=0&d=4&include=&exclude=&n=4&m=4&source=adv&a=y&l=n&q=n&k=0
# to limit list to 23710 uniques
# Those 23710 needed to be permutated and have 4 elements so (4! = 24); 24 * 23710 = 569,040 possibilities to test
# Used http://www.scrabble.org.au/words/fours.htm for 4 letter word dictionary


# from: http://stackoverflow.com/a/18995876/477660 
function permuteUnique($items, $perms = [], &$return = []) {
    if (empty($items)) {
        $return[] = $perms;
    } else {
        sort($items);
        $prev = false;
        for ($i = count($items) - 1; $i >= 0; --$i) {
            $newitems = $items;
            $tmp = array_splice($newitems, $i, 1)[0];
            if ($tmp != $prev) {
                $prev = $tmp;
                $newperms = $perms;
                array_unshift($newperms, $tmp);
                permuteUnique($newitems, $newperms, $return);
            }
        }
        return $return;
    }
}

function doIt($line, $wordList){
	$four = explode(' ', $line);
	$four[3] = substr($four[3], 0, 4);
	$twofour = permuteUnique($four);
	$answer = "";
	foreach ($twofour as $four) {
		$test = strtoupper($four[0][0].$four[1][0].$four[2][0].$four[3][0]);
		$test1 = strtoupper($four[0][1].$four[1][1].$four[2][1].$four[3][1]);
		$test2 = strtoupper($four[0][2].$four[1][2].$four[2][2].$four[3][2]);
		$test3 = strtoupper($four[0][3].$four[1][3].$four[2][3].$four[3][3]);
		if (in_array($test,$wordList) && in_array($test1,$wordList) && in_array($test2,$wordList) && in_array($test3,$wordList)){
			$answer = $four;
		}
	}
	return $answer;
}

$words = file('words.txt');
$anagrams = file('anagrams.txt');
$letters = array("N", "O", "R", "T", "H", "E", "A", "S", "V", "I", "C");
$answers = [];
$wordList = [];
foreach ($words as $line){
	$pass = true;
	$line = substr($line, 0, 4);
	# only include the words that contain letters we are searching for
	for ($x=0; $x<4; $x++) {
		if (!in_array($line[$x], $letters)) {
			$pass = false;
		}
	}
	if ($pass) {
		$wordList[] = $line;
	}
}
foreach ($anagrams as $line){
	$a = doIt($line, $wordList);
	if (!empty($a)) {
		$answers[] = $a;
	}
}

foreach ($answers as $answer){
	print "\n\n";
	print join("\n", $answer);
}