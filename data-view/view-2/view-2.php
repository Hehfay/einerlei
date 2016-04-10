<?php
// For each user id:
//select DemographicQuestion.question, DemographicAnswer.answer, DemographicAnswer.license_id from DemographicQuestion join DemographicAnswer on DemographicQuestion.id = DemographicAnswer.demographic_question_id and license_id = $some_variable;
//select LikertQuestion.question, LikertAnswer.answer, LikertAnswer.license_id from LikertQuestion join LikertAnswer on LikertQuestion.id = LikertAnswer.question_id and license_id = $some_variable;
?>
