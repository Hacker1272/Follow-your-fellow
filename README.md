# Social-Network-Module
This is a simple social connection module having followwing functionality-

1. Users can send a friend request to other users.
2. Users can accept or reject friend request from other users.
3. users can post an update to his friends.


#The project contains following sub-modules-
1. Login/SignUp
2. Users Area
  -----Updates Section From Friends.
  -----Post Area i.e. users can make an update to their friends.
  -----Friends Section
  ---------Friend requests section
  ---------Friend List Section
  ---------All Users Sections
  -----LogOut Section
  
# Database Design

Databse Contains 3 tables-
1. Users Table    # 3 columns
    
    |  userID  |  username  |  password  |
    
2. Friends Table  # 4 columns

    | users1ID | user2ID   |   status    |   actionuserID  |
    
3. Updates Table  #4 columns

    | updateID | userID    | updates   | updateTime  |    
    
