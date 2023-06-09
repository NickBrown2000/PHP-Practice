<!DOCTYPE html>

<?php use Illuminate\Support\Facades\Cache;?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Digital Resume</title>
        <script src="js/welcome_scripts.js"></script>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <!--Head With left justified Name as well as right justified current time EST, time is statefull and self refreshes-->
        <section class="header">
            <h1 class="name">Nicholas Brown</h1>
            <h1 class="clock" id="clock"><?php echo date('g:i:s A', time()); ?></h1>
        </section>

        <!--Section with navigation bar along the top which has the following categories: Education, Work Experience, Projects
        When clicked into, each pane displays text corresponding to each category in the bubble-->
        <section class="tab-section">
            <div class="tab">
                    <button class="button", onclick="showTab('tab1')">Education</button>
                    <button class="button", onclick="showTab('tab2')">Work Experience</button>
                    <button class="button", onclick="showTab('tab3')">Projects</button>
            </div>

            <blockquote id="tab1" class="tab-content active">
                <h2>Education</h2>
                <p>Mercer University 2018 - 2022<br>BSE Computer Engineering<br><br>While atending the Mercer University school of 
                    engineering I had the pleasure of studying a vast number of topics. I eventually focoused in on embedded system 
                    design as well as the various C languages (C, C++, C#). Durring my senior year at Mercer I would continue down this 
                    software development path - taking one of my favorite classes of all time: mobile application development. Below is a 
                    list of courses I would like to showcase.                    
                </p>
                <?php
                    // List of courses
                    $courses = Cache::remember('courses', 60, function () {
                        $coursesJson = file_get_contents(storage_path('app/data/courses.json'));
                        return json_decode($coursesJson, true);
                    });

                    // Calculate the number of courses per column
                    $totalCourses = count($courses);
                    $coursesPerColumn = ceil($totalCourses / 3);

                    // Generate the table
                    echo '<table>';
                    echo '<tr>';

                    // Loop through each column
                    for ($column = 0; $column < 3; $column++) {
                        echo '<td>';

                        // Loop through the courses for the current column
                        for ($i = $column * $coursesPerColumn; $i < min(($column + 1) * $coursesPerColumn, $totalCourses); $i++) {
                            echo '<ul>';
                            echo '<li>' . $courses[$i] . '</li>';
                            echo '</ul>';
                        }

                        echo '</td>';
                    }

                    echo '</tr>';
                    echo '</table>';
                ?>
            </blockquote>

            <blockquote id="tab2" class="tab-content">
            <h1>Work Experience</h1>
                <?php
                    //List of companies
                    $comp = Cache::remember('companies', 60, function () {
                        $jsonData = file_get_contents(storage_path('app/data/workInfo.json'));
                        $dataArray = json_decode($jsonData, true);
                        return $dataArray['company'];
                    });

                    //List of job titles
                    $title = Cache::remember('titles', 60, function () {
                        $jsonData = file_get_contents(storage_path('app/data/workInfo.json'));
                        $dataArray = json_decode($jsonData, true);
                        return $dataArray['title'];
                    });

                    //List of blurbs
                    $blurb = Cache::remember('blurbs', 60, function () {
                        $jsonData = file_get_contents(storage_path('app/data/workInfo.json'));
                        $dataArray = json_decode($jsonData, true);
                        return $dataArray['blurb'];
                    });

                    $jobsCount = count($comp);
                    for($i=0;$i<$jobsCount;$i++){
                        echo '<p>'.$comp[0];
                        echo '<br>'.$title[0].'<br>';
                        echo '<br>'.$blurb[0].'</p><br>';
                    }
                    
                    // List of Responsibilities
                    $Resp = Cache::remember('Resp', 60, function () {
                        $respJson = file_get_contents(storage_path('app/data/resp.json'));
                        return json_decode($respJson, true);
                    });
                    
                    // Calculate the number of Responsibilities per column
                    $totalResp = count($Resp);
                    $RespPerColumn = ceil($totalResp / 3);

                    // Generate the table
                    echo '<table>';
                    echo '<tr>';

                    // Loop through each column
                    for ($column = 0; $column < 3; $column++) {
                        echo '<td>';

                        // Loop through the Responsibilities for the current column
                        for ($i = $column * $RespPerColumn; $i < min(($column + 1) * $RespPerColumn, $totalResp); $i++) {
                            echo '<ul>';
                            echo '<li>' . $Resp[$i] . '</li>';
                            echo '</ul>';
                        }

                        echo '</td>';
                    }

                    echo '</tr>';
                    echo '</table>';
                ?>
            </blockquote>

            <blockquote id="tab3" class="tab-content">
            <h1>Projects</h1>
            <?php
                // List of projects
                $Proj = Cache::remember('proj', 60, function () {
                    $projJson = file_get_contents(storage_path('app/data/proj.json'));
                    return json_decode($projJson, true);
                });

                // List of project details
                $Proj_Details = Cache::remember('proj_details', 60, function () {
                    $projDetailsJson = file_get_contents(storage_path('app/data/proj_detail.json'));
                    return json_decode($projDetailsJson, true);
                });

                // Calculate the number of projects
                $totalProj = count($Proj);

                // Generate the table
                echo '<table>';

                // Generate rows
                for ($row = 0; $row < $totalProj; $row += 2) {
                    echo '<tr>';

                    // Generate columns for each row
                    for ($col = $row; $col < min($row + 2, $totalProj); $col++) {
                        echo '<td>';

                        echo '<strong>'.$Proj[$col].'</strong>';
                        echo '<ul>';
                        echo '<li>' . $Proj_Details[$col] . '</li>';
                        echo '</ul>';

                        echo '</td>';
                    }

                    echo '</tr>';
                }

                echo '</table>';
            ?>

            </blockquote>
        </section>

        <!--Section with translucent background talking about programing, security, and networking Skills-->
        <section class="skills-section">
            <h1 class="blacktext">Skills</h1>
            <p class="skills-text">Enter Skills Info Here</p>
        </section>

        <!--Footer containing contact info such as: phone number, email, linked in and GIT link-->
        <footer class="footer">
            <p>Contact me at <a href="mailto:nicholas.a.brown@protonmail.com">Nicholas.A.Brown@protonmail.com</a> or <a href="tel:6786972271">(678)-697-2271</a></p>
        </footer>
    </body>
</html>
