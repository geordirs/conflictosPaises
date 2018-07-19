<?php
  extract($_GET);
  require_once("sparqllib.php")
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Wanderer a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    
    <title>Conflictos</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- map -->
    <link href="css/map.css" rel="stylesheet">


    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/grayscale2.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHWf9l3eJTqw-BdHphaypiM3goFikqQTo"></script>

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Conflictos entre Países</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="dates.php">Dates</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="map.php">Map</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="report.php">Reports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="search.php">Searchs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
    
    </header>

    <!-- About Section -->
    <section id="about" class="about-section text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto">
            <h2 class="text-white mb-4">Reports about Siria</h2>
            <p class="text-white-50">Reportes de la guerra civil de <a href="https://www.unicef.es/causas/emergencias/conflicto-en-siria">Siria</a></p>
          </div>
        </div>
      </div>
    </section>

  <!-- Reports Section -->
  <section id="report">
    <div class="container">
      <div class="row">
        <h4>Seleccione Reporte   -</h4>
        <form method="POST">
          <select class="form-control" action="action" name="txtType" class="select" method="POST" onchange="this.form.submit();" style="width:300px">
            <option selected="">Seleccione</option>
            <option value="fa">Fallecidos</option>
            <option value="det">Detenidos</option>
            <option value="des">Desaparecidos</option>
            
          </select>
        </form>
      </div>
    </div>
        <div class="col-lg-12 mx-auto">
          <div class="panel-body">
             <div class="col-lg-12 mx-auto">
               <?php

                if (isset($_POST['txtType'])) {
                if ( $_POST['txtType'] == 'fa' ){
                        $dataFal = sparql_get( 
                      "http://localhost:8890/sparql","
                      PREFIX dbo: <http://dbpedia.org/ontology/>

              select ?n ?g ?l ?c ?f ?d where{
              ?s <http://xmlns.com/foaf/0.1/name> ?n.
              ?s <http://xmlns.com/foaf/0.1/gender> ?g.
              ?s <http://conflictosiria.com/schema/livedIn> ?p.
              ?p dbo:province ?l.
              ?s <http://conflictosiria.com/schema/registeredIn> ?r.
              ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type>  <http://conflictosiria.com/schema/Decease>.
              ?r <http://conflictosiria.com/schema/citizenType> ?c.
              ?r <http://dbpedia.org/ontology/deathDate> ?f.
              ?r <http://conflictosiria.com/schema/deathCause> ?d.
              }
                 " );
                  echo "<h4>FALLECIMIENTOS</h4>";
                                    
                  echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                  echo  "<thead class='thead-default'>";
                  echo  "<tr>";                              
                  echo  "<th>Nombre</th>";
                  echo  "<th>Genero</th>";
                  echo  "<th>Gobernacion</th>";
                  echo  "<th>Estado</th>";
                  echo  "<th>Fecha Muerte</th>";
                  echo  "<th>Causa</th>";
                                                      
                  echo  "</tr>";
                  echo  "</thead>";
                  echo "<tbody>";
                                            
                  foreach( $dataFal as $row )
                  {
                    echo  "<tr>";
                    foreach( $dataFal->fields() as $field )
                    {
                                               
                      echo  "<td>$row[$field]</td>";    
                    }
                      echo  "</tr>";
                  }
                  
                  echo "</tbody>";
                  echo  "</table>";   
                                              

                  } elseif ( $_POST['txtType'] == 'det' ){
                    $dataDet = sparql_get( 
                      "http://localhost:8890/sparql","
                      PREFIX dbo: <http://dbpedia.org/ontology/>
                  select ?n ?g ?f ?l ?c where{
                  ?s <http://xmlns.com/foaf/0.1/name> ?n.
                  ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                  ?s <http://conflictosiria.com/schema/livedIn> ?p.
                  ?p dbo:province ?l.
                  ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                  ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://conflictosiria.com/schema/Detention>.
                  ?r <http://dbpedia.org/ontology/arrestDate> ?f.
                  ?r <http://conflictosiria.com/schema/criminalRecord> ?c.
                  }
                      " );
                    echo "<h4>DETENCIONES</h4>";
                                              
                    echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
                    echo  "<thead class='thead-default'>";
                    echo  "<tr>";                              
                    echo  "<th>Nombre</th>";
                    echo  "<th>Genero</th>";
                    echo  "<th>Fecha Detencion</th>";
                    echo  "<th>Governacion</th>";
                    echo  "<th>Antecedentes</th>";                                
                    echo  "</tr>";
                    echo  "</thead>";
                    echo "<tbody>";
                                            
                      foreach( $dataDet as $row )
                      {
                        echo  "<tr>";
                        foreach( $dataDet-> fields() as $field )
                        {                            
                          echo  "<td>".$row[utf8_encode($field)]."</td>";    
                        }
                          echo  "</tr>";
                      }
                        echo "</tbody>";
                        echo  "</table>";

                  } elseif ( $_POST['txtType'] == 'des' ){
                        
                    $dataDes = sparql_get( 
                      "http://localhost:8890/sparql","
                      PREFIX dbo: <http://dbpedia.org/ontology/> 
                  select ?n ?g ?f ?e ?l where{
                  ?s <http://xmlns.com/foaf/0.1/name> ?n.
                  ?s <http://conflictosiria.com/schema/registeredIn> ?r.
                  ?s <http://xmlns.com/foaf/0.1/gender> ?g.
                  ?s <http://conflictosiria.com/schema/livedIn> ?p.
                  ?p dbo:province ?l.
                  ?r <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://conflictosiria.com/schema/Disapperance>.
                  ?r <http://conflictosiria.com/schema/disapperanceDate> ?f.
                  ?r <http://conflictosiria.com/schema/foundDate> ?e.
                  }
                      " );
                    echo "<h4>DESAPARICIONES</h4>";
                     
                    echo  "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";

                    echo  "<thead class='thead-default'>";
                    echo  "<tr>";                              
                    echo  "<th>Nombre</th>";
                    echo  "<th>Genero</th>";
                    echo  "<th>Fecha Desaparecido</th>";
                    echo  "<th>Fecha Encontrado</th>";
                    echo  "<th>Gobernacion</th>";
                                                      
                    echo  "</tr>";
                    echo  "</thead>";
                    echo "<tbody>";
                                            
                    foreach( $dataDes as $row )
                    {
                      echo  "<tr>";
                      foreach( $dataDes->fields() as $field )
                      {
                                               
                          echo  "<td>$row[$field]</td>";    
                      }
                        echo  "</tr>";
                    }
                      echo "</tbody>";
                      echo  "</table>";

                 }
                }

              ?>
             </div> 
            
      </div>
      
    </div>
    
  </section>

   
       

   

    <!-- Signup Section -->
    <section id="signup" class="signup-section">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 mx-auto text-center">

            <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
            <h2 class="text-white mb-5">Subscribe to receive updates!</h2>

            <form class="form-inline d-flex">
              <input type="email" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" placeholder="Enter email address...">
              <button type="submit" class="btn btn-primary mx-auto">Subscribe</button>
            </form>

          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section bg-black">
      <div class="container">

        <div class="row">

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Address</h4>
                <hr class="my-4">
                <div class="small text-black-50">4923 Market Street, Orlando FL</div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-envelope text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Email</h4>
                <hr class="my-4">
                <div class="small text-black-50">
                  <a href="#">hello@yourdomain.com</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Phone</h4>
                <hr class="my-4">
                <div class="small text-black-50">+1 (555) 902-8832</div>
              </div>
            </div>
          </div>
        </div>

        <div class="social d-flex justify-content-center">
          <a href="#" class="mx-2">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="mx-2">
            <i class="fab fa-github"></i>
          </a>
        </div>

      </div>
    </section>

    <script>
      var dataSet = [
        [ "Tiger Nixon", "System Architect", "Edinburgh", "5421", "2011/04/25", "$320,800" ],
        [ "Garrett Winters", "Accountant", "Tokyo", "8422", "2011/07/25", "$170,750" ],
        [ "Ashton Cox", "Junior Technical Author", "San Francisco", "1562", "2009/01/12", "$86,000" ],
        [ "Cedric Kelly", "Senior Javascript Developer", "Edinburgh", "6224", "2012/03/29", "$433,060" ],
        [ "Airi Satou", "Accountant", "Tokyo", "5407", "2008/11/28", "$162,700" ],
        [ "Brielle Williamson", "Integration Specialist", "New York", "4804", "2012/12/02", "$372,000" ],
        [ "Herrod Chandler", "Sales Assistant", "San Francisco", "9608", "2012/08/06", "$137,500" ],
        [ "Rhona Davidson", "Integration Specialist", "Tokyo", "6200", "2010/10/14", "$327,900" ],
        [ "Colleen Hurst", "Javascript Developer", "San Francisco", "2360", "2009/09/15", "$205,500" ],
        [ "Sonya Frost", "Software Engineer", "Edinburgh", "1667", "2008/12/13", "$103,600" ],
        [ "Jena Gaines", "Office Manager", "London", "3814", "2008/12/19", "$90,560" ],
        [ "Quinn Flynn", "Support Lead", "Edinburgh", "9497", "2013/03/03", "$342,000" ],
        [ "Charde Marshall", "Regional Director", "San Francisco", "6741", "2008/10/16", "$470,600" ],
        [ "Haley Kennedy", "Senior Marketing Designer", "London", "3597", "2012/12/18", "$313,500" ],
        [ "Tatyana Fitzpatrick", "Regional Director", "London", "1965", "2010/03/17", "$385,750" ],
        [ "Michael Silva", "Marketing Designer", "London", "1581", "2012/11/27", "$198,500" ],
        [ "Paul Byrd", "Chief Financial Officer (CFO)", "New York", "3059", "2010/06/09", "$725,000" ],
        [ "Gloria Little", "Systems Administrator", "New York", "1721", "2009/04/10", "$237,500" ],
        [ "Bradley Greer", "Software Engineer", "London", "2558", "2012/10/13", "$132,000" ],
        [ "Dai Rios", "Personnel Lead", "Edinburgh", "2290", "2012/09/26", "$217,500" ],
        [ "Jenette Caldwell", "Development Lead", "New York", "1937", "2011/09/03", "$345,000" ],
        [ "Yuri Berry", "Chief Marketing Officer (CMO)", "New York", "6154", "2009/06/25", "$675,000" ],
        [ "Caesar Vance", "Pre-Sales Support", "New York", "8330", "2011/12/12", "$106,450" ],
        [ "Doris Wilder", "Sales Assistant", "Sidney", "3023", "2010/09/20", "$85,600" ],
        [ "Angelica Ramos", "Chief Executive Officer (CEO)", "London", "5797", "2009/10/09", "$1,200,000" ],
        [ "Gavin Joyce", "Developer", "Edinburgh", "8822", "2010/12/22", "$92,575" ],
        [ "Jennifer Chang", "Regional Director", "Singapore", "9239", "2010/11/14", "$357,650" ],
        [ "Brenden Wagner", "Software Engineer", "San Francisco", "1314", "2011/06/07", "$206,850" ],
        [ "Fiona Green", "Chief Operating Officer (COO)", "San Francisco", "2947", "2010/03/11", "$850,000" ],
        [ "Shou Itou", "Regional Marketing", "Tokyo", "8899", "2011/08/14", "$163,000" ],
        [ "Michelle House", "Integration Specialist", "Sidney", "2769", "2011/06/02", "$95,400" ],
        [ "Suki Burks", "Developer", "London", "6832", "2009/10/22", "$114,500" ],
        [ "Prescott Bartlett", "Technical Author", "London", "3606", "2011/05/07", "$145,000" ],
        [ "Gavin Cortez", "Team Leader", "San Francisco", "2860", "2008/10/26", "$235,500" ],
        [ "Martena Mccray", "Post-Sales support", "Edinburgh", "8240", "2011/03/09", "$324,050" ],
        [ "Unity Butler", "Marketing Designer", "San Francisco", "5384", "2009/12/09", "$85,675" ]
    ];
     
    $(document).ready(function() {
        $('#example').DataTable( {
            data: dataSet,
            columns: [
                { title: "Name" },
                { title: "Position" },
                { title: "Office" },
                { title: "Extn." },
                { title: "Start date" },
                { title: "Salary" }
            ]
        } );
    } );
  </script>



    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
      <div class="container">
        Copyright &copy; Your Website 2018
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/font-awesome/js/all.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.min.js"></script>

    <script src="js/table.js"></script>
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>

    <script src="vendor/datatables/dataTables.bootstrap.js"></script>
    <link href="vendor/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

  </body>

</html>
