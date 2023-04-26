# Queries needed to set up a test survey called "Favorite Foods"
# Make sure there is a user with ID of 1. Otherwise, can change
#   "creator_id" value inserted in first query.

INSERT INTO survey(creator_id, title)
VALUES(1, "Favorite Foods");

INSERT INTO question(survey_id, question_text, response_type)
VALUES
(1, "Of the following foods, which is generally your favorite?", "multiple-choice"),
(1, "You're late for work and need a quick breakfast, with the following options.
 Where do you go?", "multiple-choice"),
(1, "You and a friend are going out to eat, and they give you the following restaurant options.
 Which one are you most likely to choose?", "multiple-choice"),
(1, "If you had to choose one food as your all-time-favorite, what would it be?",
"free-response");


# The following queries to create the question options assume
#   that the previous queries are the first three created,
#   and use IDs accordingly.
INSERT INTO question_option(question_id, option_type, option_text)
VALUES (1, "multiple-choice","burger"),
(1, "multiple-choice", "pizza"),
(1, "multiple-choice", "hot dog"),
(2, "multiple-choice", "McDonald's"),
(2, "multiple-choice", "Sonic"),
(2, "multiple-choice", "Taco Bell"),
(2, "multiple-choice", "None of the above"),
(3, "multiple-choice", "A steakhouse."),
(3, "multiple-choice", "An Italian restaurant"),
(3, "multiple-choice", "A Mexican restaurant"),
(4, "free-response", NULL);