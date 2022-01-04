## My Thoughts on the code
I think it's a terrible code, as it violates all the SOLID principles guiding Object Oriented Design (OOD)
1. The code base is not easily maintainable, this is because lots of different functionalities are not modularized, but rather placed in thesame repository and controller.
2. Writing automated tests for the code becomes tedious and mocking the functionalities to test become hellish
3. A compound class is injected into the controller class, this makes it difficult to easily extend the repository functionality without affecting multiple locations of injection
4. Request object is used as function arguments in the repository, this is terrible, as the controller should only worry about handling any request data, the repository should only worry about implementation and the business logic, and function parameters should not be controller specific data types, to avoid leakage as well
5. Redundant and duplicate authenticated user data being used in multiple locations, controller and the repository, this can be parsed down once
6. Multiple duplicate lines of code doing the same functionality and duplicate functions
7. Independent services like sending notifications, are all compounded into the repository instead of being injected, making it difficult for other repositories to use these services, this may lead to code duplication 
8. Filters, pagination and data sorting are not modularized, hence making it not usable by other parts of the app, as well as within the same repository leading to code duplication
9. No proper use of data validation, leading to complex if/else checks for data
10. Resource responses are not abstracted from the data logic, this means any change in the response structure will require multiple edits to the repository, which should not be so

## Some improvements I would make to improve the code
1. Authentication and authorization
    > Implement controller middleware to allow only authenticated users access. To further restrict who can and cannot perform some activities like view, update, create, delete, viewAny, on the data, I would implement policies guarding the data access, this way there wouldnt be the need for writing if/else checks in the repositories before allowing data access. This makes it very easy to update these policies, without worrying about touching multiple files and making it mockable and testable
2. Data Validation
    > Use laravel validation to validate and sanitize all store/update request data before passing the sanitized data through to the repository, this way we release the repository from worrying about data validation and it will be sure that all data that passes down to the repositories are clean and ready for use. This way, validation rules can be modified at one place and it will affect all places the rules are used
3. Scopes
    > Use Scopes to determine what data to display to which user, again, eliminating any complex/multiple if/else checks to determine who should have access to what data. This makes it easy to maintain and update these scopes and can eaily be tested
4. Dependency Injection
    > Inject Interfaces, and other services like sending messages, into controllers and repositories, Injecting interfaces instead of well formed classes makes the code light and easily extensible and polymorphable. Use the laravel service container to manage what implementations to provide when the interfaces are required by the different classes
5. Filters and Response
    > Create filters using closures and custom responses, use pipeline to enforce the use of the filters, modularizing this makes it easy to maintain, test and reusable in multiple parts of the code and not just a single repository. This prevents code duplication as well
6. Modularize code and enforce DRY
    > Make the code as modular as possible, any functionality that is not repository/controller specific should be extracted, implemented and injected instead. Facades and traits can be created for simple modules whilst interfaces and classes for complex modules