<?php 
include 'includes.php';

$query = "SELECT * FROM upcomin_events";
$result = mysqli_query($connection,$query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <script
      src="https://kit.fontawesome.com/e4c074505f.js"
      crossorigin="anonymous"
    ></script>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Genos:ital,wght@1,300&family=Mate+SC&family=Roboto+Flex:wght@500&display=swap");
    </style>
    <link rel="stylesheet" href="upcoming-events.css">
    <link rel="stylesheet" href="index.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >Upcoming Events</title>
</head>
<body>
  <nav class="nav1">
    <ul>
      <a href="index.php"><li><i class="fa-solid fa-house"></i> Home</li></a>
      <a href="index.php#aboutus"><li><i class="fa-solid fa-circle-info"></i> About Us</li></a>
      <a href="gallery.php"><li><i class="fa-solid fa-camera"></i> Gallery</li></a>
      <a href="blog-cards.php"><li><i class="fa-solid fa-blog"></i> Blogs</li></a>
      <a href="#contacts"><li><i class="fa-solid fa-circle-dollar-to-slot"></i> Donate</li></a>
      <a href="#contacts"><li><i class="fa-solid fa-phone"></i> Contacts</li></a>
    </ul>
  </nav>
  
  <nav class="nav2">
    <ul>
      <a href="index.php"><li><i class="fa-solid fa-house"></i> Home</li></a>
      <a href="index.php#aboutus"><li><i class="fa-solid fa-circle-info"></i> About Us</li></a>
      <a href="gallery.php"><li><i class="fa-solid fa-camera"></i> Gallery</li></a>
      <a href="blog-cards.php"><li><i class="fa-solid fa-blog"></i> Blogs</li></a>
      <a href="#contact"><li><i class="fa-solid fa-circle-dollar-to-slot"></i> Donate</li></a>
      <a href="#contact"><li><i class="fa-solid fa-phone"></i> Contacts</li></a>
    </ul>
    <p>Plant For The Planet</p>
  </nav>
  <div class="menu-div">
    <i class="fa-solid fa-bars menu-bars" style="margin-top: 40px; color: #139620;"></i>
  </div>
  <div class="menu-div">
    <i class="fa-solid fa-xmark cancel-bars" style="color: black; margin-top: 40px; color: #139620;"></i>
  </div>

      <div class="upcoming-events-main-page-title">
        <p>Upcoming Events</p>
      </div>
      <div class="upcoming-events-container">
        <?php 
        if ($result && mysqli_num_rows($result) > 0) {
          
        while($row=mysqli_fetch_assoc($result)) {?>
        <div class="event-card">
            <div class="event-description-pic" style="background-image: url('images/w_e_day.png');">
                <div class="event-card-overlay"></div>
                <div class="event-card-title"><?php echo $row['event_title']; ?></div>
            </div>
            <div class="event-description">
                <p id="where"><b>WHERE: </b> <?php echo $row['place'];?></p>
                <p id="when"><b>WHEN: </b><?php echo $row['datee'];?></p>
                <p id="time"><b>TIME: </b><?php echo $row['timee'];?></p>
                <button class="enqure-more">Enquire more via email</button>
                <form action="push-to-past-events.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="datee" value="<?php echo $row['datee'];?>">
                  <input type="hidden" name="timee" value="<?php echo $row['timee'];?>">
                  <input type="hidden" name="place" value="<?php echo $row['place'];?>">
                  <input type="hidden" name="photo" value="<?php echo $row['photo'];?>">
                  <input type="hidden" name="event_id"  value="<?php echo $row['id']; ?>">
                  <button name="submit" class="mark-as-done enqure-more" >Mark as done</button>
                </form>
            </div>
        </div>
        <?php } ?>
        <?php } else{ ?>
          <p>THERE ARE NO UPCOMNG EVENTS YET</p>
          <?php }?>
      </div>
      
      <footer>
        <div class="footer-upper-column">
          <div class="upper-column-section1">
            <form action="">
              <p class="footer-title">Leave us a Message</p>
              <input type="text" />
              <textarea name="" id="" cols="30" rows="10"></textarea>
              <button type="submit">Send</button>
            </form>
  
            <div class="contacts" id="contacts">
              <p class="footer-title">Contacts</p>
              <p class="footer-content">
                <i class="fa-solid fa-envelope"></i>
                info@greengloberealisation.org
              </p>
              <p class="footer-content">
                <i class="fa-solid fa-phone"></i> +254208000117
              </p>
              <p class="footer-content">
                <i class="fa-sharp fa-solid fa-location-dot"></i> Kileleshwa Mwingi Road
              </p>
            </div>
          </div>
          <div class="upper-column-section2">
            <div class="quick-links">
              <p class="footer-title">Quick Links</p>
              <p class="footer-content"><a href="">Back to top</a></p>
              <p class="footer-content"><a href="">Blogs</a></p>
              <p class="footer-content"><a href="">Gallery</a></p>
              <p class="footer-content"><a href="">About Us</a></p>
            </div>
            <div class="donate">
              <p class="footer-title">Donate</p>
              <p class="footer-content">
                <i class="fa-solid fa-dollar-sign"></i> Mpesa
              </p>
              <p class="footer-content">
                <i class="fa-brands fa-paypal"></i> PayPal
              </p>
            </div>
            <div class="patners">
              <p class="footer-title">
                <i class="fa-solid fa-handshake"></i> Patners
              </p>
              <a
                href="https://climateconnect.earth/organizations/GlobalEnvironmentalandClimateConservationInitiative(GECCI)224"
                >GECCI</a
              >
            </div>
          </div>
        </div>
        <div class="footer-line">
          <hr />
        </div>
        <div class="footer-lower-column">
          <div class="social-links">
          <ul>
            <li>
              <a href="https://twitter.com/Greenglobe_ke"><i class="fa-brands fa-twitter"></i></a>
            </li>
            <li>
              <a href="https://www.linkedin.com/company/green-globe-realisation/"><i class="fa-brands fa-linkedin"></i></a>
            </li>
            <li>
              <a href=""><i class="fa-brands fa-facebook"></i></a>
            </li>
            <li>
              <a href=""><i class="fa-brands fa-instagram"></i></a>
            </li>
            <li>
              <a href="	https://wa.me/+254722465663"><i class="fa-brands fa-whatsapp"></i></a>
            </li>
          </ul>
          </div>
          <div class="copyrignt">
            <p>&copy; 2024 Green Globe Realisation | All rignts reserved</p>
          </div>
        </div>
      </footer>
          <script>
                
      // Function to handle the screen resize event
function handleResize() {
  var screenWidth = window.innerWidth || document.documentElement.clientWidth;
  var menuBars = document.querySelector('.menu-bars');
  var menuBars2 = document.querySelector('.cancel-bars');
  var menuBars3 = document.querySelector('.menu-div');
  var nav2 = document.querySelector('.nav2');

  if (screenWidth > 1180) {
    // Hide the .menu-bars class
    menuBars.style.display = 'none';
    menuBars2.style.display = 'none';
  } else{
    // Show the .menu-bars class
    menuBars.style.display='block';
    menuBars2.style.display='none';
    nav2.style.display='none';
  }
}

// Add event listener for the resize event
window.addEventListener('resize', handleResize);
</script>
      <script src="app.js"></script>
</body>
</html>
