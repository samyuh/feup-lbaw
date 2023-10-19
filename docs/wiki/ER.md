# ER: Requirements Specification Component

BrainShare's mission is to create a community of FEUP students that allows them to easily obtain an answer to their questions regarding their curricular subject.

## A1: BrainShare

This project consists of a web application that allows FEUP students to ask, answer and search for questions according to the course, curricular units, and specific topics.
 
Nowadays, students use many platforms to obtain and share information about course subjects. By centralizing this knowledge, our project intends to create a community that allows students to ask questions regarding a subject, search for common questions or even helping others by answering their questions. 

Asking and answering questions are the core features of our application. To give easy access to those, questions are organized by course and tags referring to curricular subjects or other relevant topics. To navigate through this application, users have access to an advanced search feature where the title, body, and tag words are taken into account to that search. Furthermore, questions can be associated with tags to add specificity. Each answer can be evaluated by the community as useful or not. The author of the question will also be able to mark an answer as valid, highlighting the answer that solved the enunciated problem. So as to complement the reliability of the system, each user has an associated score, which is calculated by the number of votes for each answer given. Each answer will have an associated comment section, allowing the community to discuss details about that specific answer.  

This application promotes seven kinds of user profiles: Unregistered User, Registered User, Question Owner, Response Owner, Moderator, Administrator, and the Google Identity Platform. Unregistered Users can search and view answers and questions. To ask, answer questions, and vote, it is necessary to be a Registered User. The Question Owner can edit the details of his question while the Response Owner can change or delete his answer or comment. The Moderator can change courses, tags, and delete users' questions, answers, comments, and manage Registered Users. The Administrator can do everything that a Moderator can do and also promote Registered Users to Moderators and demote them.  
  
---


## A2: Actors and User stories


### 1. Actors
![](https://i.imgur.com/JJV50UP.png)


__Figure 1__: Actors

| Identifier | Description | Examples |
|-|-|-|
| User | Abstract user that can view public information such as questions and answers. | n/a |
| Unregistered User | Unauthenticated User that can register himself (sign-up) or sign-in in the system. | User that has just opened the website.                       |
| Registered User | Authenticated User that can insert questions and answers. Registered Users can also upvote and downvote answers. | Registered  User answering a question.                     |
| Question Owner  | Registered User that has created a question, which can be removed from the database or updated. | Registered User asking a question.                           |
| Response Owner | Registered  User who has created an answer or comment, having higher permission for editing those. | Registered User that answers a question or writes a comment. |
| Moderator | Registered  User that can manage Registered Users, change courses and tags and delete the users' questions, answers and comments. | Registered User that manages reports of questions |
| Administrator | Registered  User that can perform all the functions of a Moderator and also promote or demote Registered Users to Moderators and Administrators. | Registered User that promotes a Registered User to a Moderator|
| Google Identity Platform | External Google API that can be used to register or authenticate into the system. | Website authentication with Google |  

__Table 1__: Actor's description

### 2. User Stories

#### 2.1. User

| Identifier| Name | Priority | Description |
|-|-|-|-|
US01 | View Home Page | high | As a User, I want to access the home page, so that I can be informed about the aim of the website, visualize the featured questions. | 
US02 | View questions & answers list | high | As a User, I want to be able to select a question, so that I can access the corresponding thread of answers and visualize the text of the question. |
US03 | Filtered Search | high  | As a User, I want to be able to filter the questions by recent questions, most voted questions, courses, and tags, so that I can access the questions I am looking for. |
US04 | Advanced Search | high  | As a User, I want to use an intelligent search system considering the title and body of the questions and also the body of the answers, so that I can find a question based on text input. |
US05 | View User Profile | high  | As a User, I want to view a Registered User profile, so that I can check his history and score. |
US06 | View valid answer marker | high | As a User, I want to visualize the answer marked as valid by the owner of the question, so that I can check if the considered correct answer has already been given. |  
US07 | View the score for an answer | medium  | As a User, I want to view the score for an answer, so that I can check if the answer is trustworthy. |
US08 | Password Recovery | medium | As a User, I want to recover my password, so that I can regain access to my account. |
US09 | View About Page | low  | As a User, I want to view the About Page, so that I can be able to get more information about the context of the website and the developing team. |

__Table 2__: User's user stories

#### 2.2. Unregistered User 

| Identifier | Name | Priority | Description |
|-|-|-|-|
| US10  | Sign-in  | high  | As an Unregistered User, I want to authenticate into the system, so that I can access the functionalities that are exclusive to authenticated users. |
| US11  | Sign-up  | high  | As an Unregistered User, I want to register myself into the system, so that I can authenticate myself into the system.  |
| US12  | Sign-up using external API  | low  | As an Unregistered User, I want to register a new account linked to my Google account, so that I can access privileged information. |
| US13  | Sign-in using external API  | low  | As an Unregistered User, I want to sign in through my Google account, so that I can authenticate myself into the system. |

__Table 3__: Unregistered's User stories

#### 2.3. Registered User
| Identifier | Name | Priority | Description |
|-|-|-|-|
US14 | Add Question | high |As a Registered User, I want to add a question with tags in a specific course by editing the text in a rich text editor, so that it can be published in the system and answered by other Registered Users. |
US15 | Add answer | high | As a Registered User, I want to submit an answer to a question, so that I can help the question owner and the community. |
US16 | Comment | high | As a Registered User, I want to register a commentary in subthreads, so that I can manifest my opinion regarding an answer. |  
US17 | Manage Basic Profile | high | As a Registered User, I want to manage my profile, so that I can keep my description and profile photo up to date, visualize a list of previous questions and answers made and also edit my current course. | 
US18 | Logout | high | As a Registered User, I want to be able to logout, so that I can change the user or become an Unregistered User. |
US19 | Upvote/downvote question| medium | As a Registered User, I want to upvote/downvote a question, so that I can help the community validate a question as useful.| 
US20 | Upvote/downvote answer | medium | As a Registered User, I want to upvote/downvote an answer, so that I can help the community validate an answer to the question.| 
US21 | Delete account | medium | As a Registered User, I want to be able to delete my account, so that I can remove my profile from the platform. |  
US22 | Manage Detailed Profile | low | As a Registered User, I want to edit my profile on a detailed level: edit birthday date, edit my current email, name, and tags of interest. 
US23 | Report content | low | As a Registered User, I want to be able to report questions, answers, or comments that I find inappropriate so that the platform can take adequate measures about that content. |  
US24 | Notifications | low | As a Registered User, I want to be notified if someone answers or comments on my question and if my answer to a question is marked as valid so that I am informed about the most recent events regarding my questions and answers. |


__Table 4__: Registered's User stories

#### 2.4. Question Owner 

| Identifier| Name | Priority | Description |
|-|-|-|-|
US25 | Mark answer as valid | high |As question owner, I want to mark an answer to my question as valid, so that I can indicate the I have obtained the answer I was looking for. |
US26 |	Edit/Delete Question | high| As question owner, I want to be able to change the information of a question I made, so that I can keep it up to date, or even delete it. |

__Table 5__: Question Owner's User stories

#### 2.5 Response Owner
| Identifier| Name | Priority | Description |
|-|-|-|-|
US27 | Edit/Delete Answer | medium | As a Response Owner, I want to be able to update an answer provided or delete it, so as to remove the answer from the database or avoid inappropriate content. | 
US28  | Edit/Delete Comment | medium | As a Response Owner, I want to be able to edit a comment, so that I can replace the content of the comment, or even remove it from the website. |

__Table 6__: Response Owner's User stories


#### 2.6 Moderator

Identifier | Name | Priority | Description |
|-|-|-|-|
US29 | Manage Registered Users	| high | As a Moderator, I want to be able to ban, unban users and also delete profiles.  | 
US30 | Change question courses | medium | As a Moderator, I want to change a question course, so that the question can have the appropriate course. |
US31 | Remove questions, answers, and comments | medium | As a Moderator, I want to be able to remove a question, answer or comment, so that I can remove inappropriate user input on the website. |
US32 | Manage courses and tags | medium | As a Moderator, I want to be able to add/remove courses and tags so that users can have a better experience. |
US33 | Manage reports | low | As a Moderator, I want to be able to manage the reports received, so that I can apply the best action |

__Table 7__: Moderator's User stories 


#### 2.7 Administrator

Identifier | Name | Priority | Description |
|-|-|-|-|
US34 | Manage Moderators | medium | As an Administrator, I want to be able to promote and demote Registered Users from the moderator office. |  
US35 | Manage Administrators | medium | As an Administrator, I want to be able to promote Registered Users and Moderators to Administrators, so as to increase the number of Administrators, in order to improve the platform organization and capacity to administrate the website. | 


__Table 8__: Administrator's User stories 

#### 2.8. Google Identity Platform

| Identifier | Name    | Priority | Description |
| ---------- | ------- | -------- | ----------- |
| US36       | Sign-in | low      | As a Google Identity Platform, I want to receive the authentication data from a Registered User, so that I can retrieve the login data and permissions to the user accessing the website. |
| US37       | Sign-up | low      | As a Google Identity Platform, I want to receive the authentication data from an Unregistered User creating an account, so that I can associate the user Google account to the website.   |

__Table 9__: Google Identity Platform's user stories


### 3. Supplementary Requirements

#### 3.1. Business rules

A business rule defines or constrains one aspect of the business, with the intention of asserting business structure or influencing business behavior.

| Identifier | Name  | Description |
|-|-|-|
| BR01  | Cannot vote own answer  | The user that answered a question cannot vote for it. |
| BR02  | Deleting Profile  | When a profile is deleted, his questions and answers are not deleted from the database, but the user is registered as "anonymous". |
| BR03  | Deleting Question  | When a question is deleted, the question, answers, and comments are removed from the database, thereafter it's not possible to access it anymore.  |
| BR04  | Deleting Answer | When an answer is deleted, the answer, as well as the comments, are removed from the database. |  
| BR05 | Deleting Comment | When a comment is deleted, its content is removed from the database. | 
| BR06  | Delete Content | The content can only be deleted by its creator or by the Administrators. |    
| BR07 | Banned User | A Banned user has the same permissions as an Unregistered User, and can only contact the Moderators/Administrators in order to have its ban removed |  
| BR08 | Deleting tags | When deleting a specific tag as Moderator/Administrator, the tag is deleted from all the questions that contained it and is also removed from the system database. | 
| BR09 | Deleting courses | When deleting a course as Moderator/Administrator, the questions that were associated with that course lose their association to the deleted course, which is also removed from the database. |  

__Table 10__: Business rules

#### 3.2. Technical requirements

| Identifier | Name | Description |
|-|-|-|
| TR01  | Availability  | The system must be available 99 percent of the time in each 24-hour period  |
| TR02  | Accessibility  | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the Web browser they use  |
| TR03  | Usability  | The system should be simple and easy to use  | 
| TR04  | Performance  | The system should have response times shorter than 2s to ensure the user's attention  |
| TR05  | Web application  | The system should be implemented as a Web application with dynamic pages (HTML5, JavaScript, CSS3, and PHP)  |
| TR06  | Portability  | The server-side system should work across multiple platforms (Linux, Mac OS, etc.)  |
| TR07  | Database  | The PostgreSQL with a version higher than 9.4 database management system will be used  |
| TR08  | Security  | The system shall protect information from unauthorized access through the use of an authentication and verification system  |
| TR09  | Robustness  | The system must be prepared to handle and continue operating when runtime errors occur  |
| TR10  | Scalability  | The system must be prepared to deal with the growth in the number of users and their actions  |operations
| TR11  | Ethics  | The system must respect the ethical principles in software development (for example, the password must be stored encrypted to ensure that only the owner knows it)  |  

__Table 11__: Technical requirements

Although we have mentioned several technical requirements, it is important to highlight the most relevant ones: Availability, Performance, and Security.  
**Availability** is essential to our project because the student should always have the website available for usage since the main goal of our project is to have a website where users can always share their knowledge. Supposing, for example, that a student is studying and the website is not available, the user loses the possibility to learn with the platform during his available time. A student's availability is short and to maximize what a student can learn during a specific period of time the website must be available while the student is studying.  
To use the system properly, considering the problems explained above, the user should not have the flow usage interrupted for long periods, since it prevents students from having quick access to the forum, hence the importance of the system **Performance**, once it can heavily impact the user experience and program efficiency.  
The lack of security can impact the loss of personal data from the students, leading to major privacy issues, which makes us believe that **Security** is one of the primary technical requirements that should be addressed. The website management cannot be ensured without security, since a User may have access to administrator/moderator permissions, being able to damage the website stability by deleting data, banning users, and changing their permissions.  


#### 3.3. Restrictions

| Identifier | Name | Description | 
|-|-|-| 
|C01| Deadline | The system should be delivered in the week of May 31st | 
|C02| Effort | The Google API should be implemented, but if the implementation cost is too high in terms of time and work we will not implement this feature |
|C03| Availability | Through the project, there are weeks when we are not going to work on the project that corresponds to the holidays marked in the school calendar |

__Table 12__: Restrictions

---


## A3: User Interface Prototype

The goal of this artifact is to build a prototype for our web application with HTML5, JavaScript and CSS using the Bootstrap framework.  

### 1. Interface and common features

![search-balls](uploads/9e93f900af08318bc825046f01168d9a/search-balls.png)
__Figure 2__: Interface's guidelines.

1. **Navigation Bar**: The navigation bar is present on all pages and enables the Users to navigate through the main pages of the website, providing access to the features that are available to the current type of User (Registered, Unregistered, Moderator, and Administrator). As one of the most important features of a Q&A website is to search questions, the Search Bar is presented to all the Users in the Navigation Bar. Unregistered Users can view the Login and Register buttons. Registered Users can see the link to the Add Question Page, a link to their Profile, and a Notifications button. Moderators and Administrators will be able to see the Management link. 
2. **Logo**
3. **Content**
4. **Footer**: The footer works as a site map, including all the pages available to the current type of User. It contains a link to the About Page, which is not available in the main Navigation Bar.

In this figure some characteristics common to all the pages are highlighted:

- Our website provides a fully responsive layout from wide desktop to tablets and smartphones.
- Regarding the colors, we've decided to use blue as the default color for the website and gray for secondary information.   
- The "Search" and "Add Question" options on the header facilitate the navigation through the many questions available on the website making it faster to find the pretended answer to something.
- Different sections have a clear title to make it easier to highlight the current section. 
- The links in the header and footer provide easy access to all the website's main pages.

__Figure 3__: Interface

### 2. Sitemap

![sitemap](uploads/3c5031236c83d80bb3738029d33a6724/sitemap.png)
__Figure 4__: Sitemap

### 3. Wireflows

Four main Wireflows were developed, each representing a set of key interactions related to a specific system use case. 
The Register Wireflow highlights the interactions and screens related to register and login actions. It shows the behavior when an Unregistered User creates an account, becoming a Registered User or when a returning Registered User logs in.
The Questions Wireflow shows interactions related to questions, such as adding, viewing, answering, or searching for a question. It also highlights the Edit and Delete options available to Question Owners in their questions.
The Management Wireflow displays the interactions available to Administrators and Moderators, including the management of reports, tags, courses, and users.
At last, the Profile Wireflow shows how a Registered User can access his profile and also how he can edit it.

![Wireframe](uploads/35536827560333ce764623dfd97ebda1/Wireframe.png)
__Figure 5__: Register Wireflow (Desktop)

![Wireframe_1_](uploads/dee1f17cc3d9eff782631226243841ce/Wireframe_1_.png)
__Figure 6__: Register Wireflow (Mobile)

![Wireframe_8_](uploads/fec08eb308f8f999ae8a9503af4ca37a/Wireframe_8_.png)
__Figure 7__: Questions Wireflow (Desktop)

![Wireframe_7_](uploads/b8016fe13140cbd62cf6532d273c3741/Wireframe_7_.png)
__Figure 8__: Questions Wireflow (Mobile)

![Wireframe_2_](uploads/ec886ddd7977d327702235cb2db8ea5d/Wireframe_2_.png)
__Figure 9__: Profile Wireflow (Desktop)

![Wireframe_3_](uploads/48105ddbbb1d967784b0bbd1bf6f8605/Wireframe_3_.png)
__Figure 10__: Profile Wireflow (Mobile)

![Wireframe_5_](uploads/c8ed8cb06ce2a2976df2c7199aa21238/Wireframe_5_.png)
__Figure 11__: Administration Wireflow (Desktop)

![Wireframe_6_](uploads/962768ba4d82262416884c6e53d9b702/Wireframe_6_.png)
__Figure 12__: Admnistration Wireflow (Mobile)


### 4. Interfaces
The following images display the main content of the web pages. On the left side of each image, it's represented the desktop screen and on the right, it's displayed the mobile version for the same page.  

#### Page Inventory
1. [Home](#ui01-home)
2. [Search](#ui02-search)
3. [Question](#ui03-question)
4. [Add Question](#ui04-add-question)
5. [Profile](#ui05-profile)
6. [Login](#ui06-login) 
7. [Register](#ui07-register)
8. [Password Recovery](#ui08-password-recovery)
9. [Password Reset](#ui09-password-reset)
10. [Manage Users](#ui10-manage-users)
11. [Manage Tags](#ui11-manage-tags)
12. [Manage Courses](#ui12-manage-courses)
13. [Manage Reports](#ui12-manage-reports)
14. [Edit Profile](#ui13-edit-profile)
15. [Edit Question](#ui14-edit-question)
16. [About](#ui15-about)
17. [Notifications](#ui16-notifications)
18. [Error Page](#ui17-error-page)


#### UI01: Home
![home](uploads/8dcf05c27090d679154f187f56b8fd6c/home.png)   
__Figure 13__: [Home page](https://lbaw2152-piu.lbaw-prod.fe.up.pt/).

#### UI02: Search 
![search](uploads/1decbfe33af289ac2abbd412ac8d23f2/search.png)
__Figure 14__: [Search](https://lbaw2152-piu.lbaw-prod.fe.up.pt/search.php?).  

#### UI03: Question
![question](uploads/3bd66f96222fda2d372f5a634d475edb/question.png)
__Figure 15__: [Question](https://lbaw2152-piu.lbaw-prod.fe.up.pt/question.php).

#### UI04: Add Question
![add-question](uploads/e094b7c08db05485dd9e109416e1f45a/add-question.png)
__Figure 16__: [Add Question](https://lbaw2152-piu.lbaw-prod.fe.up.pt/add-question.php).

#### UI05: Profile
![profile](uploads/e752e80056b0ecfeafb80cf829b9e849/profile.png)
__Figure 17__: [Profile](https://lbaw2152-piu.lbaw-prod.fe.up.pt/profile.php).

#### UI06: Login 
![login](uploads/530f2a06569399cd0541368054cf9086/login.png)
__Figure 18__: [Login](https://lbaw2152-piu.lbaw-prod.fe.up.pt/login.php?) 

#### UI07: Register 
![register](uploads/e76d09070a5c8c57ab6e8093b193d7bb/register.png)
__Figure 19__: [Register](https://lbaw2152-piu.lbaw-prod.fe.up.pt/register.php?)  

### UI08: Password Recovery
![password-recovery2](uploads/ccf2bcfcfe2114c982735c071440bda2/password-recovery2.png)
__Figura 20__: [Recover Password](http://lbaw2152.lbaw-prod.fe.up.pt/forgot-password) 

### UI09: Password Reset
![password-recovery](uploads/df4c62ea045ec070449faeca345d032c/password-recovery.png)
__Figura 21__: Once the password recovery is requested the user has access to this page.

#### UI10: Manage Users
![manage-users](uploads/d5f7dddc519569595b099352dd7a514c/manage-users.png)
__Figure 22__: [Manage Users](https://lbaw2152-piu.lbaw-prod.fe.up.pt/manage-users.php).

#### UI11: Manage Tags
![tags-web](uploads/7a82a63d4d38da6b812a5dc49f16c9b5/tags-web.png)
__Figure 23__: Manage tags page, accessible by administrators and moderators. 

#### UI12: Manage Courses 
![course-web](uploads/242af174758798eb4fa052fc0c9d1733/course-web.png)
__Figure 25__: Manage courses page, accessible by administrators and moderators. 

#### UI13: Manage Reports
![manage-reports](uploads/cf5a5d97185289394e90e8ce9d0dd92b/manage-reports.png)
__Figure 26__: [Manage Reports](https://lbaw2152-piu.lbaw-prod.fe.up.pt/manage-reports.php).

#### UI14: Edit Profile
![edit-profile](uploads/50461b1d7f0740cae8782f80356d7ddc/edit-profile.png)
__Figure 27__: [Edit Profile](https://lbaw2152-piu.lbaw-prod.fe.up.pt/edit-profile.php).

#### UI15: Edit Question
![edit-question](uploads/7d4f251c1fb9e6f6e162eeca10254f54/edit-question.png)
__Figure 28__: [Edit Question](https://lbaw2152-piu.lbaw-prod.fe.up.pt/edit-question.php).

#### UI16: About
![about-page](uploads/2fbf9a7923a31cc138edd02a01e756fb/about-page.png)
__Figure 29__: [About](https://lbaw2152-piu.lbaw-prod.fe.up.pt/about.php).

#### UI17: Notifications  
![notification](uploads/312f0de1038b29fea7bb1ed77dad6ffa/notification.png)
__Figure 29__: Click on the bell of the header to see the Notifications popup - [Notifications](https://lbaw2152-piu.lbaw-prod.fe.up.pt/edit-profile.php)  

#### UI18: Error Page
![error-tog](uploads/9302182341ef6e089a6fe05250fb43db/error-tog.png)
__Figure 30__: On error this page is shown.
You can also see all the hand-made materials that we made on our 
[InVision Project](https://projects.invisionapp.com/freehand/document/L0U59Br2V).

---

## Revision history

Changes made to the first submission:
1. Corrected orthographic mistakes
2. Fixed user stories description
3. Added US18: Upvote/Downvote 
4. Added US08: Password Recovery and US33: Manage Reports
5. Added UI08 and UI09 for Password Recovery and Password Reset respectively. 
6. Changed User Stories Interfaces
7. Removed Manage categories from UIs and addition of Manage tags and Manage Categories.  

***
GROUP2152, 03/06/2021

- Group member 1: __Diana Freitas__, email: up201806230@fe.up.pt, up201806230@g.uporto.pt (editor)  
- Group member 2: __Diogo Samuel Fernandes__, email: up201806250@fe.up.pt, up201806250@g.uporto.pt  
- Group member 3: __Hugo Guimarães__, email: up201806490@fe.up.pt, up201806490@g.uporto.pt  
- Group member 4: __Juliane Marubayashi__, email: up201800175@fe.up.pt, up201800175@g.uporto.pt