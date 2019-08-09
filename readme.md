## Prerequisite
- PHP 7
- Composer
- A database system

## Installation

### Step 1.
- Begin by cloning this repository to your machine 
```
git clone https://github.com/12march/backend-dev-test.git
```

- Install dependencies
```
cd name && composer install
```

- Create enviromental file and variables
```
cp .env.example .env
```

- Generate app key
```
php artisan key:generate
```

### Step 2
- Next, create a new database and reference its name and username/password in the projects .env file. Below the database name is "expanse"
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expanse
DB_USERNAME=root
DB_PASSWORD=
```

- Go to your mailgun account and get your mailgun domain and secret key. choose an email and senders name
```
MAILGUN_DOMAIN=****
MAILGUN_SECRET=****
MAIL_FROM_ADDRESS=***@***.com
MAIL_FROM_NAME=*****
```

### Step 3
- To start the server, run the command below
```shell
$ php artisan serve
```


---

## API Information

API documentation was created using POSTMAN and can be viewed at [API Documentation](https://documenter.getpostman.com/view/5113472/SVYupwAY) - https://documenter.getpostman.com/view/5113472/SVYupwAY

METHOD | DESCRIPTION | ENDPOINTS
-------|-------------|-----------
POST   | User registration | `/api/auth/register`
POST   | User log in | `/api/auth/login`
POST   | User logout | `/api/auth/logout`
GET    | Get current logged in user | `/api/me`
POST   | Create group | `/api/groups`
GET    | List public group | `api/groups/public`
POST   | List group memebers | `api/groups/{id}/members`
POST   | Send group invite | `api/groups/invite`
GET    | Accept group invite | `api/accept/{token}`

## Implemented Features
- Users can register on the application
- Users can log into the application
- Users can create a group
- Users can fetch all public group created in the system
- Group admin can fetch all members in his group with their details
- Group admin can send group invite and add user to group via unique ID


## Technologies Used
- Laravel - A free, open-source PHP web framework, created by Taylor Otwell
- Mysql - Relational Database System used in project.
- JWT - used to authorize and authenticate API routes.
- Mailgun - Email APIs that enable you to send, receive, and track emails.


## Acknowledgements

* Expanse Technology

## Author

* Emmanuel Okeke