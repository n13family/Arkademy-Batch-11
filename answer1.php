<?php
function biodata($name, $age, $address, $hobbies, $is_married, $list_school, $skills, $interest_in_coding){
	if(is_numeric($age) == 0)
	{
		die("Age Is Number");
	}
    $biodata = array(
    	"Name" => $name,
    	"Age" => $age,
		"Address" => $address,
		"hobbies" => $hobbies,
		"is_married" => $is_married,
		"list_school" => (object)$list_school,
		"skill" => new ArrayObject($skills),
		"interest_in_coding" => $interest_in_coding
		);

    print_r($biodata);
    return json_encode($biodata);
    
}

		$name = "Bambang Priyanto";
		$age = 17;
		$address = "JL ITIK 13 NO 41 BEKASI TIMUR";
		$hobbies = array(
			"Coding",
			"Playing a game"
		);
		$is_married = false;
		$list_school = array(
			"elementarySchool" => array(
				"name" => "SMA MANDALAHAYU BEKASI",
				"year_in" => "2008",
				"year_out" => "2014",
				"major" => null),
			"juniorHighSchool" => array(
				"name" => "SMA MANDALAHAYU BEKASI",
				"year_in" => "2014",
				"year_out" => "2017",
				"major" => null),
			"highSchool" => array(
				"name" => "SMA MANDALAHAYU BEKASI",
				"year_in" => "2017",
				"year_out" => "OUT",
				"major" => "SCIENCE"),
			"university" => array(
				"name" => null,
				"year_in" => null,
				"year_out" => null,
				"major" => null
			)
		);
		$skills = array(
			"0" => "PHP"
		);
		$interest_in_coding = true;

		print(biodata($name, $age, $address, $hobbies, $is_married, $list_school, $skills, $interest_in_coding));

?>