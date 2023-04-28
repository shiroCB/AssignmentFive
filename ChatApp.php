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
        <section class="header">
            <h1>Chat</h1>
        </section>
        <section class="main">
            <div class ="list">
                <section id="nameList">
                    <div>
                        <p><b>Name List</b></p>
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
            </div>
            <div class="chat">
                <section id="send">
                    <div id="login">
                        <input type="text" id="user" name="user" placeholder="Username">
                        <span id="nameWarn"></span>
                        <input type="password" id="pass" name="pass" placeholder="Password">
                        <span id="passWarn"></span>
                    </div>
                    <textarea id="sendMessage" name="sendMessage" maxlength="16000"></textarea>
                    <div>
                        <span id="sendAlert"></span>
                    </div>
                </section>
                <section id="receive">
                    <div id="listen">
                        <input type="text" id="receiveUser" name="receiveUser" placeholder="Listen Name">
                        <span id="rNameWarn"></span>
                    </div>
                    <textarea id="receiveMessage" name="receiveMessage" disabled></textarea>
                    <div>
                        <span id="receiveAlert"></span>
                    </div>
                </section>
            </div>
            <div class="line"></div>
        </section>
    </body>
</html>