<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';

//checking whether the course belongs to the same department of faculty or not

    // Get Faculty Department ID
    $sql_faculty_department=mysqli_query($conn,"SELECT * FROM faculty_department where facultyid='$facultyid' ");
    $row_faculty_department= mysqli_fetch_array($sql_faculty_department);
    $faculty_department_id=$row_faculty_department['departmentid'];
    
    
     // Get Course Department ID
     $sql_course=mysqli_query($conn,"SELECT * FROM course where courseid='$courseid' ");
     $row_course= mysqli_fetch_array($sql_course);
     $course_department_id=$row_course['departmentid'];


    
    // check whether the faculty department id and course department id matches
    if(strcmp($faculty_department_id, $course_department_id) == 0) 
    {

        // Check whether the faculty is having other class in the timeslotid for that semesterid or not 

        $sql_timeslotid_checking=mysqli_query($conn,"SELECT * FROM course_section where timeslotid='$timeslotid' AND semesterid='$semesterid' AND facultyid='$facultyid'");
        $row_timeslotid_checkings = mysqli_fetch_array($sql_timeslotid_checking);
        if(!is_array($row_timeslotid_checkings)){
            // echo "Good TO GO as faculty is free";
       
        //check is the room free for the current semester , timeslot
        $sql_roomid_checking=mysqli_query($conn,"SELECT * FROM course_section where roomid='$roomid' AND semesterid='$semesterid' AND timeslotid='$timeslotid' ");
        $row_roomid_checking = mysqli_fetch_array($sql_roomid_checking);
        if(!is_array($row_roomid_checking)){
            // echo "GOOD TO GO AS ROOM IS FREE";

        //get number of course_section currently the faculty is handling
        $sql_course_section_faculty_count=mysqli_query($conn,"SELECT count(*) FROM course_section where facultyid='$facultyid' AND semesterid='$semesterid'; ");
        $row_course_section_faculty_count= mysqli_fetch_array($sql_course_section_faculty_count);
        $course_section_faculty_count=$row_course_section_faculty_count['count(*)'];


         // Get FacultyTYPE
        $sql_faculty=mysqli_query($conn,"SELECT * FROM faculty where facultyid='$facultyid' ");
        $row_faculty= mysqli_fetch_array($sql_faculty);
        $faculty_type=$row_faculty['faculty_type'];

        if ($faculty_type=="Full Time")
        {
        if( $course_section_faculty_count<2)
        {
            // run insert statement
            $sql1 = "UPDATE course_section SET  courseid='$courseid',facultyid='$facultyid',timeslotid='$timeslotid',roomid='$roomid',semesterid='$semesterid',section_number='$section_number',available_seats='$available_seats'  WHERE crn='$crn'";
            $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));
          
               
          
                //insert into faculty_history also
                $sql_faculty_history = "INSERT INTO faculty_history(courseid,facultyid,crn,semesterid) values('$courseid','$facultyid','$crn','$semesterid')";
                $res_faculty_history = mysqli_query($conn1, $sql_faculty_history) or die(mysqli_error($conn1));

                echo "Updated Details !";
        }
        else
        {
            echo "FAILED :- AS FACULTY IS FULL TIME AND ALREADY IN 2 COURSE_SECTION FOR CURRENT SEMESTER";
        }
        }
        //for partime checking
        if ($faculty_type=="Part Time")
        {
        if( $course_section_faculty_count<1)
        {
            // run insert statement
            $sql1 = "UPDATE course_section SET  courseid='$courseid',facultyid='$facultyid',timeslotid='$timeslotid',roomid='$roomid',semesterid='$semesterid',section_number='$section_number',available_seats='$available_seats'  WHERE crn='$crn'";
            $res = mysqli_query($conn1, $sql1) or die(mysqli_error($conn1));

           
                //insert into faculty_history also
                $sql_faculty_history = "INSERT INTO faculty_history(courseid,facultyid,crn,semesterid) values('$courseid','$facultyid','$crn','$semesterid')";
                $res_faculty_history = mysqli_query($conn1, $sql_faculty_history) or die(mysqli_error($conn1));

                echo "Updated Details !";
        }
        else
        {
            echo "FAILED :- AS FACULTY IS PART TIME AND ALREADY IN 1 COURSE_SECTION FOR CURRENT SEMESTER";
        }
    }
//checking for roomid ends here
}
else
{
    echo "FAILED AS ROOM IS NOT FREE : There is already a Course Section exists for RoomID ".$roomid." Timeslot ID -".$timeslotid." - For Semester ".$semesterid;
}

//checking for timeslotid ends here
}
else
{
    echo "FAILED AS FACULTY IS NOT FREE : There is already a Course Section exists for facultyID ".$facultyid." Timeslot ID -".$timeslotid." - For Semester ".$semesterid;
}
    //matching of department id and faculty id checking ends here
    }
    else
    {
        echo "FAILED :-  Faculty is from Department ".$faculty_department_id." And Course is from Department  ".$course_department_id." . MAKE SURE SELECT FACULTY AND COURSE FROM SAME DEPARTMENT";
    }


    // $sql2 = "INSERT INTO course_section(courseid,facultyid,timeslotid,roomid,semesterid,section_number,available_seats) values('$courseid','$facultyid','$timeslotid','$roomid','$semesterid','$section_number','$available_seats')";
    // $res2 = mysqli_query($conn1, $sql2) or die(mysqli_error($conn1));

// echo "NEW COURSE ADDED!";
}
?>