# Database Schema

## Users
- id
- username
- password
- email
- timestamps

## Pages
- id
- title
- entry_id
- timestamps

## Entries
- id
- page_id
- user_id
- entry
- timestamps

## Groups
- id 
- group
- description
- timestamps


## Page_Tag
- page_id
- tag
- timestamps

## Rights
- id
- right
- description
- timestamps

## Group_Right
- group_id
- right_id
- timestamps

# Database Seeds

## Users
- 1, admin, password, admin@md.wiki

## Pages
- 1, Home Page, 1

## Entries
- 1, 1, 1, #HomePage\n\nTest information

## Groups
- 1, superadmin, Super Administrator - cannot be deleted (only one)
- 2, admin, Administrator
- 3, editor, Editor
- 4, contributor, Contributor

## Rights
- 1, add_page, Add Page
- 2, edit_page, Edit Page
- 3, delet_page, Delete Page
- 4, add_user, Add User
- 5, edit_user, Edit User
- 6, delete_user, Delete User
- 7, edit_own, Edit Own

## Group_Right
- 1, 1
- 1, 2
- 1, 3
- 1, 4
- 1, 5
- 1, 6
- 1, 7
- 2, 1
- 2, 2
- 2, 3
- 2, 4
- 2, 5
- 2, 6
- 2, 7
- 3, 1
- 3, 2
- 3, 3
- 3, 7
- 4, 1
- 4, 7




