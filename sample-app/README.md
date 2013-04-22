# Remember The Milk API client for PHP sample app

## Instructions:

 - Copy the contents of this directory to your document root.
 - Define `API_KEY` and `SECRET` constants in `bootstrap.php` (go [here](https://www.rememberthemilk.com/services/api/keys.rtm) if you don't have API key).
 - Configure your callback URL to point to `http://your-webserver/rtm.php`.
 - Run `index.php` by pointing your browser to `http://your-webserver/` (directory where `index.php` is).
 - If everything is fine, you will be redirected to `https://www.rememberthemilk.com/services/auth/` where you can authorize your app.
 - After autorizing, you will be redirected back to `http://your-webserver/` with ability to call some service methods.
 - You can adjust requested permissions in `rtm.php` (the last `catch`).
 - Enjoy!

 Note that this sample application stats the session to remember auth token given by remember the milk services.
 