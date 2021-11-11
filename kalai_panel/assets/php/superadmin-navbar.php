<ul class="nav">
    <li class="nav-item <?php if($navactive == "1") echo "active"; ?>">
        <a href="index.php">
            <i class="pe-7s-graph"></i>
            <p>Home</p>
        </a>
    </li>
    <li class="nav-item <?php if($navactive == "2") echo "active"; ?>">
        <a href="academic-lecturers.php">
            <i class="pe-7s-display1"></i><p>Academic Lecturers</p>
        </a>
    </li>
    <li class="nav-item <?php if($navactive == "3") echo "active"; ?>">
        <a href="consultants.php">
            <i class="pe-7s-id"></i><p>Consultants</p>
        </a>
    </li>
    <li class="nav-item <?php if($navactive == "4") echo "active"; ?>">
        <a href="teachers.php">
            <i class="pe-7s-study"></i><p>Teachers</p>
        </a>
    </li>
    <li class="nav-item <?php if($navactive == "5") echo "active"; ?>">
        <a href="manage-plans.php">
            <i class="pe-7s-network"></i><p>Manage Plans</p>
        </a>
    </li>
</ul>