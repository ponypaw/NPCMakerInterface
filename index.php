<?php
    require 'config/config.php';

    $file;
    $fileName;

    $typeOfCharacter = "";
    $ageRange = "";
    $totalPoints = 0;

    $ageMin = 0;
    $ageMax = 0;

    $pronoun = "";
    $pronoun2 = '';
    $posPronoun = "";

    $name;
    $age;
    $gender;
    $occupation;
    $strength;
    $agility;
    $dexterity;
    $speed;
    $intelligence;
    $perception;
    $wisdom;
    $charisma;
    $background;

    $stats = ["strength", "agility", "dexterity", "speed", "intelligence", "perception", "wisdom", "charisma"];

    if(isset($_POST["submit"])) {

        $name = "";
        $occupation = "Farmer";
        $background = "doot";

        $typeOfCharacter = $_POST["type"];
        $ageRange = $_POST["age"];
        $totalPoints = $_POST["statPoints"];

        switch ($ageRange) {
            case "any" :
                $ageMax = 115;
                $ageMin = 0;
                break;
            case "child" :
                $ageMax = 12;
                $ageMin = 4;
                break;
            case "adolescent" :
                $ageMax = 17;
                $ageMin = 13;
                break;
            case "adult" :
                $ageMax = 65;
                $ageMin = 18;
                break;
            case "elderly" :
                $ageMax = 66;
                $ageMin = 115;
                break;
        }

        $age = rand($ageMin, $ageMax);

        $coinFlip = rand(0,1);

        if ($coinFlip == 0) {
            $gender = "male";
            $pronoun = "him";
            $pronoun2 = "he";
            $posPronoun = "his";
        } else {
            $gender = "female";
            $pronoun = "her";
            $pronoun2 = "she";
            $posPronoun = "her";
        }

        getStats($totalPoints);
        $name = getName();

        // get random job
        $jobQuery = mysqli_query($con, "SELECT * FROM occupations ORDER BY RAND() LIMIT 1");
        $job = mysqli_fetch_array($jobQuery);
        $occupation = (string)$job["job"];

        $background = createBackground();

        createFile();

    }

    function getStats($total) {
        global $strength, $agility, $dexterity, $speed, $intelligence, $perception, $wisdom, $charisma, $stats;
        $tp = $total;
        
        if ($strength == 0 || $agility == 0 || $dexterity == 0 || $speed == 0 || $intelligence == 0 || $perception == 0 || $wisdom == 0 || $charisma == 0) {
            if ($tp > 0 && count($stats) > 0) {
                $statAssigned = $stats[rand(0, count($stats) - 1)];
                $amount = rand(1, $tp);
                $index;

                $tp = $tp - $amount;

                switch ($statAssigned) {
                    case "strength" :
                        $strength = $amount;
                        $index = array_search('strength',$stats);
                        break;
                    case "agility" :
                        $agility = $amount;
                        $index = array_search('agility',$stats);
                        break;
                    case "dexterity" :
                        $dexterity = $amount;
                        $index = array_search('dexterity',$stats);
                        break;
                    case "speed" :
                        $speed = $amount;
                        $index = array_search('speed',$stats);
                        break;
                    case "intelligence" :
                        $intelligence = $amount;
                        $index = array_search('intelligence',$stats);
                        break;
                    case "perception" :
                        $perception = $amount;
                        $index = array_search('perception',$stats);
                        break;
                    case "wisdom" :
                        $wisdom = $amount;
                        $index = array_search('wisdom',$stats);
                        break;
                    case "charisma" :
                        $charisma = $amount;
                        $index = array_search('charisma',$stats);
                        break;
                }
                unset($stats[$index]);
                $stats = array_values($stats);
                getStats($tp);
            } elseif ($tp == 0 && count($stats) > 0) {
                foreach($stats as $stat){
                    switch ($stat) {
                        case "strength" :
                            $strength = 0;
                            break;
                        case "agility" :
                            $agility = 0;
                            break;
                        case "dexterity" :
                            $dexterity = 0;
                            break;
                        case "speed" :
                            $speed = 0;
                            break;
                        case "perception" :
                            $perception = 0;
                            break;
                        case "wisdom" :
                            $wisdom = 0;
                            break;
                        case "charisma" :
                            $charisma = 0;
                            break;
                        case "intelligence" :
                            $intelligence = 0;
                            break;
                    }
                }
            }
            
            else {
                return;
            }
        } else {
            return;
        }

    }

    function getName(){
        global $gender, $con;
        $newName = "";

        // get random first name from table according to gender
        $firstNameQuery = mysqli_query($con, "SELECT * FROM name WHERE type = 'first' AND gender = '$gender' ORDER BY RAND() LIMIT 1");
        $firstName = mysqli_fetch_array($firstNameQuery);
        $first = (string)$firstName["name"];

        // get random last name
        $lastNameQuery = mysqli_query($con, "SELECT * FROM name WHERE type = 'last' ORDER BY RAND() LIMIT 1");
        $lastName = mysqli_fetch_array($lastNameQuery);
        $last = (string)$lastName["name"];

        // assemble name
        $newName = $first . " " . $last;

        // return name
        return $newName;
    }

    function createBackground() {
        global $con, $occupation, $age, $pronoun, $pronoun2, $posPronoun;
        $story = "";

        $childQuery = mysqli_query($con, "SELECT sentence FROM backstories WHERE life_stage = 'child' ORDER BY RAND() LIMIT 1");
        $childStory = mysqli_fetch_array($childQuery);
        $story = $story . ucfirst($pronoun2) . " " . (string)$childStory[0] . " as a child.";

        if ($age > 12) {

            $teenQuery = mysqli_query($con, "SELECT sentence FROM backstories WHERE life_stage = 'teen' ORDER BY RAND() LIMIT 1");
            $teenStory = mysqli_fetch_array($teenQuery);
            $story = $story . " As a teenager, " . $pronoun2 . " " . (string)$teenStory[0] . ".";
            
        } 
        
        if ($age > 17) {
            $adultQuery = mysqli_query($con, "SELECT sentence FROM backstories WHERE life_stage = 'adult' ORDER BY RAND() LIMIT 1");
            $adultStory = mysqli_fetch_array($adultQuery);
            $story = $story . " After " . $pronoun2 . " grew up, ". $pronoun2 . " " . (string)$adultStory[0] . ".";
        }
        
        if ($age > 65) {
            $elderQuery = mysqli_query($con, "SELECT sentence FROM backstories WHERE life_stage = 'elderly' ORDER BY RAND() LIMIT 1");
            $elderStory = mysqli_fetch_array($elderQuery);
            $story = $story . " Later in life, ". $pronoun2 . " " . (string)$elderStory[0] . ".";
        }

        $colorQuery = mysqli_query($con, "SELECT color FROM colors ORDER BY RAND() LIMIT 1");
        $colorStory = mysqli_fetch_array($colorQuery);
        $story = $story . " " . ucfirst($posPronoun) . " favorite color was always " . (string)$colorStory[0] . ".";
        

        return $story;

    }

    function createFile() {
        global $file, $fileName, $name, $age, $gender, $occupation, $strength, $agility, $dexterity, $speed, $intelligence, $perception, $wisdom, $charisma, $background ;

        $fileName = "NewCharacter.txt";

        $file = fopen($fileName, 'w');

        fputs($file, "Name: " . $name . "\n");
        fputs($file, "Age: " . $age . "\n");
        fputs($file, "Gender: " . $gender . "\n");
        fputs($file, "Occupation: " . $occupation . "\n");
        fputs($file, "Strength: " . $strength . "\n");
        fputs($file, "Agility: " . $agility . "\n");
        fputs($file, "Dexterity: " . $dexterity . "\n");
        fputs($file, "Speed: " . $speed . "\n");
        fputs($file, "Intelligence: " . $intelligence . "\n");
        fputs($file, "Perception: " . $perception . "\n");
        fputs($file, "Wisdom: " . $wisdom . "\n");
        fputs($file, "Charisma: " . $charisma . "\n");
        fputs($file, "Background: " . $background);

        fclose($file);
    }

    if (isset($_POST["saveFile"])) {
        global $file, $fileName;
        readfile(
            $fileName
        );
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <Title>NPC Maker</Title>
</head>

<body>
    <h1>NPC Maker</h1>
    <hr>
    <div id="right_vine"><img class="frameImage" src="images/rightVine.png" /></div>
    <div id="left_vine"><img class="frameImage" src="images/leftVine.png" /></div>
    <div id="formDiv">
        <form action="index.php" method="post">
            <table id="formTable">
                <tr>
                    <td class="labels">
                        <label for="type">Type of Character: </label><br>
                    </td>
                    <td>
                        <select name="type" id="type">
                            <option value="any">Any</option>
                            <!-- <option value="fantasy">Fantasy</option> -->
                            <option value="human">Human</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="labels">
                        <label for="age">Age Range: </label>
                    </td>
                    <td>
                        <select name="age" id="type">
                            <option value="any">Any</option>
                            <option value="child">Child</option>
                            <option value="adolescent">Adolescent</option>
                            <option value="adult">Adult</option>
                            <option value="elderly">Elderly</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="labels">
                        <label for="statPoints">Points to distribute: </label>
                    </td>
                    <td>
                        <input name="statPoints" type="number">
                    </td>
                </tr>
                <th class="submitButton" colspan="2">
                    <button name="submit" type="submit">Submit</button>
                </th>

            </table>
        </form>
    </div>
    <hr>
    <div id="characterDiv">


        <?php
            if(!empty($name)){
                echo "
                    <table id='characterTable'>
                        <th colspan='8'>Character Sheet</th>
                        <tr>
                            <td>Name</td>
                            <td>$name</td>
                            <td>Gender</td>
                            <td>$gender</td>
                            <td>Age</td>
                            <td>$age</td>
                            <td>Occupation</td>
                            <td>$occupation</td>
                        </tr>
                        <tr>
                            <td>Strength</td>
                            <td>$strength</td>
                            <td>Agility</td>
                            <td>$agility</td>
                            <td>Dexterity</td>
                            <td>$dexterity</td>
                            <td>Speed</td>
                            <td>$speed</td>
                        </tr>
                        <tr>
                            <td>Intelligence</td>
                            <td>$intelligence</td>
                            <td>Perception</td>
                            <td>$perception</td>
                            <td>Wisdom</td>
                            <td>$wisdom</td>
                            <td>Charisma</td>
                            <td>$charisma</td>
                        </tr>
                        <th colspan='8'>Background</th>
                        <tr>
                            <td colspan='8'>
                                $background
                            </td>
                        </tr>
                        <th colspan='8'><button><a href='NewCharacter.txt' download='$name.txt' > Save File </a></button>
                        </th>
                    </table>
                    <br>
                    
                
                ";
            } else {
                echo 'Please select your search terms and press generate.';
            }
        ?>
        <br>


    </div>





    
    
</body>

