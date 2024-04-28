# __Library Management System using Laravel Framework.__

## Project Description:
Library Management System API using Laravel PHP. The system allow librarians
to manage books, patrons, and borrowing records.

## Entities:
```
● Create entities for:
● Book: Includes attributes like ID, title, author, publication year, ISBN, etc.
● Patron: Contains details like ID, name, contact information, etc.
● Borrowing Record: Tracks the association between books and patrons,
including borrowing and return dates.
```

## API Endpoints:
```
● Implement RESTful endpoints to handle the following operations:
● Book management endpoints:
● GET /api/books: Retrieve a list of all books.
● GET /api/books/{id}: Retrieve details of a specific book by ID.
● POST /api/books: Add a new book to the library.
● PUT /api/books/{id}: Update an existing book's information.
● DELETE /api/books/{id}: Remove a book from the library.
● Patron management endpoints:
● GET /api/patrons: Retrieve a list of all patrons.
● GET /api/patrons/{id}: Retrieve details of a specific patron by ID.
● POST /api/patrons: Add a new patron to the system.
● PUT /api/patrons/{id}: Update an existing patron's information.
● DELETE /api/patrons/{id}: Remove a patron from the system.
● Borrowing endpoints:
● POST /api/borrow/{bookId}/patron/{patronId}: Allow a patron to
borrow a book.

● PUT /api/return/{bookId}/patron/{patronId}: Record the return of a borrowed book by a patron.
```
## Data Storage:
```
● Use an appropriate database (e.g., H2, MySQL, PostgreSQL) to persist book, patron, and borrowing record details.
● Set up proper relationships between entities (e.g., one-to-many between books and borrowing records).
```
## Validation and Error Handling:
```
● Implement input validation for API requests (e.g., validating required fields, data formats, etc.).
● Handle exceptions gracefully and return appropriate HTTP status codes and error messages.
```
