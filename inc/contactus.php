
<!DOCTYPE html>

<head>

    <title>Contact Us</title>

</head>
<style>
body{
     display: flex;
     align-items: center;
     justify-content: center;
}
    #contact-us {
        display: flex;
        text-align: center;
        border: solid black;
        width:600px;

    }

    input{
        width:90%;
    }
    textarea{
        width:90%;
    }
</style>

<body>



    <br>
    <!-- the page of contact us // using w3school website-->
    <div id="contact-us">
        <form action="mailto:a7mad.amerr@gmail.com" method="post">
            <blockquote>
                <label for="">  <h1>Connect Us Page </h1></label>
                <p><strong> Name :</strong></p>
                <input type="text" name="Name" value="" ><br><br>
                <p><strong>E-mail :</strong></p>
                <input type="text" name="Email" value="" ><br><br>
                <p><strong>Location :</strong></p>
                <input type="text" name="Location" value=""><br><br>
                <p><strong>Title :</strong></p>
                <input type="text" name="Title" value=""><br> <br>
                <p><strong> Message Content :</strong></p>
                <textarea NAME="abstract" COLS=100 ROWS=5 ></textarea>
                <br>

                <div>
                <br>
                    <input type="submit" value="submit">
                    <br>
                    <input TYPE="reset" VALUE="reset">

                </div>

            </blockquote>

        </form>
    </div>


</body>

</html>