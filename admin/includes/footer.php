  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          // ['Views',     <?php echo $session->count; ?>],
          ['Photos',      <?php echo Photo::count_all(); ?>],
          ['Users',  <?php echo User::count_all(); ?>],
          ['Comments', <?php echo Comment::count_all(); ?>]
          
        ]);

        var options = {
          title: 'Admin Activities and Statistics',
          backgroundColor: 'transparent',
          // colors:['#337ab7','#5cb85c', '#f0ad4e', '#d9534f'],
          colors:['#5cb85c', '#f0ad4e', '#d9534f'],
         
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript" src="js/dropzone.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</body>

</html>
