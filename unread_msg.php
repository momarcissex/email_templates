<?php
    include 'dbh.php';

    $q = "SELECT DISTINCT chat_id, email, first_name
    FROM users, messages
    WHERE messages.u_to = users.uid
    AND messages.opened =  '0';";
    $result = $conn->query($q);

    while ($row = mysqli_fetch_assoc($result)) {
        $from = 'NXTDROP Team <support@nxtdrop.com>';

        $subject = "Login. You have UNREAD MESSAGES!!!";

        $to = $row['email'];

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

        $message = '<html>
        <title>
            You have UNREAD DMs!!!
        </title>
    
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                @media only screen and (max-width: 768px) {
                    .email_head a img {
                        width: 20% !important;
                    }
                }
                
                @media only screen and (max-width: 414px) {
                    .email_head a img {
                        width: 30% !important;
                    }
    
                    video {
                        width: 100% !important;
                    }
                }
                
                body {
                    margin: 0;
                    padding: 0;
                    font-family: Arial, Helvetica, sans-serif;
                    border: 5px solid #aa0000;
                    min-height: 98.77%;
                }
                
                .email_head {
                    width: 100%;
                    background-color: #fcfcfc;
                    padding: 10px 0;
                }
                
                .email_head a {
                    width: auto;
                }
                
                .email_head a img {
                    width: 10%;
                    display: block;
                    margin: auto;
                }
                
                .email_body {
                    width: 70%;
                    margin: 20px auto;
                }
                
                .email_body h1 {
                    font-size: 16px;
                    color: #333232;
                }
                
                .email_body p {
                    font-size: 14px;
                    text-align: center;
                    color: #333232;
                }
                
                .email_body p a {
                    color: #aa0000;
                }
                
                .email_footer p {
                    font-size: 12px;
                    text-align: center;
                    color: #333232;
                }
                
                .email_footer {
                    width: 70%;
                    margin: auto;
                }
                
                a {
                    text-decoration: none;
                }
                
                #login {
                    background: #aa0000;
                    color: #fff;
                    text-align: center;
                    width: 25%;
                    margin: 0 37.5%;
                    padding: 5px;
                    border-radius: 24px;
                    border: 1px solid #aa0000;
                }
                
                #login:hover {
                    background: #fff;
                    color: #aa0000;
                    border: 1px solid #aa0000;
                }
                
                #copy {
                    font-size: 10px;
                    text-align: center;
                    background: #aa0000;
                    color: #fff;
                }
                
                #six {
                    color: #aa0000;
                }
                
                #six:hover {
                    text-decoration: underline;
                    cursor: pointer;
                }
                
                #team {
                    color: #aa0000;
                }
                
                ul {
                    list-style: none;
                    text-align: center;
                    padding: 0;
                    margin: 0;
                }
                
                ul li {
                    display: inline-block;
                }
                
                ul li a p {
                    color: #aa0000;
                }
                
                ul li a p:hover {
                    cursor: pointer;
                    text-decoration: underline
                }
    
                .image {
                    width: 35px;
                }
    
                video {
                    display: block;
                    margin: 0 auto;
                    width: 50%;
                }
            </style>
        </head>
    
        <body>
            <div class="email_head">
                <a href="https://nxtdrop.com"><img src="https://nxtdrop.com/img/nxtdroplogo.png" alt="NXTDROP, INC." title="NXTDROP, Inc."></a>
            </div>
    
            <div class="email_body">
                <h1>Dear '.$row['first_name'].',</h1>
                <p>You have unread messages in your inbox. Login RIGHT NOW on <a href="https://nxtdrop.com/login_signup">nxtdrop.com</a> and check what is going on. Smile! You are on the way to close a new deal. Thank you for using NXTDROP.</p>
                
                <p>Best,</p>
                <p id="team">Team NXTDROP</p><br>
                <a href="https://nxtdrop.com/login_signup"><p id="login" title="Login To Your Account">Go to Inbox!!!</p></a><br>
            </div>
    
            <div class="email_footer">
                <p>We are looking forward to bring a better and safer experience. Thank you for joining us in this journey.</p>
                <p id="six" title="Toronto, Ontario, Canada">Love from the 6IX</p>
                <ul>
                    <li><p><a href="https://www.instagram.com/nxtdrop/"><img class="image" src="https://nxtdrop.com/img/instagram.png" title="Instagram"/></a></p></li>
                    <li><p><a href="https://www.twitter.com/nxtdrop/"><img class="image" src="https://nxtdrop.com/img/twitter.png" title="Twitter"/></a></p></li>
                </ul>
                    
                <ul>
                    <li><a href="https://nxtdrop.com/unsubscribe.php?email='.$row['email'].'"><p title="Unsusbcribe"> Unsuscribe </p></a></li>
                    <li><a href="https://nxtdrop.com/terms"><p title="Terms of Use"> Terms of Use </p></a></li>
                    <li><a href="https://nxtdrop.com/privacy"><p title="Privacy Policy"> Privacy Policy </p></a></li>
                    <li><a href="https://nxtdrop.com/login_signup"><p title="Login"> Sign Up </p></a></li>
                </ul>
                <p id="copy">&copy; 2018 NXTDROP, INC. All rights reserved.</p>
            </div>
        </body>
    </html>';

        if (mail($to, $subject, $message, $headers)) {
            echo 'Email Sent to '.$to.'';
            echo '</br>';
        }
        else {
            echo 'Error!';
            echo '</br>';
        }
    }
?>