# v 0.4

## Completed
- Add Movie Section
    - Revamped entire process of adding movie. Removed next button that goes to page to add cast and crew and replaced it with a submit button.
    - Added upload button for adding posters to movie. Includes function to preview poster.

## WIP
- addcrew.php and add member.php will now be it's own tools.
- Need to update tools navigation to include adding crew.
- addmovie.php still a work in progress and does not yet insert new movies into database.

# v 0.3

## Completed
- Add Movie Section
    - addcrew.php: Added search function for adding cast and crew.
    - addcrew.php: Added a popup modal to add names that doesn't exist in database
    - addmember.php: pops up in modal and allows user to add crew

## WIP
- Add Movie Section
    - addmember.php: Page still adds duplicates to database
    - addcrew.php: ability to add existing film makers to specified movie's cast/crew. Need to review and research PHP to learn how to store arrays into sessions.

# v 0.2

## Completed
- Add Movie Section

    - Added capability to store movie title, release date, and Summary into sessions to be used across the "add movie" tool.
    - Added "next" button that goes to a page to Add Crew.add readme
    - Created blank "Add Crew" page.

## WIP
- Add Movie Section
    - Add Crew Page that allows users to search for crew members. If crew member doesn't exist in database, then user can add them to database.
    - Add ability to add roles to crew members.

# v 0.1

## Completed

- Created Register and login pages.

- created admin section that allows admins to use a variety of tools which include:
    - Ability to sort, edit, and delete members.
    - Send newsletter to all users that opted in to recieve newsletter.

## WIP

- Ability for admins to add movies including title, description, runtime, and cast.