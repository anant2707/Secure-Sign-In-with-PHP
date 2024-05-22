# Secure-Sign-In-with-PHP
In implementing PHP login system, it is important to undertake certain security measures that guard it against certain related threats like the SQL injection, cross-site scripting (XSS), and cross-site request forgery (CSRF). Here is a simple implementation of how login page using the PHP and MYSQL can be developed along with some of the most important security features:
SQL Injection Prevention

1. Use of Prepared Statements:1. Use of Prepared Statements:

Prepared statements make sure that only legitimate SQL statements are run by the DBMS by eliminating the command code, ensuring that others are not executed. This is because it disallows the entry of SQL code from the side of the user, thus reducing the chances of a hit by an attacker.
Cross-Site Scripting (XSS) Prevention

2. Input Sanitization:

Depending on the type of application, it is important to sanitize experimental input data in order to eliminate any code that is capable of causing harm in one way or the other before this data is passed through the interpreter or displayed to the user.
