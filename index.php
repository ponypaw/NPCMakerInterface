<?php

    $typeOfCharacter = "";
    $ageRange = "";
    $totalPoints = 0;

    $ageMin = 0;
    $ageMax = 0;

    $name = "Fred";
    $age = "";
    $gender = "";
    $occupation = "";
    $strength = 0;
    $agility = 0;
    $dexterity = 0;
    $speed = 0;
    $intelligence = 0;
    $perception = 0;
    $wisdom = 0;
    $charisma = 0;

    if(isset($_POST["submit"])) {

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
        } else {
            $gender = "female";
        }

        getStats($totalPoints);

        echo "Age is " . strval($age) . " gender is " . $gender . " strength is " . strval($strength);

    }

    function getStats($total) {
        global $strength, $agility, $dexterity, $speed, $intelligence, $perception, $wisdom, $charisma;
        $tp = $total;
        $stats = ["strenth", "agility", "dexterity", "speed", "intelligence", "perception", "wisdom", "charisma"];

        if ($strength == 0 || $agility == 0 || $dexterity == 0 || $speed == 0 || $intelligence == 0 || $perception == 0 || $wisdom == 0 || $charisma == 0) {
            if ($tp > 0) {
                $statAssigned = $stats[rand(0, 7)];
                $amount = rand(1, $tp);

                $tp = $tp - $amount;

                switch ($statAssigned) {
                    case "strength" :
                        $strength = $amount;
                        break;
                    case "agility" :
                        $agility = $amount;
                        break;
                    case "dexterity" :
                        $dexterity = $amount;
                        break;
                    case "speed" :
                        $speed = $amount;
                        break;
                    case "intelligence" :
                        $intelligence = $amount;
                        break;
                    case "perception" :
                        $perception = $amount;
                        break;
                    case "wisdom" :
                        $wisdom = $amount;
                        break;
                    case "charisma" :
                        $charisma = $amount;
                        break;
                }
                print "TP is " . $tp . ". ";
                getStats($tp);
            } else {
                return;
            }
        } else {
            return;
        }

    }

    

        // if (isset ($_GET['gender']) ) {
        //     $gender =  $_GET['gender'];
        //     echo 'Gender set to ' + $gender;
        // } 
    
        // if (isset ($_GET['firstName']) ) {
        //    $name = $_GET['firstName'];
        // }
    
        // if (isset ($_GET['lastName']) ) {
        //     $name = $name + " " + $_GET['lastName'];
        // } 
    
        // if (isset ($_GET['age']) ) {
        //     $age =  $_GET['age'];
        // } 
    
        // if (isset ($_GET['occupation']) ) {
        //     $occupation =  $_GET['occupation'];
        // } 
    
        // if (isset ($_GET['strength']) ) {
        //     $strength =  $_GET['strength'];
        // } 
    
        // if (isset ($_GET['agility']) ) {
        //     $agility =  $_GET['agility'];
        // } 
    
        // if (isset ($_GET['dexterity']) ) {
        //     $dexterity =  $_GET['dexterity'];
        // } 
    
        // if (isset ($_GET['speed']) ) {
        //     $speed =  $_GET['speed'];
        // } 
    
        // if (isset ($_GET['intelligence']) ) {
        //     $intelligence =  $_GET['intelligence'];
        // } 
    
        // if (isset ($_GET['perception']) ) {
        //     $perception =  $_GET['perception'];
        // } 
    
        // if (isset ($_GET['wisdom']) ) {
        //     $wisdom =  $_GET['wisdom'];
        // } 
    
        // if (isset ($_GET['charisma']) ) {
        //     $charisma =  $_GET['charisma'];
        // } 

    

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
                <tr>
                    <td class="submitButton" colspan="2">
                        <button name="submit" type="submit">Submit</button>
                    </td>
                </tr>

            </table>
        </form>
    </div>
    <hr>
    <div id="characterDiv">


        <?php
            if(!empty($name)){
                echo '
                    <table id="characterTable">
                        <th colspan="8">Character Sheet</th>
                        <tr>
                            <td>Name</td>
                            <td><?php print (isset($_POST["name"])) ? $name : "???" ?></td>
                            <td>Gender</td>
                            <td><?php print (isset($_POST["gender"])) ? $_POST["gender"] : "???" ?></td>
                            <td>Age</td>
                            <td><?php print (isset($_POST["age"])) ? $_POST["age"] : "???" ?></td>
                            <td>Occupation</td>
                            <td><?php print (isset($_POST["occupation"])) ? $_POST["occupation"] : "???" ?></td>
                        </tr>
                        <tr>
                            <td>Strength</td>
                            <td><?php print (isset($_POST["strength"])) ? $_POST["strength"] : "???" ?></td>
                            <td>Agility</td>
                            <td><?php print (isset($_POST["agility"])) ? $_POST["agility"] : "???" ?></td>
                            <td>Dexterity</td>
                            <td><?php print (isset($_POST["dexterity"])) ? $_POST["dexterity"] : "???" ?></td>
                            <td>Speed</td>
                            <td><?php print (isset($_POST["speed"])) ? $_POST["speed"] : "???" ?></td>
                        </tr>
                        <tr>
                            <td>Intelligence</td>
                            <td><?php print (isset($_POST["intelligence"])) ? $_POST["intelligence"] : "???" ?></td>
                            <td>Perception</td>
                            <td><?php print (isset($_POST["perception"])) ? $_POST["perception"] : "???" ?></td>
                            <td>Wisdom</td>
                            <td><?php print (isset($_POST["wisdom"])) ? $_POST["wisdom"] : "???" ?></td>
                            <td>Charisma</td>
                            <td><?php print (isset($_POST["charisma"])) ? $_POST["charisma"] : "???" ?></td>
                        </tr>
                        <th colspan="8">Background</th>
                        <tr>
                            <td colspan="8">
                            <?php print (isset($_POST["background"])) ? $_POST["background"] : "???" ?>  
                            </td>
                        </tr>
                    </table>
                
                ';
            } else {
                echo 'Please select your search terms and press generate.';
            }
        ?>

        
    </div>





    
    
</body>

