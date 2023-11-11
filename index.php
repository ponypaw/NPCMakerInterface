<?php

    if(isset($_POST["submit"])) {
        echo "Button pressed";
    }

?>

<head>
    <link rel="stylesheet" href="styles.css">
    <Title>NPC Maker</Title>
</head>

<body>
    <h1>NPC Maker</h1>
    <hr>
    <form action="" method="post">

    <label for="type">Type of Character: </label>
    <select name="type" id="type">
        <option value="any">Any</option>
        <option value="fantasy">Fantasy</option>
        <option value="human">Human</option>
    </select>
    <br>
    <label for="age">Age Range: </label>
    <select name="age" id="type">
        <option value="any">Any</option>
        <option value="baby">Baby</option>
        <option value="toddler">Toddler</option>
        <option value="child">Child</option>
        <option value="youndAdol">Young Adolescent</option>
        <option value="oldAdol">Older Adolescent</option>
        <option value="youngAdul">Young Adult</option>
        <option value="adult">Adult</option>
        <option value="midAge">Middle Aged</option>
        <option value="oldAdul">Older Adult</option>
        <option value="elderly">Elderly</option>
    </select>
    <br>
    <label for="statPoints">Points to distribute: </label>
    <input name="statPoints" type="number">
    <br>
    <button name="submit" type="submit">Submit</button>
    </form>

    <table>
        <th colspan="8">Character Sheet</th>
        <tr>
            <td>Name</td>
            <td>???</td>
            <td>Gender</td>
            <td>???</td>
            <td>Age</td>
            <td>???</td>
            <td>Occupation</td>
            <td>???</td>
        </tr>
        <tr>
            <td>Strength</td>
            <td>000</td>
            <td>Agility</td>
            <td>000</td>
            <td>Dexterity</td>
            <td>000</td>
            <td>Speed</td>
            <td>000</td>
        </tr>
        <tr>
            <td>Intelligence</td>
            <td>000</td>
            <td>Perception</td>
            <td>000</td>
            <td>Wisdom</td>
            <td>000</td>
            <td>Charisma</td>
            <td>000</td>
        </tr>
        <th colspan="8">Background</th>
        <tr>
            <td colspan="8">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget condimentum metus. Mauris lacinia mi vitae magna lobortis, eu efficitur nisi imperdiet. Praesent porta ultrices lorem, ut mollis sapien sagittis quis. Suspendisse sed sapien lobortis, bibendum neque eget, commodo lectus. In hac habitasse platea dictumst. Donec porttitor felis id massa viverra, in convallis lacus rhoncus. Sed facilisis lorem nec mauris sodales facilisis. Sed et ultrices risus, eget accumsan risus. Aliquam convallis erat ac quam luctus, eu cursus nibh sagittis.    
            </td>
        </tr>
    </table>
</body>

