# MagicPort Case Study - Project Management Tool

## Overview

This is a basic project management tool developed with Laravel. It allows users to create, update, delete, and manage projects and tasks. The tool is designed with simplicity in mind while adhering to best practices and modern design patterns.

## Features

- **Project Management**: Create, read, update, and delete projects.
- **Task Management**: Add, edit, and delete tasks within a project.
- **Search and Filtering**: Search projects by name and filter tasks by status.
- **User Authentication**: Basic user authentication using Laravel's built-in system.
- **Role and Permission Management**: Implemented with `spatie/laravel-permission` package to manage different user roles and permissions.
- **Dockerized Environment**: The application is dockerized using Laravel Sail for easy setup and deployment.

## Setup Instructions

### Prerequisites

- Docker and Docker Compose installed on your machine.
- PHP 8.2 or higher.
- Composer.

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/arazgholami/magicport.git
   cd magicport
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Set up environment variables**:
    - Copy the `.env` file that was sent to you via Email to project root directory.
    - Update the `.env` file with your database credentials and other necessary configurations. An example `.env` file was provided via email.

4. **Run the Docker containers**:
    - Start Laravel Sail:
      ```bash
      ./vendor/bin/sail up -d
      ```

5. **Run migrations and seeders**:
   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```

6. **Access the application**:
    - Open your browser and navigate to `http://localhost`.

7. **Credentials**:
    - Project Manager: **Email**: pm@magicport.com, **Password**: 12345678
    - Task Manager: **Email**: tm@magicport.com, **Password**: 12345678

## Design Patterns

### Repository Pattern
The repository pattern is used to abstract the data access layer. Repositories are implemented for both `Project` and `Task` models, allowing for cleaner and more maintainable code. This pattern adheres to the Single Responsibility Principle (SRP) by separating business logic from data access logic.

### Service Layer Pattern
The service layer encapsulates business logic for projects and tasks, keeping controllers lightweight and focused on handling HTTP requests. This design follows the Open/Closed Principle (OCP), making it easy to extend the application without modifying existing code.

### Validation and Error Handling
While validations are currently handled directly in the controllers, this could have been abstracted into `FormRequest` classes for better separation of concerns. Custom exceptions for error handling were also considered but were not implemented to keep things simple. These could be added later for more robust error management.

## Real-Time Updates

Due to time constraints, real-time updates were not implemented. However, this feature can be easily added using Laravel Echo and Pusher for WebSocket-based real-time communication.

## Testing

PEST is used for testing the application, providing a more expressive and simpler syntax compared to PHPUnit.

### Running Tests

To run the tests, use the following command:
```bash
./vendor/bin/sail artisan test
```

Tests cover the following areas:
- **Unit Tests**: Ensure the correctness of individual models and their methods.
- **Feature Tests**: Validate the overall functionality of the controllers, ensuring that routes, views, and data manipulation work as expected.

### PEST Setup
PEST is installed and configured in the project. Factories are used for generating test data, and the tests cover both unit and feature aspects of the application.

## Future Enhancements

- **Form Requests and Custom Exceptions**: As mentioned, validations could be moved to `FormRequest` classes, and custom exceptions could be added for better error handling. These enhancements would make the application more scalable and maintainable.
- **Real-Time Updates**: Implementing real-time updates using Laravel Echo and Pusher would enhance the user experience by providing instant feedback when tasks are added, updated, or deleted.

## "Tamam-Shud"
For any questions or further assistance, please feel free to contact me.

---

**Note**: This project was developed as part of a case study, with some features being intentionally simplified to meet the project timeline.
This `README.md` file provides a comprehensive overview of the project, setup instructions, and explanations of design decisions, including the reasons for keeping certain aspects simple. Let me know if you need any further adjustments!
