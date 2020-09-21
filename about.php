
<html>

<head>
    <title>About Us</title>
    <link rel="stylesheet" href="css/style14.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script src="js/main2.js"></script>

</head>
<style>
  
body{
    
    font-family: sans-serif;
    
}

.body-content{
    background: white;
    min-width: 100vh;
    display: flex;
    align-items: center;
    justify-content: none;
    
}


</style>
<body>
        <?php
            include("inc/function.php");
            include("inc/header.php");
            include("inc/navbar.php");
        ?>
        <div class="body-content">

        
        <div class="project-details">
                        <div id="content">
                            <h2>About The Project</h2>
                            <ul>
                                <li> This site has been completed within the requirements of completing
                                the web course at Birzeit University.
                                </li>
                               <li>
                              <b>  Course information:</b> Course: COMP334, WEB APPLICATION AND TECHNOLOGY
                                </li>
                                <li><b> Department: </b>COSC, Computer Science</li>
                                <li><b> Class Times: </b>T, R 10:00 - 11:15 Masri302</li>
                                <li>Under the <b>supervision</b>  of <i> Dr. Youssef Hassouna</i></li>
                            </ul>
                                <br><br>
                                <hr>
                                <br><br>
                                <ul>
                                <li>Also, this site is specialized in selling traditional Palestinian products.
                                </li>
                               <li>
                               with the aim of reviving the Palestinian heritage and spreading awareness about it.
                                </li>
                                <li>And support industrial production and labor in Palestine, especially craftsmen.</li>
                                <li>And to reduce the disappearance of these occupations and traditional products.</li>
                            </ul>
                                <br><br>

                        </div><!-- End of content-info section -->
                        <button id="show-more" >Show More</button>

                    </div><!-- End of project-details section -->

                    <div class="contact-info">
                        <div class="card">
                                <i class="card-icon far fa-envelope"></i>
                                <p> a7mad@gmail.com</p>
                            </div>  

                        <div class="card">
                                <i class="card-icon fas fa-phone"></i>
                                <p>0592738615</p>
                            </div>

                         <div class="card">
                                <i class="card-icon fas fa-map-marker-alt"></i>
                                <p>Ramallah, Birzeit</p>
                            </div>
                    </div><!-- End of contact-info section -->

                    
                    <div class="column-me">
                        <div class="card-me">
                        <img src="imgs/slider/ahmadph.jpg" alt="Ahmad Amer" style="width:100%">
                        <div class="container-me">
                            <h2>Ahmad Amer</h2>
                            <p class="title">CEO &amp; Founder</p>
                           
                            <p><button class="button"><a href="inc/contactus.php">Contact</a> </button></p>
                        </div>
                        </div>
                    </div>

        </div><br clear="all"/> 
                         
            <script>
                         
                         //show more - less for about us page

                    var content = document.getElementById("content");
                    var button = document.getElementById("show-more");
                    var i=0;
                    button.onclick = function(){

                        if(i%2==0){//if its already open
                            //shrink the box
                            content.style.height="300px";
                            button.innerHTML = "Show More";

                        }else{
                            //expand the box 
                            content.style.height="500px";
                            button.innerHTML = "Show Less";
                        }
                        i++;
                        console.log('ahmad');
                    };

             </script>
        <?php  include("inc/footer.php");  ?>
</body>

</html>