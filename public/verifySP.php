<?php




        if(isset($_POST['spcode']) && isset($_POST['password']))
        {

                $spcode = $_POST['spcode'];
                $password = $_POST['password'];

                //Verify Validity from Server

                $db = mysqli_connect('127.0.0.1','root','','cdh_health_db'); 
                $sql = "SELECT * FROM tbl_health_facility_info WHERE Facility_Reg_No = '$spcode' and Passcode = AES_ENCRYPT('$password','Wisdom')";

                $sth = $db->query($sql);
                if($sth)
                { 
                        $result=mysqli_fetch_array($sth); 
                        $SPName = $result['Facility_Name'];
                        $SPCode = $result['Facility_Reg_No'];
                        $SPType = $result['Facility_Type'];

                        setcookie('SPCode',$SPCode,time() + (86400 * 7)); //Active for 1 day
                        setcookie('SPName',$SPName,time() + (86400 * 7)); //Active for 1 day
                        setcookie('SPType',$SPType,time() + (86400 * 7)); //Active for 1 day

                        echo "Your terminal has been registered with the following configurations; <br>";
                        echo "Service Provider Code : ".$SPCode."<br>";
                        echo "Service Provider Name : ".$SPName."<br>";
                        echo "Service Provider Type : ".$SPType."<br>";
                }
                else
                {
                        echo "Invalid service provider code or password provided!";
                }
        
        }
        else
        { 
                require_once __DIR__.'/getSPCode.php'; 
        }

