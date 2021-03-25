
-- PROFILE 

-- (1) User profile with name 
SELECT id, username, email, birthday, image, description, ban, "user".name as name, course.name as course
FROM "user" JOIN course ON "user".course_id = course.id 
WHERE "user".username = $username; 

 -- (2) User profile questions
SELECT id, title, content, date, name 
FROM question 
WHERE question_owner_id = $user_id; 

 -- (3) User profile answers  
SELECT question_id, content, date, valid, title, question_owner_id, image 
FROM answer, question, "user" 
WHERE answer_owner_id = $user_id 
    AND question_id = question.id 
    AND "user".id = question_owner_id; 

-- FOR ALL QUESTIONS

-- (4) Get tags associated with a question
SELECT name  
FROM tag, question_tag
WHERE question_id = $question_id AND tag_id = tag.tag_id; 

-- (5) Get courses associated with a question
SELECT name 
FROM course, question_course 
WHERE question_id = $question_id AND question_course.course_id = course.course_id; 


-- INITIAL PAGE  

-- (6) Featured questions (we the biggest number of votes) 
SELECT question.id, title, content, date, image, SUM(valid_vote) as votes, username, image, COUNT(answer.id) as answers
FROM question, vote, "user", answer
WHERE question.id = vote.question_id 
    AND question_owner_id = "user".id 
GROUP BY question.id 
ORDER BY votes DESC;  


-- SEARCH PAGE 

-- (7) Order by recent questions 
SELECT question.id, title, content, date, username, image,  SUM(valid_vote) as votes, COUNT(answer.id) as answers
FROM question, vote, "user", answer
WHERE question.id = vote.question_id 
    AND question_owner_id = "user".id 
GROUP BY question.id 
ORDER BY date DESC

-- (8) Order by most voted questions : (6)

-- (9) Get questions associated with the course:  
SELECT question.id, title, content, date, username , 
       image, COUNT(answer.id) as answers, SUM(valid_vote) as votes 
FROM question, course, question_course, "user", vote, answer 
WHERE question.id = question_id  
    AND question_owner_id = "user".id    
    AND question.id = vote.question_id  
    AND course_id = course.id 
GROUP BY question.id 
ORDER BY date DESC 


-- (10) Select questions with specific tag
SELECT question.id, title, content, date, username, image, SUM(valid_vote) as votes, COUNT(answer.id) as answers 
FROM question, tag, question_tag, "user", vote, answer 
WHERE question.id = question_id  
    AND question_owner_id = "user".id    
    AND question.id = vote.question_id  
    AND tag_id = tag.id 
GROUP BY question.id
ORDER BY date DESC 


-- (11) NOTIFICATIONS 
SELECT content, "notification".date, viewed, answer_id as content_id, question_id, 'answer' as "type"
FROM "notification", answer
WHERE content_id IS NOT NULL AND viewed = FALSE
UNION
SELECT content, "notification".date, viewed, comment_id as content_id, question_id, 'comment' as "type"
FROM "notification", "comment"
WHERE content_id IS NOT NULL AND viewed = FALSE
ORDER BY "notification".date DESC



-- (12) REPORTS  
CREATE TEMP VIEW IF NOT EXISTS reported_users as 
SELECT "user".id, username as summary, 'user' as "type", COUNT(report.id) as reports 
FROM report, user 
WHERE report_id = "user".id  
GROUP BY "user".id

CREATE TEMP VIEW IF NOT EXISTS reported_questions as 
SELECT question.id, title as summary, 'question' as "type", COUNT(report.id) as reports
FROM report, question 
WHERE question_id = question.id  
GROUP BY question.id 

CREATE TEMP VIEW IF NOT EXISTS reported_answers as 
SELECT answer.id, content as summary, 'answer' as "type", COUNT(report.id) as reports 
FROM report, answer 
WHERE answer_id = answer.id  
GROUP BY answer.id

CREATE TEMP VIEW IF NOT EXISTS reported_comments as 
SELECT "comment".id, content as summary, 'comment' as "type", COUNT(report.id) reports 
FROM report, "comment"  
WHERE comment_id = "comment".id  
GROUP BY "comment".id

SELECT summary, types, reports 
FROM reported_users 
UNION reported_questions 
UNION reported_answers 
UNION reported_comments 


-- (13) MANAGE USERS   
SELECT id, username, signup_date, ban, "role"  
FROM users 

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