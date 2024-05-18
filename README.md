# Withings Test

_Languages:_ PHP 7.X or 8.X in backend, JS in frontend

## Introduction

This test has 2 steps:

- 1st step for testing backend development
- 2nd step for testing frontend development

### Result

- Send a **github** with your result (or at least send an archive by email)

- To evaluate your result we will assess:

  - Topic understanding
  - Resourcefulness
  - Code quality

- Don't forget to reread, clean and nicely format your code: **we give priority to quality over quantity**

- If you want, you can add an IMPROVEMENTS.md file to specify how you would improve your code with more working time.

- Please contact us if you are facing any blocking situation.

## Instructions

### Backend

Withings has a public API making possible for developers to retrieve customer Withings data after being authorized by the customer to access it. The Withings public API is using the OAuth2.0 protocol to authenticate the calls. To simplify the usage of the Withings public API, [a demo mode](https://developer.withings.com/developer-guide/v3/integration-guide/public-health-data-api/get-access/oauth-web-flow#demo-user) exists.

In this test, you will have to **write a simple HTML webview and a script in PHP** to use the OAuth2.0 protocol and get the demo-user weight measurements using the Withings public API.

We already registered to the Withings public API and got the following credentials:

- **clientid**: a16837aaa8f536b229ce20fa8e90a2739885b640ff67de7b84562b6fe0e27513
- **secret**: 881b7dc5686e38894ef0cb27019ebc44e7daf72cc329fe914a43acee15774782
- **authorized callback url**: http://localhost:7070

Put your development files inside the following folder: _backend-oauth2_

1/ Consult our documentation about the [OAuth2.0 protocol](https://developer.withings.com/developer-guide/v3/integration-guide/public-health-data-api/get-access/oauth-web-flow) (you are allowed to consult other sources).

2/ Write a simple HTML webview to make a partner app request customer authorization and a script in PHP (you can use objects or just write a script) to retrieve the OAuth2.0 access_token. To help you starting: the HTML webview will have to display a button targeting the following link: <https://account.withings.com/oauth2_user/authorize2?response_type=code&client_id=a16837aaa8f536b229ce20fa8e90a2739885b640ff67de7b84562b6fe0e27513&redirect_uri=http://localhost:7070&state=withings_test&scope=user.metrics&mode=demo>.

3/ Improve your PHP script to get the last weight measurements of the user using the [Measure - Getmeas API](https://developer.withings.com/api-reference#operation/measure-getmeas) and display them in a webview.

Notices:

- To simplify the usage of the Withings public API, [a demo mode](https://developer.withings.com/developer-guide/v3/integration-guide/public-health-data-api/get-access/oauth-web-flow#demo-user) exists. We suggest you to use it.

- You can consult our [Postman collection](https://developer.withings.com/developer-guide/v3/integration-guide/public-health-data-api/data-api/additional-resources)

- You DON'T need to follow the [signature hash protocol](https://developer.withings.com/developer-guide/v3/integration-guide/public-health-data-api/get-access/sign-your-requests)

- You DON'T need to implement the [notification system](https://developer.withings.com/developer-guide/v3/integration-guide/public-health-data-api/maintain-your-integration/understand-our-timeline-for-notice)

- You DON'T need to implement a complex architecture with a bdd, etc..

- You can test your PHP script by running a local server (cf. _How to install_ section below) and then follow the link in Backend step 2.

### Frontend

In this test, you will create a loop of websites.

What we want:

1. Every 30 seconds, you will display a new website from an array of urls (see websitesUrls below).
2. At the end of the array, we return to the beginning
3. The website displayed need to be fullscreen, it takes all the width and height of the viewport
4. Add timer and controls : display the timer before the next website , with buttons for controls (see bonus).
5. Add a nice style/css on the control div. It must be always visible on top of the displayed website.
6. Bonus : add controls to go to previous or next website without waiting the end of the timer
7. Bonus : add a play/pause button to stop the timer and keep current website.

Notices :

- In the folder `frontend-loop` you will find an `index.html` with all the websites to display. You can add more or display other websites if you want.
- When developing, you can change the timer for 3 or 4 seconds
- If you go to previous/next website with timer pausing, keep the pause. Else, reset timer.

## How to Install

### Backend

- PHP 7.X or 8.X on your computer

The `backend-oauth2` folder is the folder for the Backend test. Go to this folder and launch the server in local with the command : `php -S localhost:7070`. Then go to your browser and open `http://localhost:7070`.

### Frontend

The `frontend-loop` folder is the folder for the Frontend test. Write your code in the index.html and open it with a browser for testing.

Thanks for the time you take!
