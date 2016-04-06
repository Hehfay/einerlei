<?php
session_start();
if(!isset($_SESSION['id']))
{
  header('Location: ../please-login/');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Performance Anxiety Diagostic Questionnaire</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>

<script>
window.onload = function()
{
  document.getElementById("likert").innerHTML += "<form id='quiz' method='post'>";
  var question = "question";
  for (i = 1; i<=10; i++)
  {
    document.getElementById("quiz").innerHTML += "<p id='" + question + i + "'>";
  }
  var likertScale_req = new XMLHttpRequest();
  likertScale_req.onreadystatechange = function()
  {
    if(likertScale_req.readyState == 4 && likertScale_req.status == 200)
    {
      var jsonText = likertScale_req.responseText;
      var obj = JSON.parse(jsonText);
      for (i=1; i<=10; i++){
        document.getElementById(question+i).innerHTML += obj[question+i];
        document.getElementById(question+i).innerHTML += "<br>";
        for(j = 1; j<=6; j++)
        {
          if(j == 6)
          {
            document.getElementById(question+i).innerHTML += "<div class='checkboxgroup'>" + "<input type='radio' id='answer" + i + "." + j + "' name='" + obj[question + i] + "' value='" + j +"'required>" +"<label for='answer" + i + "." + j + "'>N/A</label>"+ "</div>";
          }
          else
          {
            document.getElementById(question+i).innerHTML += "<div class='checkboxgroup'>" + "<input type='radio' id='answer" + i + "." + j + "' name='" + obj[question + i] + "' value='" + j +"'required>" +"<label for='answer" + i + "." + j + "'>"+j+"</label>"+ "</div>";
          }
        }
      }
      document.getElementById("quiz").innerHTML += "<button id='confirm' type='button' value='submit' onclick='submitAnswers(i-10)'>Next</button>";
    }
  }
  likertScale_req.open("GET","likertScaleQuestions.json", true);
  likertScale_req.send();
  document.getElementById("quiz").innerHTML += "</form>";
}

//-------------------------------------------------------------------------------------------------

var submitAnswers = function(counter)
{
  var qa_count = 0;
  var args = "";
  var question_key = "q";
  var answer_key = "a";
  for(i=counter; i<=counter+9; i++)
  {
    for(j=1; j<=6; j++)
    {
      var answer = "answer" + i;
      var answerWithVal = "answer" + i + "." + j;
      var idname = document.getElementById(answerWithVal).getAttribute("name");
      //console.log(idname);
      if(document.getElementById(answerWithVal).checked)
      {
        console.log(answer);
        args += question_key + qa_count + "=" + idname + "&";
        args += answer_key + qa_count + "=" + document.getElementById(answerWithVal).value;
        //console.log(document.getElementById(answer).value);
        //args += question + "=" + document.getElementById(obj[question]).value;
        qa_count++;
      }
    }
    if(i != counter+9) 
      args += "&";
  }

  var submitAnswers_req = new XMLHttpRequest();
  submitAnswers_req.onreadystatechange = function()
  {
    if(submitAnswers_req.readystate == 4 && submitAnswers_req.status == 200)
    {
      document.getElementById("console").innerHTML = submitAnswers_req.responsetext;
    }
  }
  console.log(args);
  submitAnswers_req.open("POST", "questionSubmit.php", true);
  submitAnswers_req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  submitAnswers_req.send(args);
  nextPage(i);
}

//-------------------------------------------------------------------------------------------------

var nextPage = function(counter)
{
  document.getElementById("likert").innerHTML = "<form id='quiz' method='post'>";
  var question = "question";
  for (i = counter; i<=counter+9; i++)
  {
    document.getElementById("quiz").innerHTML += "<p id='" + question + i + "'>";
  }

  var nextPage_req = new XMLHttpRequest();
  nextPage_req.onreadystatechange = function()
  {
    if(nextPage_req.readyState == 4 && nextPage_req.status == 200)
    {
      var jsonText = nextPage_req.responseText;
      var obj = JSON.parse(jsonText);
      for (i=counter; i<=counter+9; i++){
        if(!obj[question+i])
        {
        }
        else
        {
          document.getElementById(question+i).innerHTML += obj[question+i];
          document.getElementById(question+i).innerHTML += "<br>";
          for(j = 1; j<=6; j++)
          {
            if(j == 6)
            {
              document.getElementById(question+i).innerHTML += "<div class='checkboxgroup'>" + "<input type='radio' id='answer" + i + "." + j + "' name='" + obj[question + i] + "' value='" + j +"'required>" +"<label for='answer" + i + "." + j + "'>N/A</label>"+ "</div>";
            }
            else
            {
              document.getElementById(question+i).innerHTML += "<div class='checkboxgroup'>" + "<input type='radio' id='answer" + i + "." + j + "' name='" + obj[question + i] + "' value='" + j +"'required>" +"<label for='answer" + i + "." + j + "'>"+j+"</label>"+ "</div>";
            }
            //document.getElementById(question+i).innerHTML +=
            //"<input type = 'radio' name='" + obj[question + i] + "' value='"+j+"'required>"+j; 
            //"<input type = 'radio' id='answer" + i + "." + j + "' name='" + obj[question + i] + "' value='"+j+"'>"+j; 
            //"<label for='answer" + i + "." + j + "'>"+j+"</label>";
            //document.getElementById(question+i).innerHTML +=
            //"<input type='radio' id='answer" + i + "." + j + "' name='" + obj[question + i] + "' value='"+j+"' required>"; 
          }
        }
      }
    }
  }
  document.getElementById("quiz").innerHTML += "<button id='confirm' type='button' value='submit' onclick='submitAnswers(i-10)'>Next</button>";
  nextPage_req.open("GET","likertScaleQuestions.json", true);
  nextPage_req.send();
  document.getElementById("quiz").innerHTML += "</form>";
}

</script>

<h1>Likert Scale Questions</h1>
<h4>For the following questions, please answer with a number between 1 and 5.</h4>
<ul>
  <li>1 "Strongly Disagree"</li>
  <li>2 "Disagree"</li>
  <li>3 "Undecided" or "Neutral"</li>
  <li>4 "Agree"</li>
  <li>5 "Strongly Agree"</li>
</ul>
<h4 id="bottom">Select the appropriate number.  </h4>

<div id="likert">


</body>
</html>
