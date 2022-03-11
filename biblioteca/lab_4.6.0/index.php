<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../bootstrap/4.6.0/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="../bootstrap/4.6.0/dist/js/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="../bootstrap/4.6.0/dist/js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="../bootstrap/4.6.0/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
   


    <title>Bienvenidos a la Biblioteca</title>
  </head>
  <body>

  <div class="row">
            <div class="col-12" style="text-align: center;">
                <h1>Bienvenidos a la Biblioteca</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <div class="alert alert-primary" role="alert">
                    Cuenta con bootstrap 4.6.1, jquery 3.5.1 y popper 1.16.1
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <div class="alert alert-primary" role="alert">
                    <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>                    
                    <br>
                    <br>
                    <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="top" data-content="Top popover">
                    Popover on top
                    </button>
                    <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="right" data-content="Right popover">
                    Popover on right
                    </button>
                    <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Bottom popover">
                    Popover on bottom
                    </button>
                    <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="left" data-content="Left popover">
                    Popover on left
                    </button>                    
                </div>
            </div>
        </div>

        <script>
            $( document ).ready(function() {
                $('[data-toggle="popover"]').popover()
            });
        </script>
  </body>
</html>