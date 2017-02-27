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

                $req=$bdd->prepare("INSERT INTO chats(ChatUserId,ChatText) VALUES(:ChatUserId,:ChatText)");
                $req->execute(array(
                    'ChatUserId'=>$this->getChatUserId(),
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
                    <span class="UserNameS"> <?php echo $Datauser['UserName'];  ?></span><br>
                    <span class="ChatMessageS"><?php echo $DataChat['ChatText']; ?></span><br>
                    <input type="button" value="edit" href="EditChatMessage.php?edit=1" onclick="return confirm('Are you sure want to edit?')" />
                    <input type="button" value="delete" href="DeleteChatMessage.php?delete=1" onclick="return confirm('Are you sure want to delete?')" />
                   <hr>
                    <?php
//                    $new_data = strip_tags($DataChat['ChatText'], '<a><code><i><strike><strong>'); //список разрешенных для ввода тегов
//                  if(mb_strlen($DataChat['ChatText']) !== strlen($new_data)){
//                       return exit("<p><span  style='color:red;'>Не используйте запрещенный html!</span><br>Можно использовать как теги только: '<br>' '<a>','<code>','<i>','<strike>','<strong>'. <br>Вернитесь и исправьте свою ошибку <a href='javascript:history.go(-1)'>здесь</a>.</p>");
//                   } -->
               }
            }

    }


?>