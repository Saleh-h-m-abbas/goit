    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">
    <!-- <img src="<?php //if($PageName=='Nested'){echo '../';} ?>Assets/Images/icon.png" width="30" height="30" class="d-inline-block align-top" alt=""> -->
    GoIT
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item <?php if($PageName=='home'){echo 'active';}?>">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php if($PageName=='transaction'){echo 'active';}?>">
        <a class="nav-link" href="transaction.php">Transaction</a>
      </li>
      <li class="nav-item <?php if($PageName=='MontlyFees'){echo 'active';}?>">
        <a class="nav-link" href="MontlyFeesSystem.php">MontlyFees</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="Operations/Auth/logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>