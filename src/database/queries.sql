-- PROFILE 

-- (1) User profile with name 
SELECT "user".id, username, email, birthday, image, description, ban, "user".name as name, course.name as course
FROM "user" JOIN course ON "user".course_id = course.id 
WHERE "user".username = $username; 

 -- (2) User profile questions
SELECT "question".id, title, content, date 
FROM question, "user"
WHERE question_owner_id = $user_id AND "user".id = question_owner_id
LIMIT $page_limit OFFSET $page_number; 

 -- (3) User profile answers  
SELECT answer.content, answer.date AS answer_date, valid, 
question_id, title, question_owner_id, username AS question_owner_username, image AS question_owner_image, question."date" AS question_date
FROM answer, question, "user"
WHERE answer_owner_id = $user_id
    AND question_id = question.id 
	AND question_owner_id = "user".id
LIMIT $page_limit OFFSET $page_number; 

-- FOR ALL QUESTIONS

-- (4) Get tags associated with a question
SELECT name  
FROM tag, question_tag
WHERE question_id = $question_id AND tag_id = tag.id; 

-- (5) Get courses associated with a question
SELECT name 
FROM course, question_course 
WHERE question_id = $question_id AND question_course.course_id = course.id; 


-- INITIAL PAGE  

-- (6) Featured questions (with the biggest number of votes) 
SELECT question.id, title, "question".content, "question".date, "user".image, SUM(value_vote) as votes, username,
 image, COUNT(answer.id) as answers
FROM question, vote, "user", answer
WHERE question.id = vote.question_id 
    AND question_owner_id = "user".id 
GROUP BY question.id, "user".image, username
ORDER BY votes DESC;  


-- SEARCH PAGE 

-- (7) Order by recent questions 
SELECT question.id, title, "question".content, "question".date, username, image,  SUM(value_vote) as votes, 
COUNT(answer.id) as answers
FROM question, vote, "user", answer
WHERE question.id = vote.question_id 
    AND question_owner_id = "user".id 
GROUP BY question.id, username, image
ORDER BY date DESC

-- (8) Order by most voted questions : (6)

-- (9) Get questions associated with the course:  (*)
SELECT question.id, title, "question".content, "question".date, username , 
       image, COUNT(answer.id) as answers, SUM(value_vote) as votes 
FROM question, course, question_course, "user", vote, answer 
WHERE question.id = "question_course".question_id  
    AND question_owner_id = "user".id    
    AND question.id = vote.question_id  
    AND "question_course".course_id = course.id  
    AND course.id = $course_id 
GROUP BY question.id, username, image
ORDER BY date DESC;


-- (10) Select questions with specific tag (*)
SELECT question.id, title, "question".content, "question".date, username, image, SUM(value_vote) as votes, 
COUNT(answer.id) as answers 
FROM question, tag, question_tag, "user", vote, answer 
WHERE question.id = "question_tag".question_id  
    AND question_owner_id = "user".id    
    AND question.id = vote.question_id  
    AND tag_id = tag.id 
GROUP BY question.id, username, image
ORDER BY date DESC;

-- (11) NOTIFICATIONS:(*)
SELECT "notification"."date", "noticiation".viewed, "notification".answer_id, "notification".comment_id 
FROM "notification", answer, comment
WHERE viewed = FALSE
ORDER BY date DESC;

SELECT "notification"."date", "noticiation".viewed, "notification".answer_id, "notification".comment_id 
FROM "notification", answer, comment
WHERE viewed = FALSE and "notification".user_id = $user_id
ORDER BY date DESC;


-- (12) REPORTS  
SELECT report.id as report_id, reported_id, question.id as question_id, answer.id as answer_id, comment.id as comment_id
FROM report LEFT JOIN "user" ON report.reported_id = "user".id 
            LEFT JOIN question ON report.question_id = question.id
            LEFT JOIN answer ON report.answer_id = answer.id
            LEFT JOIN "comment" ON report.comment_id = "comment".id
ORDER BY report.id

-- (13) MANAGE USERS   
SELECT id, username, signup_date, ban, TYPE 
FROM "user"; 

-- (13) MANAGE TAGS 
SELECT id, name, creation_date, COUNT(question_id) as uses_number  
FROM question_tag, tag 
WHERE id = tag_id   
GROUP BY id  

-- (14) MANAGE COURSES  
SELECT id, name, creation_date, COUNT(course_id) as uses_number
FROM course, question_course 
WHERE id = course_id 
GROUP BY id 
