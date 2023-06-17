<!--Credits https://youtu.be/cfjepC7aITs -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>


  <?php $page_title = "Contact Us"; ?>

</head>

<body>
  <?php include('includes/header.php'); ?>


  <div class="contact-wrap">
    <div class="contact-in" style="color:white">
      <h1>Contact Info</h1>
      <h2><i class="fa fa-phone" aria-hidden="true"></i> Phone</h2>
      <p style="color:white">+966-562788902</p>
      <h2><i class="fa fa-envelope" aria-hidden="true"></i> Email</h2>
      <p style="color:white">info@usparkle.com</p>
      <h2><i class="fa fa-map-marker" aria-hidden="true"></i> Address</h2>
      <p style="color:white">
        11<sup>th</sup> street, Rakkah Al- Janubiyah<br />
        Al-Khobar, Saudi Arabia
      </p>
    </div>
    <div class="contact-in">
      <h1>Send a Message</h1>
      <form id="myForm">
        <input type="text" name="fname" id="fnameField" placeholder="Full Name" class="contact-in-input" />
        <input type="text" id="emailField" placeholder="Email" class="contact-in-input"  />
        <input type="text" id="subjectField" placeholder="Subject" class="contact-in-input" />
        <textarea placeholder="Message" class="contact-in-textarea" id="message"></textarea>
        <input type="submit" value="SUBMIT" class="contact-in-btn" />
        <input type="reset" value="CLEAR" class="contact-in-btn" />
      </form>
      </div>
     
    
    <div class="contact-in">
      <iframe class="mapAlignmnet" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3577.626864900725!2d50.21014231435125!3d26.27377099362927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49c29d63f5f74f%3A0x78808c6f3a50a6a7!2sRakah%20St%2C%20Aldugheither%20Village%2C%20Al%20Khobar%2034611!5e0!3m2!1sen!2ssa!4v1671646478558!5m2!1sen!2ssa" width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>

  <?php include('includes/footer.html'); ?>


  
<script>
var fullName;
var email;
var subject;
var message;
    function start3() {
      var myForm = document.getElementById("myForm");
      fullName= document.getElementById("fnameField");
      email= document.getElementById("emailField");
      subject= document.getElementById("subjectField");
      message= document.getElementById("message");
      myForm.onsubmit = checknumthree;
    }

    function checknumthree()
    {
        var mssg3 = "";
        //Check fnameField
        if(fullName.value == ""){
        mssg3 = "Please enter the full name";
        }
        //Check emailField
        if(email.value == ""){
        mssg3 = mssg3 + "Please enter the email";
        }
        else if(!email.value.match(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/)){
        mssg3 = mssg3 +  " Email should be written in the correct format\n";
        }
        //Check subjectField
        if(subject.value == ""){
        mssg3 = mssg3 +  "Please enter the subject";
        }
        //Check message
        if(message.value == ""){
        mssg3 = mssg3 +  "Please enter the message";
        }
        if(mssg3!=""){
          alert(mssg3);
          return false;
        }
      }

    window.addEventListener("load", start3, false);
  </script>


</body>

</html>