<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/indexB.css"/>
        <title>Sanctuary of the Chosen People Christian Fellowship Inc.</title>
</head>

<body>

<!-- HEADER ------------------------------------------------------------------------------------------------------------------------ -->
        <header>
        <?php echo "Date: ".date("m/d/y") ; echo " Time: ".date("h:i:s:a") ; ?>
        </header>
<!-- END OF HEADER ----------------------------------------------------------------------------------------------------------------- -->

<!-- LOGO -------------------------------------------------------------------------------------------------------------------------- -->
        <img class="rounded mx-auto d-block" src="css/logoname.png" alt="SCPCFI">
<!-- END OF LOGO ------------------------------------------------------------------------------------------------------------------- -->

<!-- MAIN -------------------------------------------------------------------------------------------------------------------------- -->
        <div class="container-fluid">
                <div class="row justify-content-center rowwelcome">        
                <h1>Hi, Welcome!</h1>
                </div>
                <div class="row justify-content-center rowdestination">
                <p>Please click your destination</p>
                </div>

        <!-- FORMS USER BUTTON ---------------------------------------------------------------------------------------------------- -->        
                <div class="row justify-content-center rowuserbutton">
                <form action="userlogin.php">
                <button class="btn btn-primary btn-lg" type="submit">START</button>
                </form>
                </div>
        <!-- END OF FORMS USER BUTTON ----------------------------------------------------------------------------------------------- -->

        </div>
<!-- END OF MAIN ------------------------------------------------------------------------------------------------------------------- -->


<!-- FOOTER ------------------------------------------------------------------------------------------------------------------------ -->
<div class="wrapper">
        <footer>
            <div class="footer text-center">@SCPCFILaguna:
            <a href = "index.php">Sanctuary of the Chosen People Christian Fellowship Inc.</a>
            </div>
        </footer>
</div>
<!-- END OF FOOTER ----------------------------------------------------------------------------------------------------------------- -->

</body>
        <script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyBHlqch54_PGD95e75XUGHSVGOIIK9SrEg",
    authDomain: "scpcfi-a0473.firebaseapp.com",
    projectId: "scpcfi-a0473",
    storageBucket: "scpcfi-a0473.appspot.com",
    messagingSenderId: "865707508527",
    appId: "1:865707508527:web:ed79dc1c0dbfb9ec7217da",
    measurementId: "G-S8LE8RVWZR"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>
</html>
