# EAP: Architecture Specification and Prototype


## A7: High-level architecture. Privileges. Web resources specification

This page represents the documentation for an API for the BrainShare website including the CRUD operations over data. The specification adheres to the OpenAPI standard using the YAML, which can be better visualized at the link provided in the third section. 

### 1. Overview  

This section is an overview of the web application modules, where each of them is represented in the table below and briefly described. 


| Module | Description | 
| -------- | -------- |
| __M01: Authentication__   | Web resources associated with the login, logout, register actions, and notification visualization.  |
| __M02: Profile and User Settings__   | Web resources associated with the user profile, such as his personal information and published questions, answers, and comments   |
| __M03: Search__ |  Web resources associated with the search page, filtering questions, answers, and tags according to user input |
| __M04: Questions__ |  Web resources associated with searching, filtering, and adding questions, answers, and comments |
| __M05: Reports__ |  Web resources associated with the report of users, questions, answers, and comments |
| __M06: Management__  | Web resources associated with the management of Users, Questions, Tags, and Courses. | 
| __M07: Static Pages__ |  Web resources associated with static content pages, such as the home, about, and 404 pages |


### 2. Permissions

This section defines the permissions used in the modules, establishes a conditional relation between the access to the page and the users. 

||||
|-|-|-|
| PUB | Public | Unregistered users | 
| USR | User   | Authenticated users | 
| OWN | Owner  | Users that are owners of a information (e.g questions, answers, profile) | 
| ADM | Administrator | Administrators | 
| MOD | Moderators    | Moderators     |


### 3. OpenAPI Specification

This section provides the complete API for this project in OpenAPI (YAML). 
For easier navigation over the content in this section.  

- Link to the specification in GitLab: 
[BrainShare OpenAPI in GitLab](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/blob/master/docs/a7_openapi.yaml)  
- Link to the specification in Swagger:
[BrainShare OpenAPI in swagger](https://app.swaggerhub.com/apis/lbaw2152/Brainshare/1.0.0#/default/R107)


```yaml=
openapi: 3.0.0
servers:
  # Added by API Auto Mocking Plugin
  - description: SwaggerHub API Auto Mocking
    url: https://virtserver.swaggerhub.com/lbaw2152/Brainshare/1.0.0
  - description: Website production server.
    url: lbaw2152-piu.lbaw-prod.fe.up.pt/
info:
  version: 1.0.0
  title: Brainshare API
  description: Web resources specification for Brainshare


# Add the url later. 
externalDocs: 
  description: It's possible to find more information here.  
  url: https://app.swaggerhub.com/apis/lbaw2152/Brainshare/1.0.0#/


tags:
  - name: 'M01: Authentication'
  - name: 'M02: Profile and User Settings'
  - name: 'M03: Search'
  - name: 'M04: Questions' 
  - name: 'M05: Reports'
  - name: 'M06: Management'
  - name: 'M07: Static Pages' 
  
paths:
# MODULE 01: Authentication 
  /auth/login:
    get:
      operationId: R101
      summary: "R101: Login form"
      description: "Provides the login form. Access: PUB"
      tags: 
        - 'M01: Authentication'
      responses:
        "200":
          description: "OK. Show the Login Page [UI06](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui06-login)" 

    post:
      operationId: R102
      summary: "R102: Login Action"
      description: "Processes the login action. Access: PUB"  
      tags:  
        - 'M01: Authentication'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
                password:
                  type: string

              required:
                - email
                - password

            example: 
              email: "up201800123@edu.fe.up.pt"
              password: "lbaw2152"

      responses:
        "302":
          description: "Redirected. Login credentials processed."
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: "Success authetication. Redirected to the search questions page."
                  value: "/search"
                302Error:
                  description: "Failed authetication. Redirected to the login page form."
                  value: "/auth/login"
                
  /auth/logout:
    post:
      operationId: R103
      summary: "R103: Logout Action"
      description: "Logout the current authenticated user. Access: USR, MOD, ADM"
      tags:  
        - 'M01: Authentication'
      
      responses:
        "302":
          description: "Redirect to the home page after logout. "
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: "Successful logout. Redirected to the home page."
                  value: "/"
              
  /auth/register:
    get:
      operationId: R104
      summary: "R104: Register form"
      description: "Provides the user register form. Access: PUB"
      tags:  
        - 'M01: Authentication'
      responses:
        "200":
          description: "OK. Show the Register Page [UI07](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui07-register)"

    post:
      operationId: R105
      summary: "R105: Register Action"
      description: "Processes the register form. Access: PUB" 
      tags:  
        - 'M01: Authentication'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                username:
                  type: string
                email:
                  type: string
                password:
                  type: string
                image:
                  type: string
                  format: binary

              required:
                - username
                - email
                - password
                
            example: 
              username: "Maria123"
              email: "maria123@gmail.com" 
              password: "123456" 
            
            
      responses:
        "302":
          description: "Redirect after user register form has been processed."

          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: "Successful authentication. Redirect to the search questions page."
                  value: "/search"
                302Error:
                  description: "Failed authentication. Redirect to the register page."
                  value: "/auth/register"
  
  /auth/forgot-password: 
    get: 
      operationId: R106
      summary: "R106: Recovery password page" 
      description: "Shows the recovery password page. Access: PUB."
      tags:  
        - 'M01: Authentication'
      responses: 
        "200": 
          description: "Ok. Show the recovery password page [UI08](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui08-password-recovery)" 
  
    post: 
      operationId: R107
      summary: "R107: Send email to recover password." 
      description: "Send email to recover password. Access: PUB." 
      tags: 
        - 'M01: Authentication' 
      
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
        
              required: 
                - email 
                
            example: 
              email: "maria123@gmail.com"
                     
      responses: 
        "200": 
          description: "Ok. Email has been sent. Returns true in case of success, false otherwise."
          
  /auth/reset-password/{token}: 
    get:
      operationId: R108
      summary: "R108: Reset password page." 
      description: "Shows the reset password page. Access: PUB" 
      tags: 
        - 'M01: Authentication' 
        
      parameters: 
        - in: path 
          name: token 
          schema: 
            type: string 
          required: true 
                
      responses: 
        "200": 
          description: "Ok. Show the reset password page [UI09](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui09-password-reset)"
    
  /auth/reset-password: 
    post: 
      operationId: R109
      summary: "R109: Change password."
      description: "Resets the pasword of a user. Access: PUB" 
      tags: 
        - "M01: Authentication" 

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                token:
                  type: string
                email: 
                  type: string
                password: 
                  type: string 
                  
              required: 
                - token 
                - email 
                - password 
                
            example: 
              email: "maria123@gmail.com"
              password: "123456"
                  
                  
      responses: 
        "200": 
          description: "Ok. The password has been reset. Returns true in case of success, false otherwise. "
    
  
# MODULE 02: Profile and User Settings
  /user/{id}/profile:
    get:
      operationId: R201
      summary: "R201: View and load the user profile."
      description: "Show the user profile and the questions/answers created by him. Access: USR"
      tags:  
        - 'M02: Profile and User Settings'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        "200":
          description: "OK. Show the user profile page [UI05](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui05-profile)."
    
    post:
      operationId: R202
      summary: "R202: Deletes the user."
      description: "Deletes the user account. Access: OWN."
      tags:  
        - 'M02: Profile and User Settings'
      
      parameters: 
        - in: path 
          name: "id" 
          schema: 
            type: integer 
          required: true 
      
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                password:
                  type: string
                password_confirmation:
                  type: string

              required:
                - password
                - password_confirmation

            example: 
              password: "123456"
              password_confirmation: "123456"
              
      responses:
        "302":
          description: "Redirects after the user has been deleted."

          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: "Success. Redirects to the home page."
                  value: "/"
                302Error:
                  description: "Failed deletion. Redirects to the user profile."
                  value: "/user/{id}/profile"

  /user/{id}/profile/edit: 
    get:
      operationId: R203
      summary: "R203: Edit profile."
      description: "Provides the form to edit the profile. Access: OWN."
      tags:  
        - 'M02: Profile and User Settings'
      
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
      
      responses:
        "200":
          description: "OK. Show the Edit Profile page [UI14](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui14-edit-profile)."

    put:
      operationId: R204
      summary: "R204: Update a user profile."
      description: "Processes the edition of a user profile. Access: OWN."
      tags:  
      - 'M02: Profile and User Settings'
      
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
          
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                email:
                  type: string
                birthday:
                  type: string
                about:
                  type: string
                course:
                  type: array
                  items:
                    type: string
                tags:
                  type: array
                  items:
                    type: string

            example: 
              name: "Joaquina"
              email: "up201800123@edu.fe.up.pt"
              birthday: "19/01/2000"
              about: "Hello, it's Joaquina and I like to program!"
              course: ["MIEIC", "MIEEC"]
              tags: ["c++", "php"]
      
      responses:
        "302":
          description: "Redirect after user edit profile form has been processed."

          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: "Success. Redirects to the user profile."
                  value: "/user/{id}/questions"
                302Error:
                  description: "Failed authentication. Redirects to the same page."
                  value: "/user/{id}/profile/edit"
          
  /api/user/{id}/questions:
    get:
      operationId: R205
      summary: "R205: View and load user questions"
      description: "Show the user's questions in his profile. Access: PUB"
      tags:  
        - 'M02: Profile and User Settings'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
        - in: query 
          name: "page"
          description: "Number of the question page"
          schema: 
            type: string 
        - in: query 
          name: "profile-search"
          description: "The input for the search"
          schema: 
            type: string

      responses: 
        "200": 
          description: "Ok. Get the questions from the profile as an array of html elements. Each element contains the source for a question card."
          
  /api/user/{id}/answers:
    get:
      operationId: R206
      summary: "R206: View and load user answers"
      description: "Show the user's answers in his profile. Access: USR"
      tags:  
        - 'M02: Profile and User Settings'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true
        - in: query 
          name: "page"
          description: "Number of the answer page"
          schema: 
            type: string 
        - in: query 
          name: "profile-search"
          description: "The input for the search"
          schema: 
            type: string 

      responses: 
        "200": 
          description: "Ok. Get the answers from the profile as an array of html elements. Each element contains the source for an answer card."

  /api/user/notification:
    get:
      operationId: R207
      summary: "R207: Loads and view the user's notification."
      description: "Shows the Notification. Access: OWN"
      tags:  
        - 'M02: Profile and User Settings'

      responses:
        "200":
          description: "Ok, get the html returned to update the notification items on the page. "
  
  /api/user/{id}/notification: 
    delete: 
      operationId: R208
      summary: "R208: Delete a Notification"
      description: "Delete a Notification. Access: OWN"
      tags:  
      - 'M02: Profile and User Settings'

      parameters:
        - in: path
          name: "id"
          schema:
            type: integer
          required: true

      responses:
        "200":
          description: "OK. Use the html returned to render the notification list without the deleted notification."

    post:
      operationId: R209
      summary: "R209: Mark a notification as read."
      description: "Updates a Notification, marking it as read. Access: OWN"
      tags:  
        - 'M02: Profile and User Settings'

      parameters:
        - in: path
          name: "id"
          schema:
            type: integer
          required: true 

      responses:
        "202":
          description: "Accepted. Adds the notification to the database."   
  

# MODULE 03: Search
  /search: 
    get: 
      operationId: R301
      summary: "R201: Show the search page."
      description: "Show the search page with default questions ordered by most voted. Access: PUB"
      tags:  
      - 'M03: Search'
      
      parameters: 
        - in: query 
          name: "page"
          description: "Number of the question page "
          schema: 
            type: string 
        - in: query 
          name: "search-input"
          description: "The input for the search"
          schema: 
            type: string 
        - in: query 
          name: "filter" 
          description: "Types of filter, that can be: new, votes or relevance"
          schema: 
            type: string 
        - in: query
          name: "courses" 
          description: "Name of the course"
          schema: 
            type: string 
        - in: query 
          name: "tags"
          description: "Name of the tag"
          schema:
            type: string
            
        
      responses: 
        "200": 
          description: "Ok. Shows the Search page [UI02](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui02-search)."

  /api/search: 
    get: 
      operationId: R302
      summary: "R302: Get the result for a question search."
      description: "Shows the search page according to the results on query. Access: PUB"
      tags:  
      - 'M03: Search'
      
      parameters: 
        - in: query 
          name: "page"
          description: "Number of the question page"
          schema: 
            type: string 
        - in: query 
          name: "search-input"
          description: "The input for the search"
          schema: 
            type: string 
        - in: query 
          name: "filter" 
          description: "Types of filter, that can be: new, votes or relevance"
          schema: 
            type: string 
        - in: query
          name: "courses" 
          description: "Name of the course"
          schema: 
            type: string 
        - in: query 
          name: "tags"
          description: "Name of the tag"
          schema:
            type: string
      

      # a resposta eh um bloco de html. application/xml 
      responses: 
        "200": 
          description: "Ok. Get the questions from the search result as an array of html elements. Each element contains the source for a question card."

  /api/search/tag:
    get: 
      operationId: R303
      summary: "R303: Search tag."
      description: "Get all the tags that matchs with the input. Access: PUB"
      tags: 
        - 'M03: Search' 
        
      parameters: 
        - in: query 
          name: "tag-input"
          schema: 
            type: string 
          required: true 
          
      responses: 
        "200": 
          description: "OK. Get the objects the tags that match the current text. Each element contains the source for a question card. "
        
  /api/search/tag/{id}: 
    get: 
      operationId: R304
      summary: "R304: Get tag name."
      description: "Get the name of a tag given the id. Access: PUB"
      tags: 
        - 'M03: Search' 
        
      parameters: 
        - in: path 
          name: "id"
          description: "The tag Id"
          schema: 
            type: string 
          required: true 
          
      responses: 
        "200": 
          description: "OK. Get the objects the tags that match the current text. Each element contains the source for a question card."


# MODULE 04: QUESTION    --- questions

  /question/{id}/view:
    get:
      operationId: R401
      summary: "R401: Show question."
      description: "Shows the question page, which contains the question, answers, respective comments and also text fields to add more answers and comments. Access: PUB"
      tags:  
        - 'M04: Questions'
      
      parameters:
        - in: path
          name: "id"
          schema:
            type: integer
          required: true
          
      responses: 
        "200": 
          description: "Success. Show the question page [UI03](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui03-question)"
  
  /question/{id}/delete: 
    delete:
      operationId: R402
      summary: "R402: Delete a question"
      description: "Deletes a question. Access: OWN, ADM, MOD"
      tags:  
        - 'M04: Questions'

      parameters:
        - in: path
          name: "id"
          schema:
            type: integer
          required: true

      responses:
        "302":
            description: "Redirect after the update is processed."

            headers:
              Location:
                schema:
                  type: string
                examples:
                  302Success:
                    description: "Successful, redirects back to the search page."
                    value: "/search"
                  302Error:
                    description: "Failed delete. Redirects to the same page."
                    value: "/question/{id}" 
 
  /question/add:
    get: 
      operationId: R403
      summary: "R403: Question add form."
      description: "Shows the form to create a new question. Access: USR"
      tags:  
      - 'M04: Questions'
    
      responses: 
        "200": 
          description: "Ok. Show the add question page [UI04](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui04-add-question)"

    post:
      operationId: R404
      summary: "R404: Process add question."
      description: "Submit the form to create a question. Access: USR"
      tags:  
      - 'M04: Questions'
      
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              $ref: '#/components/schemas/question-form'
      
            example:
              title: "Is it hard to program in C?"
              content: "I've been struggling to learn it. I don't know if I'm dumb or if it's really hard."
              courseList: ["MIEIC", "MIEEC"]
              tagList: ["c++", "php"]

      responses:
        "302":
            description: "Redirect after the question creation is processed."

            headers:
              Location:
                schema:
                  type: string
                examples:
                  302Success:
                    description: "Successful, redirects to the question page."
                    value: "/search"
                  302Error:
                    description: "Failed creation. Redirects to the same page."
                    value: "/question/create"
  
  /api/question/{id}/scroll: 
    get: 
      operationId: R405 
      summary: "R405: Request the scroll" 
      description: "Process the scroll operation." 
      tags: 
        - 'M04: Questions' 
      
      parameters: 
        - in: path
          name: "id" 
          schema: 
            type: integer 
          required: true  
        - in: query 
          name: "page" 
          schema :
            type: string 
          required: true 
            
        
      responses: 
        "200": 
          description: "Ok. Returns question card list html. Use this information to render the page."
          
     
  /question/{id}/edit:  
    get: 
      operationId: R406
      summary: "R406: View the edit page of a question" 
      description: "Shows the page to edit a question. Access: OWN, ADM, MOD"
      tags: 
        - "M04: Questions"
      
      parameters: 
        - in: path 
          name: "id" 
          schema:
            type: integer 
          required: true 
          
          
      responses: 
        "200": 
          description: "Success. Show the edit question page [UI15](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui15-edit-question)"
          
    put:
      operationId: R407
      summary: "R407: Processes edit question"
      description: "Submit the form to edit a question. Access: OWN, ADM, MOD"
      tags:  
        - 'M04: Questions'
      
      parameters:
        - in: path
          name: "id"
          schema:
            type: integer
          required: true

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              $ref: '#/components/schemas/question-form'
      
            example:
              title: "Is it hard to program in C?"
              content: "I've been struggling to learn it. I don't know if I'm dumb or if it's really hard."
              courseList: ["MIEIC", "MIEEC"]
              tagList: ["c++", "php"]
              
                
      responses:
        "302":
          description: "Redirect after the update is processed."

          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: "Successful, redirects to the question page."
                  value: "/question/{id}"
                303Error: 
                  description: "Error, fail on update the comment."
  

  /api/question/{id}/vote: 
    post:
      operationId: R408
      summary: "R408: Question vote"
      description: "Processes the vote to a question. Access: USR"
      tags:  
        - 'M04: Questions'
      
      parameters:
        - in: path
          name: "id"
          schema:
            type: integer
          required: true
          
      requestBody: 
        required: true 
        content:
          application/json: 
            schema: 
              properties: 
                vote: 
                  type: integer 
            example: 
              vote: -1
              
      responses:
        "202":
          description: "Accepted. Mark the question as voted."
          

# MODULE 04: QUESTION    --- answers 
  /api/answer/{id}: 
    put:
      operationId: R409
      summary: "R409: Edit an answer."
      description: "Edit an answer. Access: OWN, MOD, ADM"
      tags:  
      - 'M04: Questions' 


      parameters:
        - in: path
          name: "id"
          description: "Answer identification number"
          schema:
            type: integer
          required: true

          
      requestBody:
        required: true
        content:
          application/json:
            schema:
              $ref: "#/components/schemas/text"

            example:
              - content: "I think that C is easy. You're the one that is dumb."

      responses: 
        "202": 
          description: "Accepted. Use the updated information to render the page."
  
    delete:
      operationId: R410
      summary: "R410: Delete an answer"
      description: "Deletes an answer. Access: OWN, ADM, MOD"
      tags:  
      - 'M04: Questions' 
      

      parameters:
        - in: path
          name: "id"
          description: "Answer identification number"
          schema:
            type: integer
          required: true


      responses:
        "202":
          description: "Accepted. Render the page without the deleted answer."
  
  /api/question/{id}/answer:
    post:
      operationId: R411
      summary: "R411: Processes the creation of an answer"
      description: "Adds an answer to a question. Access: USR"
      tags:  
      - 'M04: Questions' 


      parameters:
        - in: path
          name: "id"
          schema:
            type: integer
          required: true


      requestBody:
        required: true
        content:
          application/json:
            schema:
              $ref: "#/components/schemas/text"
              
            example:
              - content: "I think that C is easy. You're the one that is dumb."

      responses: 
        "202": 
          description: "Accepted. Use the inserted information to render the page."
  
  /api/answer/{id}/valid: 
    post: 
      operationId: R412
      summary: "R412: Mark the answer as valid/not valid"
      description: "Owner of the question marks the answer as valid. Access: OWN"
      tags:  
      - 'M04: Questions' 
      
      
      parameters:
        - in: path
          name: "id"
          description: "Answer identification number"
          schema:
            type: integer
          required: true
      
      
      responses:
        "202":
          description: "Accepted. Use the action to render the page with the answer marked as correct."
  
  /api/question/{idQuestion}/answer/{idAnswer}: 
    post: 
      operationId: R413
      summary: "R413: Upvote/ Downvote an answer"
      description: "Owner of the question marks the answer as valid. Access: USR"
      tags:  
      - 'M04: Questions' 
      
      
      parameters:
        - in: path
          name: "idQuestion"
          description: "Question identification number"
          schema:
            type: integer
          required: true
        - in: path
          name: "idAnswer"
          description: "Answer identification number"
          schema:
            type: integer
          required: true
      
      
      responses:
        "202":
          description: "Accepted. Use the action to render the page with the upvote value of the answer changed."
  

# MODULE 04: QUESTION    --- comments 

  /api/comment/{id}:
    put:
      operationId: R414
      summary: "R414: Update a comment."
      description: "Update a comment. Access: OWN, MOD, ADM"
      tags:  
      - 'M04: Questions' 


      parameters:
        - in: path
          name: "id"
          description: "Comment identification number"
          schema:
            type: integer
          required: true


      requestBody:
        required: true
        content:
          application/json:
            schema:
              $ref: "#/components/schemas/text"

            example:
              content: "I think that C is easy. You're the one that is dumb."

      responses: 
        "202": 
          description: "Ok. Use the new information to render the page."
    
    delete:
      operationId: R415
      summary: "R415: Delete a comment"
      description: "Deletes a comment. Access: OWN, ADM, MOD"
      tags:  
      - 'M04: Questions' 
      

      parameters:
        - in: path
          name: "id"
          description: "Comment identification number"
          schema:
            type: integer
          required: true


      responses:
        "202":
          description: "Accepted. Render the page without the deleted comment."

  /api/answer/{id}/comment:
    get: 
      operationId: R416
      summary: "R416: Show comments"
      description: "Show all the comments of an answer. Access: PUB"
      tags:  
      - 'M04: Questions' 
      
      parameters: 
        - in: path
          name: "id"
          description: "Answer identification"
          schema:
            type: integer
          required: true 
        
      responses: 
        "200": 
          description: "OK. Get's the comments objects and use the information to render the page. " 
          
    post:
      operationId: R417
      summary: "R417: Processes the creation of a comment."
      description: "Adds a comment to an answer. Access: USR"
      tags:  
      - 'M04: Questions' 
    
      parameters:
        - in: path
          name: "id"
          description: "Answer identification"
          schema:
            type: integer
          required: true 
          
      requestBody:
        required: true
        content:
          application/json:
            schema:
              $ref: "#/components/schemas/text"

            example:
              content: "I think that C is easy. You're the one that is dumb."
        
      responses: 
        "202": 
          description: "Accepted. Use the information to render the question page. " 
  
    
# MODULE 05: REPORT 
  /api/report/status: 
    get: 
      operationId: R501
      summary: "R501: Checks if element was reported"
      description: "Sends request asking if an element was reported" 
      tags: 
        - "M05: Reports" 
        
      parameters: 
        - in: query
          name: "id"
          description: "Answer identification"
          schema:
            type: integer
          required: true 
        - in: query
          name: "reportType"
          description: "Type of the report." 
          schema:
            type: string 
          required: true 
          
              
      responses:
        "200": 
          description: "Get's the json response if the content has already been reported."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  isReported: 
                    type: boolean 
                    description: "True if the content has already been reported. False otherwise."
              
              example: 
                - isReported: true
  
  /api/report/question/{id}: 
    post: 
      operationId: R502
      summary: "R502: Report a question."
      description: "Process the question report. Access: USR"  
      tags:  
        - 'M05: Reports'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        "200": 
          description: "OK. The question has been reported. Use the confirmation to give the user a feedback."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: boolean
                    description: "True case the operations has succeeded. False otherwise."

              example: 
                - success: true 

  /api/report/answer/{id}:
    post: 
      operationId: R503
      summary: "R503: Reports an answer "
      description: "Proccesses the report of an answer. Access: USR"  
      tags:  
        - 'M05: Reports'
  
      parameters:
        - in: path
          name: "id"
          description: "Answer identification number"
          schema:
            type: integer
          required: true
  
      responses:
        "200": 
          description: "OK. The answer has been reported. Use the confirmation to give the user a feedback."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: boolean
                    description: "True case the operations has succeeded. False otherwise."

              example: 
                - success: true 

  /api/report/comment/{id}: 
    post: 
      operationId: R504
      summary: "R504: Report a comment."
      description: "Proccesses comment report. Access: USR"  
      tags:  
        - 'M05: Reports'

      parameters:
        - in: path
          name: "id"
          description: "Comment identification number"
          schema:
            type: integer
          required: true

      responses:
        "200": 
          description: "OK. The cmoment has been reported. Use the confirmation to give the user a feedback."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: boolean
                    description: "True case the operations has succeeded. False otherwise."

              example: 
                - success: true 

  /api/report/user/{id}: 
    post: 
      operationId: R505
      summary: "R505: Report a user."
      description: "Proccesses the report of a user. Access: USR"  
      tags:  
        - 'M05: Reports'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        "200": 
          description: "OK. The user has been reported. Use the confirmation to give the user a feedback."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: boolean
                    description: "True case the operations has succeeded. False otherwise."

              example: 
                - success: true 
    
  
# MODULE 06: MANAGEMENT
  /admin/courses: 
    get: 
      operationId: "R601"
      summary: "R601: Show the courses"
      description: "Shows the categories page with the course tab selected and result of the text search if defined. Case not defined the results shown will be the default. Access: MOD, ADM"
      tags:  
      - 'M06: Management'

      responses: 
        "200": 
          description: "Ok. Show the manage coures page [UI12](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui12-manage-courses)"
  
  /api/admin/courses: 
    get: 
      operationId: R602
      summary: "R602: Show the courses"
      description: "Shows the categories page with the course tab selected and result of the text search if defined. Case not defined the results shown will be the deafult. Access: MOD, ADM"
      tags:  
      - 'M06: Management'

      parameters:
        - in: query
          name: "search-name"
          description: "Content to be searched for."
          schema:
            type: string
          required: true
        - in: query 
          name: "page"
          description: "Number of the page." 
          schema: 
            type: integer 
          required: false 

      responses: 
        "200": 
          description: "Ok. Get the filtered courses' objects and use the information to render the page."
                  
    delete:
      operationId: R603
      summary: "R603: Delete a course"
      description: "Deletes a course. Access: ADM, MOD"
      tags:
      - 'M06: Management'

      requestBody:
          required: true
          content:
            application/json:
              schema:
                type: object
                properties: 
                  input: 
                    type: string
  
              example:
                - input: "MIEIC"

      responses:
        "200":
          description: "Accepted. Request processed."
          
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: string 
                    description: "Return the success message"

    post:
      operationId: R604
      summary: "R604 : Process add course."
      description: "Create a new course. Access: ADM, MOD"
      tags:
      - 'M06: Management'

      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                name:
                  type: string
              required:
                - name

            example:
              - name: "MIEC"
          
      responses:
        "200":
          description: "OK. Request processed."
          
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: string 
                    description: "Return the success message"
        
  /admin/tags: 
    get: 
      operationId: R605
      summary: "R605: Show the tags"
      description: "Shows the manage tags page. Access: ADM, MOD"
      tags:  
      - 'M06: Management'


      responses: 
        "200": 
          description: "Ok. Show the manage tags page [UI11](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui11-manage-tags)"
  
  /api/admin/tags: 
    get: 
      operationId: R606
      summary: "R606: Search the tags"
      description: "Searches the tags. Access: Access: ADM, MOD"
      tags:  
      - 'M06: Management'

      parameters:
        - in: query
          name: "search-name"
          description: "Content to be searched for"
          schema:
            type: string
          required: true
        - in: query 
          name: "page"
          description: "Number of the page" 
          schema: 
            type: integer 
          required: false
      
      responses: 
        "200": 
          description: "OK. Request processed."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: string 
                    description: "Return the success message"
  
  
    delete:
      operationId: R607
      summary: "R607: Delete a tag"
      description: "Deletes a tag. Access: ADM, MOD"
      tags:
      - 'M06: Management'
    
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: string

            example:
              - name: "Exam"


      responses: 
        "200": 
          description: "OK. Request processed."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: string 
                    description: "Return the success message"


    post:
      operationId: R608
      summary: "R608 : Tag being processed."
      description: "Create new tag. Access: ADM, MOD"
      tags:
      - 'M06: Management'
      
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                name:
                  type: string
              required:
                - name

            example:
              name: "MIEC"

      responses: 
        "200": 
          description: "OK. Request processed."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: string 
                    description: "Return the success message"
 
# MODULE 06: MANAGEMENT   --- Manage reports 
  /admin/reports: 
    get: 
      operationId: R609
      summary: "R608: Show the reports"
      description: "Shows the report page. Access: ADM, MOD"
      tags:  
      - 'M06: Management'


      responses: 
        "200": 
          description: "Ok. Show the report page [UI13](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui12-manage-reports)"
  
  
  /api/admin/reports:
    get: 
      operationId: R610
      summary: "R610: Filter the reports"
      description: "Filter the reports according to the user input int eh search bar. Access: ADM, MOD"
      tags:  
      - 'M06: Management'

      parameters:
        - in: query
          name: "search-username"
          description: "Content to be searched for"
          schema:
            type: string
          required: true
        - in: query 
          name: "report-type"
          description: "Type of the report"
          schema: 
            type: string
          required: true 
        - in: query
          name: "report-state"
          schema: 
            type: string
          required: true 
        - in: query 
          name: "page"
          description: "Number of the page" 
          schema: 
            type: integer 
          required: false 
      
      responses: 
        "200": 
          description: "Ok. Get the filtered reports from the database as an array of html elements."
                    
  
  /api/admin/reports/discard:
    put: 
      operationId: R611
      summary: "R611 : Discard a report."  
      description: "Discard a report, considering it handled. Access: ADM, MOD"
      tags:
        - 'M06: Management'   
      
      requestBody: 
        required: true 
        content:
          application/json: 
            schema: 
              properties: 
                id: 
                  type: integer 
                search-username:
                  type: string
                report-type:
                  type: string
                report-state:
                  type: string
            example: 
              - id: 27
              - search-username: 'carlos'
              - report-type: 'user'
              - report-state: 'pending'

      responses:
        "200": 
          description: "Uses the html response to render the page."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: string 
                    description: "Return the success message"
                  html:
                    type: string
                    description: "Html to be added to the page."
              
              example: 
                - success: "The user role has changed with success."


  /api/admin/reports/undiscard: 
    put: 
      operationId: R612
      summary: "R612: Undiscard a report."  
      description: "Undiscard a report in order to review it. Access: ADM, MOD"
      tags:
        - 'M06: Management'   

      requestBody: 
        required: true 
        content:
          application/json: 
            schema: 
              properties: 
                id: 
                  type: integer 
                search-username:
                  type: string
                report-type:
                  type: string
                report-state:
                  type: string
            example: 
              - id: 27
              - search-username: 'carlos'
              - report-type: 'user'
              - report-state: 'handled'

      responses:
        "200": 
          description: "Uses the html response to render the page."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: string 
                    description: "Return the success message"
                  html:
                    type: string
                    description: "Html to be added to the page."
              
              example: 
                - success: "The user role has changed with success."


  /api/admin/reports/delete:
    put: 
      operationId: R613
      summary: "R613 : Delete a report."  
      description: "Delete a report, setting it as a deleted . Access: ADM, MOD"
      tags:
        - 'M06: Management'   

      requestBody: 
        required: true 
        content:
          application/json: 
            schema: 
              properties: 
                id: 
                  type: integer 
                search-username:
                  type: string
                report-type:
                  type: string
                report-state:
                  type: string
            example: 
              - id: 27
              - search-username: 'carlos'
              - report-type: 'user'
              - report-state: 'pending'

      responses:
        "200": 
          description: "Uses the html response to render the page."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: string 
                    description: "Return the success message"
                  html:
                    type: string
                    description: "Html to be added to the page."
              
              example: 
                - success: "The user role has changed with success."


  /api/admin/reports/revert:   
    put: 
      operationId: R614
      summary: "R614 : Revert the report."  
      description: "Revert the action preformed by the report. Access: ADM, MOD"
      tags:
        - 'M06: Management'   
      
      requestBody: 
        required: true 
        content:
          application/json: 
            schema: 
              properties: 
                id: 
                  type: integer 
                search-username:
                  type: string
                report-type:
                  type: string
                report-state:
                  type: string
            example: 
              - id: 27
              - search-username: 'carlos'
              - report-type: 'user'
              - report-state: 'handled'

      responses:
        "200": 
          description: "Uses the html response to render the page."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: string 
                    description: "Return the success message"
                  html:
                    type: string
                    description: "Html to be added to the page."
              
              example: 
                - success: "The user role has changed with success."
                
  
  # R315 
  /admin/user: 
    put: 
      operationId: R615
      summary: "R615 : Manage user page"  
      description: "Show the manage user page. Access: ADM, MOD"
      tags:
        - 'M06: Management'   


      responses: 
        "202": 
          description: "OK. Show the user management page [UI10](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui10-manage-users)."
  
  # R316
  /api/admin/user: 
    get: 
      operationId: R616
      summary: "R616: User search"
      description: "Get the user search result and render the page according to it. Access: ADM, MOD"
      tags:  
      - 'M06: Management'

      parameters:
        - in: query
          name: "search-username"
          description: "User to be searched for."
          schema:
            type: string
          required: true
        - in: query 
          name: "page"
          description: "Number of the page" 
          schema: 
            type: integer 
          required: false
      
      responses:
        "200": 
          description: "Uses the html response to render the page."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  html:
                    type: string
                    description: "Html to be added to the page."
                    
              

 
  /api/admin/user/{id}: 
    put: 
      operationId: R617
      summary: "R617: Update the status of a user."
      description: "Update the status of a user chaging the role and ban status. Access: ADM."  
      tags: 
        - 'M06: Management'

      parameters: 
        - in: path 
          name: "id" 
          schema: 
            type: integer 
          required: true 
      
      requestBody:
        required: true
        content:
          application/json:
            schema:
              type: object
              properties:
                content:
                  type: boolean 
                role: 
                  type: string 
              
            example:
              type: false 
              role: "ADM" 
      
      responses:
        "200": 
          description: "Uses the html response to render the page."
          content: 
            application/json:
              schema: 
                type: object 
                properties: 
                  success: 
                    type: string 
                    description: "Return the success message"
                  id:
                    type: string 
                    description: "Id of the user changed." 
                  html:
                    type: string
                    description: "Html to be added to the page."
              
              example: 
                - success: "The user role has changed with success."
                - id: "2"
                

# MODULE 07: Static Pages

  /:
    get:
      operationId: R701
      summary: "R701: View home page "
      description: "Shows the home page. Access: PUB"
      tags:
      - 'M07: Static Pages'

      responses:
        "202":
          description: "Ok. Show the home page [UI01](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui01-home)." 

  /about:
    get:
      operationId: R702
      summary: "R702: View the about page "
      description: "Shows the about page. Access: PUB"
      tags:
      - 'M07: Static Pages'

      responses:
        "202":
          description: "Ok. Show the about page [UI16](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui16-about)."   
      
  /notfound:   
    get:
      operationId: R703 
      summary: "R703: View the error page"
      description: "Shows the error page. Access: PUB"
      tags: 
        - "M07: Static Pages"
      
      responses: 
        "202":
          description: "Ok, Show the error page [UI18](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/wikis/ER#ui18-error-page)"
          
          
components: 
  schemas:
    question-form: 
      type: object
      properties:
        title:
          type: string
        content:
          type: string
        courseList:
          type: array
          items:
            type: string
        tagList:
          type: array
          items:
            type: string
        

      required:
        - title
        - content
        - courseList 
        - tagList 

   
    text: 
      type: object
      properties:
        content:
          type: string 

      required:
        - content
   
```

## A8: Vertical prototype

The Vertical Prototype includes the implementation of the user stories that have more value to our Q&A website.

The prototype includes the basic CRUD operations for the Question model, the home and about pages, the control of access permissions, and the presentation of error messages for the implemented pages.

### 1. Implemented Features

#### 1.1. Implemented User Stories

| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
| US01                 | View Home Page | high | As a User, I want to access the home page, so that I can be informed about the aim of the website, visualize the featured questions. |
| US02 | View questions & answers list | high | As a User, I want to be able to select a question, so that I can access the corresponding thread of answers and visualize the text of the question. |
| US03 | Filtered Search | high  | As a User, I want to be able to filter the questions by recent questions, most voted questions, courses, and tags, so that I can access the questions I am looking for. |
| US04 | Advanced Search | high  | As a User, I want to use an intelligent search system considering the title and body of the questions and also the body of the answers, so that I can find a question based on text input. |
| US09  | Sign-in  | high  | As an Unregistered User, I want to authenticate into the system, so that I can access the functionalities that are exclusive to authenticated users. |
| US10  | Sign-up  | high  | As an Unregistered User, I want to register myself into the system, so that I can authenticate myself into the system.  |
| US13 | Add Question | high |As a Registered User, I want to add a question with tags in a specific course by editing the text in a rich text editor, so that it can be published in the system and answered by other Registered Users. |
| US17 | Logout | high | As a Registered User, I want to be able to logout, so that I can change the user or become an Unregistered User. |
| US25 | Edit/Delete Question | high | As question owner, I want to be able to change the information of a question I made, so that I can keep it up to date, or even delete it. |

#### 1.2. Implemented Web Resources

Module M01: Authentication

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R101: Login Form | [/login](http://lbaw2152.lbaw-prod.fe.up.pt/login) |
| R102: Login Action | POST login |
| R103: Logout Action | POST logout |
| R104: Register Form | [/register](http://lbaw2152.lbaw-prod.fe.up.pt/register) |
| R104: Register Action | POST register |

Module M02: Questions

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R201: Search Page | [/search](http://lbaw2152.lbaw-prod.fe.up.pt/search) | 
| R202: Get the result for a question search | /api/search |
| R203: Question Add Form | [/question/add](http://lbaw2152.lbaw-prod.fe.up.pt/question/add) | 
| R204: Process Add Question | POST /question/add | 
| R205: Show Question | [/question/{id}](http://lbaw2152.lbaw-prod.fe.up.pt/question/7) | 
| R221: Search Tag | /api/tag/search |
| R222: Get tag name | /api/tag/{id} |

Module M04: Static Pages
| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R401: View home page  | [/](http://lbaw2152.lbaw-prod.fe.up.pt/) |
| R402: View about page | [/about](http://lbaw2152.lbaw-prod.fe.up.pt/about) | 

### 2. Prototype

The website prototype is available at [http://lbaw2152.lbaw-prod.fe.up.pt/](http://lbaw2152.lbaw-prod.fe.up.pt/)

Credentials necessary to login:

- Regular User:
    - Email: lbaw2152@lbaw.com
    - Password: lbaw2152!


The code is available at [https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/tree/master](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2152/-/tree/master)

---


## Revision history

Changes made to the first submission:
- Added new modules (Search and Report)
- Separated the Authentication and User Profile module into two different modules: 'Authentication' and 'Profile and User Settings'.
- Paths from the same module were uniformed by using the same root for those. 

***
GROUP2152, 04/05/2021
 
* Group member 1: Diana Freitas, email: up201806230@fe.up.pt, up201806230@g.uporto.pt
* Group member 2: Diogo Samuel Fernandes, email: up201806250@fe.up.pt, up201806250@g.uporto.pt
* Group member 3: Hugo Guimarães, email: up201806490@fe.up.pt, up201806490@g.uporto.pt (editor)
* Group member 4: Juliane Marubayashi, email: up201800175@fe.up.pt, up201800175@g.uporto.pt