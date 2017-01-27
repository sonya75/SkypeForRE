# SkypeForRE
A way to send messages from RE to Skype

# Usage
To use it, put the script in SkypeForRE.txt in RE snippet and edit the first few lines to enter your skype id and password. There is a line
  
<code>set sender skypeforevony.herokuapp.com</code>

That is a website I created, which the script uses as an intermediary for sending messages in Skype. You can use your own website for this. All you need to do is upload the php files in this repository to your site and replace the link <code>skypeforevony.herokuapp.com</code> in the snippet with the link of your own site without the http:// or https:// at the beginning.
  
Here is how to use this snippet to send messages to other users in Skype:-

```
set userid random_guy
set msg "Hello World"
include SkypeForRE
```
Running that script will send the message "Hello World" to the person with skype id "random_guy".

And this is how to use this snippet to send messages in groups in Skype:-
```
//Here you need to add the topic of the group conversation and of course 
//you will need to be a part of the group for this to work. 
//You don't need to add the full name, just entering part of the name is sufficient.
set skypetopic "Official RE Support"
set msg "Hello World"
include SkypeForRE
```

Running this script will send the message "Hello World" to a group you are in which has the string "Official RE Support" in its topic name.
