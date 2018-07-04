<script type="text/javascript">
    // setting the progress global object.
    var progress = 0
</script>
<div class="modal-header">
    <h3><?php echo page('courses')->test_title()->text() ?></h3>
</div>
<!-- answer questions section -->
<?php 
$mods = $page->module_items()->yaml(); 
$listquestions = array();
$questCtr = 0;
$score = 0;
if(is_object($userCoursesScore)){
    $score = $userCoursesScore->score();
}
foreach(a::shuffle($mods) as $modItems){ 
    $items = array();
    $items[] = $modItems['modules_select'];
    $sql = implode(' ', $items);
    $modules = db::table('modules')->select(array('uri'))->where(array('id' => $sql))->first(); 
    $p = page('modules')->children()->find($modules->uri);
    if($p){
        $questions =  $p->questions()->yaml();
        $questCtr = $questCtr + count($questions);
        foreach(a::shuffle($questions) as $questionss){
            array_push($listquestions, $questionss); 
        }
    }
}
?>
<?php if($questCtr == 0) :?>
    <div style="padding:50px;text-align: center">No test questions available!</div>
<?php else :?>
    <form id="formQuestion" action="">
        <p id="pCount" class="progress-count">Progress: <?php echo (100/10);?>%</p>
        <div class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div id="progressTest" class="progress-meter" style="width: <?php echo (100/10);?>%"></div>
        </div>
        <div id="questionsWrap">
            <?php 

            if(!empty($listquestions)){
                snippet('course/questions', array('listquestions' => $listquestions));
            }

            ?>
        </div>
    </form>
<?php endif ?>

<!-- end of answer questions section -->
<!-- result section -->
<div class="result-contents">
    <!-- success test -->

    <div class="success" style="display: none;">
        <p>Congratulations, <br> <?php 
        foreach($result_user as $user) {
            echo $user->firstname(); }?>! </p>
            <p>You passed the test <br> with a score of</p>
            <h1><div id="passsed_score"></div></h1>
            <img class="hide-for-medium show-for-small" src="<?php echo url() ?>/assets/images/pass-result-img.png" alt="result">
            <img class="hide-for-small show-for-medium" src="<?php echo url() ?>/assets/images/pass-result-img-desktop.png" alt="result">
        </div>
        <!-- end of success test -->
        <!-- failed test -->
        <div class="failed" style="display: none;">

            <p>Good try! <br> You need 8/10 to <br> pass, and you scored</p>

            <h1><div id="failed_score"><?php
            foreach($result_course as $course) {
                echo $course->score(); } ?>/10</div></h1>
                <img class="hide-for-medium show-for-small" src="<?php echo url() ?>/assets/images/fail-result-img.png" alt="result">
                <img class="hide-for-small show-for-medium" src="<?php echo url() ?>/assets/images/fail-result-img-desktop.png" alt="result">
            </div>
            <!-- end of failed test -->
            <div class="modal-footer" id="modal-footer" style="display: none;">
                <!-- hide buttons depending on the action-->
                <button class="btnThree radial showanswer" data-open="test-answers"><?php echo page('courses')->showAnswer_button_text()->text() ?></button>
                <a class="btnOne radial back-to-course" href="<?php echo url::current() ?>"><?php echo page('courses')->backtoCourse_button_text()->text() ?></a>

                <div style="display: <?php echo ($score >= 8) ? 'block' : 'none'; ?>;" class="testDownload show-for-large hide-for-small">
                    <button type="submit" class="btnOne radial submitCertDesktop" name="submit"><?php echo page('courses')->downloadCert_button_text()->text() ?></button>
                </div>
                <div style="display: <?php echo ($score >= 8) ? 'block' : 'none'; ?>;" class="testDownload show-for-small hide-for-large dlcertplaceholder">
                    <button type="submit" class="btnOne mobilefixme radial submitCertDesktop" name="submit"><?php echo page('courses')->downloadCert_button_text()->text() ?></button>
                </div>

                <!-- hide buttons depending on the action -->
            </div>
            <div class="modal-footer" id="modal-footer-failed" style="display: none;">
                <button class="btnThree radial showanswer" data-open="test-answers"><?php echo page('courses')->showAnswer_button_text()->text() ?></button>

                <a class="btnOne radial back-to-course" href="<?php echo url::current() ?>"><?php echo page('courses')->backtoCourse_button_text()->text() ?></a>
                <!-- hide buttons depending on the action -->
            </div>
        </div>
        <!-- result section -->
        <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
            <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
        </button>

        <!-- show answers -->

        <div class="reveal" id="test-answers" data-animation-out="fade-out" data-animation-in="fade-in" data-reveal>
            <div class="modal-header">
                <h3><?php echo page('courses')->test_answers_title()->text() ?></h3>
            </div>
            <div class="test-contents" id="userAnswers" style="padding-top: 20px;">

            </div>
            <div class="modal-footer">
                <a class="btnThree radial taketest" href="<?php echo $page->url(); ?>"><?php echo page('courses')->tryTest_button_text()->text() ?></a>
                <a class="btnOne radial back-to-course" href="<?php echo url::current() ?>"><?php echo page('courses')->backtoCourse_button_text()->text() ?></a>
            </div>
            <!-- result section -->
            <button class="close-button" data-close aria-label="Close modal" type="button" autofocus>
                <img src="<?php echo url() ?>/assets/images/modal-close.png" alt="close" >
            </button>
        </div>
        <!-- end of show answers -->