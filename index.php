<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- tittle  -->
    <title>Crud App</title>

    <!-- Bootstrap-css-link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Datatables-css-link  -->
     <link rel="stylesheet" href="//cdn.datatables.net/2.1.0/css/dataTables.dataTables.min.css">

     <!-- jquery-cdn  -->
     <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

    <!-- php  -->
    <?php
    include("Db.php");  
    $insert = false;  

    // $SQL = "CREATE DATABASE `CRUDAPP`";
    // $result = mysqli_query($connection,$SQL);
    
    // if($result){
    //     echo " Create database is succesfully";
    // } 
    // else{
    //     echo "Create database is Not created succesfully";
    // }

    // insert the data on click the button 
    
    if($_SERVER["REQUEST_METHOD"] == 'POST'){

      $Tittle = $_POST["Notes"];
      $Description = $_POST["desc"];

      $SQL = "INSERT INTO `inotes`(`Tittle`,`Description`)VALUES('$Tittle','$Description')"; 
      $result = mysqli_query($connection,$SQL);

      if($result){
        $insert = true;
      }
      else{
        echo "Insert data not succesfull";
      }
    }

    ?>
    
  </head>
  <body>

    <!-- Edit-modal  -->
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
          Edit Modal
        </button>  -->

        <!-- Modal -->
        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit this Note</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form  -->
                <form action="/CRUDAPP/index.php" method="POST">
                <div class="container my-4">
                <h2>Add A Note</h2>
                <div class="mb-3">
                  <label for="notetittle" class="form-label">Note Tittle</label>
                  <input type="text" class="form-control" id="titleEdit"  name="Notes" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="Description" class="form-label">Note Description</label>
                  <textarea class="form-control" id="DescEdit" name="descEdit" rows="3"></textarea>
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary mb-3">Add Note</button>
                </div>    
              </div>
              </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>







    <!-- Navbar  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">iNotes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Contact Us</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

    <!-- alert  -->

    <?php
    
    if($insert){  
        echo "<div class='alert alert-success  alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been inserted succesfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    ?>

      <!-- Form  -->
       <form action="/CRUDAPP/index.php" method="POST">
       <div class="container my-4">
       <h2>Add A Note</h2>
      <div class="mb-3">
        <label for="notetittle" class="form-label">Note Tittle</label>
        <input type="text" class="form-control" id="Notes"  name="Notes" placeholder="">
      </div>
      <div class="mb-3">
        <label for="Description" class="form-label">Note Description</label>
        <textarea class="form-control" id="Desc" name="desc" rows="3"></textarea>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Add Note</button>
      </div>    
    </div>
    </form>

    
    <!-- table  -->

    <div class="container my-6">
        <table class="table" id="myTable">
            <thead>
              <tr>
                <th scope="col">S.No</th>
                <th scope="col">Tittle</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            
            <tbody>

        

              <!-- php  -->

              <?php
              $SQL = "SELECT * FROM `inotes`";
              $RESULT = mysqli_query($connection,$SQL);
              $Sno = 0;
              while($row = mysqli_fetch_assoc($RESULT)){
              $Sno = $Sno + 1;
                echo "
                    <tr>
                    <th scope='row'>". $Sno ."</th>
                    <td>".$row['Tittle']."</td>
                    <td>".$row['Description']."</td>
                    <td><button class='btn btn-primary edit' type='button'>Edit</button> <button class='btn btn-danger delete' type='button'>Delete</button></td>
                    </tr>
                ";
              }
              ?>
              
            </tbody>
          </table>
    </div>














    <!-- Bootstrap-js-link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- Datatables-js-link  -->
    <script src="//cdn.datatables.net/2.1.0/js/dataTables.min.js"></script>

    <!-- Datatable-js-work  -->
     <script>
      let table = new DataTable('#myTable');
     </script>


     <!-- Edit-&-Delete-button-js  -->

      <script>
        let edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) =>{
          element.addEventListener('click', (e) =>{
            // console.log("clicked hora he")
             console.log("edit " , e);
             tr = e.target.parentNode.parentNode;
             Tittle = tr.getElementsByTagName("td")[0].innerText;
             Description = tr.getElementsByTagName("td")[1].innerText;
             console.log(Tittle, Description);
             titleEdit.value = Tittle;
             DescEdit.value = Description;
             $('#EditModal').modal('toggle');
          })
        })
 </script>     
  </body>
</html>
 