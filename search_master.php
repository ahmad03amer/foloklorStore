<?php
            include("inc/db.php");
            $user_search_input = $_POST['search_query'];

            $query=$con->prepare(" SELECT * FROM products WHERE pro_name LIKE '%$user_search_input%'");
            $query->setFetchMode(PDO:: FETCH_ASSOC);
            $query->execute();

            if($query->rowCount() >= 1){
                
                ?>
                <ul>
                <?php
                while($row=$query->fetch()){
                    ?>  
               
                    <li>
                <div id="row_result">
                    <div id="product_img">
                        <img src="imgs/pro_img/<?php echo $row['pro_img1']; ?>" alt="img_icon">
                       
                    </div>
                    <div id="product_name">
                    <?php echo $row['pro_name']; ?>

                    </div>
                    <div id="product_price">
                    <?php echo $row['pro_price']; ?>

                    </div>
                </div>
                    </li>
                
                    <?php
                }

               ?>
                </ul>
               <?php
            }

            
?>    
