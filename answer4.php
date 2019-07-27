<?php
function count_vowels($str)
{
	preg_match_all('/[aeiou]/i', $str, $result);
	return count($result[0]);
}