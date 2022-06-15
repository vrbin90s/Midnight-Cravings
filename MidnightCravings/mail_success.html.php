<html>
  <head>
    <?php include 'admin/includes/head.inc.html.php'; ?>
    <script type="text/javascript" src="assets/js/js.js"></script>
    <meta http-equiv = "refresh" content = "20; url = ./" />
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
    <body>
      <div class="card">
      <div class="img-circle">
        <div>
                  <i class="far fa-envelope-open"></i>
        </div>

      </div>
        <h1 class="text-uppercase">Thank you</h1> 
        <p>Your message has been successfully sent. <br/> We will contact you very soon!</p>
        <form method="get" action="./">
        <button type="submit" class="btn btn-outline-dark btn-lg text-uppercase rounded-0 mt-4 back_button"><i class="fas fa-chevron-left"></i>Back</button><br />
        </form>
        <small class="pt-4">Page will redirect automaticly in 20 seconds.</small>
      </div>
      <?php include 'admin/includes/scripts.inc.html.php'; ?>
    </body>
</html>