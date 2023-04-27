<!DOCTYPE html>
<html>
    <head>
        <title>Chat</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="ChatApp.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="ChatApp.js"></script>
    </head>
    <body>
        <section id="nameList">
            <div>
                <p>Name List</p>
                <ul>
                    <?php 
                        include "db_connect.php";
                        $sql = "SELECT * FROM Users";
                        $result = $conn->query($sql);
                        if ($result -> num_rows > 0) {
                            while ($row = $result-> fetch_assoc()) {
                                echo "<li>". $row['Name'] ."</li>";
                            }
                        }
                        else {
                            echo "No Results";
                        }
                        $conn-> close();
                    ?>
                </ul>
            </div>
        </section>
        <section id="send">
            <div>
                <label for="user">Username: </label>
                <input type="text" id="user" name="user" placeholder="Username">
                <span id="nameWarn"></span>
            </div>
            <div>
                <label for="password">Password: </label>
                <input type="password" id="pass" name="pass" placeholder="Password">
                <span id="passWarn"></span>
            </div>
            <div>
                <textarea id="sendMessage" name="sendMessage" rows="10" cols="62"></textarea>
            </div>
            <div>
                <span id="sendAlert"></span>
            </div>
        </section>
        <section id="receive">
            <div>
                <label for="receiveUser">Enter a name from the list to listen to: </label>
                <input type="text" id="receiveUser" name="receiveUser" placeholder="Name">
                <span id="rNameWarn"></span>
            </div>
            <div>
                <textarea id="receiveMessage" name="receiveMessage" rows="10" cols="62" disabled></textarea>
            </div>
            <div>
                <span id="receiveAlert"></span>
            </div>
        </section>
    </body>
</html>