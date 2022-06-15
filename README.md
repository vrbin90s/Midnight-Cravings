# MidnightCravings - Recibe Website (CMS)

This project has been developed for the web technologies coursework at the University of Greenwich using PHP, MYSQL, HTML, CSS & Bootstrap Technologies.

# Scenario

This is a website built for a small chain delicatesness who wants to set up a website to increase their profits and create an online community to share recipes, initially featuring ingredients they sell. 


# System functionalities

- [x] Website displays a random selection of recipes on each visit.
- [x] Allows a user to send an email message to the admin via a web form.
- [x] Allows all users to search recipes by author, category or by text search.
- [x] Display an image for each recipe.
- [x] Displays more detailed info about the recipe (ingredients, preparation method, prep time, cooking time, how many servings etc.)
- [x] Website has administrator’s area (dashboard) with a different URL to the customer site.
- [x] System has access control and role limitations.
- [x] Administrator can add, delete, edit -> recipes, categories, users, authors.
- [x] Editors can create, edit, and delete -> recipes, categories.
- [x] Users can create, edit, and delete recipes -> only their own recipes.
- [x] Administrators can send email to individual authors for updates, offers etc.
- [x] Administrators can send mass email all authors for updates, offers etc.
- [x] Website has a customer sign up/ sign in system
- [x] User  receives a welcome email when they sign up.
- [x] Users can retrieve their lost or forgotten passwords.
- [x] Register user can format their own content.
- [x] System has client side and server side validation -> Layer 2 - JavaScript, Jquary, HTML -> Level 1: PHP Back-End validation
- [x] Added CAPTCHA to the sign-up process
- [x] All sensitive data in database is encrypted.

# Instruction / Install

1. Clone the repository 
2. Place all files in xampp/htdocs or any other software to run the side server.
3. Go to PHPMyAdmin and create a new database.
4. Inmport database to the new created database.
5. Change database connection setting in MidnightCravings\admin\includes\db.inc.php -> 
(Note: Ensure that mdb_ remains before your database name, see img below)


![image](https://user-images.githubusercontent.com/72602872/173801573-9e2f5ea7-b776-487e-8ca5-c3631dbca1fa.png)



6. Done. Website should be running now. 

(Note. the last time I checked there was few minor errors that I havent fixed yet, If anyone wants I can fix them for you, jsut let me know)

# Login

| Account Details | User Name| Password |
| :---         |     :---:      |          ---: |
| Account Administrator  | a_admin@admin.com     | admin   |
| Site Administrator    | s_admin@admin.com      | admin     |
| Content Editor  | editor@editor.com    | admin   |
| User    | user@user.com     | admin     |


# Gallery
  
![image](https://user-images.githubusercontent.com/72602872/173799290-c48711c4-d904-4342-801a-afbf87b689ba.png)

![image](https://user-images.githubusercontent.com/72602872/173799825-51896a84-7e2e-4754-9aab-98d4cd1c2740.png)

![image](https://user-images.githubusercontent.com/72602872/173800087-23d0f554-9428-44ed-9554-a9e5e6d33907.png)

![image](https://user-images.githubusercontent.com/72602872/173800188-5a2ba350-0f64-4dd5-bc51-e8bf3a86ca26.png)


