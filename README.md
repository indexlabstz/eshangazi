# eShangazi [![Build Status](https://travis-ci.org/indexlabstz/eshangazi.svg?branch=master)](https://travis-ci.org/indexlabstz/eshangazi)

## About eShangazi

eShangazi is a knowledge-sharing system (ChatBot) that aims at informing, educating and advising youths about Sexual and Reproductive Health (SRH) via Facebook Messenger, Telegram, Skype, Slack, SMS and Google Hangouts.

This is an open source forum that was built and maintained at Laracasts.com.

### Prerequisites
 
 * To run this project, you must have PHP 7 installed.
 * You should setup a host on your web server for your local domain. 
 For this you could also configure Laravel Homestead or Valet. 
 * Alternatively, install the following
 ```bash
 * WAMP/XAMPP on windows or LAMP on Linux
 * Composer
 * On windows also install Git Bash to run git commands
 ```
  
 ### Step 1
 
 Begin by cloning this repository to your machine, and installing all Composer dependencies.
 
 ```bash
 git clone https://github.com/indexlabstz/eshangazi.git
 cd eshangazi-web && composer install
 ```
 
 ### Step 2
 
 Create a new [Facebook page](https://developers.facebook.com/docs/messenger-platform) or use one you already have to as a starting point. 

 
 ### Step 3
 
 Visit [Dialogflow](https://dialogflow.com) to create your first agent to interact with eShangazi. 
 
 ### Step 4
 
 Finish the setup by creating a new app at [Heroku](http://heroku.com), integration with Facebook Messenger requires a https link.
 You can get one for free at Heroku. You can also try other options like ngrok for quick getting started. 
 
 ### Step 5
 
 Next, boot up a server and visit your browser and locate your application.