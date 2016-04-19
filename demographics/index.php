<!--
Team Einerlei
File Written by: Isaac Meisner

This file generates the demographic section of the questionnaire.
There are currently 14 questions that each have unique inputs.
These inputs are radio, option, text, and textarea. The answers
are sent to questionSubmit.php.
-->

<?php
session_start();
if(!isset($_SESSION['id']))
{
  header('Location: ../please-login/');
}
$_SESSION["time"] = time();
?>
<!DOCTYPE html>
<html>
<head>
<title>Performance Anxiety Diagostic Questionnaire</title>
<link rel="stylesheet" href="../style.css">
<script src="../src/jquery-1.12.2.min.js"></script>
</head>
<body>
<script>

//JQUERY
//-----------------------------------------------------

var totalQues = 14;
var question = "";

$(document).ready(function(){

  $.getJSON("demographicQuestions.json", function(data)
  {
    obj = data;
    for(i=1; i<=totalQues; i++)
    {
      question = "question" + i;
      $("#"+question).append(obj[question]);
      $("#"+question).append("<br><br>");

    }

    //1. Gender
    $("#question1").append(
      "<input type='radio' name='question1' value='Male' required> Male" +
      "<input type='radio' name='question1' value='Female' required> Female"
    );
    
    //2. Age
    $("#question2").append(
      "<select name='question2' required>"
        +"<option disabled selected value> -- select an option -- </option>"
        +"<option value='17 and under'>17 and under</option>"
        +"<option value='18-23'>18-23</option>" 
        +"<option value='24-30'>24-30</option>"
        +"<option value='31-40'>31-40</option>"
        +"<option value='41-50'>41-50</option>"
        +"<option value='51-60'>51-60</option>"
        +"<option value='61-70'>61-70</option>"
        +"<option value='Over 70'>Over 70</option>"
      +"</select>"
    );

    //3. Number of years studying primary* voice/instrument:
    $("#question3").append(
      "<select name='question3' required>"
        +"<option disabled selected value> -- select an option -- </option>"
        +"<option value='0-2'>0-2</option>"   
        +"<option value='3-5'>3-5</option>"   
        +"<option value='6-10'>6-10</option>"   
        +"<option value='11-15'>11-15</option>"   
        +"<option value='16-20'>16-20</option>"   
        +"<option value='21-25'>21-25</option>"  
        +"<option value='Over 25'>Over 25</option>"   
      +"</select>"
    );

    //4. Age when starting musical study of primary instrument:
    $("#question4").append(
      "<select name='question4' required>"
        +"<option disabled selected value> -- select an option -- </option>"
        +"<option value='0-3'>0-3</option>"   
        +"<option value='4-5'>4-5</option>"   
        +"<option value='6-7'>6-7</option>"   
        +"<option value='8-9'>8-9</option>"   
        +"<option value='10-11'>10-11</option>"   
        +"<option value='12-13'>12-13</option>"  
        +"<option value='14-15'>14-15</option>"   
        +"<option value='16-17'>16-17</option>"   
        +"<option value='18-19'>18-19</option>"   
        +"<option value='Over 20'>Over 20</option>"   
      +"</select>"
    );

    //5. Age when starting musical study of primary instrument:
    $("#question5").append(
      "<select name='question5' required>"
        +"<option disabled selected value> -- select an option -- </option>"
        +"<option value='0-3'>0-3</option>"   
        +"<option value='4-5'>4-5</option>"  
        +"<option value='6-7'>6-7</option>"   
        +"<option value='8-9'>8-9</option>"   
        +"<option value='10-1l'>10-11</option>"   
        +"<option value='12-13'>12-13</option>"   
        +"<option value='14-15'>14-15</option>"   
        +"<option value='16-17'>16-17</option>"   
        +"<option value='18-19'>18-19</option>"   
        +"<option value='Over 20'>Over 20</option>"   
      +"</select>"
    );

    //6. Are you currently (select one)
    $("#question6").append(
      "<select name='question6' onchange= 'return specifyOther(this.value);' required>"
        +"<option disabled selected value> -- select an option -- </option>"
        +"<option value='High school student uncertain of future role of music in life'>"
        +"High school student uncertain of future role of music in life"
        +"</option>"
        +"<option value='High school student looking toward career as a musician'>"
        +"High school student looking toward career as a musician"
        +"</option>"
        +"<option value='Undergraduate music minor'>"
        +"Undergraduate music minor"
        +"</option>"
        +"<option value='Undergraduate music major'>"
        +"Undergraduate music major"
        +"</option>"
        +"<option value='Masters music student'>"
        +"Masters music student"
        +"</option>"
        +"<option value='Doctoral music student'>"
        +"Doctoral music student"
        +"</option>"
        +"<option value='Amateur adult musician'>"
        +"Amateur adult musician"
        +"</option>"
        +"<option value='Part-time professional musician'>"
        +"Part-time professional musician"
        +"</option>"
        +"<option value='Full-time professional musician in early career stage'>"
        +"Full-time professional musician in early career stage"
        +"</option>"
        +"<option value='Full-time professional musician for at least ten years'>"
        +"Full-time professional musician for at least ten years"
        +"</option>"
        +"<option value='Other'>"
        +"Other"
        +"</option>"
      +"</select>"
      +"<p id='pleaseSpecify'></p>"
    );
    
    //7. Primary voice type or instrument:
    $("#question7").append(
      "<select name='question7' onchange='specificInstrument();' required>"
        +"<option disabled selected value> -- select an option -- </option>"
        +"<option value='Woodwind'>Woodwind</option>"
        +"<option value='Brass'>Brass</option>"
        +"<option value='Strings'>Strings</option>"
        +"<option value='Percussion'>Percussion</option>"
        +"<option value='Keyboard'>Keyboard</option>"
        +"<option value='Vocalist'>Vocalist</option>"
        +"<option value='Conductor'>Conductor</option>"
      +"</select>"
      +"<p id='specificInstrument'></p>"
    );

    //8. Number of professional performances given (approximate):
    $("#question8").append(
      "<select name='question8' required>"
        +"<option disabled selected value> -- select an option -- </option>"
        +"<option value='0-5'>0-5</option>"
        +"<option value='6-10'>6-10</option>"
        +"<option value='11-15'>11-15</option>"
        +"<option value='16-20'>16-20</option>"
        +"<option value='21-25'>21-25</option>"
        +"<option value='26-30'>26-30</option>"
        +"<option value='31-35'>31-35</option>"
        +"<option value='36-40'>36-40</option>"
        +"<option value='41-45'>41-45</option>"
        +"<option value='46-50'>46-50</option>"
        +"<option value='Over 50'>Over 50</option>"
      +"</select>"
    );

    //9. Number of total performances given (approximate):
    $("#question9").append(
      "<select name='question9' required>"
        +"<option disabled selected value> -- select an option -- </option>"
        +"<option value='0-5'>0-5</option>"
        +"<option value='6-10'>6-10</option>"
        +"<option value='11-20'>11-20</option>"
        +"<option value='21-30'>21-30</option>"
        +"<option value='31-40'>31-40</option>"
        +"<option value='41-50'>41-50</option>"
        +"<option value='51-60'>51-60</option>"
        +"<option value='61-70'>61-70</option>"
        +"<option value='71-80'>71-80</option>"
        +"<option value='81-90'>81-90</option>"
        +"<option value='91-100'>91-100</option>"
        +"<option value='Over 100'>Over 100</option>"
      +"</select>"
    );

    //10. Do you have medical conditions impacting your ability to sing/play
    $("#question10").append(
      "<input type='radio' name='question10' value='Yes medical condition' " 
      +"onchange='return specificConditions(this.value);' required> Yes"
      +"<input type='radio' name='question10' value='No medical condition' " 
      +"onchange='return specificConditions(this.value);' required> No"
      +"<br>"
      +"<p id ='specificConditions'></p>"
    );

    //11. Number of alcoholic drinks per month:
    $("#question11").append(
      "<select name='question11' required>"
        +"<option disabled selected value> -- select an option -- </option>"
        +"<option value='0'>0</option>"
        +"<option value='1-5'>1-5</option>"
        +"<option value='6-10'>6-10</option>"
        +"<option value='11-20'>11-20</option>"
        +"<option value='21-30'>21-30</option>"
        +"<option value='31-40'>31-40</option>"
        +"<option value='41-50'>41-50</option>"
        +"<option value='Over 50'>Over 50</option>"
      +"</select>"
    );

    //12. Use of recreational drugs?
    $("#question12").append(
      "<input type='radio' name='question12'" 
      +"value='Yes use of recreational drugs' required> Yes"
      +"<input type='radio' name='question12'" 
      +"value='No use of recreational drugs' required> No"
      +"<br>"
    );

    //13. Do you take any blood pressure or anxiety medication(s)?
    $("#question13").append(
      "<input type='radio' name='question13'"
      +"value='Yes use of blood pressure/anxiety meds' required> Yes"
      +"<input type='radio' name='question13'"
      +"value='No use of blood pressure/anxiety meds' required> No"
    );

    //14. Professional plans / career goals:
    $("#question14").append( 
      "<textarea name='question14' id='question14' cols='25' rows='3'></textarea>"
      +"<br><br>"
    );
  });
});

function specifyOther(other)
{
  if(other == 'Other')
  {
    document.getElementById("pleaseSpecify").innerHTML = "Please Specify:"
                            + "<input type='text' name='pleaseSpecify' required>"; 
  }
  else{
  }
}

function specificInstrument()
{
  document.getElementById("specificInstrument").innerHTML = 
  "Specific instrument or voice type: <input type='text' name='specificInstrument' required>";
}

function specificConditions(ans)
{
  if(ans == 'Yes medical condition'){
    document.getElementById("specificConditions").innerHTML = "Specific medical condition:<input type='text'>"; 
  }
  if(ans == 'No medical condition'){
  }
}

</script>

<h1>Demographic Questions</h1>

<p id = demographicQuestions>
</p>

<form action='questionSubmit.php' method='post'>
<table>
  <p id ='question1'></p>
  <p id ='question2'></p>
  <p id ='question3'></p>
  <p id ='question4'></p>
  <p id ='question5'></p>
  <p id ='question6'></p>
  <p id ='question7'></p>
  <p id ='question8'></p>
  <p id ='question9'></p>
  <p id ='question10'></p>
  <p id ='question11'></p>
  <p id ='question12'></p>
  <p id ='question13'></p>
  <p id ='question14'></p>
</table>
<input type='submit'>
</form>

<!--
  <input type='radio' name='question1' value='Male' required> Male
  <input type='radio' name='question1' value='Female' required> Female

  <select name='question2' required>
    <option disabled selected value>  select an option  </option>
    <option value='17 and under'>17 and under</option>   
    <option value='18-23'>18-23</option>   
    <option value='24-30'>24-30</option>   
    <option value='31-40'>31-40</option>   
    <option value='41-50'>41-50</option>   
    <option value='51-60'>51-60</option>   
    <option value='61-70'>61-70</option>   
    <option value='Over 70'>Over 70</option>   
  </select>


  <p id ='question3'></p>
  <select name='question3' required>
    <option disabled selected value>  select an option  </option>
    <option value='0-2'>0-2</option>   
    <option value='3-5'>3-5</option>   
    <option value='6-10'>6-10</option>   
    <option value='11-15'>11-15</option>   
    <option value='16-20'>16-20</option>   
    <option value='21-25'>21-25</option>   
    <option value='Over 25'>Over 25</option>   
  </select>


  <p id ='question4'></p>
  <select name='question4' required>
    <option disabled selected value>  select an option  </option>
    <option value='0-3'>0-3</option>   
    <option value='4-5'>4-5</option>   
    <option value='6-7'>6-7</option>   
    <option value='8-9'>8-9</option>   
    <option value='10-11'>10-11</option>   
    <option value='12-13'>12-13</option>   
    <option value='14-15'>14-15</option>   
    <option value='16-17'>16-17</option>   
    <option value='18-19'>18-19</option>   
    <option value='Over 20'>Over 20</option>   
  </select>
  <br>

  <p id ='question5'></p>
  <select name='question5' required>
    <option disabled selected value>  select an option  </option>
    <option value='0-3'>0-3</option>   
    <option value='4-5'>4-5</option>   
    <option value='6-7'>6-7</option>   
    <option value='8-9'>8-9</option>   
    <option value='10-1l'>10-11</option>   
    <option value='12-13'>12-13</option>   
    <option value='14-15'>14-15</option>   
    <option value='16-17'>16-17</option>   
    <option value='18-19'>18-19</option>   
    <option value='Over 20'>Over 20</option>   
  </select>
  <br>

  <p id = 'question6'></p>
  <select name='question6' onchange= "return specifyOther(this.value);" required>
    <option disabled selected value>  select an option  </option>
    <option value='High school student uncertain of future role of music in life'>
    High school student uncertain of future role of music in life
    </option>
    <option value='High school student looking toward career as a musician'>
    High school student looking toward career as a musician
    </option>
    <option value='Undergraduate music minor'>
    Undergraduate music minor
    </option>
    <option value='Undergraduate music major'>
    Undergraduate music major
    </option>
    <option value='Masters music student'>
    Masters music student
    </option>
    <option value='Doctoral music student'>
    Doctoral music student
    </option>
    <option value='Amateur adult musician'>
    Amateur adult musician
    </option>
    <option value='Part-time professional musician'>
    Part-time professional musician
    </option>
    <option value='Full-time professional musician in early career stage'>
    Full-time professional musician in early career stage
    </option>
    <option value='Full-time professional musician for at least ten years'>
    Full-time professional musician for at least ten years
    </option>
    <option value='Other'>
    Other
    </option>
  </select>
  <p id='pleaseSpecify'></p>
    

  <p id ='question7'></p>
  <select name="question7" onchange="specificInstrument();" required>
    <option disabled selected value>  select an option  </option>
    <option value='Woodwind'>Woodwind</option>
    <option value='Brass'>Brass</option>
    <option value='Strings'>Strings</option>
    <option value='Percussion'>Percussion</option>
    <option value='Keyboard'>Keyboard</option>
    <option value='Vocalist'>Vocalist</option>
    <option value='Conductor'>Conductor</option>
  </select>
  <p id='specificInstrument'></p>
  

  <p id ='question8'></p>
  <select name='question8' required>
    <option disabled selected value>  select an option  </option>
    <option value='0-5'>0-5</option>
    <option value='6-10'>6-10</option>
    <option value='11-15'>11-15</option>
    <option value='16-20'>16-20</option>
    <option value='21-25'>21-25</option>
    <option value='26-30'>26-30</option>
    <option value='31-35'>31-35</option>
    <option value='36-40'>36-40</option>
    <option value='41-45'>41-45</option>
    <option value='46-50'>46-50</option>
    <option value='Over 50'>Over 50</option>
  </select>


  <p id ='question9'></p>
  <select name='question9' required>
    <option disabled selected value>  select an option  </option>
    <option value='0-5'>0-5</option>
    <option value='6-10'>6-10</option>
    <option value='11-20'>11-20</option>
    <option value='21-30'>21-30</option>
    <option value='31-40'>31-40</option>
    <option value='41-50'>41-50</option>
    <option value='51-60'>51-60</option>
    <option value='61-70'>61-70</option>
    <option value='71-80'>71-80</option>
    <option value='81-90'>81-90</option>
    <option value='91-100'>91-100</option>
    <option value='Over 100'>Over 100</option>
  </select>


  <p id ='question10'></p>
  <input type='radio' name='question10' value='Yes medical condition' 
    onchange= "return specificConditions(this.value);" required> Yes
  <input type='radio' name='question10' value='No medical condition' 
    onchange=" return specificConditions(this.value);" required> No
  <br>
  <p id ='specificConditions'></p>


  <p id ='question11'></p>
  <select name='question11' required>
    <option disabled selected value>  select an option  </option>
    <option value='0'>0</option>
    <option value='1-5'>1-5</option>
    <option value='6-10'>6-10</option>
    <option value='11-20'>11-20</option>
    <option value='21-30'>21-30</option>
    <option value='31-40'>31-40</option>
    <option value='41-50'>41-50</option>
    <option value='Over 50'>Over 50</option>
  </select>


  <p id ='question12'></p>
  <input type='radio' name='question12' value='Yes use of recreational drugs' required> Yes
  <input type='radio' name='question12' value='No use of recreational drugs' required> No
  <br>


  <p id ='question13'></p>
  <input type='radio' name='question13' value='Yes use of blood pressure/anxiety meds' required> Yes
  <input type='radio' name='question13' value='No use of blood pressure/anxiety meds' required> No


  <p id ='question14'></p>
  <textarea name='question14' id='question14' cols='25' rows='3'></textarea>
  <br>
  <br>

<input type='submit'>
-->
</body>
</html>
