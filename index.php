<?php

include "core/config.php";

$aa=array('-','+','*'); 
$a=rand(5,10);
$b=$aa[rand(0,2)];
$c=rand(0,5);


if($b=='-'){
$total=$a-$c;
}else if($b=='+'){
  $total=$a+$c;
}else if($b=='*'){
  $total=$a*$c;
}



setcookie('login_calculate',5,strtotime('+1 day'),"/");


?>

<!doctype html>
<html>

<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Kitab Reytinq proyekt v1.0</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <link href=https://pro.fontawesome.com/releases/v5.10.0/css/all.css rel=stylesheet>
  <style>
    ::-webkit-scrollbar {
      width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }

    body {

      background-color: #B3E5FC;

    }


    .card-1 {

      border: none;
      border-radius: 10px;
      width: 100%;
      background-color: #fff;
    }


    .icons i {

      margin-left: 20px;

    }
  </style>
</head>
<center><br><br><br>
  <h4 style="font-weight: bold;">Kitab Reytinq proyekt v1.0</h4>
  <br><br>
 <?php
 if($_GET['code']=='no'){?>
   <div class="alert alert-danger" role="alert">
  Hesablanan kod yalnışıdır !!!
</div>
 <?php }else  if($_GET['login']=='no'){?>
   <div class="alert alert-danger" role="alert">
 Parol yalnışıdır !!!
</div>
 <?php }
 
 
 ?><br>
  <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success" type="button"><i
      class="fas fa-books-medical"></i> Kitab Əlavə et</button>
  <button data-bs-toggle="modal" data-bs-target="#exampleModal_login" class="btn btn-primary" type="button"><i
      class="fal fa-sign-in"></i> Giriş</button>
</center>

<body className='snippet-body'>
  <div class="container mt-5">

    <table class="table table-borderless table-responsive card-1 p-4">

      <thead>

        <tr class="border-bottom">

          <th>
            <span class="ml-2">Kitabın adı</span>
          </th>
          <th>
            <span class="ml-2">Yazarın adı</span>
          </th>
          <th>
            <span class="ml-2">Janr</span>
          </th>
          <th>
            <span class="ml-2">Tarix</span>
          </th>
          <th>
            <span class="ml-4">Reytinq</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
if(isset($_GET['login'])){
  $books = $db->prepare('SELECT * from book where code=:code ');
  $books->execute(array('code'=>$_GET['login']));

}else {
  $books = $db->prepare('SELECT * from book ');
  $books->execute();
}
   

        while ($books_view = $books->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr class="border-bottom">
            <td>
              <div class="p-2">
                <span class="d-block font-weight-bold">
                  <?php echo $books_view['name'] ?>
                </span>

              </div>
            </td>
            <td>
              <div class="p-2 d-flex flex-row align-items-center mb-2">
                <img src="  <?php echo $books_view['img'] ?>" width="40"  >
                <div class="d-flex flex-column ml-2">
                    <span class="d-block font-weight-bold">
                    &nbsp; &nbsp;  <?php echo $books_view['author'] ?>
                  </span>

                </div>
              </div>

            </td>
            <td>
              <div class="p-2">
                <span class="font-weight-bold">
                  <?php echo $books_view['type'] ?>
                </span>
              </div>
            </td>
            <td>
              <div class="p-2 d-flex flex-column">
                <span>
                  <?php echo $books_view['date'] ?>
                </span>

              </div>
            </td>
            <td>
              <div class="p-2 icons">
                <i class="fal fa-star"></i>


                <?php 
                if(isset($_GET['login'])){?>
             
             <i class="fas fa-trash-alt"></i>
                <?php }
                
                ?>
               
              </div>
            </td>
          </tr>
        <?php } ?>








      </tbody>
    </table>




  </div>




  <!-- Əlavə et -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Kitab Əlavə et</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="core/funksiya.php">
            <input type="text" name="name" class="form-control mb-3" placeholder="Kitabın adı">
            <input type="text" name="img" class="form-control mb-3" placeholder="Kitabın şəklinin linki">
            <input type="text" name="author" class="form-control  mb-3" placeholder="Yazarın adı">
            <select name="type" class="form-select mb-3">
              <option style="display:none">Tip seçin</option>
              <option>Dedektiv</option>
              <option>Klassik</option>
              <option>Tarixi</option>
              <option>Aksiyin</option>
              <option>Roman</option>

            </select>
            <input type="date" name="date" class="form-control  mb-3" placeholder="Tarix">

            <input type="password" name="code" class="form-control  mb-3" placeholder="GİRİŞ KODU">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
          <button type="submit" class="btn btn-primary">Yadda saxla</button>
          </form>
        </div>
      </div>
    </div>
  </div>






  <!-- Giris et -->
  <div class="modal fade" id="exampleModal_login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Giriş</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST" action="core/funksiya.php">
          <input type="text" name="login_code" class="form-control" placeholder="Kodun daxil edin">
        
  <div class="input-group mt-3">
<span class="input-group-text">
  
<?php 

echo $a.$b.$c;



?>



</span> 
<input type="text" name="login_calc"   class="form-control">

  </div>     
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
          <button type="submit" class="btn btn-primary">Daxil ol</button>
        </form>
        </div>
      </div>
    </div>
  </div>







  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script type='text/javascript' src='#'></script>
  <script type='text/javascript' src='#'></script>
  <script type='text/javascript' src='#'></script>
  <script type='text/javascript'>#</script>
  <script type='text/javascript'>var myLink = document.querySelector('a[href="#"]');
    myLink.addEventListener('click', function (e) {
      e.preventDefault();
    });</script>

</body>

</html>