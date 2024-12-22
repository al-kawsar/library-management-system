# Library Management System 📚

Welcome to the **Library Management System**, a robust and efficient application designed to manage books, users, and loan records seamlessly. Built with **Laravel**, **Vue.js**, and **Inertia.js**, this system leverages modern web technologies for a smooth and intuitive user experience.

---

## 🚀 Features

-   **Authentication**: Login and logout functionality with secure session handling.
-   **Book Management**: Add, view, update, and delete books from the system.
-   **User Management**: Manage user profiles and permissions.
-   **Loan Records**: Track book loans with detailed information.
-   **API Integration**: Fully RESTful APIs for seamless integrations.
-   **Modern UI**: Powered by Vue.js and Tailwind CSS for a responsive and sleek interface.

---

## 🛠️ Tech Stack

-   **Backend**: Laravel 11.x
-   **Frontend**: Vue.js 3 with Inertia.js
-   **Authentication**: Laravel Sanctum
-   **Styling**: Tailwind CSS
-   **Build Tool**: Vite

---

## ⚡ Quick Start

1. Clone the repository:

    ```bash
    git clone https://github.com/your-repo/library-management-system.git
    ```

2. Install dependencies:

    ```bash
    composer install
    npm install
    ```

3. Configure environment:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Run migrations:

    ```bash
    php artisan migrate
    ```

5. Start the development server:

    ```bash
    composer run dev
    ```

6. Access the application at [http://localhost:8000](http://localhost:8000).

---

## 📖 API Documentation

### Authentication

#### Login

```http
POST /api/auth/login
```

-   **Body Parameters**:
    -   `email`: User email address (string)
    -   `password`: User password (string)
-   **Response**:
    -   200: Login successful.
    -   400: Invalid credentials.

#### Logout

```http
GET | POST /api/auth/logout
```

-   **Response**:
    -   200: Logout successful.

### Books Management

#### List Books

```http
GET /api/books
```

-   **Response**:
    -   200: List of books.

#### Add Book

```http
POST /api/books
```

-   **Body Parameters**:
    -   `title`: Title of the book (string)
    -   `author`: Author of the book (string)
-   **Response**:
    -   201: Book created successfully.

#### View Book

```http
GET /api/books/{book}
```

-   **Response**:
    -   200: Book details.

#### Update Book

```http
PUT /api/books/{book}
```

-   **Body Parameters**:
    -   `title`: Updated title (string)
    -   `author`: Updated author (string)
-   **Response**:
    -   200: Book updated successfully.

#### Delete Book

```http
DELETE /api/books/{book}
```

-   **Response**:
    -   200: Book deleted successfully.

### Users Management

#### List Users

```http
GET /api/users
```

-   **Response**:
    -   200: List of users.

#### Add User

```http
POST /api/users
```

-   **Body Parameters**:
    -   `name`: User's name (string)
    -   `email`: User's email (string)
-   **Response**:
    -   201: User created successfully.

#### View User

```http
GET /api/users/{user}
```

-   **Response**:
    -   200: User details.

#### Update User

```http
PUT /api/users/{user}
```

-   **Body Parameters**:
    -   `name`: Updated name (string)
    -   `email`: Updated email (string)
-   **Response**:
    -   200: User updated successfully.

#### Delete User

```http
DELETE /api/users/{user}
```

-   **Response**:
    -   200: User deleted successfully.

### Loans Management

#### List Loans

```http
GET /api/loans
```

-   **Response**:
    -   200: List of loan records.

#### Add Loan

```http
POST /api/loans
```

-   **Body Parameters**:
    -   `book_id`: ID of the book being loaned (integer)
    -   `user_id`: ID of the user borrowing the book (integer)
-   **Response**:
    -   201: Loan created successfully.

#### View Loan

```http
GET /api/loans/{loan}
```

-   **Response**:
    -   200: Loan details.

#### Update Loan

```http
PUT /api/loans/{loan}
```

-   **Body Parameters**:
    -   `status`: Updated status (string)
-   **Response**:
    -   200: Loan updated successfully.

#### Delete Loan

```http
DELETE /api/loans/{loan}
```

-   **Response**:
    -   200: Loan deleted successfully.
