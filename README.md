#Facebook page feed scanner

Implement facebook page feed scanner.  
In this case you can use Long Lived User Access token to get feed from you'r example FB Page.  
Use InboxItem to represent posts and comment ( subcomment ).  
Send all result to you'r ZeroMQ (ZMQ::SOCKET_PUSH). ZMQ Server can be written in python  
Prepare optional command for print the result before you send it to ZMQ

Write Test in Codeception & show your code coverage in separate file

##Example

``php app app:feed 105477064851833 -p``

**105477064851833** it's example FB page


````
╰─$ php app app:feed 105477064851833 -p                                                     
Drugi post na stronie
         Tylko jeden komentarz
---------
Testowy post pierwszy na stronie
         Pierwszy komentarz 
                 Testowa strona Drugi komentarz
                 Drugi subcoment
---------
Flat array:
105477064851833_105491108183762: Drugi post na stronie
105491108183762_105491241517082: Tylko jeden komentarz => 105477064851833_105491108183762
105477064851833_105477468185126: Testowy post pierwszy na stronie
105477468185126_105477574851782: Pierwszy komentarz  => 105477064851833_105477468185126
105477468185126_105478384851701: Testowa strona Drugi komentarz => 105477468185126_105477574851782
105477468185126_105495888183284: Drugi subcoment => 105477468185126_105477574851782
````



