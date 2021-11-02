<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?php echo TITLE;?> - My Homepage</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="assets/main_style.css" rel="stylesheet">
<link href='//cdn2.editmysite.com/fonts/BlackJack/font.css?2' rel='stylesheet' type='text/css' />
 <!--[if lt IE 7]>
<style>
#content
{
    height:400px !important;
}
</style>
<![endif]-->
</head>
<body class=' wsite-theme-light'>
    <div id="wrapper">
        <div id="container">
            <div class="title"><span id="wsite-title">My Homepage</span></div>
            
            <div id="navigation">
                <ul>
                    <li <?php if ($activenav1){ echo "id='active'";}?>><a href="index.php">Home</a></li>
                    <li <?php if ($activenav2){ echo "id='active'";}?> class="dropdown">
                        <a href="#" class="dropbtn">Experience</a>
                        <div class="dropdown-content">
                            <a href="experience-aq.php">Academic Qualification</a>
                            <a href="experience-pm.php">Professional Membership</a>
                            <a href="experience-ch.php">Career History</a>
                            <a href="experience-aa.php">Administrative Appointment</a>
                            <a href="experience-sa.php">Scholarly Activities</a>
                        </div>
                    </li>
                    <li <?php if ($activenav3){ echo "id='active'";}?>><a href="teaching.php">Teaching</a></li>
                    <li <?php if ($activenav4){ echo "id='active'";}?> class="dropdown">
                        <a href="#" class="dropbtn">Research</a>
                        <div class="dropdown-content">
                            <a href="research-members.php">Research Team Members</a>
                            <a href="research-grant-leader.php">Research Grant (Leader)</a>
                            <a href="research-grant-co.php">Research Grant (Co-Researcher)</a>
                            <a href="research-grant-member.php">Research Grant (Group Member)</a>
                            <a href="research-outcomes.php">Research Outcomes</a>
                            <a href="research-facilities.php">Research Facilities</a>
                        </div>
                    </li>
                    <li <?php if ($activenav5){ echo "id='active'";}?> class="dropdown">
                        <a href="#" class="dropbtn">Publications</a>
                        <div class="dropdown-content">
                            <a href="publications-journals.php">Journals</a>
                            <a href="publications-proceedings.php">Proceedings</a>
                            <a href="publications-bc.php">Book Chapters</a>
                            <a href="publications-books.php">Books</a>
                        </div>
                    </li>
                    <li <?php if ($activenav6){ echo "id='active'";}?>class="dropdown">
                        <a href="#" class="dropbtn">Students</a>
                        <div class="dropdown-content">
                            <a href="students-ug.php">Undergraduates</a>
                            <a href="students-msc.php">Masters</a>
                            <a href="students-phd.php">PhD</a>
                            <a href="kalaistd/login.php">Student Panel Login</a>
                        </div>
                    </li>
                    <li <?php if ($activenav7){ echo "id='active'";}?>><a href="knowledge.php">Knowledge</a></li>
                    <li <?php if ($activenav8){ echo "id='active'";}?>><a href="interest.php">Interest</a></li>
                    <li <?php if ($activenav9){ echo "id='active'";}?>><a href="value.php">Value</a></li>
                    <li <?php if ($activenav10){ echo "id='active'";}?>><a href="communitycontribution.php">C.C.</a></li>
                    <li <?php if ($activenav11){ echo "id='active'";}?>><a href="blog.php">Blog</a></li>
                </ul>
            </div>
            <div class="wsite-header">
            </div>