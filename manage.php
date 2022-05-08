<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Tony Lam">
    <meta name="keywords" content="php, manage, mySQL">
    <meta name="description" content="managing EOI database">
    <title>EOI Manager</title>
    <link rel="stylesheet" href="styles/style.css"/>
</head>
<body>
    <?php include 'header.inc';?>
    <?php include 'menu.inc';?>

    <h1>Search EOI:</h1>
    <form action="search.php" method="POST" class="manage">
        <p>
        <label for="reference">Select a job position:</label> 
        <select id="reference" name="reference">
            <option value="*">All</option>
            <option value="NET2T">NET2T</option>
            <option value="FED03">FED03</option>
        </select>
            <label for="firstname">Firstname:</label>
            <input type="text" id="firstname" name="fname"/>
            <label for="lastname">Lastname:</label>
            <input type="text" id="lastname" name="lname"/>
            <input type="submit" value="Display"/> 
        </p>
    </form>
    <h2>Delete EOI:</h2>
    <form action="change.php" method="POST" class="delete">
        <p>
            <label for="delete">Delete EOI for:</label>
            <select id="delete" name="delete">
                <option value="all">All</option>
                <option value="NET2T">NET2T</option>
                <option value="FED03">FED03</option>
            </select>
            <input type="submit" value="Delete"/>
        </p>
    </form>
    <p>
    <h2>Change Status:</h2>
    <form action="change.php" method="POST" class="changer">
        <p>
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="New">New</option>
                <option value="Current">Current</option>
                <option value="Final">Final</option>
            </select>
            <label for="eoi">EOI:</label>
            <input id="eoi" name="eoi"/>
            <input type="submit" value="Change">
        </p>
    </form>
    <?php include 'footer.inc';?>
</body>
</html>