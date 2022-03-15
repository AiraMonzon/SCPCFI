<?php 
	session_start();
	if(isset($_SESSION['id']) && isset($_SESSION['username']))
	{
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="css/adminhomeD.css">
      <title>Admin Home | SCPCFI</title>
</head>

<body>

<div class="whole">

<!-- HEADER NAVIGATION ------------------------------------------------------------------------------------------------------------------------->
      <header>

            <div class="wholenav fixed-top" id="fixmenu">

            <!-- FIRST HEADER NAVIGATION ------------------------------------------------------------------------------------------------------->
            <div class="row firstheader">
                  <div class="col-10 justify-content-left">
                  <img class ="logo" src="css/logo.png">
                  <a><b>Sanctuary of the Chosen People Christian Fellowship Inc.</b></a>
                  <a class ="system"><i>(Event Reservation and Management System)</i></a>        
                  </div>

                  <div class="col-2 d-flex justify-content-right hello"> 
                  <a><b>HOME</b></a>
                  </div>
            </div>
            <!-- FIRST HEADER NAVIGATION ------------------------------------------------------------------------------------------------------->  
            <!-- SECOND HEADER NAVIGATION ------------------------------------------------------------------------------------------------------>
            <nav class="navbar navbar-expand-lg navigation">
                  <div class="container">
                  <a class="navbar-brand" ><?php echo "Date: ".date("m/d/y") ; echo " Time: ".date("h:i:s:a") ;?></a>


                        <ul class="navbar-nav collapse navbar-collapse" id="navbarResponsive">

                              <li class="nav-item">
                              <a class="nav-link active" href="adminhome.php">Home</a>
                              </li>

                              <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Accounts</a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="settings.php">Administrator Accounts</a>
                              <a class="dropdown-item" href="members.php">Member Accounts</a>
                              </div>
                              </li>

                              <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="events.php">Administrator Events</a>
                              <a class="dropdown-item" href="memberevents.php">Member Events</a>
                              </div>
                              </li>

                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="adminmyprofile.php">My Profile</a>
                                <a class="dropdown-item" href="adminlogrecords.php">Log Records</a>
                                </li>

                              <li class="nav-item">
                              <a class="nav-link" href="adminmessage.php">Messages</a>
                              </li>
                        </ul>

                       <a class="navbar-brand ml-auto logout" href="logout.php">Logout</a>
                       <a><i>Hello, <?php echo $_SESSION['first_name']; ?></i></a>
                        <button class="btn btn-primary navbar-toggler menugler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        Menu
                        <i class="fa fa-bars"></i>
                        </button>

                 </div>
            </nav>
            <!-- SECOND HEADER NAVIGATION ------------------------------------------------------------------------------------------------------>
            </div>

      </header>
<!-- HEADER NAVIGATION ------------------------------------------------------------------------------------------------------------------------->

<!-- MAIN -------------------------------------------------------------------------------------------------------------------------------------->
<div class="main">

        <section class="page-section" id="churchservices">
            <div class="heading">
      <div class='row'>
      <div class='col-4'>
      <h1>SERVICES</h1>
      </div>
      <div class='col-8'>
            <div class='row secondmenu'>
            <div class='col-3 secondlink'>
      <a href="#location">Location</a>
      </div>     
                  <div class='col-3 secondlink'>
      <a class="active">Services</a>
      </div>
                  <div class='col-3 secondlink'>
      <a href="#watch">Watch</a>
      </div>
                  <div class='col-3'>
      <a href="#about">About</a>
      </div>
      </div>  
      </div>
      </div>
      </div></section>

      <?php
      include 'databaseconnection.php';

      $sql = "SELECT * FROM admin_event ORDER BY dateadded DESC LIMIT 3";
                                    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");
              
              while ($row = mysqli_fetch_assoc($result)) 
              {

              echo "<div class='container-fluid'>
            <div class='row'><div class='col-6'>
              <img class='eventimg' src='data:image;base64," .base64_encode($row['img_name']). "'style='width:100%' ></div><br><br>

              <div class='col-6 detailgroup'>

                      <div class='row detail justify-content-center'>
                      <h1><a class='tableview' href='adminhome.php?viewid={$row['id']}'>{$row['event_name']}</a></h1>
                      </div>

                    <div class='row detail justify-content-center'>
                      <p>Added by: {$row['username']} On: {$row['dateadded']}</p>
                      </div>

                      <div class='row detail'>
                      <p class='paragraph'><b>Date: {$row['event_date']} Time: {$row['event_time']}</b></p>
                      </div>
        


                      </div></div></div>";
              }
              
      ?>
<?php if(isset($_GET['viewid'])){  
    $sql = "SELECT * FROM admin_event WHERE id='$_GET[viewid]'";
    $result = mysqli_query($database_connection, $sql) or die("Bad Query: $sql");    
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) 
    { 
$idbc= $row['id'];
$img_namebc= $row['img_name'];
$event_namebc= $row['event_name'];
$event_datebc= $row['event_date'];
$event_timebc= $row['event_time'];
$event_slotbc= $row['event_slot'];
?>
  <!-- Modal -->
<div class="modal fade" id="exampleModalb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Church Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                <div class="col-12">
       <?php echo "<img class='eventimg' src='data:image;base64," .base64_encode($row['img_name']). "'style='width:100%' >"; ?>
</div>
</div>

        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-calendar-check-o"></i></center>
                </div>
                <div class="col-3">
                        Name
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_namebc; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-calendar"></i></center>
                </div>
                <div class="col-3">
                        Date
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_datebc; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-clock-o"></i></center>
                </div>
                <div class="col-3">
                        Time
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_timebc; ?></p>
                </div>
        </div>
        <div class="row">
                <div class="col-1">
                        <center><i class="fa fa-users"></i></center>
                </div>
                <div class="col-3">
                        Slot
                </div>
                <div class="col-7">
                        <p class="data"><?php echo $event_slotbc; ?></p>
                </div>
        </div>
      </div>

      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>  
<?php    
} }
}
?>
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://khaalipaper.com/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          $('#exampleModalb').modal({
              show: true,
              backdrop: 'static',
            keyboard: false

          });
        });
    
    </script>
<section class="page-section" id="watch">
            <div class="heading">
      <div class='row'>
      <div class='col-4'>
      <h1>WATCH</h1>
      </div>
      <div class='col-8'>
            <div class='row secondmenu'>
            <div class='col-3 secondlink'>
      <a href="#location">Location</a>
      </div>     
                  <div class='col-3 secondlink'>
      <a href="#churchservices">Services</a>
      </div>
                  <div class='col-3 secondlink'>
      <a class="active">Watch</a>
      </div>
                  <div class='col-3'>
      <a href="#about">About</a>
      </div>
      </div>  
      </div>
      </div>
      </div> </section>

      <div class='container-fluid'>
      <div class='row'><div class='col-12'>
      <h1>Blessed Sunday</h1><br>
      <iframe class="video" src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FSPCFILaguna%2Fvideos%2F482083576593884%2F&show_text=false&width=560&t=0" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
      </div></div></div>  

<section class="page-section" id="about">
            <div class="heading">
      <div class='row'>
      <div class='col-4'>
      <h1>ABOUT</h1>
      </div>
      <div class='col-8'>
            <div class='row secondmenu'>
            <div class='col-3 secondlink'>
      <a href="#location">Location</a>
      </div>     
                  <div class='col-3 secondlink'>
      <a href="#churchservices">Services</a>
      </div>
                  <div class='col-3 secondlink'>
      <a href="#watch">Watch</a>
      </div>
                  <div class='col-3'>
      <a class="active">About</a>
      </div>
      </div>  
      </div>
      </div>
      </div></section>

      <div class='container-fluid'>
      <div class='row'><div class='col-12'>
      <center><h1>STATEMENT OF FAITH</h1><br><br>
      <h3>SACRAMENTS OF THE CHURCH</h3>

      <p class="aboutparagraph">Water baptism is intended only for the individual who has received the saving benefits of

      Christ's atoning work and become his disciple. Therefore, in obedience to Christ's command and as a testimony to

      God, the Church, oneself, and the world, a believer should be immersed in water in the name of the Father, Son and

      Holy Spirit. Water baptism is a visual demonstration of a person's union with Christ in the likeness of his death and resurrection. It signifies that his former way of life has been put to death, and vividly depicts a person's release from the mastery of sin.

      As with water baptism, the Lord's Supper is to be observed only by those who have become genuine followers of Christ. This ordinance symbolizes the breaking of Christ's body and the shedding of his blood on our behalf, and is to be observed repeatedly throughout the Christian life as a sign of continued participation in the atoning benefits of Christ's death. As we partake of the Lord's Supper with an attitude of faith and selfexamination, we remember and proclaim the death of Christ, receive spiritual nourishment for our souls, and signify our unity with other members of Christ's body.</p>

      <br><br><h3>THE CONSUMMATION</h3>

      <p class="aboutparagraph">The Consummation of all things includes the visible, personal and glorious return of Jesus Christ, the resurrection of the dead and the translation of those alive in Christ, the judgment of the just and the unjust, and the fulfillment of Christ's kingdom in the new heavens and the new earth. In the Consummation, Satan with his hosts and all those outside Christ are finally separated from the benevolent presence of God, enduring eternal punishment, but the righteous, in glorious bodies, shall live and reign with him forever. Married to Christ as his Bride, the Church will be in the presence of God forever, serving him and giving him unending praise and glory. Then shall the eager expectation of creation be fulfilled and the whole earth shall proclaim the glory of God who makes all things new.</p>

      <br><br><h3>SANCTIFICATION</h3>

      <p class="aboutparagraph">The Holy Spirit is the active agent in our sanctification and seeks to produce his fruit in us our minds are renewed and we are conformed to the image of Christ. Though indwelling sin remains a reality, we are led by the Spirit we grow in the knowledge of the Lord, freely keeping his commandments and endeavoring to so live in the world that all people may see our good works and glorify our Father who is in heaven. All believers are exhorted to persevere in the faith, knowing they will have to give an account to God for their every thought, word, and deed. The spiritual disciplines, especially Bible study, prayer, worship and confession, are a vital means of grace in this regard. Nevertheless, the believer's ultimate confidence to persevere is based in the sure promise of God to preserve his people until the end, which is most certain.</p>

      <br><br><h3>EMPOWERED BY THE SPIRIT</h3>    

      <p class="aboutparagraph">In addition to effecting regeneration and sanctification, the Holy Spirit also empowers believers for Christian witness and service. While all genuine believers are indwelt by the Holy Spirit at conversion, the New Testament indicates the importance of an ongoing, empowering work of the Spirit subsequent to conversion as well. Being indwelt by the Spirit and being filled with the Spirit are theologically distinct experiences. The Holy Spirit desires to fill each believer continually with increased power for Christian life and witness, and imparts his su pernatural gifts for the edification of the Body and for various works of ministry in the world. All the gifts of the Holy Spirit at work in the church of the first century are available today, are vital for the mission of the church, and are to be earnestly desired and practiced.</p>

      <br><br><h3>THE CHURCH</h3>

      <p class="aboutparagraph">God by his Word and Spirit creates the Church, calling sinful men out of the whole human race into the fellowship of Christ's Body. By the same Word and Spirit, he guides and preserves that new redeemed humanity. The Church is not a religious institution or denomination. Rather, the Church universal is made up of those who have become genuine followers of Jesus Christ and have personally appropriated the gospel. The Church exists to worship and glorify God as Father, Son, and Holy Spirit. It also exists to serve him by faithfully doing his will in the earth. This involves a commitment to see the gospel preached and churches planted in all the world for a testimony. The ultimate mission of the Church is the making of disciples through the preaching of the gospel. When God transforms human nature, this then becomes the chief means of society's transformation. Upon conversion, newly redeemed men and women are added to a local church, in which they devote themselves to teaching, fellowship, the Lord's Supper, and prayer.

      All members of the Church universal are to be a vital and committed part of a local church. In this context they are called to walk out the New Covenant as the people of God, and demonstrate the real ity of the kingdom of God. The ascended Christ has given gift ministries to the church (including apostles, prophets, evangelists, pastors and teachers) for the equipping of Christ's body that it might mature and grow. Through the gift ministries, all members of the Church are to be nurtured and equipped for the work of ministry. Women play a vital role in the life of the church, but in keeping with God's created design they are not permitted "to teach or to exercise over a man" (1 Timothy 2:12 ESV). Leadership in the church is male. In the context of the local church, God's people receive pastoral care and leadership and the opportunity to employ their God-given gifts in his service in relation to one another and to the world.</p>

      <br><br><h3>THE HOLY SPIRIT</h3>

      <p class="aboutparagraph">The Holy Spirit, the Lord and Giver of life, convicts the world of sin, righlezionezt, uni judgment. Through the proclamation of the gospel he persundes men to repent of their sins and confess Jesus us Lord. By the same Spirit a person is led to trust in divine mercy. The Holy Spirit unites believers to Jesus Christ in faith, brings about the new birth, and dwells within the regenerate. The Holy Spirit hus come to glarify the Son, who in turn came to glorify the Father. He will lead the Church into a right understanding and rich application of the truth of God's Word. He is to be respected, honored, and worshiped as God the Third Person of the Trinity.</p>

      <br><br><h3>MAN</h3>

      <p class="aboutparagraph">God made mun-male and female-in his own image, as the crown of creation, that man might have fellowship with him. Tempted by Sotan, mun rebelled against God. Being estranged from his Maker, yet responsible to him, he became subject to divine wrath, inwordly deproved and, apart from a special work of grace, utterly incapable of returning to God. This depravity is radical and pervasive. If extends to his mind, will, and uffections. Unregenerate mun lives under the dominion of sin and Satan. He is af enmity with God, hostile toward God, and hateful of God. Fallen, sinful people, whatever their character or attuinments, are lost and without hope apart from salvation in Christ.</p>   

      <br><br><h3>THE GOSPEL</h3>

      <p class="aboutparagraph">Jesus Christ is the gospel. The good news is revealed in his birth, life, death, resurrection, and ascension. Christ's crucifixion is the heart of the gospel, his resurrection is the power of the gospel, and his ascension is the glory of the gospel. Christ's death is a substitutionary and propitiatory sacrifice to God for our sins. It satisfies the demands of God's holy justice and appeases his holy wrath. It also demonstrates his mysterious love and reveals his amazing grace. Jesus Christ is the only mediator between God and man. There is no other name by which men must be saved. At the heart of all sound doctrine is the cross of Jesus Christ and the infinite privilege that redeemed sinners have of glorifying God because of what he has accomplished. Therefore, we want all that takes place in our hearts, churches, and ministries to proceed from and be related to the cross.</p>

      <br><br><h3>MAN'S RESPONSE TO THE GOSPEL</h3>

      <p class="aboutparagraph">Man's response to the gospel is rooted and grounded in the free and unconditional election of God for his own pleasure and glory. It is also true that the message of the gospel is only effectual to those who genuinely repent of their sins and, by God's grace, put saving faith in Christ. This gospel of grace is to be sincerely preached to all men in all nations. Biblical repentance is characterized by a changed life, and saving faith is evidenced by kingdom service or works, While neither repentance nor works save, unless a person is willing to deny himself, pick up his cross, and follow Christ, he cannot become his disciple.</p>

      <br><br><h3>MAN'S INHERITANCE THROUGH THE GOSPEL</h3>

      <p class="aboutparagraph">Salvation, the free gift of God, is provided by grace alone, through faith alone, because of Christ alone, for the glory of God alone. Anyone turning from sin in repentance and looking to Christ and his substitutionary death receives the gift of eternal life and is declared righteous by God as a free gift. The righteousness of Christ is imputed to him. He is justified and fully accepted by God. Through Christ's atonement for sin un individual is reconciled to God as Father and becomes his child, The believer is forgiven the debt of his sin and, via the miracle of regeneration, liberated from the law of sin and death into the freedom of God's Spirit.

      One of the primary connections among Sovereign Grace churches is our commitment to a common Statement of Faith, which we summarize as evangelical, Reformed, and continuationist.

      At the core of our doctrine is the gospel of Jesus Christ-the glorious truth that Jesus Christ died and was raised so that sinners would be reconciled to God. The gospel is our primary passion and the driving influence in our churches' preaching, worship, small groups, and outreach.

      Surrounding thiscoreis an emphasis on sound doctrine. We are committed to a Reformed doctrine of salvation (the doctrines of grace), justification by faith alone, and the belief that Scripture is the sole infallible source of doctrine and authority.

      Beyond this agreement on the general tenets of Reformed theology, there are areas in which we differ from many Reformed traditions, such as infant baptism, cessationism (the belief that some miraculous spiritual gifts have ceased), and some traditionally Reformed types of church government.

      Finally, we want all these convictions to inspire a passion for the local church. We believe that local churches are to be the primary means of advancing the Great Commission, in addition to being the context where all believers are to grow in holiness, be equipped for service, and bear witness to the saving grace of God.</p>

      <br><br><h3>THE SCRIPTURES</h3>

      <p class="aboutparagraph">We accept the Bible, including the 39 books of the Old Testament and the 27 books of the New Testament, as the written Word of God. The Bible is the only essential and infallible record of God's self-disclosure to mankind. It leads us to salvation through faith in Jesus Christ. Being given by God, the Scriptures are bath fully and verbally inspired by God. Therefore, as originally given, the Bible is free of error in all it teaches. Eath book is to be interpreted according to its context and purpose and in reverent obedience to the Lord who speaks through it in living power. All believers are exhorted to study the Scriptures and diligently apply them to their lives. The Scriptures are the authoritative and normative rule and guide of all Christian life, practice, and doctrine. They are totally sufficient and must not be added to, superseded, or changed by later tradition, extra-biblical revelation, or worldly wisdom. Every doctrinal formulation, whether of creed, confession, or theology must be put to the test of the full counsel of God in Holy Scripture.</p>

      <br><br><h3>GOD THE FATHER</h3>

      <p class="aboutparagraph">God the Father is the Creator of heaven and earth. By his Word and for his glory, he freely and supernaturally created the world from nothing. Through the same Word he daily sustains all his creatures. He rules over all and is the only Sovereign. His plans and purposes cannot be thwarted. He is faithful to every promise, works all things together for good to those who love him, and in his unfathomable grace gave his Son, Jesus Christ, for mankind's redemption. He made man for fellowship with himself, and intended that all creation should live to the praise of his glory.</p>

      <br><br><h3>JESUS CHRIST</h3>

      <p class="aboutparagraph">Jesus Christ, the only begotten Son of God, was the eternal Word made flesh, supernaturally conceived by the Holy Spirit, born of the Virgin Mary. He was perfect in nature, teaching, and obedience. He is fully God and fully man. He was always with God and is God. Through him all things came into being and were created. He was before all things and in him all things hold together by the word of his power. He is the image of the invisible God, the first-born of all creation, and in him dwells the fullness of the godhead bodily. He is the only Savior for the sins of the world, having shed his blood and died a vicarious death on Calvary's cross. By his death in our place, he revealed the divine love and upheld divine justice, removing our guilt and reconciling us to God. Having redeemed us from sin, the third day he rose bodily from the grave, victorious over death and the powers of darkness, and for a period of 40 days appeared to more than 500 witnesses, performing many convincing proofs of his resurrection. He ascended into heaven where, at God's right hand, he intercedes for his people and rules as Lord over all. He is the Head of his body, the Church, and should be adored, loved, served, and obeyed by all.</p></center>
      </div></div></div>  

        <section class="page-section" id="location">
      <div class="heading">
      <div class='row'>
      <div class='col-4'>
      <h1>LOCATION</h1>
      </div>
      <div class='col-8'>
            <div class='row secondmenu'>
            <div class='col-3 secondlink'>
      <a class="active">Location</a>
      </div>     
                  <div class='col-3 secondlink'>
      <a href="#churchservices">Services</a>
      </div>
                  <div class='col-3 secondlink'>
      <a href="#watch">Watch</a>
      </div>
                  <div class='col-3'>
      <a href="#about">About</a>
      </div>
      </div>  
      </div>
      </div>
      </div>

      <div class='container-fluid'>
      <div class='row'><div class='col-12'>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15465.248754742197!2d121.1165039166714!3d14.29328499422163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d9b6aaa9fb9f%3A0xc7a66210ef892ccf!2sBlessed%20Christian%20School%20de%20Sta.%20Rosa!5e0!3m2!1sfil!2sph!4v1637666924450!5m2!1sfil!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy">
      </iframe>
      </div></div></div> </section>
</div>
<!-- END OF MAIN ---------------------------------------------------------------------------------------------------------------------->
</div>
<!-- FOOTER --------------------------------------------------------------------------------------------------------------------------->       
<footer>
      @SCPCFILaguna:<a class="index" href = "index.php"> Sanctuary of the Chosen People Christian Fellowship Inc.</a><br>
      <nav class="navbar2 navbar-expand-sm">
            <ul class="navbar-nav centering">

                    <li class="nav-item">
                    <a class="nav-link footlink" href="adminhome.php">Home</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle footlink" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Accounts</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="settings.php">Administrator Accounts</a>
                    <a class="dropdown-item" href="members.php">Member Accounts</a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle footlink" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="events.php">Administrator Events</a>
                    <a class="dropdown-item" href="memberevents.php">Member Events</a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle footlink" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="adminmyprofile.php">My Profile</a>
                    <a class="dropdown-item" href="adminlogrecords.php">Log Records</a>
                    </li>
                    
                    <li class="nav-item">
                    <a class="nav-link footlink" href="adminmessage.php">Messages</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link footlink" href="logout.php">Logout</a>
                    </li>
            </ul>
      </nav>
</footer>
<!-- END OF FOOTER ---------------------------------------------------------------------------------------------------------------------------> 

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

<?php
	}
	else
	{

		header("Location: logout.php");

		exit();
	}
?>