<nav>
    
            <ul>

                <li><a href="index.php">Home Page</a></li>
                <li>
                <a href="#">Products & Categories</a>
                    <ul>
                      <?php echo all_cat();
                           // echo trim($str, '<br>');
                      ?>
                      
                    </ul>
                </li>

                <li><a href="about.php">About Us</a></li>

                <li style="padding:0;">
                
                    <button id="modalBtn" class="button" onclick="user_guide()">Site Guide</button>

                    <div id="simpleModal" class="modal">
                         <div class="modal-content">
                            <div class="modal-header">
                                <span class="closeBtn">&times; </span>
                                <h2>User's Guide</h2>
                            </div>
                            <div class="modal-body">
                                <p><br> Hello user. <br>
                                    To know how this site works and how to register and buy from it. <br>
                                    Please watch the video on YouTube by clicking on the attached link. <br>

                                    We wish you a unique shopping experience <br> <br>
                            </p>
                            </div>
                            <div class="modal-footer">
                                <h3><a href="">click here to see the video </a></h3>
                                <br>
                            </div>
                         </div>
                     </div>
                   
                </li>
                 
            </ul>
        </nav>