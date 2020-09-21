
        <header>
            <div id="logo">
            
              <!--  <img src="imgs/logo.png" alt="Logo"> -->
              <a href="index.php" id="logo_name">Foloklor Store</a>
             
            </div><!--end of the logo -->
            <div id="link">
                <ul>
                    <li><a href="myaccount.php">My Account </a></li>
                    <li><a href="cart.php">Shopping Cart</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="checkout.php">Check Out</a> </li> 
                    <li><a href="login.php">Login </a></li> 
                </ul>
            </div><!--end of the link -->

            <div id="search" >
                <form action="search.php" method="get" enctype="multipart/form-data" autocomplete="off">
                    <input type="text" id="user_input" name="user_query" oninput="triggerSearch()" placeholder="Search From Here >> " name="search">
                    <button id="search_btn" name="search">Search</button>
                    <button id="cart_btn"><a href='cart.php'>Cart</a> </button><!--<php echo cart_count(); عشان اضيف عدد المنتجات بالcart?>-->
                </form>
            </div><!--end of the search -->
            <div id="search_result_container">

                 <!-- 
                      <div class="sugg-header">
                                <span class="closeBtn">&times; </span>
                                <h5> User's suggestions</h5>
                            </div>
                            <div id="sugg-body">
                        
                            </div>
                --> 
            </div> 
          

            <!-- ajax call back function , live search-->
            <script>
               function triggerSearch(){
                        var user_input=document.getElementById("user_input").value;

                        //use ajax

                        $.ajax({
                            type:'POST',
                            url:'search_master.php',
                            data:{'search_query':user_input},
                            success:function (result){
                                //look for search container
                                //then add the data thad had been returned
                                document.getElementById('search_result_container').innerHTML = result;
                                
                            }

                        });
                    
                }
            </script>


        </header>