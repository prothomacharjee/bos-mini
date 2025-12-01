# BOS Mini Project Management Module – Laravel

A small Project & Task management module demonstrating BOS-style architecture with APIs, queues, policies, and tests.

## Requirements

- PHP 8.2+
- Laravel 12
- MySQL
- Composer
- (Optional) Redis / database queue for jobs
- Node.js & NPM (if you run the frontend scaffolding)

## Installation

```bash
git clone <repo-url>
cd bos-mini

composer install

cp .env.example .env
php artisan key:generate

# Configure your DB in .env, then:
php artisan migrate
```

# (Optional) If you use a different queue driver, set in .env:
```bash
QUEUE_CONNECTION=database
```

# Then create the jobs table if not already:
```bash
php artisan queue:table
php artisan migrate
```

# Start the app:
```bash
php artisan serve
```

## Authentication
The API is protected by Laravel Sanctum.
To test via Postman:

```bash
php artisan tinker
```

```bash
>>> $user = App\Models\User::first() ?? App\Models\User::factory()->create();
>>> $token = $user->createToken('postman')->plainTextToken;
>>> $token;
```

# Use this token in Postman:
Authorization: Bearer <token>
Accept: application/json
Content-Type: application/json


## API Endpoints
All endpoints are under /api and protected by Sanctum + policy.

# Create Project

POST /api/projects

# Body (JSON):
```bash
{
  "title": "Website Redesign",
  "client": "KoldaTech",
  "start_date": "2024-01-01",
  "end_date": "2024-02-01",
  "status": "active"
}
```
Returns 201 Created with the project JSON.


# Add Task to Project

POST /api/projects/{project}/tasks
# Body (JSON):
```bash
{
  "title": "Design homepage",
  "deadline": "2024-01-10",
  "assigned_user": 1,
  "status": "pending"
}
```
Returns 201 Created with the task JSON and dispatches a queued email job.

# Get Project with Tasks

GET /api/projects/{project}

Returns 200 OK and the project with eager loaded tasks (and assigned user):
```bash
{
  "id": 1,
  "title": "Website Redesign",
  "client": "KoldaTech",
  "tasks": [
    {
      "id": 1,
      "title": "...",
      "deadline": "...",
      "assigned_user": 1,
      "status": "pending"
    }
  ]
}
```


## Authorization

ProjectPolicy is used for create and view actions on Project.

Controllers call $this->authorize('create', Project::class) and $this->authorize('view', $project) so all access is routed through the policy.

Currently, for demo purposes, the policy allows any authenticated user.



## Queues & Email

When a new task is created:

A SendTaskCreatedMail job is dispatched.

The job uses a TaskCreatedMail mailable to send an email to the assigned user.

# To process jobs:

```bash
php artisan queue:work
```

# For local dev you can keep:
```bash
MAIL_MAILER=log
```

and check storage/logs/laravel.log to see the email content.

## Testing
This project uses Pest for feature tests.

# Feature tests cover:
Project creation
Project retrieval with tasks (eager loading)
Task creation

## Run tests:
```bash
php artisan test
```

## Postman Collection

API collection can be generated via:
```bash
php artisan postman:generate
```

Then import the generated JSON file into Postman and:

Set the base URL (http://127.0.0.1:8000 or your local domain)

Set the Authorization: Bearer <token> header


## Notes

# This mini-module is intentionally focused on backend architecture: models, migrations, REST APIs, policies, queues, and tests.

# A simple Blade UI is added on top if needed (optional bonus).

