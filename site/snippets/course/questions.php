<?php 

$numQuestions = count($listquestions);

if($numQuestions < 10){

  $rand10 = $numQuestions;

  $noQuestionsNeeded = 10 - $rand10;

  $newQuestions = array();

  if($noQuestionsNeeded % $rand10 == 0){
    $multiplied = $noQuestionsNeeded / $rand10;
    for ($i=0; $i < $rand10; $i++) { 
      for ($j=0; $j < $multiplied; $j++) { 
        $random = rand(0, $rand10-1);
        array_push($newQuestions, $listquestions[$random]);
      }
    }
  }else{
    $remainder = fmod($noQuestionsNeeded,$rand10);
    $divisor = $noQuestionsNeeded - $remainder;
    $multiplied = $divisor / $rand10;
    for ($i=0; $i < $rand10; $i++) { 
      for ($j=0; $j < $multiplied; $j++) { 
        $random = rand(0, $rand10-1);
        array_push($newQuestions, $listquestions[$random]);
      }
    }
    for ($k=0; $k < $remainder; $k++) { 
      $random = rand(0, $rand10-1);
      array_push($newQuestions, $listquestions[$random]);
    }
  }

  $mergeAllQuestions = array_merge($listquestions,$newQuestions);
}else{
  $rand10 = 10;
  $mergeAllQuestions = $listquestions;
}



$rand_keys = array_rand($mergeAllQuestions, 10);

$percent = (100/10);


?>

<form class="forms" id="testForm" method="post" style="display: block">

  <?php for ($i=0; $i < 10 ; $i++) : 

  $question = $mergeAllQuestions[$rand_keys[$i]];
  
  ?>

  <ul class="question-list">
    <li>
      <input type="hidden" value="0" class="questionIndex">
      <?php $correctAnswers[$i] = $question['answer'];  ?>
      <div class="questions" id="question-<?php echo $i;?>" style="display:<?php echo ($i == 0) ? 'block' :'none'; ?>">
        <span><?php echo $qNo = $i + 1; ?>.</span>
        <b><?php echo $question['question'] ?></b>
        <input type="hidden" name="questions-<?php echo $i; ?>" id="questions-<?php echo $i; ?>" value="<?php echo $question['question']; ?>">
        <ul>
          <li >
            <label >
              <input type="radio" class="first answer-<?php echo $i; ?>" name="answer[<?php echo $i?>]" data-answer="<?php echo 1; ?>" value="<?php echo $question['choice_1'] ?>">
              <span><?php echo $question['choice_1'] ?></span></label>
            </li>
            <li >
              <label>
                <input  type="radio" class="answer-<?php echo $i; ?>" name="answer[<?php echo $i?>]"  data-answer="<?php echo 2; ?>"value="<?php echo $question['choice_2'] ?>">
                <span><?php echo $question['choice_2'] ?></span></label>
              </li>
              <li >
                <label>
                 <input  type="radio" class="answer-<?php echo $i; ?>" name="answer[<?php echo $i?>]"  data-answer="<?php echo 3; ?>"value="<?php echo $question['choice_3'] ?>">
                 <span><?php echo $question['choice_3'] ?></span></label>   
               </li>
               <li>
                <label>
                 <input  type="radio" class="answer-<?php echo $i; ?>" name="answer[<?php echo $i?>]"  data-answer="<?php echo 4; ?>"value="<?php echo $question['choice_4'] ?>">
                 <span><?php echo $question['choice_4'] ?></span></label>
               </li>            
             </ul>

           </li>
         </ul> 


       <?php endfor; ?>

       <div class="modal-footer">
        <a tabindex="0" id="prevLink" class="btnThree radial" style="display: none">&lt;&lt; <?php echo page('courses')->prev_button_text()->text() ?></a>
        <a tabindex="0" id="nextLink" class="btnThree radial" ><?php echo page('courses')->next_button_text()->text() ?> &gt;&gt;</a>
        <button tabindex="0" class="btnOne radial" id="submitQuiz" name="submit1" class="submitQ" type="submit" style="display: none;"><?php echo page('courses')->submit_button_text()->text() ?></button>
      </div>
      <input type="hidden" name="page_uri" id="page_uri" value="<?php echo $page->uid() ?>">
      <input type="hidden" name="user_id" id="user_id" value="<?php echo s::get('hasOnlineAccess') ?>">
      <input type="hidden" name="score" id="score" value="0">
      <input type="hidden" name="ans_array" id="ans_array" value="">
      <input type="hidden" value="10" id="questionCount">
      <input type="hidden" value="10" id="progress">
      <input type="hidden" value="0" id="qestionNo">
    </form> 



    <script type="text/javascript">
      var progress = parseInt($('#questionCount').val());
      var incrementProgress = parseInt($('#questionCount').val());
      var decrementProgress = parseInt($('#questionCount').val());
      var questionIndex =  parseInt($('#qestionNo').val());
      var questionCount = $('#questionCount').val();
      var questions = new Array();
      var answerText = new Array();
      var score = 0;
      var correctAnswers = <?php echo '["' . implode('", "', $correctAnswers) . '"]' ?>;
      var answers = new Array();

      if(questionCount == 1){
        $('#nextLink').attr('style','display: none;');
        $('#submitQuiz').attr('style','display: inline-block;');
      }


      $("#nextLink").click(function(){

        progress = parseInt($('#progress').val()) + Math.ceil(incrementProgress);
        $('#progress').val(progress);
        $('#progressTest').width(progress + '%');
        document.getElementById('pCount').innerHTML = 'Progress: ' + progress + '%';
        answers[questionIndex] = $('input[name="answer['+questionIndex.toString()+']"]:checked').data('answer');
        answerText[questionIndex] = $('input[name="answer['+questionIndex.toString()+']"]:checked').val();

        questions[questionIndex] = $('#questions-'+questionIndex.toString()).val();
        questionIndex = parseInt($('#qestionNo').val()) + 1;
        $('#qestionNo').val(questionIndex);

        for(index = 0; index <= questionCount; index++) {
          if (index == questionIndex) {
            $('#question-'+index.toString()).attr('style','display: block; overflow: hidden');
          } else {
            $('#question-'+index.toString()).attr('style','display: none; overflow: hidden');
          }
        }

        if (questionIndex == 0)  {
          $('#prevLink').attr('style','display: none;  ');
        } else {
          $('#prevLink').attr('style','display: inline-block;  ');
        }

        if (questionIndex > 0 && questionIndex <= questionCount) {
          $('#prevLink').attr('style','display: inline-block;  ');

        } else {
          $('#prevLink').attr('style','display: none;  ');
        }

        if (questionIndex == questionCount-1) {
          $('#submitQuiz').attr('style','display: inline-block;  ');
          $('#nextLink').attr('style','display: none;  ');
        }  else {

          $('#submitQuiz').attr('style','display: none;  ');
        }

      });
    ///Enter at any time while doing a test regardless if on the last question or not will submit the test.
    $('.reveal').keypress(function(event) {
      if (event.keyCode == 13) {
        event.preventDefault();
      }
    });

    $("#prevLink").click(function(){

     progress = parseInt($('#progress').val()) - Math.ceil(incrementProgress);
     $('#progress').val(progress);
     $('#progressTest').width(progress + '%');
     document.getElementById('pCount').innerHTML = 'Progress: ' + progress + '%';
     questionIndex = parseInt($('#qestionNo').val()) - 1;
     $('#qestionNo').val(questionIndex);
     for(index = 0; index <= questionCount; index++) {
      if (index == questionIndex) {
        $('#question-'+index.toString()).attr('style','display: block; overflow: hidden');
      } else {
        $('#question-'+index.toString()).attr('style','display: none; overflow: hidden');
      }
    }

    if (questionIndex == 0)  {
      $('#prevLink').attr('style','display: none;  ');
      $('#submitQuiz').attr('style','display: none;  ');
      $('#nextLink').attr('style','display: inline-block;  ');
    } else {
      $('#prevLink').attr('style','display: inline-block;  ');
    }

    if (questionIndex > 0 && questionIndex <= questionCount) {
      $('#prevLink').attr('style','display: inline-block;  ');
      $('#submitQuiz').attr('style','display: none;  ');
      $('#nextLink').attr('style','display: inline-block;  ');
    } else {
      $('#prevLink').attr('style','display: none;  ');
    }

    if (questionIndex == questionCount-1) {
      $('#prevLink').attr('style','display: inline-block;  ');
      $('#submitQuiz').attr('style','display: inline-block;  ');
    }  else {
      $('#submitQuiz').attr('style','display: none;  ');
    }

  });

    $("#submitQuiz").click(function(e) {


     e.preventDefault();
     var form = $('#formQuestion')[0];
     var getcurse = $("#getcurse").val();
     var getid = $("#getid").val();

     score = 0;

     answers[questionIndex] = $('input[name="answer['+questionIndex.toString()+']"]:checked').data('answer');
     answerText[questionIndex] = $('input[name="answer['+questionIndex.toString()+']"]:checked').val();

     questions[questionIndex] = $('#questions-'+questionIndex.toString()).val();


     for (var i = 0; i < questionCount ; i++) {
      if (answers[i] == correctAnswers[i])
      {
        score += 1;
      }
      else {
        score = score;
      }
    }

    setTimeout(function() { $('#test-yourself').find('.showanswer').focus(); }, 1000);

    if (score >= 8) {
      $('.success').attr('style','display: block; padding-top: 30px ');
      $('#modal-footer').attr('style','display: block; ');
      $("#formQuestion").hide();
      $("div#passsed_score").html( score + "/10" );
      $('.testDownload').css('display','block');
      $('.taketest').css('display','none');
      $('.trytest').css('display','inline-block');
      $('#submitCertDesktop').css('display','block');
    }  else {
      $('.failed').attr('style','display: block; padding-top: 30px ');
      $('#modal-footer-failed').attr('style','display: block; ');
        // $('#getformv').attr('style','display: none;  ');
        $("#formQuestion").hide();
        $("div#failed_score").html( score + "/10" );
      }

      document.getElementById('score').value = score;
      var getscore = $("#score").val();
      showAnswers();

            //var answers = JSON.stringify(answers);
            var getscore = score;
            var page_uri = $('#page_uri').val();
            var user_id = $('#user_id').val();
            $.ajax({
              url: "<?php echo url() ?>/api/quiz?score="+score+'&page_uri='+page_uri+'&user_id='+user_id,
              type: "POST",
              data:  new FormData(form),
              contentType: false,
              cache: false,
              processData:false,
              success: function(data){

              },
              error: function(data){

              }          
            })
          });

    function showAnswers() {
      var questionIndex = 0;
      var answersHTML = '<ul style="list-style-type: none;">';

      questions.forEach(function(question) {
        var answer = ""
        if (answers[questionIndex] == null){
          answer = "No answer.";
        } else {
          answer = answers[questionIndex];
        }

        answersHTML += '<li style="list-style-type: none;">' +
        '<b>' + (questionIndex + 1).toString() +'. ' + question + '</b>' +
        '<ul style="list-style-type: none;">' +
        ((correctAnswers[questionIndex] == answer) ?
         '<li style="list-style-type: none;"><img src="../assets/images/correct.png" alt="correct"> ' + answerText[questionIndex] +'</span></li>' 
         : '<li style="list-style-type: none;"><img src="../assets/images/wrong.png" alt="wrong"> ' + answerText[questionIndex] +'</span></li>') +
        '</ul>' +
        '</li>';
        questionIndex ++;
      });

      answersHTML += '</ul>';
      document.getElementById('userAnswers').innerHTML = answersHTML;
    }

  </script>