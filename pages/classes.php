<?php

    class user{
            private $UserId, $UserName, $UserMail, $UserPassword;

            /**
             * @return mixed
             */
            public function getUserId()
            {
                return $this->UserId;
            }

            /**
             * @param mixed $UserId
             */
            public function setUserId($UserId)
            {
                $this->UserId = $UserId;
            }

            /**
             * @return mixed
             */
            public function getUserName()
            {
                return $this->UserName;
            }

            /**
             * @param mixed $UserName
             */
            public function setUserName($UserName)
            {
                $this->UserName = $UserName;
            }

            /**
             * @return mixed
             */
            public function getUserMail()
            {
                return $this->UserMail;
            }

            /**
             * @param mixed $UserMail
             */
            public function setUserMail($UserMail)
            {
                $this->UserMail = $UserMail;
            }

            /**
             * @return mixed
             */
            public function getUserPassword()
            {
                return $this->UserPassword;
            }

            /**
             * @param mixed $UserPassword
             */
            public function setUserPassword($UserPassword)
            {
                $this->UserPassword = $UserPassword;
            }


            public function InsertUser()
            {
                include "conn.php";
                $req = $bdd->prepare("INSERT INTO users(UserName,UserMail,UserPassword) VALUES(:UserName,:UserMail,:UserPassword ) ");

                $req->execute(array(
                    'UserName' => $this->getUserName(),
                    'UserMail' => $this->getUserMail(),
                    'UserPassword' => $this->getUserPassword()
                ));
            }


            public function Userlogin(){
                include "conn.php";
                $req=$bdd->prepare("SELECT * FROM users WHERE UserMail=:UserMail AND UserPassword=:UserPassword");

                $req->execute(array(
                   'UserMail'=>$this->getUserMail(),
                    'UserPassword'=>$this->getUserPassword()
                ));
                if($req->rowCount()==0){
                    header("Location: ../index.php?error=1");
                    return false;
                } else{
                    while($data=$req->fetch()){
                        $this->setUserId($data['UserId']);
                        $this->setUserName($data['UserName']);
                        $this->setUserPassword($data['UserPassword']);
                        $this->setUserMail($data['UserMail']);
                        header("Location: Home.php");
                        return true;
                    }
                }
            }


    }

    class chat{
            private $ChatId,$ChatUserId,$ChatText;

            public function getChatId(){
                return $this->ChatId;
            }
            public function setChatId($ChatId){
                $this->ChatId = $ChatId;
            }
            public function getChatUserId(){
                return $this->ChatUserId;
            }
            public function setChatUserId($ChatUserId){
                $this->ChatUserId = $ChatUserId;
            }
            public function getChatText(){
                return $this->ChatText;
            }
            public function setChatText($ChatText){
                $this->ChatText = $ChatText;
            }


            public function InsertChatMessage(){
                include "conn.php";

                $req=$bdd->prepare("INSERT INTO chats(ChatText) VALUES(:ChatUserId,:ChatText)");
                $req->execute(array(
                    'ChatUserId'=>$this->getChatUserId(),
                    'ChatText'=>$this->getChatText()
                ));
            }

            public function EditChatMessage(){
                include "conn.php";

                $req=$bdd->prepare("INSERT INTO chats(ChatText) VALUES(:ChatText)");
                $req->execute(array(
                    'ChatText'=>$this->getChatText()
                ));
            }

            public function DeleteChatMessage(){
                include "conn.php";

                $req=$bdd->prepare("INSERT INTO chats(ChatText) VALUES(:ChatText)");
                $req->execute(array(
                    'ChatText'=>$this->getChatText()
                ));
            }


            public function DisplayMessage(){
                include "conn.php";

                $ChatReg=$bdd->prepare("SELECT * FROM chats ORDER BY ChatId DESC");
                $ChatReg->execute();

               while($DataChat = $ChatReg->fetch()){
                   $UserReq=$bdd->prepare("SELECT * FROM users WHERE UserId=:UserId");
                   $UserReq->execute(array(
                      'UserId'=>$DataChat['ChatUserId']
                   ));
                   $Datauser = $UserReq->fetch();
                   ?>
                    <div>
                        <span class="UserNameS"> <?php echo $Datauser['UserName'];  ?></span><br>
                        <span class="ChatMessageS"><?php echo $DataChat['ChatText']; ?></span><br>

                        <a href="EditChatMessage.php?edit=1">Edit</a>
                        <a href="DeleteChatMessage.php?delete=1">Delete</a>
                        <hr>
                    </div>

                    <?php
               }
            }




    }


?>