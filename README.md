# LdcZfcUserApi

## What?

A REST API for ZfcUser, suitable for standalone use or in an [Apigility](http://apigility.org/) application.

 - `POST /user` - Account registration
 - `GET /user/:user_id` - Retrieve user profile
 - `PUT /user/:id/email` - Update account email address
 - `PUT /user/:id/password` - Change account password

__WARNING__: This code is not yet tested, documented or been used in a live environment.  Approach with extreme caution.

## How?

1. Install module using Composer

   ```
   composer install adamlundrigan/ldc-zfc-user-api:<version>
   ```

2. Enable required modules in your `application.config.php` file:

   - ZfcBase
   - ZfcUser
   - LdcZfcUserApi

3. Configure ZfcUser

## TODO

 - [x] Apigility RPC resource for account registration
 - [x] Apigility RPC resource for change email / change password 
 - [ ] RBAC / ACL integration points 
 - [ ] Some tests might be a good idea
 - [ ] Some documentation and an example might also be good ideas
