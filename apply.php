<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Apply for Job">
        <meta name="keywords" content="HTML,CSS, .NET, Job_Application, Front-End">
         <meta name="author" content="Tony Lam">
         <title>Apply now</title>

         <link rel="stylesheet" href="styles/style.css"/>
         <script src="scripts/apply.js"></script>
    </head>

    <body id="applypage">
        <?php include 'header.inc';?>
        <?php include 'menu.inc';?>

        <section class="formsection">
            <h2>Application:</h2>
        <form id="form" method="post" action="processEOI.php" novalidate="novalidate">
                <p><label for="jobRef" id="jobnumber">Job reference number:</label>
                <input type="text" id="jobRef" maxlength="5" name="jobRef" required="required" pattern="[a-zA-Z0-9-]+" readonly/>
                </p>
            <fieldset>
                <legend>Your details:</legend>
                <p>
                <label for="name">First name:</label>
                <input type="text" id="name" name="firstname" minlength="1" maxlength="20" pattern="[A-Za-z]+" required="required"/>
                <label for="surname">Last name:</label>
                <input type="text" id="surname" name="lastname" maxlength="20" pattern="[A-Za-z]+" required="required"/>
                </p>
                
                <p><label for="birthdate">Date of birth:</label>
                <input type="text" id="birthdate" name="dob" required="required" placeholder="dd/mm/yyyy"/>
                <br/>
                </p> 
                <div id="errdate"></div>
            </fieldset>

            <fieldset id="genderset">
                <legend>Gender:</legend>
                <input type="radio" id="male" name="gender" value="Male" checked>Male
                <input type="radio" id="female" name="gender" value="Female">Female
                <input type="radio" id="other" name="gender" value="Other">Other
            </fieldset>

            <fieldset>
                <legend>Location:</legend>
                <p>
                <label for="address">Street Address</label>
                <input type="text" id="address" maxlength="40" name="address" required="required" />
                <label for="suburb">Surburb/town</label>
                <input type="text" id="suburb" maxlength="40" name="suburb/town" required="required" />
                </p>

                <p>
                <label for="state">State:</label>
                <select id="state" name="State">
                    <option value="none">Select your state</option>
                    <option value="VICTORIA">VIC</option>
                    <option value="NEW SOUTH WALES">NSW</option>
                    <option value="AUSTRALIAN CAPITAL TERRITORY">ACT</option>
                    <option value="TASMANIA">TAS</option>
                    <option value="QUEENSLAND">QLD</option>
                    <option value="NORTHERN TERRITORY">NT</option>
                    <option value="WESTERN AUSTRALIA">WA</option>
                    <option value="SOUTH AUSTRALIA">SA</option>
                </select>
                </p>
                <div id="errstate"></div>
                <p>
                <label for="post">Post code:</label>
                <input type="text" name="postcode" id="post" pattern="[0-9]{4}" required="required" maxlength="4"/>
                </p>
                <div id="errpost"></div>
            </fieldset>

            <fieldset>
                <legend>Contact details:</legend>
                <p><label for="email">Email address:</label>
                <input type="email" name="email" id="email" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"/>

                <label for="phone">Phone number:</label>
                <input type="text" name="phone" id="phone" required="required" size="15" minlength="8" maxlength="12"/>
                </p>
            </fieldset>

            <fieldset>
                <legend>Skill list: Tick all that apply to You</legend>
                <p>
                <input type="checkbox" name="organise" id="organised" value="organised">Organisation
                <input type="checkbox" name="punctual" id="punctual" value="punctual" required>Punctuality
                <input type="checkbox" name="writing" id="writingskills" value="Writing Skills">Writing Skills
                <input type="checkbox" name="passionate" id="passionate" value="Passionate">Passionate
                <input type="checkbox" name="math" id="mathematics" value="Mathematics">Mathematics
                <input type="checkbox" name="problemsolve" id="problemsolving" value="Problem Solver">Problem Solving
                <input type="checkbox" name="communicative" id="communicative" value="Communicative">Communicative
                <input type="checkbox" name="other" value="Other" id="otherskill">Other (please specify below)
                </p>
                Other skills:<br/>
                <textarea id="textarea" placeholder="other skills..." rows="6" cols="40" name="otherskill"></textarea>
                <div id="errtextarea"></div>
            </fieldset>

                <input type="submit" value="Apply" class="button"/>
                <input type="reset" value="Reset Form" class="button"/>
            
        </form>
        </section>

        <?php include 'footer.inc';?>
        
    </body>

</html>