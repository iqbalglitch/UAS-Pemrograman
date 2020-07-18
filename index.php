<?php

    //memulai session
    session_start();

    //jika ada session, maka akan diarahkan ke halaman dashboard admin
    if(isset($_SESSION['id_user'])){

        //mengarahkan ke halaman dashboard admin
        header("Location: ./admin.php");
        die();
    }

    //mengincludekan koneksi database
    include "koneksi.php";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Aplikasi Pemesanan Makanan</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<style>
		body {
       background: -webkit-linear-gradient(bottom, 	#008080, 	#40E0D0);
       background-repeat: no-repeat;
}

		#card {
        background: #fbfbfb;
        border-radius: 8px;
        box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
        height: 410px;
        margin: 6rem auto 8.1rem auto;
        width: 329px;}

	    #card-content {
	      padding: 10px 20px;
			}
			#card-title {
	      font-family: "Raleway Thin", sans-serif;
	      letter-spacing: 2px;
	      padding-bottom: 35px;
	      padding-top: 13px;
	      text-align: center;
			}
			.underline-title {
	      background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
	      height: 2px;
	      margin: -1.1rem auto 0 auto;
	      width: 200px; 
			}

		a {
		    text-decoration: none;
		}
		label {
		    font-family: "Raleway", sans-serif;
		    font-size: 11pt;
		}
		#forgot-pass {
		    color: #2dbd6e;
		    font-family: "Raleway", sans-serif;
		    font-size: 10pt;
		    margin-top: 3px;
		    text-align: right;
		}
		.form {
		    align-items: left;
		    display: flex;
		    flex-direction: column;
		}
		.form-border {
		    background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
		    height: 1px;
		    width: 100%;
		}
		.form-content {
		    background: #fbfbfb;
		    border: none;
		    outline: none;
		    padding-top: 14px;
		}

		#signup {
	    color: #2dbd6e;
	    font-family: "Raleway", sans-serif;
	    font-size: 10pt;
	    margin-top: 16px;
			    text-align: center;
			}
		#submit-btn {
		    background: -webkit-linear-gradient(right, #a6f77b, #2dbd6e);
		    border: none;
		    border-radius: 21px;
		    box-shadow: 0px 1px 8px #24c64f;
		    cursor: pointer;
		    color: white;
		    font-family: "Raleway SemiBold", sans-serif;
		    height: 42.3px;
		    margin: 0 auto;
		    margin-top: 50px;
		    transition: 0.25s;
		    width: 153px;
		}
		#submit-btn:hover {
		    box-shadow: 0px 1px 18px #24c64f;
		}


    </style>

        

</head>
<body>
	<div id="card"> 
    <div class="container">
	
		<div id="card-content">
			  <div id="card-title">
			    <h2>LOGIN ADMIN<br></h2>
			    <div class="underline-title"></div>
			  </div>
		</div>

		<?php

    //apabila tombol login di klik akan menjalankan skript dibawah ini
	if( isset( $_REQUEST['login'] ) ){

        //mendeklarasikan data yang akan dimasukkan ke dalam database
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];

        //skript query ke insert data ke dalam database
		$sql = mysqli_query($koneksi, "SELECT id_user, username, nama, level FROM user WHERE username='$username' AND password=MD5('$password')");

        //jika skript query benar maka akan membuat session
		if( $sql){
			list($id_user, $username, $nama, $level) = mysqli_fetch_array($sql);

            //membuat session
            $_SESSION['id_user'] = $id_user;
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $nama;
			$_SESSION['level'] = $level;

			header("Location: ./admin.php");
			die();
		} else {

			$_SESSION['err'] = '<strong>ERROR!</strong> Username dan Password tidak ditemukan.';
			header('Location: ./');
			die();
		}

	} else {
	?>
      <form class="form" method="post" action="" role="form">
		<?php
		if(isset($_SESSION['err'])){
			$err = $_SESSION['err'];
			echo '<div class="alert alert-warning alert-message">'.$err.'</div>';
            unset($_SESSION['err']);
		}
		?>

		<label for="user-email" style="padding-top:13px">&nbsp;Username</label>
        	<input autocomplete="on"  id="user-email" type="text" name="username" class="form-content" placeholder="Username" required autofocus>  <div class="form-border"></div>

        <label for="user-password" style="padding-top:22px">&nbsp;Password</label>
        	<input  id="user-password" type="password" name="password" class="form-content" placeholder="Password" required>  <div class="form-border"></div>
        <button id="submit-btn"class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
        
      </form>
	<?php
	}
	?>
    
	</div> 
</div>


	


</body>
</html>