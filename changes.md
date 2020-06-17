# Changes made by Rami Zouari on 06/17/2020

1. Databases and Entities
    - Added year attribute to book table
    - Added evaluation table
    - Added exchange table (still empty)
    - Added publication table (still empty)
    - Added purge_database.sql
    - Dumped the database to the file projet_web.sql
2. Controllers
    - Modification to the code of LivreController
    - Removed method LivreController::lister LivreController (I actually commented it, and the logic of the code has been transfered to method LivreController::index)
    - dsd
3. TWIG
    - Modified base.html.twig and included all the dependencies
    - the file livre/liste.html.twig is no longer needed, its content has been transfered to livre/index.html.twig
    - Modified livre/index.html.twig: The expected result of this page is on the messenger group
4. Dependencies
    - npm: font-awesome,bootstrap,mdbootstrap,popper.js,jquery.. Note that some of those dependencies are redundant but I didn't want to take the risk of removing one of them, if they are not included add them using npm install
    - composer: faker, symfonycasts/reset-password-bundle
5. Future Changes (Chouf chmezel min 5edmti fi TODO.md)
    - Adding a form to create a book
    - Adding a form for exchanging books
    - Adding support for books photos and users photos
    - Adding support for user role
    - Adding support for user text publications
