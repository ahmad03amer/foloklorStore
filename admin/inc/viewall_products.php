<div class="scroll" id="bodyright">
    <h3>Add a new Product from here </h3>
    <br><br>

<form  method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Number</th>
           
            <th> Name</th>
            <th> Images</th>
            <th> Descreption</th>
            <th> Price</th>
            <th> Size</th>
            <th> Keyword</th>
            <th>Added Date</th>
             <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
            
            include("inc/function.php");
            echo viewall_product();
        ?>
    </table>
</form>

</div>




















 





