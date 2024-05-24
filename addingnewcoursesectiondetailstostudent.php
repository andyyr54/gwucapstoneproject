<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbconfig.php';

//checking whether the course belongs to the same department of faculty or not

    // Get Course ID
    $sql_course_section=mysqli_query($conn,"SELECT * FROM course_section where crn='$crn' ");
    $row_course_section= mysqli_fetch_array($sql_course_section);
    $courseid=$row_course_section['courseid'];
    $new_crn_timeslotid=$row_course_section['timeslotid'];
    $available_seats=$row_course_section['available_seats'];
    // echo $courseid;
    $grade="NA";


    // check crn's timeslot id with existing enrollments for clash
    //First loop through all enrollments of student and match with new_crn_timeslotid
    $sql_enrollment = "SELECT * FROM enrollment where studentid='$studentid' ";
    $result_enrollment= mysqli_query($conn1, $sql_enrollment) or die(mysqli_error($conn1));

    //assuming positive scenarios and assigning for variables and checking later and updating accordingly
    $is_conflict="NO";
    $is_hold="NO";
    $is_course_prerequisite_met="YES";
    $message_to_be_displayed="";
    $student_already_passed_subject="NO";


    //checking pre requisite
    $sql_course_prerequisite_exists=mysqli_query($conn,"SELECT * FROM course_prerequisite where courseid='$courseid'");
    $row_course_prerequisite_exists = mysqli_fetch_array($sql_course_prerequisite_exists);
    if(is_array($row_course_prerequisite_exists))
    {

      
        //now pre requisite exists for the courseid

        $sql_course_prerequisite= "SELECT * FROM course_prerequisite where courseid='$courseid'";
        $result_course_prerequisite = mysqli_query($conn1, $sql_course_prerequisite) or die(mysqli_error($conn1));

        //now running loop to get all pre requisite from the course_prerequisite table
        while($det_course_prerequisite = mysqli_fetch_assoc($result_course_prerequisite)){
            // echo "Pre requisite exists";
            //get prerequisiteid so we will get to  know which courses-courseid need to be completed
            $prerequisite_course_id=$det_course_prerequisite['prerequisiteid'];
            $prerequisite_grade_required=$det_course_prerequisite['minimum_grade'];
            //now query and see whether it was enrolled by student or not
            $sql_course_prerequisite_student_history_exists=mysqli_query($conn,"SELECT * FROM student_history where courseid='$prerequisite_course_id' and studentid='$studentid'");
            $row_course_prerequisite_student_history_exists = mysqli_fetch_array($sql_course_prerequisite_student_history_exists);
            if(is_array($row_course_prerequisite_student_history_exists))
                {

                    // echo " Student is already enrolled in prerequisite";
                        //now check the grade is it satisfied or not
                        $student_grade_acquired=$row_course_prerequisite_student_history_exists['grade'];
                        $passingGrades = ['A', 'B', 'C'];

                        if (in_array($student_grade_acquired, $passingGrades)) {
                            // echo "Pass";
                            //its pass don't worry
                        } else {
                            //  echo "Fail";
                            $message_to_be_displayed="The Student didn't pass yet. He is having Grade - ".$student_grade_acquired;
                            $is_course_prerequisite_met="NO";
                            // echo $message_to_be_displayed;
                        }
                }
                else
                {
                    $message_to_be_displayed="The course pre requisite hasn't taken yet. Please Enroll first for courseid - ".$prerequisite_course_id;
                    $is_course_prerequisite_met="NO";
                    // echo "Student is not enrolled in prerequisite";
                }

        }
    }




    $sql_hold_checking=mysqli_query($conn,"SELECT * FROM student_hold where studentid='$studentid' ");
    $row_hold_checkings = mysqli_fetch_array($sql_hold_checking);

    //means there is match and record retrieved so it's a conflict
    if(is_array($row_hold_checkings)){
        $is_hold="YES";
    }

//looping 
while($det_enrollment= mysqli_fetch_assoc($result_enrollment)){
    //now check with course_section table with current_semester using semesterid for match
    $existing_crn=$det_enrollment['crn'];
    $sql_timeslotid_checking=mysqli_query($conn,"SELECT * FROM course_section where timeslotid='$new_crn_timeslotid' AND semesterid='$semesterid' AND crn='$existing_crn'");
    $row_timeslotid_checkings = mysqli_fetch_array($sql_timeslotid_checking);

    //means there is match and record retrieved so it's a conflict
    if(is_array($row_timeslotid_checkings)){
        $is_conflict="YES";
    }

}


    //checking whether he has passed or not if registered in student_history

    $sql_course_in_student_history_exists=mysqli_query($conn,"SELECT * FROM student_history where courseid='$courseid' AND studentid='$studentid'");
    $row_course_in_student_history_exists = mysqli_fetch_array($sql_course_in_student_history_exists);
    if(is_array($row_course_in_student_history_exists))
    {
        //he has registered 
        $grade_of_history=$row_course_in_student_history_exists['grade'];
        $passingGrades = ['A', 'B', 'C'];

        if (in_array($grade_of_history, $passingGrades)) {
            // echo "Pass";
            $message_to_be_displayed="The Student has already passed the course and He is having Grade - ".$grade_of_history;
            $student_already_passed_subject="YES";
          
        }
         
    }


if($student_already_passed_subject=="NO")
{

if($is_course_prerequisite_met=="YES")
{


if($is_hold=="NO")
{


if( $is_conflict=="NO")
{


       //insert into student_hsitory also
       $sql_student_history = "INSERT INTO student_history(studentid,crn,courseid,semesterid,grade) values('$studentid','$crn','$courseid','$semesterid','$grade')";
       $res_student_history = mysqli_query($conn1, $sql_student_history) or die(mysqli_error($conn1));
  //insert into enrollment also
  $sql_student_history = "INSERT INTO enrollment(studentid,crn,grade,date_of_enrollment) values('$studentid','$crn','$grade','$date_of_enrollment')";
  $res_student_history = mysqli_query($conn1, $sql_student_history) or die(mysqli_error($conn1));
//update the available seats -1
$available_seats=$available_seats-1;
$sql_update_available_seats = "UPDATE course_section SET  available_seats='$available_seats'  WHERE crn='$crn'";
$res_update_available_seats = mysqli_query($conn1, $sql_update_available_seats) or die(mysqli_error($conn1));

     echo "STUDENT IS ENROLLED";
    }
    else
    {
        echo "TIMESLOT is conflict as student is already having another class at that timeslot.";
    }
 
}
else
{
    echo "THERE IS HOLD ON STUDENT, SO HE CAN'T REGISTER.";
}
}
else
{
    echo $message_to_be_displayed;
}
}
else
{
    echo $message_to_be_displayed;
}
}

?>