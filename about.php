    <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Founder Bio">
        <meta name="keywords" content="HTML,CSS, .NET, Job_Application, Front-End">
        <meta name="author" content="Tony Lam">
        <title>About me</title>

        <link rel="stylesheet" href="styles/style.css"/>
    </head>

    <body class="aboutbody">
        <?php include 'header.inc';?>
        <?php include 'menu.inc';?>
        
        <section class="aboutsection">
            <h2>About myself:</h2>
            <dl>
                <dt>Name:</dt>
                <dd>Tony Lam</dd>
                <dt>Student number:</dt>
                <dd>102157199</dd>
                <dt>Tutor:</dt>
                <dd>Grace Tao</dd>
                <dt>My current course:</dt>
                <dd>Bachelor of Games and Interactivity / Bachelor of Computer Science</dd>
                <dt>My Email: </dt>
                <dd><a href="mailto:102157199@student.swin.edu.au">102157199@student.swin.edu.au</a></dd>
            </dl>
                <figure><img src="images/weirdman.jpg" alt="Founderkid"/></figure>
               
        </section>

        <section id="tablestuff">
            <h2>My Timetable:</h2>
            <table>
                <tr>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;Friday&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;Saturday&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;Sunday&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>
                <tr>
                    <td>2:30pm-4:30pm<br/>COS10011 LECTURE</td> 
                    <td>12:30pm-2:30pm<br/>COS10009 LECTURE</td>
                    <td>10:30am-12:30pm<br/>COS20001 TUTORIAL</td>
                    <td>10:30am-12:30pm<br/>COS10009 LAB    </td>          
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6:30pm-8:30pm<br/>COS20001 LECTURE</td> 
                    <td>2:30pm-4:30pm<br/>COS10011 LAB</td>
                    <td>12:30pm-2:30pm<br/>COS10003 LECTURE</td>
                    <td></td>          
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td> 
                    <td></td>
                    <td>4:30pm-6:30pm<br/>COS10003 TUTORIAL</td>
                    <td></td>          
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </section>

        <?php include 'footer.inc';?>
    </body>
</html>